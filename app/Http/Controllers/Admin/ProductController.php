<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $query = Product::with(['category', 'variants'])->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sku',  'like', "%{$search}%")
                    ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        match ($request->input('sort', 'newest')) {
            'oldest'     => $query->reorder()->oldest(),
            'stock_asc'  => $query->reorder()->orderBy('stock'),
            'price_asc'  => $query->reorder()->orderBy(
                ProductVariant::select('price')
                    ->whereColumn('product_id', 'products.id')
                    ->orderBy('price')
                    ->limit(1)
            ),
            'price_desc' => $query->reorder()->orderByDesc(
                ProductVariant::select('price')
                    ->whereColumn('product_id', 'products.id')
                    ->orderByDesc('price')
                    ->limit(1)
            ),
            default => null,
        };

        $products = $query->paginate(10)->withQueryString();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $sizes      = Size::orderBy('name')->get();
        $colors     = Color::orderBy('name')->get();
        return view('admin.products.create', compact('categories', 'sizes', 'colors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'tags'        => 'nullable|string|max:500',
            'sku'         => 'required|string|max:100|unique:products,sku',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:active,draft,inactive',
            'main_image'  => 'nullable|image|max:2048',
            'gallery'     => 'nullable|array',
            'gallery.*'   => 'nullable|file|max:51200|mimetypes:image/jpeg,image/png,image/webp,image/gif,video/mp4,video/webm,video/ogg',
            // variants
            'variants'           => 'nullable|array',
            'variants.*.size_id'  => 'nullable|exists:sizes,id',
            'variants.*.color_id' => 'nullable|exists:colors,id',
            'variants.*.price'    => 'required_with:variants|numeric|min:0',

            // SEO
            'meta_title'       => $validated['meta_title']       ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords'    => $validated['meta_keywords']    ?? null,
            'og_image'         => $validated['og_image']         ?? null,
        ]);

        try {
            // Main image
            $mainImagePath = null;
            if ($request->hasFile('main_image')) {
                $mainImagePath = $request->file('main_image')
                    ->store('products/main', 'public');
            }

            $product = Product::create([
                'name'        => $validated['name'],
                'description' => $validated['description'] ?? null,
                'tags'        => $validated['tags'] ?? null,
                'sku'         => $validated['sku'],
                'stock'       => $validated['stock'],
                'category_id' => $validated['category_id'],
                'status'      => $validated['status'],
                'main_image'  => $mainImagePath,

                'meta_title'       => $validated['meta_title']       ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords'    => $validated['meta_keywords']    ?? null,
                'og_image'         => $validated['og_image']         ?? null,
            ]);

            // Gallery images + video
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $mime    = $file->getMimeType();
                    $isVideo = str_starts_with($mime, 'video/');

                    $folder = $isVideo ? 'products/videos' : 'products/gallery';
                    $path   = $file->store($folder, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $path,
                        'type'       => $isVideo ? 'video' : 'image',
                    ]);
                }
            }

            // Variants
            if (!empty($validated['variants'])) {
                foreach ($validated['variants'] as $variant) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'size_id'    => $variant['size_id']  ?? null,
                        'color_id'   => $variant['color_id'] ?? null,
                        'price'      => $variant['price'],
                    ]);
                }
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $product = Product::with(['category', 'images', 'variants.size', 'variants.color'])
            ->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product    = Product::with(['images', 'variants'])->findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $sizes      = Size::orderBy('name')->get();
        $colors     = Color::orderBy('name')->get();

        $existingVariants = $product->variants->map(fn($v) => [
            'size_id'  => $v->size_id,
            'color_id' => $v->color_id,
            'price'    => $v->price,
        ])->values()->toArray();

        return view('admin.products.edit', compact(
            'product',
            'categories',
            'sizes',
            'colors',
            'existingVariants'
        ));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'tags'                => 'nullable|string|max:500',
            'sku'                 => 'required|string|max:100|unique:products,sku,' . $id,
            'stock'               => 'required|integer|min:0',
            'category_id'         => 'required|exists:categories,id',
            'status'              => 'required|in:active,draft,inactive',
            'main_image'          => 'nullable|image|max:2048',
            'gallery'             => 'nullable|array',
            'gallery.*'           => 'nullable|file|max:51200|mimetypes:image/jpeg,image/png,image/webp,image/gif,video/mp4,video/webm,video/ogg',
            'delete_images'       => 'nullable|array',
            'delete_images.*'     => 'integer|exists:product_images,id',
            'variants'            => 'nullable|array',
            'variants.*.size_id'  => 'nullable|exists:sizes,id',
            'variants.*.color_id' => 'nullable|exists:colors,id',
            'variants.*.price'    => 'required_with:variants|numeric|min:0',

            // SEO
            'meta_title'       => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords'    => 'nullable|string|max:500',
            'og_image'         => 'nullable|string|max:500',
        ]);

        try {
            // Main image
            if ($request->input('remove_main_image') == '1') {
                if ($product->main_image) {
                    Storage::disk('public')->delete($product->main_image);
                }
                $validated['main_image'] = null;
            } elseif ($request->hasFile('main_image')) {
                if ($product->main_image) {
                    Storage::disk('public')->delete($product->main_image);
                }
                $validated['main_image'] = $request->file('main_image')
                    ->store('products/main', 'public');
            } else {
                unset($validated['main_image']);
            }

            $product->update($validated);

            // Delete selected gallery items
            if (!empty($validated['delete_images'])) {
                $toDelete = ProductImage::whereIn('id', $validated['delete_images'])
                    ->where('product_id', $product->id)
                    ->get();
                foreach ($toDelete as $img) {
                    Storage::disk('public')->delete($img->image);
                    $img->delete();
                }
            }

            // Add new gallery files
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $isVideo = str_starts_with($file->getMimeType(), 'video/');
                    $path    = $file->store($isVideo ? 'products/videos' : 'products/gallery', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $path,
                        'type'       => $isVideo ? 'video' : 'image',
                    ]);
                }
            }

            // Replace variants
            $product->variants()->delete();
            if (!empty($validated['variants'])) {
                foreach ($validated['variants'] as $variant) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'size_id'    => $variant['size_id']  ?? null,
                        'color_id'   => $variant['color_id'] ?? null,
                        'price'      => $variant['price'],
                    ]);
                }
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Delete images from storage
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->image);
            }

            $product->delete();

            return redirect()->route('admin.products.index')
                ->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

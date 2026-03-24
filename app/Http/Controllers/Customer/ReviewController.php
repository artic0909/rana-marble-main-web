<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly submitted review.
     * Route: POST /products/{product}/reviews  →  name: reviews.store
     */
    public function store(Request $request, int $productId)
    {
        $data = $request->validate([
            'rating'        => ['required', 'integer', 'min:1', 'max:5'],
            'name'          => ['required', 'string', 'max:100'],
            'city'          => ['nullable', 'string', 'max:100'],
            'state'         => ['nullable', 'string', 'max:100'],
            'review'        => ['required', 'string', 'min:5', 'max:2000'],
            'reviewMedia'   => ['nullable', 'array', 'max:5'],
            'reviewMedia.*' => ['file', 'mimes:jpeg,jpg,png,webp,gif,mp4,webm', 'max:20480'],
        ]);

        // ── Handle media uploads ──────────────────────────────────────────────
        $mediaPaths = [];

        if ($request->hasFile('reviewMedia')) {
            foreach ($request->file('reviewMedia') as $file) {
                $path = $file->store("reviews/{$productId}", 'public');
                $mediaPaths[] = $path;
            }
        }

        // ── Persist ───────────────────────────────────────────────────────────
        Review::create([
            'product_id'  => $productId,
            'customer_id' => Auth::guard('customer')->id() ?? null,
            'rating'      => $data['rating'],
            'name'        => $data['name'],
            'city'        => $data['city']  ?? null,
            'state'       => $data['state'] ?? null,
            'review'      => $data['review'],
            'media'       => $mediaPaths ?: null,
            'status'      => 'pending',
        ]);

        // ── Redirect back to the review section on the product page ───────────
        return redirect()
            ->back()
            ->with('review_success', 'Thank you! Your review has been submitted for approval.')
            ->withFragment('tab-reviews');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    // ── List all reviews (with optional rating filter) ────────────────────────
    public function index(Request $request)
    {
        $query = Review::with('product')->latest();

        // Filter by rating if selected
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        $reviews = $query->paginate(15);

        return view('admin.reviews.reviews', compact('reviews'));
    }

    // ── Approve ───────────────────────────────────────────────────────────────
    public function approve(Review $review)
    {
        $review->update(['status' => 'approved']);

        return back()->with('success', 'Review approved successfully.');
    }

    // ── Reject ────────────────────────────────────────────────────────────────
    public function reject(Review $review)
    {
        $review->update(['status' => 'rejected']);

        return back()->with('success', 'Review rejected.');
    }

    // ── Delete ────────────────────────────────────────────────────────────────
    public function destroy(Review $review)
    {
        // Also delete media files from storage
        if (!empty($review->media)) {
            foreach ($review->media as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $review->delete();

        return back()->with('success', 'Review deleted.');
    }
}
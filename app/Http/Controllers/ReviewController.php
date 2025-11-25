<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $reviews = Review::latest()->get()->map(function ($review) {
            if ($review->avatar_url) {
                $review->avatar_url = Storage::url($review->avatar_url);
            }

            return $review;
        });

        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'title' => ['nullable', 'string', 'max:120'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'message' => ['required', 'string', 'max:1000'],
            'avatar' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar_url'] = $request->file('avatar')->store('reviews', 'public');
        }

        unset($data['avatar']);

        $review = Review::create($data);

        if ($review->avatar_url) {
            $review->avatar_url = Storage::url($review->avatar_url);
        }

        return response()->json($review, 201);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

    /**
     * Get reviews from Google Maps Place Details API.
     */
    public function google(): JsonResponse
    {
        $placeId = config('services.google.place_id', env('GOOGLE_PLACE_ID'));
        $apiKey = config('services.google.places_api_key', env('GOOGLE_PLACES_API_KEY'));

        if (!$placeId || !$apiKey) {
            return response()->json([
                'message' => 'Google Place ID atau API Key belum diatur.',
            ], 500);
        }

        $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
            'place_id' => $placeId,
            'fields' => 'name,rating,user_ratings_total,reviews',
            'reviews_no_translations' => true,
            'language' => 'id',
            'key' => $apiKey,
        ]);

        if (!$response->ok()) {
            return response()->json([
                'message' => 'Gagal mengambil data dari Google Places.',
                'status' => $response->status(),
            ], 502);
        }

        $payload = $response->json();
        if (($payload['status'] ?? '') !== 'OK') {
            return response()->json([
                'message' => 'Google Places mengembalikan status tidak OK.',
                'google_status' => $payload['status'] ?? null,
                'error_message' => $payload['error_message'] ?? null,
            ], 502);
        }

        $reviews = collect($payload['result']['reviews'] ?? [])->map(function ($review) {
            return [
                'id' => $review['author_url'] ?? $review['author_name'] ?? null,
                'name' => $review['author_name'] ?? 'Anonymous',
                'title' => $review['relative_time_description'] ?? 'Google Reviewer',
                'rating' => $review['rating'] ?? 0,
                'message' => $review['text'] ?? '',
                'avatar_url' => $review['profile_photo_url'] ?? null,
            ];
        });

        return response()->json($reviews);
    }
}

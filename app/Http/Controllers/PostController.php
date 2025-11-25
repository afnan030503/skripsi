<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * GET /posts
     * Return JSON semua post (latest first)
     */
    public function index()
    {
        $posts = Post::latest()->get();

        // Tambahkan full URL gambar supaya gampang dipakai di frontend
        $posts->transform(function ($post) {
            $post->image_url = asset('storage/' . $post->image);
            return $post;
        });

        return response()->json($posts);
    }

    /**
     * POST /posts
     * Store post baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'tag'   => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:50'],
            'color' => ['required', 'string', 'max:50'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:4096'], // max 4MB
        ]);

        if ($request->hasFile('image')) {
            // Simpan di storage/app/public/posts
            $path = $request->file('image')->store('posts', 'public'); // menghasilkan "posts/namafile.jpg"
            $validated['image'] = $path;
        }

        // optional user relationship (nullable)
        $validated['user_id'] = Auth::id();

        $post = Post::create($validated);

        $post->image_url = asset('storage/' . $post->image);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Post created successfully.',
                'post'    => $post,
            ], 201);
        }

        return redirect()->back()->with('status', 'Post created.');
    }
}
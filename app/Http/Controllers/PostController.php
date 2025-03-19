<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(Post::all());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching posts' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPost(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'description' => 'nullable|string|max:1000',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Debug information
            if (!$request->hasFile('image')) {
                return response()->json(['message' => 'No image file found in request'], 400);
            }
    
            // Store the file
            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->hashName();
                
                // Make sure the directory exists
                if (!file_exists(public_path('storage/post_images'))) {
                    mkdir(public_path('storage/post_images'), 0755, true);
                }
                
                $file->move(public_path('storage/post_images'), $filename);
                $imagePath = 'post_images/' . $filename;
            }
            
            // Create the post with the image path
            $post = Post::create([
                'user_id' => $request->user_id,
                'description' => $request->description,
                'image' => $imagePath,
                'likes_count' => 0,
            ]);
    
            return response()->json([
                'message' => 'Post created successfully',
                'post' => $post,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating post: '. $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

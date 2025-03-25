<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function showCreatePost() {
        return view('posts.createPost');
    }

    public function showUpdatePost() {
        return view('posts.updatePost');
    }

    public function showNewsFeed() {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return view('posts.newsFeed', compact('posts'));
    }

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
          
            // Check if the request is properly formatted
            if (!$request->hasFile('image')) {
                return response()->json([
                    'message' => 'No image file found in request',
                    'request_data' => $request->all(),
                    'files' => $request->allFiles(),
                    'content_type' => $request->header('Content-Type')
                ], 400);
            }
            
            // Validate after checking for file existence
            $validated = $request->validate([
                'description' => 'nullable|string|max:1000',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Store the file
            $imagePath = null;
            $file = $request->file('image');
            $filename = $file->hashName();
            // Make sure the directory exists
            if (!file_exists(public_path('storage/post_images'))) {
                mkdir(public_path('storage/post_images'), 0755, true);
            }
            
            $file->move(public_path('storage/post_images'), $filename);
            $imagePath = 'post_images/' . $filename;
            
            // Create the post with the image path and authenticated user ID
            $post = Post::create([
                'user_id' => Auth::id(),
                'description' => $request->description,
                'image' => $imagePath,
                'likes_count' => 0,
            ]);
    
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Post created successfully',
                    'post' => $post,
                ], 201);
            }
            return redirect()->route('newsFeed')->with('success', 'Post created successfully');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Validation error', 
                    'errors' => $e->errors(),
                    'request_data' => $request->all()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Error creating post: '. $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'request_data' => $request->all()
                ], 500);
            }
            return redirect()->back()->with('error', 'Error creating post: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function getOnePost(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePost(Request $request, $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json(['message' => 'Post not found'], 404);
            }

            $validatedData = $request->validate([
                'description' => 'nullable|string|max:1000',
            ]);

            // Only update the description, keep the existing image
            $post->description = $request->description;
            $post->save();
            
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Post updated', 'post' => $post], 200);
            }
            return redirect()->route('newsFeed')->with('success', 'Post updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Error updating post: '. $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Error updating post: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePost($id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json(['message' => 'Post not found'], 404);
            }
            $post->delete();
            
            if (request()->wantsJson()) {
                return response()->json(['message' => 'Post deleted'], 200);
            }
            return redirect()->route('newsFeed')->with('success', 'Post deleted successfully');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['message' => 'Error deleting post: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Error deleting post: ' . $e->getMessage());
        }
    }
}

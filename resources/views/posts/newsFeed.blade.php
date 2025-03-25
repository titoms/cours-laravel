@extends('layouts.app')

@section('title', 'News Feed')

@section('content')
<div class="container mx-auto px-24">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">News Feed</h1>
        <a href="{{ route('createPost') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Create Post
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if(count($posts) > 0)
        <div class="grid grid-cols-1 gap-8">
            @foreach($posts as $post)
                <div class="bg-slate-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-4 border-b border-slate-700 flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            @if($post->user->profile_picture)
                                <img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="{{ $post->user->username }}" class="h-10 w-10 rounded-full object-cover">
                            @else
                                <div class="h-10 w-10 rounded-full bg-slate-600 flex items-center justify-center">
                                    <span class="text-lg font-bold text-white">{{ substr($post->user->username, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold">{{ $post->user->username }}</h3>
                            <p class="text-xs text-slate-400">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        
                        @if($post->user_id === Auth::id())
                            <div class="ml-auto flex">
                                <button type="button" class="edit-post-btn text-blue-400 hover:text-blue-300 mr-3" data-post-id="{{ $post->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </button>
                                <button type="button" class="delete-post-btn text-red-400 hover:text-red-300" data-post-id="{{ $post->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    
                    <div class="relative">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="w-full object-cover max-h-[500px]">
                    </div>
                    
                    <div class="p-4">
                        <div class="flex items-center mb-4">
                            <button class="flex items-center text-slate-400 hover:text-red-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span>{{ $post->likes_count }}</span>
                            </button>
                        </div>
                        
                        <div class="post-description-container" id="post-description-{{ $post->id }}">
                            @if($post->description)
                                <p class="text-slate-200 mb-2 post-description">{{ $post->description }}</p>
                            @else
                                <p class="text-slate-400 italic mb-2 post-description">No description</p>
                            @endif
                        </div>
                        
                        <div class="post-edit-form hidden" id="post-edit-form-{{ $post->id }}">
                            <form action="{{ route('updatePost', $post->id) }}" method="POST" class="edit-post-form">
                                @csrf
                                @method('PUT')
                                <textarea name="description" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 mb-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-200" rows="3">{{ $post->description }}</textarea>
                                <input type="hidden" name="image" value="{{ $post->image }}">
                                <div class="flex justify-end space-x-2">
                                    <button type="button" class="cancel-edit-btn px-3 py-1 bg-slate-600 text-white rounded hover:bg-slate-700 transition-all">Cancel</button>
                                    <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition-all">Save</button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-slate-700">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-3">
                                    @if(Auth::user()->profile_picture)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->username }}" class="h-8 w-8 rounded-full object-cover">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-slate-600 flex items-center justify-center">
                                            <span class="text-sm font-bold text-white">{{ substr(Auth::user()->username, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="text" placeholder="Add a comment..." class="w-full bg-slate-700 border border-slate-600 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-slate-800 rounded-lg shadow-lg p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-slate-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <h2 class="text-xl font-semibold mb-2">No posts yet</h2>
            <p class="text-slate-400 mb-6">Be the first to share a post with your friends!</p>
            <a href="{{ route('createPost') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Create Post
            </a>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-slate-800 rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold mb-4">Delete Post</h3>
        <p class="mb-6 text-slate-300">Are you sure you want to delete this post? This action cannot be undone.</p>
        <div class="flex justify-end space-x-3">
            <button id="cancel-delete" class="px-4 py-2 bg-slate-600 text-white rounded hover:bg-slate-700 transition-all">Cancel</button>
            <form id="delete-post-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-all">Delete</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Delete post functionality
        const deleteModal = document.getElementById('delete-modal');
        const deleteForm = document.getElementById('delete-post-form');
        const cancelDelete = document.getElementById('cancel-delete');
        
        // Show delete modal when delete button is clicked
        document.querySelectorAll('.delete-post-btn').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                deleteForm.action = `/posts/${postId}/delete`;
                deleteForm.method = 'POST';
                
                // Add CSRF token and method spoofing for DELETE
                if (!deleteForm.querySelector('input[name="_token"]')) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    deleteForm.appendChild(csrfInput);
                }
                
                if (!deleteForm.querySelector('input[name="_method"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    deleteForm.appendChild(methodInput);
                }
                
                deleteModal.classList.remove('hidden');
            });
        });
        
        // Hide delete modal when cancel button is clicked
        cancelDelete.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });
        
        // Also hide modal when clicking outside
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                deleteModal.classList.add('hidden');
            }
        });
        
        // Edit post functionality
        document.querySelectorAll('.edit-post-btn').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                const descriptionContainer = document.getElementById(`post-description-${postId}`);
                const editForm = document.getElementById(`post-edit-form-${postId}`);
                
                descriptionContainer.classList.add('hidden');
                editForm.classList.remove('hidden');
            });
        });
        
        // Cancel edit
        document.querySelectorAll('.cancel-edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.post-edit-form');
                const postId = form.action.split('/').slice(-1)[0];
                
                const descriptionContainer = document.getElementById(`post-description-${postId}`);
                const editForm = document.getElementById(`post-edit-form-${postId}`);
                
                descriptionContainer.classList.remove('hidden');
                editForm.classList.add('hidden');
            });
        });
        
        // Handle form submission via AJAX to avoid page reload
        document.querySelectorAll('.edit-post-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const postId = this.action.split('/').slice(-1)[0];
                
                // Add method spoofing for PUT
                formData.append('_method', 'PUT');
                
                // Get CSRF token from meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Simple approach: submit the form normally to refresh the page
                const tempForm = document.createElement('form');
                tempForm.method = 'POST';
                tempForm.action = this.action;
                tempForm.style.display = 'none';
                
                // Add CSRF token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                tempForm.appendChild(csrfInput);
                
                // Add method spoofing
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                tempForm.appendChild(methodInput);
                
                // Add description
                const descInput = document.createElement('input');
                descInput.type = 'hidden';
                descInput.name = 'description';
                descInput.value = formData.get('description');
                tempForm.appendChild(descInput);
                
                // Add to document and submit
                document.body.appendChild(tempForm);
                tempForm.submit();
            });
        });
        
        // Check for success message in session flash data
        // This will be handled by the existing session('success') check in the blade template
    });
</script>
@endsection
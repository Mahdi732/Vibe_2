<!-- resources/views/components/posts.blade.php -->
<div id="posts-container" class="space-y-6">
    @foreach($posts as $post)
      <div class="post-card bg-white rounded-xl shadow-md p-4 transition-colors duration-300">
        <div class="flex items-center space-x-4 mb-4">
          <img src="{{ $post->user->profile_photo_url }}" class="h-10 w-10 rounded-full object-cover" alt="{{ $post->user->name }}">
          <div>
            <h3 class="font-bold text-gray-800">{{ $post->user->name }}</h3>
            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
          </div>
        </div>
        <p class="text-gray-700">{{ $post->content }}</p>
        @if($post->image)
          <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="mt-4 rounded-lg">
        @endif
      </div>
    @endforeach
  </div>
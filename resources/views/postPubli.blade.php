<article class="post-card bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-colors duration-300">
    <div class="p-4">
      <div class="flex justify-between items-center mb-4">
        <div class="flex items-center space-x-3">
          <img src="/api/placeholder/50/50" class="h-10 w-10 rounded-full object-cover" alt="Jessica Williams's profile">
          <div>
            <h3 class="text-gray-800 dark:text-gray-200 font-semibold transition-colors duration-300">{{ $post->user->name }}</h3>
            <p class="text-gray-500 dark:text-gray-400 text-xs transition-colors duration-300">
              <time datetime="2025-02-24T14:00:00Z">{{ $post->created_at }}">{{ $post->created_at->diffForHumans() }}</time>
            </p>
          </div>
        </div>
        <div class="relative">
          <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 focus-visible transition-colors duration-300 post-menu-button" aria-label="Post options" aria-haspopup="true">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
            </svg>
          </button>
          <div class="post-menu hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg z-10 py-1 transition-colors duration-300">
            <button class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-300 focus-visible">Save post</button>
            <button class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-300 focus-visible">Hide post</button>
            <button class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-300 focus-visible">Report</button>
          </div>
        </div>
      </div>
      
      <p class="text-gray-700 dark:text-gray-300 mb-4 transition-colors duration-300">{{ $post->content }}</p>
      @if ($post->image)
      <figure class="mb-4">
          <img src="{{ asset('/storage/' . $post->image) }}" class="w-full h-64 object-cover rounded-lg">
      </figure>
    @endif
      <div class="flex justify-between text-gray-500 dark:text-gray-400 text-sm mb-4 transition-colors duration-300">
        <div class="flex items-center">
          <span class="flex items-center mr-2">
            <span class="inline-block h-5 w-5 rounded-full bg-red-500 flex items-center justify-center text-white text-xs mr-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
            </span>
            <span class="like-count">124</span>
          </span>
          likes
        </div>
        <span>36 comments</span>
      </div>
      
      <div class="flex justify-between pt-3 border-t border-gray-100 dark:border-gray-700 transition-colors duration-300">
        <button class="action-btn like-btn flex items-center text-gray-600 dark:text-gray-300 hover:text-red-500 dark:hover:text-red-400 transition-colors duration-300 focus-visible" aria-label="Like this post">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
          </svg>
          Like
        </button>
        <button class="action-btn comment-btn flex items-center text-gray-600 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400 transition-colors duration-300 focus-visible" aria-label="Comment on this post">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
          </svg>
          Comment
        </button>
        <button class="action-btn share-btn flex items-center text-gray-600 dark:text-gray-300 hover:text-green-500 dark:hover:text-green-400 transition-colors duration-300 focus-visible" aria-label="Share this post">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
          </svg>
          Share
        </button>
      </div>
      
      <!-- Hidden comments section, will be shown when Comment button is clicked -->
      <div class="comments-section hidden mt-4 pt-3 border-t border-gray-100 dark:border-gray-700 transition-colors duration-300">
        <!-- Will be populated dynamically -->
      </div>
    </div>
  </article>

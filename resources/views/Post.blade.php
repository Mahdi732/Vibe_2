<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A modern social media feed with enhanced performance and accessibility">
  <title>Enhanced Social Feed</title>
  <script src="https://unpkg.com/htmx.org@2.0.4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
  <style>
    /* Custom Animations and Transitions */
    .post-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .post-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .action-btn {
      transition: all 0.2s ease;
      position: relative;
    }
    .action-btn:hover {
      transform: scale(1.05);
    }
    .action-btn:active {
      transform: scale(0.95);
    }
    .like-active {
      color: #EF4444;
    }
    .like-active svg {
      fill: #EF4444;
    }
    
    /* Skeleton loading animation */
    @keyframes pulse {
      0%, 100% { opacity: 0.6; }
      50% { opacity: 0.3; }
    }
    .skeleton {
      animation: pulse 1.5s infinite;
      background-color: #e5e7eb;
    }
    
    /* Story indication */
    .story-ring {
      background: conic-gradient(
        from 0deg,
        #7C3AED 0%,
        #EC4899 25%,
        #EF4444 50%,
        #F59E0B 75%,
        #10B981 100%
      );
    }
    
    /* Custom scrollbar for story carousel */
    .story-carousel::-webkit-scrollbar {
      height: 4px;
    }
    .story-carousel::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    .story-carousel::-webkit-scrollbar-thumb {
      background: #6366F1;
      border-radius: 10px;
    }
    
    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
      .dark-mode-toggle svg .sun { opacity: 1; }
      .dark-mode-toggle svg .moon { opacity: 0; }
    }
    
    html.dark .dark-mode-toggle svg .sun { opacity: 0; }
    html.dark .dark-mode-toggle svg .moon { opacity: 1; }
    
    html.dark {
      --bg-primary: #121212;
      --bg-secondary: #1E1E1E;
      --text-primary: #F9FAFB;
      --text-secondary: #9CA3AF;
      --border-color: #374151;
    }
    
    html.dark body {
      background-color: var(--bg-primary);
      color: var(--text-primary);
    }
    
    html.dark .post-card, 
    html.dark .create-post, 
    html.dark .story-inner,
    html.dark .comment-input {
      background-color: var(--bg-secondary);
      color: var(--text-primary);
      border-color: var(--border-color);
    }
    
    /* Accessibility improvements */
    .focus-visible:focus {
      outline: 2px solid #6366F1;
      outline-offset: 2px;
    }
    
    /* Loading indicator for infinite scroll */
    .loader {
      width: 48px;
      height: 48px;
      border: 5px solid #FFF;
      border-bottom-color: #6366F1;
      border-radius: 50%;
      animation: rotation 1s linear infinite;
      margin: 0 auto;
    }
    @keyframes rotation {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen transition-colors duration-300">
  <x-app-layout>
  <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-10 transition-colors duration-300">
    <div class="container mx-auto px-4 py-3 max-w-4xl flex justify-between items-center">
      <h1 class="text-2xl font-bold text-indigo-700 dark:text-indigo-400">SocialApp</h1>
      <div class="flex space-x-3">
        <button class="bg-gray-100 dark:bg-gray-700 p-2 rounded-lg shadow-sm focus-visible transition-colors duration-300" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
        <button class="bg-gray-100 dark:bg-gray-700 p-2 rounded-lg shadow-sm focus-visible transition-colors duration-300 relative" aria-label="Notifications">
          <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
        </button>
        <button id="darkModeToggle" class="dark-mode-toggle bg-gray-100 dark:bg-gray-700 p-2 rounded-lg shadow-sm focus-visible transition-colors duration-300" aria-label="Toggle dark mode">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path class="sun" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            <path class="moon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
          </svg>
        </button>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-4 py-6 max-w-4xl">
    <!-- Create Post Section -->
    <section class="create-post bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 mb-6 transition-colors duration-300">
      <form id="post-form" hx-post="{{ route('posts.store') }}" 
      hx-encoding="multipart/form-data" 
      enctype="multipart/form-data"
      hx-target="#posts-container"
      hx-swap="afterbegin">
          @csrf
          <div class="flex items-center space-x-4">
              <img src="" class="h-10 w-10 rounded-full object-cover" alt="Your profile">
              <input type="text" name="content" placeholder="What's on your mind?" class="bg-gray-100 dark:bg-gray-700 rounded-full py-2 px-4 flex-1 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition-colors duration-300">
          </div>
          <div class="flex justify-between mt-4 pt-3 border-t border-gray-100 dark:border-gray-700 transition-colors duration-300">
              <button type="button" class="flex items-center text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 focus-visible transition-colors duration-300" aria-label="Add photo" onclick="document.getElementById('image-input').click()">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  Photo
              </button>
              <input type="file" id="image-input" name="image" class="hidden">
              <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 text-white px-4 py-1 rounded-lg text-sm font-medium transition-colors duration-200" aria-label="Post">
                  Post
              </button>
          </div>
      </form>
    </section>
      

    <!-- Story Carousel -->
    <section class="mb-6">
      <h2 class="sr-only">Stories</h2>
      <div class="story-carousel flex space-x-4 pb-2 overflow-x-auto scrollbar-hide">
        <div class="flex-shrink-0 relative w-20">
          <div class="h-20 w-20 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 p-0.5">
            <div class="h-full w-full rounded-full bg-white dark:bg-gray-800 p-0.5 transition-colors duration-300">
              <img src="/api/placeholder/80/80" class="h-full w-full rounded-full object-cover" alt="Your story">
              <span class="absolute bottom-0 right-0 bg-indigo-600 rounded-full p-1 border-2 border-white dark:border-gray-800 transition-colors duration-300" aria-label="Add story">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
              </span>
            </div>
          </div>
          <p class="text-xs text-center mt-1 font-medium dark:text-gray-300 transition-colors duration-300">Your Story</p>
        </div>
        
        <div class="flex-shrink-0">
          <div class="story-ring h-20 w-20 rounded-full p-0.5">
            <div class="story-inner h-full w-full rounded-full bg-white dark:bg-gray-800 p-0.5 transition-colors duration-300">
              <img src="/api/placeholder/80/80" class="h-full w-full rounded-full object-cover" alt="Emma's story">
            </div>
          </div>
          <p class="text-xs text-center mt-1 font-medium dark:text-gray-300 transition-colors duration-300">Emma</p>
        </div>
        
        <div class="flex-shrink-0">
          <div class="story-ring h-20 w-20 rounded-full p-0.5">
            <div class="story-inner h-full w-full rounded-full bg-white dark:bg-gray-800 p-0.5 transition-colors duration-300">
              <img src="/api/placeholder/80/80" class="h-full w-full rounded-full object-cover" alt="John's story">
            </div>
          </div>
          <p class="text-xs text-center mt-1 font-medium dark:text-gray-300 transition-colors duration-300">John</p>
        </div>
        
        <div class="flex-shrink-0">
          <div class="story-ring h-20 w-20 rounded-full p-0.5">
            <div class="story-inner h-full w-full rounded-full bg-white dark:bg-gray-800 p-0.5 transition-colors duration-300">
              <img src="/api/placeholder/80/80" class="h-full w-full rounded-full object-cover" alt="Sarah's story">
            </div>
          </div>
          <p class="text-xs text-center mt-1 font-medium dark:text-gray-300 transition-colors duration-300">Sarah</p>
        </div>
        
        <div class="flex-shrink-0">
          <div class="story-ring h-20 w-20 rounded-full p-0.5">
            <div class="story-inner h-full w-full rounded-full bg-white dark:bg-gray-800 p-0.5 transition-colors duration-300">
              <img src="/api/placeholder/80/80" class="h-full w-full rounded-full object-cover" alt="David's story">
            </div>
          </div>
          <p class="text-xs text-center mt-1 font-medium dark:text-gray-300 transition-colors duration-300">David</p>
        </div>
      </div>
    </section>

    <!-- Feed Filter -->
    <section class="mb-6">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-2 flex transition-colors duration-300">
        <button class="flex-1 py-2 px-4 rounded-lg bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 font-medium transition-colors duration-300" aria-label="View latest posts">
          Latest
        </button>
        <button class="flex-1 py-2 px-4 rounded-lg text-gray-600 dark:text-gray-300 font-medium hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300" aria-label="View popular posts">
          Popular
        </button>
        <button class="flex-1 py-2 px-4 rounded-lg text-gray-600 dark:text-gray-300 font-medium hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300" aria-label="View following posts">
          Following
        </button>
      </div>
    </section>

    <!-- Posts container -->
    <div id="posts-container" class="space-y-6">
      @foreach($posts as $post)
        <article id="post-{{ $post->id }}" class="post-card bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-colors duration-300">
          <div class="p-4">
            <!-- Post Header -->
            <div class="flex justify-between items-center mb-4">
              <div class="flex items-center space-x-3">
                <img src="{{ $post->user->profile_photo_url }}" class="h-10 w-10 rounded-full object-cover" alt="{{ $post->user->name }}'s profile">
                <div>
                  <h3 class="text-gray-800 dark:text-gray-200 font-semibold transition-colors duration-300">{{ $post->user->name }}</h3>
                  <p class="text-gray-500 dark:text-gray-400 text-xs transition-colors duration-300">
                    <time datetime="{{ $post->created_at }}">{{ $post->created_at->diffForHumans() }}</time>
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
                  <form 
                    action="{{ route('posts.delete', $post->id) }}" 
                    method="POST" 
                    hx-delete="{{ route('posts.delete', $post->id) }}" 
                    hx-target="#post-{{ $post->id }}" 
                    hx-swap="outerHTML"
                    hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}'
                  >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:text-red-700 transition-colors duration-300 focus-visible">Delete</button>
                  </form>
                  <button class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-300 focus-visible">Hide post</button>
                  <button class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-300 focus-visible">Report</button>
                </div>
              </div>
            </div>
    
            <!-- Post Content -->
            <p class="text-gray-700 dark:text-gray-300 mb-4 transition-colors duration-300">{{ $post->content }}</p>
    
            <!-- Post Image -->
            @if ($post->image)
              <figure class="mb-4">
                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-64 object-cover rounded-lg">
              </figure>
            @endif
    
            <!-- Post Stats (Likes and Comments) -->
            <div class="flex justify-between text-gray-500 dark:text-gray-400 text-sm mb-4 transition-colors duration-300">
              <div class="flex items-center">
                <span class="flex items-center mr-2">
                  <span class="inline-block h-5 w-5 rounded-full bg-red-500 flex items-center justify-center text-white text-xs mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                  </span>
                  <span id="like-count-{{ $post->id }}" class="like-count">{{ $post->likes->count() }}</span> likes
                </span>
              </div>
              <span id="comments-count-{{ $post->id }}">{{ $post->comments->count() }} Comments</span>
            </div>
    
            <!-- Post Actions (Like, Comment, Share) -->
            <div class="flex justify-between pt-3 border-t border-gray-100 dark:border-gray-700 transition-colors duration-300">
              <form 
                action="{{ route('posts.like', $post->id) }}" 
                method="POST" 
                class="like-form" 
                hx-post="{{ route('posts.like', $post->id) }}" 
                hx-target="#like-count-{{ $post->id }}" 
                hx-swap="outerHTML"
              >
                @csrf
                <button type="submit" class="action-btn like-btn flex items-center text-gray-600 dark:text-gray-300 hover:text-red-500 dark:hover:text-red-400 transition-colors duration-300 focus-visible" aria-label="Like this post">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                  </svg>
                  Like
                </button>
              </form>
              <button 
                class="action-btn comment-btn flex items-center text-gray-600 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400 transition-colors duration-300 focus-visible" 
                aria-label="Comment on this post"
                onclick="toggleCommentForm('{{ $post->id }}')"
              >
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
    
            <!-- Comment Form (initially hidden) -->
            <div id="comment-form-{{ $post->id }}" class="comment-form mt-4 hidden">
              <form 
                action="{{ route('posts.comment', $post->id) }}" 
                method="POST" 
                hx-post="{{ route('posts.comment', $post->id) }}" 
                hx-target="#comments-section-{{ $post->id }}" 
                hx-swap="innerHTML"
                hx-on::after-request="document.getElementById('comment-content-{{ $post->id }}').value = ''"
              >
                @csrf
                <textarea 
                  id="comment-content-{{ $post->id }}"
                  name="content" 
                  class="form-input w-full p-2 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-700 focus:border-transparent transition-all duration-300 dark:bg-gray-800 dark:text-white" 
                  placeholder="Write a comment..." 
                  required
                ></textarea>
                <div class="flex justify-end mt-2">
                  <button type="submit" class="submit-btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-300">Post Comment</button>
                </div>
              </form>
            </div>
    
            <!-- Toggle Comments Button -->
            <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
              <button 
                class="text-sm text-gray-500 dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 transition-colors duration-300 flex items-center"
                onclick="toggleComments('{{ $post->id }}')"
                id="toggle-comments-btn-{{ $post->id }}"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <span id="comments-count-{{ $post->id }}">{{ $post->comments->count() }} Comments</span>
              </button>
            </div>
    
            <!-- Comments Section -->
            <div id="comments-section-{{ $post->id }}" class="comments-section mt-2 transition-all duration-300">
              @include('partials.comments', ['post' => $post])
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </main>

  <!-- Dark Mode Toggle Script -->
  <script>

const postMenuButtons = document.querySelectorAll('.post-menu-button');
    postMenuButtons.forEach(button => {
      button.addEventListener('click', () => {
        const menu = button.nextElementSibling;
        menu.classList.toggle('hidden');
      });
    });
  
    // Close post menu when clicking outside
    document.addEventListener('click', (event) => {
      if (!event.target.closest('.post-menu-button')) {
        document.querySelectorAll('.post-menu').forEach(menu => {
          menu.classList.add('hidden');
        });
      }
    });
  

    function toggleCommentForm(postId) {
      const commentForm = document.getElementById(`comment-form-${postId}`);
      commentForm.classList.toggle('hidden');
      
      // Focus the textarea when showing the form
      if (!commentForm.classList.contains('hidden')) {
        document.getElementById(`comment-content-${postId}`).focus();
      }
    }

    const likeButtons = document.querySelectorAll('.like-btn');
    likeButtons.forEach(button => {
      button.addEventListener('click', () => {
        const likeCount = button.closest('.post-card').querySelector('.like-count');
        const isLiked = button.classList.toggle('like-active');
        likeCount.textContent = isLiked ? parseInt(likeCount.textContent) + 1 : parseInt(likeCount.textContent) - 1;
      });
    });
  
    function toggleComments(postId) {
      const commentsSection = document.getElementById(`comments-section-${postId}`);
      const toggleButton = document.getElementById(`toggle-comments-btn-${postId}`);
      const iconSvg = toggleButton.querySelector('svg');
      
      commentsSection.classList.toggle('hidden');
      
      // Change the icon direction based on state
      if (commentsSection.classList.contains('hidden')) {
        iconSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />';
      } else {
        iconSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />';
      }
    }
  </script>
</x-app-layout>
</body>
</html>
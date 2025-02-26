<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Social Feed</title>
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <style>
    .post-card {
      transition: all 0.3s ease;
    }
    .post-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .like-btn, .comment-btn, .share-btn {
      transition: all 0.2s ease;
    }
    .like-btn:hover, .comment-btn:hover, .share-btn:hover {
      transform: scale(1.1);
    }
    .like-active {
      color: #EF4444;
      fill: #EF4444;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-indigo-700">Feed</h1>
      <div class="flex space-x-4">
        <button class="bg-white p-2 rounded-lg shadow">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
        <button class="bg-white p-2 rounded-lg shadow">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Create Post Section -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
      <div class="flex items-center space-x-4">
        <img src="/api/placeholder/50/50" class="h-10 w-10 rounded-full object-cover" alt="Your profile">
        <input type="text" placeholder="What's on your mind?" class="bg-gray-100 rounded-full py-2 px-4 flex-1 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
      </div>
      <div class="flex justify-between mt-4 pt-3 border-t border-gray-100">
        <button class="flex items-center text-gray-600 hover:text-indigo-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          Photo
        </button>
        <button class="flex items-center text-gray-600 hover:text-indigo-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
          </svg>
          Video
        </button>
        <button class="flex items-center text-gray-600 hover:text-indigo-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
          </svg>
          Poll
        </button>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1 rounded-lg text-sm font-medium">
          Post
        </button>
      </div>
    </div>

    <!-- Story Carousel -->
    <div class="mb-6 overflow-x-auto">
      <div class="flex space-x-4 pb-2">
        <div class="flex-shrink-0 relative w-20">
          <div class="h-20 w-20 rounded-full bg-gradient-to-r from-pink-500 to-indigo-500 p-0.5">
            <div class="h-full w-full rounded-full bg-white p-0.5">
              <img src="/api/placeholder/80/80" class="h-full w-full rounded-full object-cover" alt="Your story">
              <span class="absolute bottom-0 right-0 bg-indigo-600 rounded-full p-1 border-2 border-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
              </span>
            </div>
          </div>
          <p class="text-xs text-center mt-1 font-medium">Your Story</p>
        </div>
        
        <div class="flex-shrink-0">
          <div class="h-20 w-20 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 p-0.5">
            <div class="h-full w-full rounded-full bg-white p-0.5">
              <img src="/api/placeholder/80/80" class="h-full w-full rounded-full object-cover" alt="User story">
            </div>
          </div>
          <p class="text-xs text-center mt-1 font-medium">Emma</p>
        </div>
        
        <div class="flex-shrink-0">
          <div class="h-20 w-20 rounded-full bg-gradient-to-r from-yellow-500 to-red-500 p-0.5">
            <div class="h-full w-full rounded-full bg-white p-0.5">
              <img src="/api/placeholder/80/80" class="h-full w-full rounded-full object-cover" alt="User story">
            </div>
          </div>
          <p class="text-xs text-center mt-1 font-medium">John</p>
        </div>
        
        <div class="flex-shrink-0">
          <div class="h-20 w-20 rounded-full bg-gradient-to-r from-green-500 to-blue-500 p-0.5">
            <div class="h-full w-full rounded-full bg-white p-0.5">
              <img src="/api/placeholder/80/80" class="h-full w-full rounded-full object-cover" alt="User story">
            </div>
          </div>
          <p class="text-xs text-center mt-1 font-medium">Sarah</p>
        </div>
        
        <div class="flex-shrink-0">
          <div class="h-20 w-20 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 p-0.5">
            <div class="h-full w-full rounded-full bg-white p-0.5">
              <img src="/api/placeholder/80/80" class="h-full w-full rounded-full object-cover" alt="User story">
            </div>
          </div>
          <p class="text-xs text-center mt-1 font-medium">David</p>
        </div>
      </div>
    </div>

    <!-- Posts -->
    <div class="space-y-6">
      <!-- Post 1 -->
      <div class="post-card bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-4">
          <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-3">
              <img src="/api/placeholder/50/50" class="h-10 w-10 rounded-full object-cover" alt="User profile">
              <div>
                <h3 class="text-gray-800 font-semibold">Jessica Williams</h3>
                <p class="text-gray-500 text-xs">Posted 2 hours ago</p>
              </div>
            </div>
            <button class="text-gray-500 hover:text-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
              </svg>
            </button>
          </div>
          
          <p class="text-gray-700 mb-4">Just finished this amazing book on design thinking! Highly recommend it to everyone interested in UX/UI design. What are you all reading these days?</p>
          
          <img src="/api/placeholder/600/400" class="w-full h-64 object-cover rounded-lg mb-4" alt="Post image">
          
          <div class="flex justify-between text-gray-500 text-sm mb-4">
            <span>124 likes</span>
            <span>36 comments</span>
          </div>
          
          <div class="flex justify-between pt-3 border-t border-gray-100">
            <button class="like-btn flex items-center text-gray-600 hover:text-red-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
              Like
            </button>
            <button class="comment-btn flex items-center text-gray-600 hover:text-blue-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
              </svg>
              Comment
            </button>
            <button class="share-btn flex items-center text-gray-600 hover:text-green-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
              </svg>
              Share
            </button>
          </div>
        </div>
      </div>
      
      <!-- Post 2 -->
      <div class="post-card bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-4">
          <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-3">
              <img src="/api/placeholder/50/50" class="h-10 w-10 rounded-full object-cover" alt="User profile">
              <div>
                <h3 class="text-gray-800 font-semibold">Mark Johnson</h3>
                <p class="text-gray-500 text-xs">Posted yesterday</p>
              </div>
            </div>
            <button class="text-gray-500 hover:text-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
              </svg>
            </button>
          </div>
          
          <p class="text-gray-700 mb-4">Finally finished my latest coding project - a full stack app using React and Node.js! It's been quite the journey, but I'm really proud of what I've built. Check out my latest post on my portfolio for more details!</p>
          
          <div class="grid grid-cols-2 gap-2 mb-4">
            <img src="/api/placeholder/300/300" class="w-full h-40 object-cover rounded-lg" alt="Project screenshot">
            <img src="/api/placeholder/300/300" class="w-full h-40 object-cover rounded-lg" alt="Project screenshot">
          </div>
          
          <div class="flex justify-between text-gray-500 text-sm mb-4">
            <span>89 likes</span>
            <span>17 comments</span>
          </div>
          
          <div class="flex justify-between pt-3 border-t border-gray-100">
            <button class="like-btn flex items-center text-gray-600 hover:text-red-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
              Like
            </button>
            <button class="comment-btn flex items-center text-gray-600 hover:text-blue-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
              </svg>
              Comment
            </button>
            <button class="share-btn flex items-center text-gray-600 hover:text-green-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
              </svg>
              Share
            </button>
          </div>
        </div>
      </div>

      <!-- Post 3 with Comments -->
      <div class="post-card bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-4">
          <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-3">
              <img src="/api/placeholder/50/50" class="h-10 w-10 rounded-full object-cover" alt="User profile">
              <div>
                <h3 class="text-gray-800 font-semibold">Alex Turner</h3>
                <p class="text-gray-500 text-xs">Posted 3 days ago</p>
              </div>
            </div>
            <button class="text-gray-500 hover:text-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
              </svg>
            </button>
          </div>
          
          <p class="text-gray-700 mb-4">Does anyone have recommendations for hiking trails around the city? Looking to plan a weekend trip with friends.</p>
          
          <div class="flex justify-between text-gray-500 text-sm mb-4">
            <span>56 likes</span>
            <span>8 comments</span>
          </div>
          
          <div class="flex justify-between pt-3 border-t border-gray-100">
            <button class="like-btn flex items-center text-gray-600 hover:text-red-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
              Like
            </button>
            <button class="comment-btn flex items-center text-gray-600 hover:text-blue-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
              </svg>
              Comment
            </button>
            <button class="share-btn flex items-center text-gray-600 hover:text-green-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
              </svg>
              Share
            </button>
          </div>
          
          <!-- Comments Section -->
          <div class="mt-4 pt-4 border-t border-gray-100">
            <h4 class="text-gray-700 font-medium mb-3">Comments</h4>
            
            <!-- Comment 1 -->
            <div class="flex space-x-3 mb-4">
              <img src="/api/placeholder/40/40" class="h-8 w-8 rounded-full object-cover" alt="User profile">
              <div class="bg-gray-100 rounded-lg p-3 flex-1">
                <h5 class="text-gray-800 font-medium text-sm">Sarah Chen</h5>
                <p class="text-gray-700 text-sm mt-1">I highly recommend Cedar Ridge! Beautiful views and not too difficult.</p>
                <div class="flex space-x-3 mt-2 text-xs text-gray-500">
                  <button class="hover:text-gray-700">Like</button>
                  <button class="hover:text-gray-700">Reply</button>
                  <span>3 hrs ago</span>
                </div>
              </div>
            </div>
            
            <!-- Comment 2 -->
            <div class="flex space-x-3">
              <img src="/api/placeholder/40/40" class="h-8 w-8 rounded-full object-cover" alt="User profile">
              <div class="bg-gray-100 rounded-lg p-3 flex-1">
                <h5 class="text-gray-800 font-medium text-sm">Mike Wilson</h5>
                <p class="text-gray-700 text-sm mt-1">Pine Mountain is awesome if you're looking for something more challenging. Make sure to bring plenty of water!</p>
                <div class="flex space-x-3 mt-2 text-xs text-gray-500">
                  <button class="hover:text-gray-700">Like</button>
                  <button class="hover:text-gray-700">Reply</button>
                  <span>2 hrs ago</span>
                </div>
              </div>
            </div>
            
            <!-- Add Comment -->
            <div class="flex space-x-3 mt-4">
              <img src="/api/placeholder/40/40" class="h-8 w-8 rounded-full object-cover" alt="Your profile">
              <div class="flex-1 flex">
                <input type="text" placeholder="Write a comment..." class="bg-gray-100 rounded-full py-2 px-4 flex-1 text-gray-700 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <button class="ml-2 text-indigo-600">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Load More Button -->
    <div class="text-center mt-8">
      <button class="bg-white text-indigo-700 font-medium px-6 py-3 rounded-lg shadow hover:shadow-lg transition-all duration-200">
        Load More Posts
      </button>
    </div>
  </div>

  <script>
    // Simple interactive elements
    document.addEventListener('DOMContentLoaded', function() {
      const likeButtons = document.querySelectorAll('.like-btn');
      
      likeButtons.forEach(button => {
        button.addEventListener('click', function() {
          const svgElement = this.querySelector('svg');
          this.classList.toggle('like-active');
          
          if (this.classList.contains('like-active')) {
            svgElement.setAttribute('fill', 'currentColor');
            // Update like count (this would normally be done via an API call)
            const likeCountElement = this.closest('.post-card').querySelector('.flex.justify-between.text-gray-500.text-sm span:first-child');
            const currentLikes = parseInt(likeCountElement.textContent);
            likeCountElement.textContent = (currentLikes + 1) + ' likes';
          } else {
            svgElement.setAttribute('fill', 'none');
            // Update like count
            const likeCountElement = this.closest('.post-card').querySelector('.flex.justify-between.text-gray-500.text-sm span:first-child');
            const currentLikes = parseInt(likeCountElement.textContent);
            likeCountElement.textContent = (currentLikes - 1) + ' likes';
          }
        });
      });
      
      // Comment button functionality
      const commentButtons = document.querySelectorAll('.comment-btn');
      commentButtons.forEach(button => {
        button.addEventListener('click', function() {
          const postCard = this.closest('.post-card');
          const commentInput = postCard.querySelector('input[type="text"]');
          
          if (commentInput) {
            commentInput.focus();
          }
        });
      });
    });
  </script>
</body>
</html>
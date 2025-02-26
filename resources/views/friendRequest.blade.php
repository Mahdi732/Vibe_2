<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Friend Requests</title>
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <script src="https://unpkg.com/htmx.org@2.0.4"></script>
  <style>
    .request-card {
      transition: all 0.3s ease;
    }
    .request-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .accept-btn {
      transition: all 0.2s ease;
    }
    .accept-btn:hover {
      transform: scale(1.05);
    }
    .decline-btn {
      transition: all 0.2s ease;
    }
    .decline-btn:hover {
      transform: scale(1.05);
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <x-app-layout>
    <div class="container mx-auto px-4 py-8">
      <!-- Header -->
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-indigo-700">Friend Requests</h1>
        <div class="relative">
          <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
          <button class="bg-white p-2 rounded-lg shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </button>
        </div>
      </div>
  
      <!-- Filter Options -->
      <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
          <span class="text-gray-700 font-medium">Filter by:</span>
          <button class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full text-sm font-medium">All Requests</button>
          <button class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium">Recent</button>
          <button class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium">Pending</button>
        </div>
      </div>
      <form hx-get="{{ route('friend') }}"
          hx-trigger="input changed delay:300ms"
          hx-target="#parent"
          hx-swap="outerHTML">
        <input type="text" name="search" placeholder="find your friend" value="{{ request('search') }}">
      </form>
  
      <!-- Friend Requests Section -->
      <div id="parent" class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Request Card 1 -->
        @foreach ($users as $user)
        <div class="request-card bg-white rounded-xl shadow-md overflow-hidden">
          <div class="p-5">
            <div class="flex items-center mb-4">
              <img src="{{ $user->username }}" class="h-12 w-12 rounded-full object-cover" alt="User profile">
              <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $user->username }}</h3>
                <p class="text-gray-600 text-sm">{{ $user->name }}</p>
              </div>
            </div>
            <p class="text-gray-700 mb-4">Hey! I'd love to connect with you on this platform!</p>
            <div class="flex space-x-3">
              <button class="accept-btn flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg font-medium">
                Accept
              </button>
              <button class="decline-btn flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-lg font-medium">
                Decline
              </button>
            </div>
          </div>
          <div class="bg-gray-50 px-5 py-3 text-sm text-gray-600">
            Sent 2 days ago
          </div>
        </div>
        @endforeach
  
      <!-- See More Button -->
      <div class="text-center mt-8">
        <button class="bg-white text-indigo-700 font-medium px-6 py-3 rounded-lg shadow hover:shadow-lg transition-all duration-200">
          Load More Requests
        </button>
      </div>
    </div>
</x-app-layout>
  <script>
    // Simple interactive elements
    document.addEventListener('DOMContentLoaded', function() {
      const acceptButtons = document.querySelectorAll('.accept-btn');
      const declineButtons = document.querySelectorAll('.decline-btn');
      const requestCards = document.querySelectorAll('.request-card');
      
      acceptButtons.forEach(button => {
        button.addEventListener('click', function() {
          const card = this.closest('.request-card');
          card.style.borderLeft = '4px solid #4F46E5';
          card.innerHTML = `
            <div class="p-5 text-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-green-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <h3 class="text-lg font-semibold text-gray-800">Friend Request Accepted!</h3>
              <p class="text-gray-600 mt-2">You are now connected</p>
            </div>
          `;
          setTimeout(() => {
            card.style.opacity = '0';
            setTimeout(() => {
              card.style.display = 'none';
            }, 300);
          }, 2000);
        });
      });
      
      declineButtons.forEach(button => {
        button.addEventListener('click', function() {
          const card = this.closest('.request-card');
          card.style.opacity = '0.6';
          card.innerHTML = `
            <div class="p-5 text-center">
              <h3 class="text-lg font-semibold text-gray-800">Request Declined</h3>
              <p class="text-gray-600 mt-2">This request has been removed</p>
            </div>
          `;
          setTimeout(() => {
            card.style.opacity = '0';
            setTimeout(() => {
              card.style.display = 'none';
            }, 300);
          }, 2000);
        });
      });
    });
  </script>
</body>
</html>
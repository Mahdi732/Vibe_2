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
    .accept-btn, .decline-btn {
      transition: all 0.2s ease;
    }
    .accept-btn:hover, .decline-btn:hover {
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

      <!-- Search Bar -->
      <form 
        hx-get="{{ route('users.search') }}" 
        hx-trigger="keyup changed delay:300ms" 
        hx-target="#parent"
        hx-swap="innerHTML"
        hx-indicator=".loading"
        class="relative w-full mb-8 max-w-md mx-auto"
      >
      @csrf
        <input
          type="text"
          name="search"
          placeholder="Find your friend..."
          value="{{ request('search') }}"
          class="w-full px-4 py-2 pr-10 text-gray-700 bg-white border-2 border-gray-200 rounded-lg shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all duration-300"
        />
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
          <svg
            class="w-5 h-5 text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
            ></path>
          </svg>
        </div>
        <div class="loading absolute inset-y-0 right-0 flex items-center pr-3 hidden">
          <svg
            class="animate-spin h-5 w-5 text-indigo-500"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
          >
            <circle
              class="opacity-25"
              cx="12"
              cy="12"
              r="10"
              stroke="currentColor"
              stroke-width="4"
            ></circle>
            <path
              class="opacity-75"
              fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
          </svg>
        </div>
      </form>

      <!-- Research Section -->
      <div id="parent" class=" rounded-lg  mb-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      </div>

      <!-- Friend Requests Section -->
      <p>Your friend Request</p>
      <div  class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Example Friend Request Card -->
    @if($receivedRequests->isEmpty())
    <p>no request for you 👌👌👌.</p>
    @else
   <!-- For each friend request -->
    @foreach($receivedRequests as $request)
    <div id="friend-request-{{ $request->id }}" class="request-card bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center mb-4">
            <img src="https://via.placeholder.com/40" alt="User" class="w-10 h-10 rounded-full mr-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">{{ $request->sender->username }}</h3>
                <p class="text-gray-600">{{ $request->sender->username }}</p>
            </div>
        </div>
        <div class="flex justify-between">

            <form hx-post="{{ route('friend.accept', $request->id) }}" hx-target="#friend-request-{{ $request->id }}" hx-swap="outerHTML">
              @csrf
              <button type="submit" class="accept-btn bg-indigo-500 text-white px-4 py-2 rounded-lg">Accept</button>
          </form>
          <form hx-post="{{ route('friend.decline', $request->id) }}" hx-target="#friend-request-{{ $request->id }}" hx-swap="outerHTML">
              @csrf
              <button type="submit" class="decline-btn bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">Decline</button>
          </form>
          
        </div>
    </div>
    @endforeach

@endif

        <!-- Add more friend request cards here -->
      </div>
    </div>
  </x-app-layout>
  {{-- <script>
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
  </script> --}}
</body>
</html>
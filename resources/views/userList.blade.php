@foreach ($users as $user)

<div class=" bg-white rounded-xl shadow-md overflow-hidden">
  <div class="p-5">
    <div class="flex items-center mb-4">
      <img src="" class="h-12 w-12 rounded-full object-cover" alt="User profile">
      <div class="ml-4">
        <h3 class="text-lg font-semibold text-gray-800">{{ $user->username }}</h3>
        <p class="text-gray-600 text-sm">{{ $user->name }}</p>
      </div>
    </div>
    <p class="text-gray-700 mb-4">Hey! I'd love to connect with you on this platform!</p>
    <div class="flex space-x-3">
      <form hx-get='{{ route('add.friend', $user->id) }}'
        hx-target="#parent"
        hx-swap="innerHTML">
        <button class="request-btn flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg font-medium">
          Accept
        </button>
      </form>
    </div>
  </div>
  <div class="bg-gray-50 px-5 py-3 text-sm text-gray-600">
    Sent 2 days ago
  </div>
</div>
@endforeach
@if (isset($message))
    <p class="text-gray-500">{{ $message }}</p>
@endif
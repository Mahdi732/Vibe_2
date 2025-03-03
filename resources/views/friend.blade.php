{{-- @extends('layouts.app')
@section('content') --}}<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Friend Requests</title>
      <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
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

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Liste des amis</h2>
        <div class="flex space-x-3">
            <div class="relative">
                <input type="text" placeholder="Rechercher un ami..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <button class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>Ajouter</span>
            </button>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="flex bg-gray-50 px-6 py-3 border-b border-gray-200">
            <div class="w-12"></div>
            <div class="w-1/3 font-medium text-gray-700">Nom</div>
            <div class="w-1/3 font-medium text-gray-700">Email</div>
            <div class="w-1/3 font-medium text-gray-700">Actions</div>
        </div>
        
        @if($friends->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 px-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun ami trouvé</h3>
                <p class="text-gray-500 mb-6 max-w-md">Commencez à élargir votre réseau en trouvant et en ajoutant des amis à votre liste.</p>
                <a href="{{ route('friend.requests') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-black font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none transition duration-300 shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    find friend
                </a>
            </div>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach($friends as $friend)
                    <li class="group hover:bg-blue-50 transition-all duration-200">
                        <div class="flex items-center px-6 py-4">
                            <div class="w-12 flex-shrink-0">
                                <div class="relative">
                                    <img src="{{$friend->profile_photo_path}}" 
                                         alt="Photo de {{ $friend->username }}" 
                                         class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow group-hover:ring-blue-200 transition-all duration-200">
                                </div>
                            </div>
                            <div class="w-1/3">
                                <p class="text-gray-900 font-medium group-hover:text-blue-700 transition-colors duration-200">
                                    {{ $friend->username }}
                                </p>
                                {{-- <p class="text-sm text-gray-500">
                                    {{ $friend->status ?? 'Ami depuis ' . $friend->created_at->diffForHumans(null, true) }}
                                </p> --}}
                            </div>
                            <div class="w-1/3 truncate text-gray-600">
                                {{ $friend->email }}
                            </div>
                            <div class="w-1/3 flex space-x-2 justify-end">
                                <button class="p-2 rounded-full text-blue-600 hover:bg-blue-100 transition-colors duration-200" title="Envoyer un message">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </button>
                                <button class="p-2 rounded-full text-indigo-600 hover:bg-indigo-100 transition-colors duration-200" title="Voir le profil">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <div class="relative" x-data="{ open: false }">
                                    <button class="p-2 rounded-full text-gray-600 hover:bg-gray-100 transition-colors duration-200" title="Plus d'options" @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </button>
                                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden" x-show="open" @click.away="open = false">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Bloquer</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Signaler</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    
    @if(!$friends->isEmpty())
        <div class="mt-6 bg-white rounded-lg shadow px-6 py-4 flex justify-between items-center">
            <div class="text-gray-600">
                <span class="font-medium text-gray-900"></span> ami(s) au total
            </div>
            <div class="flex space-x-2">
             
            </div>
        </div>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg mt-8 px-6 py-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-blue-800 text-sm">Vous pouvez gérer les paramètres de confidentialité de votre liste d'amis dans les <a href="#" class="font-medium underline hover:text-blue-600">paramètres du compte</a>.</p>
        </div>
    @endif
</div>

</x-app-layout>
{{-- @endsection --}}
    </body>
    </html>
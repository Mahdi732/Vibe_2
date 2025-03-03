<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class friendController extends Controller
{
    public function addFriend($userId)
    {
        $user = User::find($userId);
        $existingRequest = FriendRequest::where(function($query) use ($userId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', auth()->id());
        })->where('status', 'pending')->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'No more request sent.');
        }

        FriendRequest::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $userId,
            'status' => 'pending', 
        ]);

    }

    public function showReceivedRequests()
    {
        $receivedRequests = FriendRequest::where('receiver_id', auth()->id())
            ->where('status', 'pending') 
            ->with('sender') 
            ->get();

        return view('friendRequest', compact('receivedRequests'));
    }

    public function acceptRequest($requestId)
    {
        $friendRequest = FriendRequest::find($requestId);
        DB::table('friends')->insert([
            'user_id' => $friendRequest->receiver_id, 
            'friend_id' => $friendRequest->sender_id, 
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $friendRequest->update(['status' => 'accepted']);
    }

    public function declineRequest($requestId)
    {
        $friendRequest = FriendRequest::find($requestId);
        $friendRequest->delete();
    }

    public function friendsList()
{
    $userId = auth()->id();

    $friends = DB::table('friends')
        ->join('users', function ($join) use ($userId) {
            $join->on('users.id', '=', 'friends.user_id')
                ->orOn('users.id', '=', 'friends.friend_id');
        })
        ->whereRaw('(friends.user_id = ? OR friends.friend_id = ?) AND users.id != ?', [$userId, $userId, $userId])
        ->select('users.id', 'users.username', 'users.email', 'users.profile_photo_path')
        ->distinct()
        ->get();

    return view('friend', compact('friends')); 
}


}

<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    // public function store(Request $request)
    // {
    // $message = new Chat();
    // $message->complaints_id = $request->complaints_id;
    // $message->user_id = auth()->user()->id;
    // $message->message = $request->message;
    // $message->save();

    // // Data untuk broadcast
    // $data = [
    //     'message' => $message->message,
    //     'created_at' => $message->created_at,
    //     'user' => ['name' => auth()->user()->name],
    //     'userId' => auth()->user()->id
    // ];

    // // Trigger Pusher event
    // broadcast(new \App\Events\NewChatMessage($data))->toOthers();

    // return response()->json(['success' => true] + $data);
    // }

    public function store(Request $request)
    {

        $message = new Chat();
    $message->complaints_id = $request->complaints_id;
    $message->user_id = auth()->user()->id; // Asumsi Anda menggunakan autentikasi
    $message->message = $request->message;
    $message->save();

    // // Trigger event
    // event(new NewChatMessage($message));

    return response()->json(['success' => true, 'message' => $message->message, 'created_at' => $message->created_at, 'user' => ['name' => auth()->user()->name]]);
    }


    public function getMessages($complaints_id)
{
    $messages = Chat::where('complaints_id', $complaints_id)->with('users')->orderBy('created_at', 'desc')->get();

    return response()->json(['message' => $messages]);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}

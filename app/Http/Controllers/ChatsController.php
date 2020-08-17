<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Storage;


class ChatsController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }


    public function index()
    {
         return view('chat');
    }


    public function fetchMessages()
    {
        return Message::with('user')->get();
    }



     public function sendMessage(Request $request)
     {
       $user = Auth::user();

      $message = $user->messages()->create([
      'message' => $request->input('message')
     ]);
      broadcast(new MessageSent($user, $message))->toOthers();



        // return ['status' => 'Message Sent!'];

        $user=User::all()->map->email;
        $details = ['email' => $user];
         SendEmailJob::dispatch($details, $message);

      }
}

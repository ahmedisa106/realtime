<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\NewNotification;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $posts = Post::with(['user','comments'])->get();







        return view('home', compact('posts'));
    }

    public function saveComent(Request $request)
    {



        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'body' => $request->comment,

        ]);

        $data = [
            'user_id'=>Auth::id(),
            'user_name'=>Auth()->user()->name,
            'body'=>$request->comment,
            'post_id'=>$request->post_id,

        ];
        event(new NewNotification($data));

        return redirect()->back()->with('success', 'تم إضافه التعليق بنجاح');


    }
}

<?php

namespace App\Http\Controllers;

use App\Events\PostUpdated;
use App\Models\Post;
use App\Notifications\PostUpdatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $published_posts = $posts->whereNotNull('published_at');
        $draft_posts = $posts->whereNull('published_at');
        
        
        // $published_posts = Post::published();
        // $published_posts = Post::published();
        // $draft_posts = Post::draft();
        return view('post.index',compact('published_posts','draft_posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'title'=>['required','min:7','max:255'],
        ]);
        Post::Create($val);
        return redirect()->action([PostController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $val = $request->validate([
            'title'=>['required','min:7','max:255'],
        ]);
        $post->update($val);
        $post->files()->sync($request['files']);
        // Event Demo
        // event(new PostUpdated($post));
        // Notification Demo
        Notification::send(Auth::user(),new PostUpdatedNotification($post));
        // Auth::user()->notify(new PostUpdatedNotification($post));
        return redirect()->action([PostController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->action([PostController::class, 'index']);

    }
}

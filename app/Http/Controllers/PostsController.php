<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Session;
class PostsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        
        $post->title = $request->input('title');
        $post->email = $request->session()->get('email');
        $post->body_md = $request->input('body_md');
        $post->body_html = $request->input('body_html');
        $post->status = $request->input('status');
        $post->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       if( $request->session()->get('email') ){
            $posts = Post::Where('email', '=', $request->session()->get('email'))->orderBy('id','DESC')->paginate(10);
            return view('posts',compact('posts'))->with('i', ($request->input('page', 1) - 1) * 1);
       }

       return redirect()->route('index'); 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post = Post::find($post->id);

        $post->title = $request->input('title');
        $post->email = $request->session()->get('email');
        $post->body_md = $request->input('body_md');
        $post->body_html = $request->input('body_html');
        $post->status = $request->input('status');
        $post->save();
        
        return redirect()->route('user.posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $posts = Post::findOrFail($post->id);

        $posts->delete();

        Session::flash('flash_message', 'Post successfully deleted!');

        return redirect()->route('user.posts');
    }
}

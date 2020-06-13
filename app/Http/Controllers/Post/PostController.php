<?php

namespace App\Http\Controllers\Post;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
         /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::all();
        // Auth::user()->test;
        
        // dd($posts->where('id', 1));
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        $post = new Post;
        
        return view('post.create', compact('post'));
    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        //
       
        $data = $request->validate([
            'text' => 'required',
            'title' => 'required|max:255',
           
        ]);

        $post = Post::create($data);

        $user = User::select('id')->where('id', Auth::user()->id)->first();
        $post->users()->attach($user);   
        
        return redirect('/post')->with('successMessage', "Uw post $post->title is succesvol geplaatst!");
    }


     /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post){
        return view('post.show', compact('post'));
    }
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        
        return view('post.edit', compact('post'));
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
        //
        
        if($post->text != $request->text OR $post->title != $request->title){
            if($post->isNotUserInvolvedWithPost(Auth::user()) === true){       
                $post->users()->attach($request->users);
            }
        } 
        
        $data = $request->validate([
            'text' => 'required',
            'title' => 'required|max:255',
           
        ]);
        
        $post->update($data);
        
        
        return redirect('/post')->with('successMessage', "Uw post $post->title is succesvol geupdate!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->users()->detach();
        $post->delete();
        return redirect('/post')->with('successMessage', 'Uw post ' . $post->title . ' is succesvol verwijderd!');
    }
}

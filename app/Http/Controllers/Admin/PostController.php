<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        $data = $request->validated();

        $post = new Post();
        $post->fill($data);

        $post->slug =  Str::slug($data['title']);
        if (isset($data['image'])) {
            $post->image = Storage::put('uploads', $data['image']);
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('message', 'Post creato con successo');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // public function show(string $slug)
    // {
    //    //$post = Post::find($id);
    //    $posts = Post::where('slug', $slug)->get();

    //  return view('admin.posts.show', compact('posts'));
    // }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {




        $data = $request->validated();

        $post->slug =  Str::slug($data['title']);

        if(empty($data['set_image'])){


            if($post->image){
                Storage::delete($post->image);
                $post->image = null;
            }



        } else {
            if (isset($data['image'])) {

                if($post->image){
                    Storage::delete($post->image);
                }

                $post->image = Storage::put('uploads', $data['image']);
            }
        }

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('message', "Post $post->id aggiornato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $old_id = $post->id;

        if($post->image){
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', "Post $old_id cancellato con successo");
    }
}
<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
//        Door middleware te gebruiken op create en store kan je alleen bij deze functies als je aan de eisen in de middleware VerifyCategoriesCount voldoet
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all())->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // image wordt in storage/app/public/posts opgeslagen en gehasht, doordat  in .env de FILESYSTEM_DRIVER op public is gezet
//        om de image te weergeven in front-end: php artisan storage:link. Nu is de storage/public gelinkt met public/storage
        $image = $request->image->store('posts');

        Post::create([
            'title' => $request->title,
            'date' => $request->date,
            'rating' => $request->rating,
            'review' => $request->review,
            'image' => $image,
            'category_id' => $request->category,
            'user_id' => Auth::user()->id

        ]);

        session()->flash('success', 'Movie added!');

        return redirect(route('posts.index'));


//
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return void
     */
    public function show(Post $post)
    {
        if(Auth::user() == $post->user){
        return view('posts.show')->with('post', $post);
        }
        else {
            return redirect(route('posts.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Auth::user() == $post->user) {
            return view('posts.create')->with('post', $post)->with('categories', Category::all());
        }
        else {
            return redirect(route('posts.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return void
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'date', 'rating', 'review']);
        $post->category()->associate($request->category);

        if ($request->hasFile('image')) {
            $image = $request->image->store('posts');
            Storage::delete($post->image);
            $data['image'] = $image;
        }
        $post->update($data);

        session()->flash('success', 'Movie updated');

        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        Storage::delete($post->image);

        session()->flash('success', 'Movie deleted');

        return redirect(route('posts.index'));
    }

    public function search(Request $request)
    {
        $error = "Nothing found";
        $query = $request->get('search');
        $posts = Post::where('title', 'LIKE', '%' . $query . '%')->orWhere('review', 'LIKE', '%' . $query . '%')->get();
//        Zoekt in zowel de title als de review
        return view('posts.search')->with('error', $error)->with('query', $query)->with('posts', $posts);

    }
}
//->orWhere('review','LIKE', '%' . $query . '%' )->get()
//compact('posts', 'query', 'error'));

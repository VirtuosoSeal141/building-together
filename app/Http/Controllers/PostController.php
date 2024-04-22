<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function addpost(Request $request){
        $postData = $request->all();
        $validator = Validator::make($postData, [
            'title' => 'required|max:100',
            'description' => 'required|max:600',
            'image' => 'required|image|mimes:png,jpeg,jpg',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $post = new Post();
        $post->title = $postData['title'];
        $post->description = $postData['description'];
        $post->image = $request->file('image')->store('img/news');
        $post->user_id = Auth::id();
        $post->publication_date = now();
        $post->save();

        return redirect('myposts');
    }

    public function editpost(Request $request, $id){
        $postData = $request->all();
        $validator = Validator::make($postData, [
            'title' => 'required|max:100',
            'description' => 'required|max:600',
            'image' => 'image|mimes:png,jpeg,jpg',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $post = Post::findOrFail($id);
        $post->title = $postData['title'];
        $post->description = $postData['description'];
        if($request->file('image')){
            $post->avatar = $request->file('image')->store('img/news');
        }
        $post->save();

        return redirect(route('post-page', ['id' => $post->id]));
    }

    public function delpost($id){

        Post::findOrFail($id)->delete();

        return back();
    }

    public function addcomment(Request $request, $id){
        $commentData = $request->all();
        $validator = Validator::make($commentData, [
            'comment' => 'required|max:200',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment();
        $comment->comment = $commentData['comment'];
        $comment->user_id = Auth::id();
        $comment->post_id = $id;
        $comment->save();

        return back();
    }

    public function delcomment($id){

        Comment::findOrFail($id)->delete();

        return back();
    }

    public function search(Request $request){

        if ($request->input('search')) {
            $posts = Post::search($request->input('search'))->orderBy('id', 'desc')->paginate(6);
        } else {
            $posts = Post::orderBy('id', 'desc')->paginate(3);
        }

        return view('posts', compact('posts'));
        
    }
}

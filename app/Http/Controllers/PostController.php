<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function showCreateForm()
    {
        return view('create-post');
    }

    public function storeNewPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        return redirect("/post/$newPost->id")->with('success', 'new post successfully created');
    }

    // type hinting 
    public function viewSinglePost(Post $post)
    {



        $ourHTML = Str::markdown($post->body);
        $post['body'] = $ourHTML;
        return view('single-post', ['post' => $post]);
    }

    public function delete(Post $post)
    {
       
        $post->delete();
        return redirect('/profile/' . auth()->user()->username)->with('success', 'post successfully deleted');
    }

    public function showEditFrom(Post $post){
        return view('edit-post', ['post' => $post]);

    }

    public function actuallyUpdate(Post $post, Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return back()->with('success', 'post successfully updated');
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller {

	use Helpers;
	
	public function index() {
		$posts = Post::all();
		return $this->response->array($posts);
	}

	public function store(Request $request) {

		$input = $request->all();
		$post = new Post;
		$post->user_id = 1;
        $post->text = $request->text; 
        $post->save();

        return $this->response->array($post);

	}

}
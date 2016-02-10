<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Models\Post;
use Validator;

class PostController extends Controller {

	use Helpers;
	
	public function index() {
		$posts = Post::all();
		return $this->response->array($posts);
	}

	public function store(Request $request) {

		$input = $request->all();

		$validator = Validator::make($input, Post::getCreateRules());

		if ($validator->passes()) {
			
			$post = new Post;
			$post->user_id = $request->user_id;
	        $post->text = $request->text; 
	        $post->save();

	        return $this->response->array($post);

	    } else {
	    	throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.', $validator->errors());
	    }

	}

}
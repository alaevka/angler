<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Models\Post;
use Validator;
use App\Models\User;

class UserController extends Controller {

	use Helpers;
	
	public function index() {
		$users = User::all();
		return $this->response->array($users);
	}

}
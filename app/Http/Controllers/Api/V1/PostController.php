<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

class PostController extends Controller {

	use Helpers;
	
	public function index() {
		return $this->response->array(['test' => 'test']);
	}

}
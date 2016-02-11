<?php
namespace App\Http\Controllers\Api\V1;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Dingo\Api\Routing\Helpers;


class AuthController extends Controller
{
    use Helpers;


    public function token_refresh(){

        $token = JWTAuth::getToken();

        if(!$token){
            
            return $this->response->array(['meta' => ['code' => 400, 'message' => 'BadRequestHttpException'], 'data' => ['status' => 'error', 'errors' => ['name' => 'token_not_provided']]]);
            //throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException('Token not provided');
        }
        try{

            $token = JWTAuth::refresh($token);
        
        } catch(TokenInvalidException $e){
            
            //throw new AccessDeniedHttpException('The token is invalid');
            return $this->response->array(['meta' => ['code' => 403, 'message' => 'AccessDeniedHttpException'], 'data' => ['status' => 'error', 'errors' => ['name' => 'the_token_is_invalid']]]);

        }

        return $this->response->withArray(['token'=>$token]);
    }

    
    public function index() {

        return User::all();

    }

    public function authenticate(Request $request)
    {

        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {

                return $this->response->array(['meta' => ['code' => 200, 'message' => 'OK'], 'data' => ['status' => 'error', 'errors' => ['name' => 'invalid_credentials']]]);

            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->response->array(['meta' => ['code' => 200, 'message' => 'OK'], 'data' => ['status' => 'error', 'errors' => ['name' => 'could_not_create_token']]]);
        }

        // all good so return the token
        return $this->response->array(['meta' => ['code' => 200, 'message' => 'OK'], 'data' => ['token' => compact('token'), 'user' => Auth::user()]]);
    }

    public function store(Request $request) {

    	$input = $request->all();

		$validator = Validator::make($input, User::getCreateRules());
		if ($validator->passes()) {

			$user = new User();
			$user->email = $request->input('email');
            $user->name = $request->input('name');
			$user->password = bcrypt($request->input('password'));

			if (!$user->save()) 
				throw new \Dingo\Api\Exception\StoreResourceFailedException('An error occured. Please, try again.');
		} else {
			throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.', $validator->errors());
		}
		
        $token = JWTAuth::fromUser($user);
		return response()->json(['token' => $token]);

    }
}
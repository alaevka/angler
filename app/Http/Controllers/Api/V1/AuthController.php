<?php
namespace App\Http\Controllers\Api\V1;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
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

                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
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
		//\Log::info('<!> Created : '.$user);
        $token = JWTAuth::fromUser($user);
		return response()->json($token);

    }
}
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
public function register(Request $request)
{
$validator = Validator::make($request->all(), [
'name' => 'required|string|max:255',
'email' => 'required|string|email|unique:users',
'password' => 'required|string|min:6',
]);

if ($validator->fails()) {
return response()->json(['errors' => $validator->errors()], 400);
}

$user = User::create([
'name' => $request->name,
'email' => $request->email,
'password' => bcrypt($request->password),
]);

$token = $user->createToken('MyApp')->accessToken;

return response()->json(['token' => $token], 201);
}

// Implement login, logout, and user retrieval methods here
}


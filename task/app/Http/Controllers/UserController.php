<?php

namespace App\Http\Controllers;

use App\Models\ResponseObject;
use App\Models\User;
use App\Services\UserService;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Info(title="API documentation", version="1.0")
 */

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users/list",
     *     @OA\Response(response="200", description="List of users")
     * )
     */

    public function index()
    {
        Log::info('List of users');
        $users = User::all();
        return response()->json(
            [
                "data" => $users,
                "message" => "list of users",
                "error" => false
            ],
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/api/users/create",
     *     @OA\Response(response="200", description="Create user"),
     *      @OA\Parameter(
     *         name="username",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="gender",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="birthday",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="firstname",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="surname",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="address",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="quote",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string")
     *     )
     * )
     */

    public function store(Request $request)
    {
        Log::info('Create new user');

        $validatedData = $request->validate([
            'username' => 'required|string',
            'gender' => 'required|string',
            'birthday' => 'required|string',
            'firstname' => 'required|string',
            'surname' => 'required|string',
            'address' => 'required|string',
            'quote' =>   'string',
        ]);

        $user = User::create($validatedData);

        return response()->json([
            "data" => $user,
            "message" => "user successfully created",
            "error" => false
        ], 200);
    }


    /**
     * @OA\Get(
     *     path="/api/users/view/{id}",
     *     @OA\Response(response="200", description="View users"),
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *    )
     * )
     */
    public function show(User $user)
    {
        Log::info('View user', [$user]);

        return response()->json([
            "data" => $user,
            "message" => "view users",
            "error" => false
        ], 200);
    }


    /**
     * @OA\Patch(
     *     path="/api/users/{id}",
     *     @OA\Response(response="200", description="User successfully updated"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="username",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="gender",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="birthday",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="firstname",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="surname",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="address",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="quote",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string")
     *     )
     * )
     */
    public function update(Request $request, User $user)
    {
        Log::info('Update user', [$user]);

        $validatedData = $request->validate([
            'username' => 'required|string',
            'gender' => 'required|string',
            'birthday' => 'required|date',
            'firstname' => 'required|string',
            'surname' => 'required|string',
            'address' => 'required|string',
            'quote' =>   'string',
        ]);

        $user->update($validatedData);

        return response()->json([
            "data" => $user,
            "message" => "user successfully updated",
            "error" => false
        ], 200);
    }


    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     @OA\Response(response="200", description="User successfully deleted"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     )
     * )
     */
    public function destroy(User $user)
    {
        Log::info('Delete user', [$user]);

        $user->delete();

        return response()->json([
            "data" => null,
            "message" => "user successfully deleted",
            "error" => false
        ], 200);
    }




}

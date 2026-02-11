<?php

namespace App\Http\Controllers;

use App\Application\User\CreateUser;
use App\Application\User\DeleteUser;
use App\Application\User\DTOs\UserData;
use App\Application\User\ListUsers;
use App\Application\User\UpdateUser;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(ListUsers $listUsers): UserCollection
    {
        return new UserCollection($listUsers());
    }

    public function store(UserStoreRequest $request, CreateUser $createUser): UserResource
    {
        $data = new UserData(
            name: $request->name,
            email: $request->email,
            password: $request->password,
            role: $request->role,
            active: (bool) $request->active
        );

        $user = $createUser($data);

        return new UserResource($user);
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user, UpdateUser $updateUser): UserResource
    {
        $data = new UserData(
            name: $request->name,
            email: $request->email,
            password: $request->password,
            role: $request->role,
            active: (bool) $request->active
        );

        $user = $updateUser($user, $data);

        return new UserResource($user);
    }

    public function destroy(User $user, DeleteUser $deleteUser): Response
    {
        $deleteUser($user);

        return response()->noContent();
    }
}

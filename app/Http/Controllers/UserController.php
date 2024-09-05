<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\CreateUserRequest;

class UserController extends Controller
{
    public function index(): Response
    {
        $loggedInUser = Auth::user()->id;
        $users = User::whereNot('id', $loggedInUser)
            ->whereNull('deleted_at')->get();

        return Inertia::render('Admin/Users/Index', [
            'users' => UserResource::collection($users)
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Users/Create', [
            'roles' => RoleResource::collection(Role::all()),
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    public function store(CreateUserRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();
        
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads', 'public');
            $user->photo = $request->get('photo', $photoPath);
            $validatedData['photo'] = $photoPath;
        }

        $user = $user->create($validatedData); 

        $user->syncRoles($request->input('roles.*.name'));
        $user->syncPermissions($request->input('permissions.*.name'));

        return to_route('users.index');
    }

    public function edit(User $user): Response
    {
        $user->load(['roles', 'permissions']);

        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'roles' => RoleResource::collection(Role::all()),
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    public function update(EditUserRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();
        
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads', 'public');
            $user->photo = $request->get('photo', $photoPath);
            $validatedData['photo'] = $photoPath;
        }

        $user->update($validatedData);

        $user->syncRoles($request->input('roles.*.name'));
        $user->syncPermissions($request->input('permissions.*.name'));
        
        return to_route('users.index');
    }

    public function show(User $user): Response
    {
        $user->load(['roles', 'permissions']);

        return Inertia::render('Admin/Users/Show', [
            'user' => $user,
            'roles' => RoleResource::collection(Role::all()),
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return to_route('users.index');
    }

    public function trashed(): Response
    {
        $loggedInUser = Auth::user()->id;
        $users = User::whereNot('id', $loggedInUser)
            ->whereNotNull('deleted_at')
            ->withTrashed()
            ->get();

        return Inertia::render('Admin/Users/Index', [
            'trashed' => true,
            'users' => UserResource::collection($users)
        ]);
    }

    public function restore($id): RedirectResponse
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return to_route('users.index');
    }
}

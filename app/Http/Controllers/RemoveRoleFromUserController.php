<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;

class RemoveRoleFromUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, Role $role): RedirectResponse
    {
        $user->removeRole($role);
        return back();
    }
}
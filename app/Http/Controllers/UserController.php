<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //

    public function index()
    {
        $users = User::paginate(9);
        return view('pages.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $languages = config('system.lang');
        $experts = Expert::all();
        return view('pages.users.edit', compact('user', 'roles', 'languages', 'experts'));
    }

    public function update(Request $request, User $user)
    {
        $langRuleArray = implode(',', array_keys(config('system.lang')));
        $validated = $request->validate([
            'name' => 'required|unique:users,name,' . $user->id . ',id',
            'email' => 'required|unique:users,email,' . $user->id . ',id',
            'gender' => 'required|in:male,female',
            'language' => 'required|in:' . $langRuleArray,
            'display_name' => 'string',
        ]);

        $user->fill($validated);
        $expert = Expert::find($request->expert);
        if ($expert) {
            $user->expert()->save($expert);
        }
        $user->save();
        $user->syncRoles($request->role);


        return redirect()->to(route('user.show', $user))->withToastSuccess(__('app.user_updated_successfully'));
    }

    public function show(User $user)
    {
        return view('pages.users.view', compact('user'));
    }
}

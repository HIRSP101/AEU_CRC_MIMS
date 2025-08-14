<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\users;
use App\Models\branch;
use App\Models\branch_bindding_user;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . users::class],
            'password' => ['required'],
            'roles' => ['nullable', 'array'],
            'branch_id' => ['nullable'],
            'permissions' => ['nullable', 'array'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);

        if ($request->hasFile('image')) {
            $imageName = 'u-' . (users::latest()->first()->id + 1) . '.' . $request->image->extension();
            $request->image->move(public_path('images/users'), $imageName);
            $imagePath = 'images/users/' . $imageName;
        } else {
            $imagePath = 'images/users/default-profile.png';
        }

        $user = users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagePath
        ]);

        $branchId = null;
        $branchHeiId = null;
        $inputBranchId = $request->branch_id;

        if (Str::startsWith($inputBranchId, 'bra_')) {
            $branchId = str_replace('bra_', '', $inputBranchId);
        } elseif (Str::startsWith($inputBranchId, 'bhei_')) {
            $branchHeiId = str_replace('bhei_', '', $inputBranchId);
        }

        $bbu = branch_bindding_user::create([
            "branch_id" => $branchId,
            "user_id" => $user->id,
            "branch_hei_id" => $branchHeiId
        ]);

        $user->assignRole($request->roles);
        $user->givePermissionTo($request->permissions);
        event(new Registered($user));

        // Auth::login($user);

        return redirect('/userroles');
    }
}

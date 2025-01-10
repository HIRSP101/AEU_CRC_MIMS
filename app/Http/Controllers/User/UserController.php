<?php

namespace App\Http\Controllers\User;

use App\Models\users;
use App\Models\branch;
use App\Models\branch_bindding_user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user_branch = users::with(['branch_bindding_user.branch', 'roles', 'permissions'])
        ->withAggregate('roles', 'id')->orderBy('roles_id', 'asc')->get();
        $branches = branch::all()->pluck('branch_kh', 'branch_id');
        //  dd($user_branch[5]->branch[0]);
        //dd($branches);
        //dd($user_branch[0]->branch_bindding_user[0]->branch->branch_name);
        return view('user.index', compact('user_branch', 'branches'));
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Users::class . ',email,' . $id],
            'password' => ['nullable', 'string'],
            'roles' => ['nullable', 'array'],
            'branch_id' => ['nullable', 'exists:branch,branch_id'],
            'permissions' => ['nullable', 'array'],
        ]);

        $user = Users::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        if (empty($request->password)) {
            $request->request->remove('password');
        } else {
            $request->merge(['password' => bcrypt($request->password)]);
        }

        $user->fill($request->except(['roles', 'permissions']))->save();


        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }
        if ($request->has('permissions')) {
            $user->syncPermissions($request->permissions);
        }

        if ($request->filled('branch_id')) {
         //   dd(branch_bindding_user::where('branch_id', $request->branch_id)->get());
            branch_bindding_user::where('user_id', $user->id)->update(["user_id" => $user->id]);
            branch_bindding_user::where('user_id', $user->id)->update(['branch_id' => $request->branch_id]);

        }

        return redirect('/userroles');
    }

    public function delete(Request $request): RedirectResponse
    {
        $user = users::where('id', $request->id);
        //dd($user);
        if ($user) {
            $bbu = branch_bindding_user::where('user_id', $request->id);
            //  dd("/public/".str_replace("\\",'/',$user->select('id', 'image')->get()->pluck('image')[0]));
            File::delete(public_path($user->select('id', 'image')->get()->pluck('image')[0]));
            //Storage::disk('public')->delete("images/users/u-22.png");
            if ($bbu) {
                $bbu->delete();
            }
            $user->delete();
            return Redirect::to('/userroles');
        }
    }
}

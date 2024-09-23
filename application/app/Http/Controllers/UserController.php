<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, $id = null)
    {

        $order = $request->input('order') ?: null;
        $paginate = $request->input('paginate') ?: null;

        $query = isset($id) ? User::findOrFail($id) : User::query();

        if ($order) {
            $query->orderBy('id', $order);
        }

        if ($paginate) {
            $query->paginate($paginate);
        }


        $users = $query->get();
        // $users = isset($id) ? User::findOrFail($id)->first() : User::get();
        // $users = isset($order) ? User::orderBy('id', $order)->get() : $users;
        // $users = isset($paginate) ? $users->paginate($paginate) : $users;

        // $users = (isset($id)) ? User::orderBy($order)->all() : User::all();
        // $users = isset($id) ? User::findOrFail($id)->first() : (isset($order) ? User::orderBy($order)->all() : User::all());
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'role_id' => 'nullable|integer',
            'profile_picture_id' => 'nullable|integer',
            'biography' => 'nullable|string',
        ]);

        $fields['raw_pass'] = $fields['password'];
        $fields['password'] = bcrypt($fields['password']);

        // dd($fields);
        $user = User::create($fields);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        if ($request->form_type == 'update_password') {
            $fields['raw_pass'] = $request->password;
            $fields['password'] = bcrypt($request->password);
        } else {
            $fields = $request->validate([
                'firstname' => 'nullable',
                'lastname' => 'nullable',
                'phone' => 'nullable',
                'email' => 'nullable',
                'profile_picture_id' => 'nullable',
                'role_id' => 'nullable',
                'permission_id' => 'nullable',
                'status' => 'nullable',
            ]);
        }

        // dd($request->form_type);
        // dd($request->post());
        // dd($fields);

        $user = tap(USER::where('id', $id))->update($fields)->first();
        return response()->json(['message' => 'User Updated successfully', 'user' => $user, 'status' => 200]);
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $destroy = User::destroy($id);
            return response()->json(['message' => 'User Has been deleted successfully', 'status' => $destroy]);
        } else {
            return response()->json(['message' => 'User Not Found']);
        }
    }

    public function users($type = "all")
    {
        $role = Role::where('title', $type)->first();
        $users = ($type == "all") ? User::all()->sortByDesc("id") : User::where('role_id', $role->id)->orderBy('id', 'DESC')->get();
        return view('pages.users.user_list', ['page_title' => $type . " - List", "type" => $type, 'users' => $users]);
    }

    public function user($id)
    {
        $user = User::findOrFail($id)->get();
        return view('pages.users.user_single', ['page_title' => "User - Single", "user" => $user]);
    }

    public function user_create()
    {
        $roles = Role::get();
        // dd($roles);
        return view('pages.users.user_create', ['page_title' => "User - Create", 'roles' => $roles]);
    }

    public function user_edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        return view('pages.users.user_edit', ['page_title' => "User - Edit", 'user' => $user, 'roles' => $roles]);
    }
}

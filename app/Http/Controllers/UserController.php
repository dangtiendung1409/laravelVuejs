<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    public function index()
    {
        $users = User::join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select(
                'users.*',
                'departments.name as departments',
                'users_status.name as status'
            )
            ->where('users.id', '<>', 1)
            ->get();

        return response()->json($users);
    }


    public function create()
    {
        $users_status = \DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();
        $departments = \DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        return response()->json([
            "users_status" => $users_status,
            "departments" => $departments
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "status_id" => "required",
            "username" => "required|unique:users,username",
            "name" => "required|max:255",
            "email" => "required|email",
            "password" => "required|confirmed",
            "department_id" => "required"
        ], [
            "status_id.required" => "Nhập tình trạng",
            "username.required" => "Nhập tên tài khoản",
            "username.unique" => "Tên tài khoản đã tồn tại",
            "name.required" => "Nhập họ và tên",
            "name.max" => "Ký tự tối đa là 255",
            "email.required" => "Nhập email",
            "email.email" => "Email không hợp lệ",
            "password.required" => "Nhập mật khẩu",
            "password.confirmed" => "Mật khẩu và xác nhận mật khẩu không khớp",
            "department_id.required" => "Nhập phòng ban"
        ]);

        // Lưu ảnh vào thư mục public/img
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('img');
            $avatar->move($avatarPath, $avatarName);

            $avatarUrl = 'img/' . $avatarName;
        }

        // Eloquent ORM
        User::create([
            "status_id" => $request["status_id"],
            "username" => $request["username"],
            "name" => $request["name"],
            "email" => $request["email"],
            "password" => \Hash::make($request["password"]),
            "department_id" => $request["department_id"],
            "avatar" => $avatarUrl ?? null
        ]);

        return response()->json(['message' => 'User created successfully']);
    }


    public function edit($id) {
        $users = User::find($id);

        $users_status = \DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();
        $departments = \DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        return response()->json([
            "users" => $users,
            "users_status" => $users_status,
            "departments" => $departments
        ]);

    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "status_id" => "required",
            "username" => "required|unique:users,username,".$id,
            "name" => "required|max:255",
            "email" => "required|email",
            "department_id" => "required"
        ], [
            "status_id.required" => "Nhập tình trạng",
            "username.required" => "Nhập tên tài khoản",
            "username.unique" => "Tên tài khoản đã tồn tại",
            "name.required" => "Nhập họ và tên",
            "name.max" => "Ký tự tối đa là 255",
            "email.required" => "Nhập email",
            "email.email" => "Email không hợp lệ",
            "department_id.required" => "Nhập phòng ban"
        ]);

        $user = User::find($id);
        $user->update([
            "status_id" => $request["status_id"],
            "username" => $request["username"],
            "name" => $request["name"],
            "email" => $request["email"],
            "department_id" => $request["department_id"]
        ]);

        if ($request["change_password"] == true) {
            $validated = $request->validate([
                "password" => "required|confirmed",
            ], [
                "password.required" => "Nhập mật khẩu",
                "password.confirmed" => "Mật khẩu và xác nhận mật khẩu không khớp",
            ]);
            $user->update([
                "password" => \Hash::make($request["password"]),
                "change_password_at" => now()
            ]);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && File::exists(public_path($user->avatar))) {
                File::delete(public_path($user->avatar));
            }

            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('img');
            $avatar->move($avatarPath, $avatarName);

            $user->update([
                "avatar" => 'img/' . $avatarName
            ]);
        }

        return response()->json(['message' => 'User updated successfully']);
    }



    public function destroy($id) {
        User::find($id)->delete();
    }
}





//        // Query builder
//        DB::table('users')->insert([
//            'email' => 'kayla@example.com',
//            'votes' => 0
//        ]);

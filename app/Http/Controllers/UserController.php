<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show(string $id)
    {
        return  User::findOrFail($id);
    }
    public function index()
    {
        $users = User::
            join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select(
                'users.*',
                'departments.name as departments',
                'users_status.name as status'
            )
            ->get();
        return response()->json($users);

    }
    public function create() {
        $users_status = \DB::table("users_status")
            -> select (
                "id as value",
                "name as label"
            )
            ->get();
        $departments = \DB::table("departments")
            -> select (
                "id as value",
                "name as label"
            )
            ->get();

        return response()-> json([
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

        ],[
            "status_id.required" => "Nhập tình trạng",
            "username.required" => "Nhập tên tài khoản",
            "username.unique" => "tên tài khoản đã tồn tại",

            "name.required" => "Nhập họ và tên",
            "name.max" => "Ký tự tối đa là 255",

            "email.required" => "Nhập email",
            "email.email" => "email không hợp lệ",

            "password.required" => "Nhập mật khẩu",
            "password.confirmed" => "mật khẩu và xác nhận mật khẩu không khớp",

            "department_id.required" => "Nhập phòng ban"

        ]);
    }
}

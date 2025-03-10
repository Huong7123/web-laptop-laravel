<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // đăng ký
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|digits_between:10,15',
            'address' => 'nullable|max:255',
            'role_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user = User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'role_id' => $request->role_id ?? 2,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Người dùng đã được tạo thành công',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không thể tạo người dùng: ' . $e->getMessage(),
            ], 500);
        }
    }

    //đăng nhập
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Thông tin đăng nhập không hợp lệ',
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Đăng nhập thành công',
            'user' => $user,
        ]);
    }

    // Lấy thông tin một người dùng (API)
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Người dùng không tồn tại'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);

        // Kiểm tra xem người dùng có tồn tại không
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại.'], 404);
        }

        // Xác thực và cập nhật các trường hợp cần thiết
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:6', // Mật khẩu có thể để trống
            'phone_number' => 'nullable|digits_between:10,15',
            'address' => 'nullable|max:255',
        ]);

        // Cập nhật thông tin người dùng
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;

        // Chỉ cập nhật mật khẩu nếu nó được cung cấp
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Lưu thông tin đã cập nhật
        $user->save();

        return response()->json(['message' => 'Thông tin người dùng đã được cập nhật thành công!', 'user' => $user]);
    }

}
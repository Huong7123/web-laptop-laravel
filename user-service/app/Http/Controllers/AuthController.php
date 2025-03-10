<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Dùng để mã hóa mật khẩu
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    // Đăng ký tài khoản mới
    public function register(Request $request)
    {
        // Xác thực dữ liệu đầu vào
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
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Lưu thông tin người dùng vào cơ sở dữ liệu (mã hóa mật khẩu)
            $user = User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'role_id' => $request->role_id ?? 1,
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

    // Lấy danh sách tất cả người dùng (API)
    public function index()
    {
        $users = User::where('role_id',1)->get();
        return response()->json($users);
    }

    

    //Xóa tài khoản
    public function delete($id)
    {
        // Tìm người dùng theo ID
        $user = User::find($id);

        // Kiểm tra xem người dùng có tồn tại không
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại.'], 404);
        }

        // Xóa người dùng
        $user->delete();

        return response()->json(['message' => 'Người dùng đã được xóa thành công!']);
    }
}
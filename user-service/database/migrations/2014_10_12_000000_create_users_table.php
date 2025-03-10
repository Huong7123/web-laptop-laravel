<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->string('username'); // Trường username, phải là duy nhất
            $table->string('email')->unique(); // Trường email, phải là duy nhất
            $table->string('password'); // Trường mật khẩu
            $table->string('phone_number')->nullable(); // Trường số điện thoại, có thể null
            $table->string('address')->nullable(); // Trường địa chỉ, có thể null
            $table->unsignedBigInteger('role_id')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); // Khóa chính
            $table->unsignedBigInteger('user_id');
            $table->string('order_code'); // Mã đơn hàng
            $table->string('customer_name'); // Tên khách hàng
            $table->string('address'); // Địa chỉ
            $table->string('phone'); // Số điện thoại
            $table->string('payment_method'); // Phương thức thanh toán
            $table->decimal('total_amount', 20, 2); // Tổng số tiền
            $table->string('status'); // Trạng thái
            $table->timestamps(); // Các trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

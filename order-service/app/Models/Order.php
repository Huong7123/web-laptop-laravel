<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';  // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'order_id';  // Khóa chính của bảng
    public $timestamps = true;  // Đảm bảo bảng có cột created_at và updated_at

    // Các trường có thể được gán giá trị
    protected $fillable = [
        'user_id',
        'order_code',
        'customer_name',
        'address',
        'phone',
        'payment_method',
        'total_amount',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

}

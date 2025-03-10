<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order;

class OrderItem extends Model
{
    //
    use HasFactory;
    protected $table = 'order_items';  // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'order_item_id';  // Khóa chính của bảng
    public $timestamps = false;  // Đảm bảo bảng có cột created_at và updated_at
    protected $fillable = [
        'order_id',
        'product_name',
        'quantity',
        'price',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}

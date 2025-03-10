@extends('layout.layout')  

@section('title', 'Thankyou | Laptop-Shoppe') 

@section('content')
<style>
    .btn-return{
        font-size: 20px;
        background: #FE980F;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }
    .thankyou{
        margin-bottom: 20px;
        text-align: center;
    }
</style>
<div class="container thankyou">
    <h1>Cảm ơn bạn!</h1>
    <p style="font-size: 24px;">Đơn hàng của bạn đã được đặt thành công.</p>
    <p style="font-size: 24px;">Chúng tôi đang xử lý đơn hàng của bạn và sẽ liên hệ sớm nhất có thể.</p>
    <a href="/home" class="btn-return">Quay về trang chủ</a>
</div>

@endsection


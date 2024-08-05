@extends('layouts.app')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>Tổng tiền đơn</h2>
            <h3 class="text-danger">{{ number_format($order->total) }} đ</h3>
            <h2>Khách hàng</h2>
                <ul>
                    <li>{{ $order->customer->name }}</li>
                    <li>{{ $order->customer->address }}</li>
                    <li>{{ $order->customer->phone }}</li>
                    <li>{{ $order->customer->email }}</li>
                </ul>
        </div>
       
        <div class="col-md-8">
            <h2>Danh sách sản phẩm</h2>
            <div class="table-reponsive">
                <table class="table">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Nhà cung cấp</th>
                        <th>Giá</th>
                        <th>Số lượng bán</th>
                        <th>Tổng tiền </th>
                        <th>Ngày đặt</th>
                    </tr>
                    @foreach ($order->details as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td>
                                <ul>
                                    <li>{{ $detail->supplier->name }}</li>
                                    <li>{{ $detail->supplier->address }}</li>
                                    <li>{{ $detail->supplier->phone }}</li>
                                    <li>{{ $detail->supplier->email }}</li>
                                </ul>
                            </td>
                            <td>{{ number_format($detail->price) }} đ</td>
                            <td>
                                {{ number_format($detail->pivot->qty) }}
                            </td>
                            <td>
                                {{ number_format($detail->pivot->qty * $detail->price) }} đ
                            </td>
                            <td>
                                {{ $detail->created_at }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Quay về</a>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    Sửa đơn hàng
@endsection

@section('content')
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    @if (session()->has('succes'))
        <div class="alert alert-success">
            {{ session()->get('succes') }}
        </div>
    @endif
    <form action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <h2>Tổng tiền</h2>
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
                            <th>Giá</th>
                            <th>Số lượng bán</th>
                        </tr>
                        @foreach ($order->details as $detail)
                            <tr>
                                <td>{{ $detail->name }}</td>
                                <td>{{ number_format($detail->price) }} đ</td>
                                <td>
                                    <input type="hidden" name="order_details[{{ $detail->id }}][price]"
                                        value="{{ $detail->pivot->price }}">
                                    <input type="number" class="form-control"
                                        name="order_details[{{ $detail->id }}][qty]" value="{{ $detail->pivot->qty }}">
                                    @error("order_details.$order->id.qty")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('orders.index')}}" class="btn btn-primary">Quay về</a>
            </div>
        </div>
    </form>
@endsection

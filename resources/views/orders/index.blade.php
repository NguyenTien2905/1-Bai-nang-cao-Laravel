@extends('layouts.app')

@section('title')
    Danh mục đơn hàng
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
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('orders.create') }}" class="mb-2 btn btn-primary">Thêm</a>
            <form action="{{ route('logout') }}" method="post" class="float-end">
                @csrf
                <button type="submit" class="btn btn-danger">Đăng xuất</button>
            </form>
            <div class="table-reponsive">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Người đặt</th>
                        <th>Tổng tiền</th>
                        <th>Sản phẩm</th>
                        <th>Ngày đặt</th>
                        <th>Ngày cập nhật</th>
                        <th>Thao tác</th>
                    </tr>
                    <tr>
                        @foreach ($orders as $order)
                            <td>{{ $order->id }}</td>
                            <td>
                                <ul>
                                    <li>{{ $order->customer->name }}</li>
                                    <li>{{ $order->customer->address }}</li>
                                    <li>{{ $order->customer->phone }}</li>
                                    <li>{{ $order->customer->email }}</li>
                                </ul>
                            </td>
                            <td>{{ number_format($order->total) }} đ</td>
                            <td>
                                @foreach ($order->details as $detail)
                                <h6>Sản phẩm: {{ $detail->name }}</h6>
                                <ul>
                                    <li>Giá: {{ number_format($detail->pivot->price) }}</li>
                                    <li>Số lượng: {{ $detail->pivot->qty }}</li>
                                    @if ($detail->image && \Storage::exists($detail->image))
                                        <li>
                                            <img width="100px" src="{{ \Storage::url($detail->image) }}" alt="">
                                        </li>
                                    @endif
                                </ul>
                                @endforeach
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                <div>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success">Chi tiết</a>
                                </div>

                                <div class="d-flex mt-2">
                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Sửa</a>

                                    <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Chắc chắn muốn xóa không ?')"
                                            class="btn btn-danger">Xóa</button>
                                    </form>
                                </div>
                            </td>
                    </tr>
                    @endforeach
                </table>
            </div>

            {{ $orders->links() }}
        </div>
    </div>
@endsection

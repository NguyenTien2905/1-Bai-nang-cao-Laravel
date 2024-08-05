@extends('layouts.app')

@section('title')
    Thêm mới đơn hàng
@endsection

@section('content')
    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h2>Customer</h2>
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Tên</label>
                    <input type="text" class="form-control" name="customer[name]" id="customer_name"
                        value="{{ old('customer[name]') }}">
                    @error('customer.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="customer[address]" id="customer_address"
                        value="{{ old('customer[address]') }}">
                    @error('customer.address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_phone" class="form-label">SĐT</label>
                    <input type="tel" class="form-control" name="customer[phone]" id="customer_phone"
                        value="{{ old('customer[phone]') }}">
                    @error('customer.phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="customer_email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="customer[email]" id="customer_email"
                        value="{{ old('customer[email]') }}">
                    @error('customer.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <h2>Supplier</h2>
                <div class="mb-3">
                    <label for="supplier_name" class="form-label">Tên</label>
                    <input type="text" class="form-control" name="supplier[name]" id="supplier_name"
                        value="{{ old('supplier[name]') }}">
                    @error('supplier.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="supplier_address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="supplier[address]" id="supplier_address"
                        value="{{ old('supplier[address]') }}">
                    @error('supplier.address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="supplier_phone" class="form-label">SĐT</label>
                    <input type="tel" class="form-control" name="supplier[phone]" id="supplier_phone"
                        value="{{ old('supplier[phone]') }}">
                    @error('supplier.phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="supplier_email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="supplier[email]" id="supplier_email"
                        value="{{ old('supplier[email]') }}">
                    @error('supplier.email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <h2 class="my-3">Add Products</h2>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Tên Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Số lượng trong kho</th>
                            <th>Số lượng bán </th>
                        </tr>
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="products[{{ $i }}][name]"
                                        value="{{ old("products.$i.name") }}">

                                    @error("products.$i.name")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="products[{{ $i }}][image]">
                                    @error("products.$i.image")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" class="form-control"
                                        name="products[{{ $i }}][description]"
                                        value="{{ old("products.$i.description") }}">
                                    @error("products.$i.description")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="products[{{ $i }}][price]"
                                        value="{{ old("products.$i.price") }}">
                                    @error("products.$i.price")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" class="form-control"
                                        name="products[{{ $i }}][stock_qty]"
                                        value="{{ old("products.$i.stock_qty") }}">
                                    @error("products.$i.stock_qty")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>

                                <td>
                                    <input type="number" class="form-control"
                                        name="order_details[{{ $i }}][qty]"
                                        value="{{ old("order_details.$i.qty") }}">
                                    @error("order_details.$i.qty")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                        @endfor
                    </table>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
@endsection

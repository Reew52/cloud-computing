@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection

@section('content')
    <h1>{{$title}}</h1>
    {{-- Nếu có lỗi sẽ xuất hiện --}}
    @if ($errors ->any())
        <div class="alert alert-danger">Dữ liệu nhập vào không hợp. Vui lòng kiểm tra lại dữ liệu</div>
    @endif

    {{-- form nhập --}}
    <form action="" method="post">

        {{-- nhập Name --}}
        <div class="mb-3">
            <label for="">Tên công ty</label>
            <input type="text" class="form-control" name="unit_name" placeholder="Họ và tên..." value="{{old('unit_name')}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('unit_name')
                <span style="color: red">{{$message}} </span>
            @enderror

        </div>

        {{-- nhập email --}}
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control" name="unit_email" placeholder="Email..." value="{{old('unit_email')}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('unit_email')
                <span style="color: red">{{$message}} </span>
            @enderror

        </div>

        {{-- Công ty --}}
        <div class="mb-3">
            {{-- Chọn Công ty --}}
            <label for="">Công ty: </label>
            <select name="cp_id" name="form-control">
                <option value="0">Chọn Công ty</option>
                @if (!empty($allCompany))
                    @foreach ($allCompany as $item)
                    <option value="{{$item->cp_id}}" {{old('cp_id')==$item->cp_id?'selected':false}}> {{$item->cp_name}}</option>
                    @endforeach
                @endif
            </select>
            {{-- gọi ra lỗi của công ty --}}
            @error('cp_id')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- nhập Phone Number --}}
        <div class="mb-3">
            <label for="">Phone Number</label>
            <input type="text" class="form-control" name="unit_phoneNumber" placeholder="Phone Number..." value="{{old('unit_phoneNumber')}}">
            {{-- gọi ra lỗi của phone Number --}}
            @error('unit_phoneNumber')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- nhập Address --}}
        <div class="mb-3">
            <label for="">Address</label>
            <input type="text" class="form-control" name="unit_address" placeholder="Address..." value="{{old('unit_address')}}">
            {{-- gọi ra lỗi của Address --}}
            @error('unit_address')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{route('admin.unit.index')}} " class="btn btn-warning">Quay lại</a>
        @csrf
    </form>
    <br>
@endsection
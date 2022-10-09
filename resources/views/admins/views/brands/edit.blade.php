@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection

@section('content')
    <h1>{{$title}} </h1>
    {{-- Nếu có lỗi sẽ xuất hiện --}}
    @if ($errors ->any())
        <div class="alert alert-danger">Dữ liệu nhập vào không hợp. Vui lòng kiểm tra lại dữ liệu</div>
    @endif

    {{-- form nhập --}}
    <form action="{{route('admin.brand.postEdit')}}" method="post">

        {{-- nhập Name --}}
        <div class="mb-3">
            <label for="">Tên Thuong hieu</label>
            <input type="text" class="form-control" name="brand_name" placeholder="Họ và tên..." value="{{old('brand_name') ?? $brandDetail->brand_name}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('brand_name')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{route('admin.brand.index')}} " class="btn btn-warning">Quay lại</a>
        @csrf
    </form>
    <br>
@endsection
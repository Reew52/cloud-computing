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
    <form action="{{route('admin.color.postEdit')}}" method="post">

        {{-- nhập Name --}}
        <div class="mb-3">
            <label for="">Màu Sắc</label>
            <input type="text" class="form-control" name="color_name" placeholder="Tên màu sắc..." value="{{old('color_name') ?? $colorDetail->color_name}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('color_name')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{route('admin.color.index')}} " class="btn btn-warning">Quay lại</a>
        @csrf
    </form>
    <br>
@endsection
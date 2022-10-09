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
    <form action="{{route('admin.company.postEdit')}}" method="post">

        {{-- nhập Name --}}
        <div class="mb-3">
            <label for="">Name</label>
            <input type="text" class="form-control" name="cp_name" placeholder="Tên công ty..." value="{{old('cp_name') ?? $companyDetail->cp_name }}">
            {{-- gọi ra lỗi của fullname --}}
            @error('cp_name')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- nhập email --}}
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control" name="cp_email" placeholder="Email..." value="{{old('cp_email')  ?? $companyDetail->cp_email }}">
            {{-- gọi ra lỗi của fullname --}}
            @error('cp_email')
                <span style="color: red">{{$message}} </span>
            @enderror

        </div>

        {{-- nhập Phone Number --}}
        <div class="mb-3">
            <label for="">Phone Number</label>
            <input type="text" class="form-control" name="cp_phoneNumber" placeholder="Phone Number..." value="{{old('cp_phoneNumber')  ?? $companyDetail->cp_phoneNumber }}">
            {{-- gọi ra lỗi của fullname --}}
            @error('cp_phoneNumber')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- nhập Address --}}
        <div class="mb-3">
            <label for="">Address</label>
            <input type="text" class="form-control" name="cp_address" placeholder="Address..." value="{{old('cp_address') ?? $companyDetail->cp_address }}">
            {{-- gọi ra lỗi của fullname --}}
            @error('cp_address')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{route('admin.company.index')}} " class="btn btn-warning">Quay lại</a>
        @csrf
    </form>
    <br>
@endsection
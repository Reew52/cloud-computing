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
    <form action="{{route('admin.user.postEdit')}}" method="post">

        {{-- nhập Name --}}
        <div class="mb-3">
            <label for="">Họ và tên</label>
            <input type="text" class="form-control" name="user_name" placeholder="Họ và tên..." value="{{old('user_name') ?? $userDetail ->user_name}} ">
            {{-- gọi ra lỗi của fullname --}}
            @error('user_name')
                <span style="color: red">{{$message}} </span>
            @enderror

        </div>

        {{-- nhập email --}}
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control" name="user_email" placeholder="Email..." value="{{old('user_email') ?? $userDetail->user_email}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('user_email')
                <span style="color: red">{{$message}} </span>
            @enderror

        </div>

        {{-- Chọn Role --}}
        <div class="mb-3">
            <label for="">Role</label>
            <select name="ur_id" name="form-control">
                <option value="0">Chọn Role</option>
                @if (!empty($allUserRole))
                    @foreach ($allUserRole as $item)
                    <option value="{{$item->ur_id}}" {{old('ur_id')==$item->ur_id || $userDetail->ur_id ?'selected':false}}> {{$item->ur_name}}</option>
                    @endforeach
                @endif
            </select>
            {{-- gọi ra lỗi của fullname --}}
            @error('user_role')
                <span style="color: red">{{$message}} </span>
            @enderror

            {{-- Chọn trạng thái --}}
            <label for="">Trạng thái: </label>
            <select name="user_status" name="form-control">
                <option value="0" {{old('user_status')==0 || $userDetail->user_status ?'selected':false?'selected':false}}>Chưa kích hoạt</option>
                <option value="1" {{old('user_status')==1 || $userDetail->user_status ?'selected':false?'selected':false}}>Kích hoạt</option>
            </select>
            {{-- gọi ra lỗi của trạng thái --}}
            @error('user_status')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- nhập Phone Number --}}
        <div class="mb-3">
            <label for="">Phone Number</label>
            <input type="text" class="form-control" name="user_phoneNumber" placeholder="Phone Number..." value="{{old('user_phoneNumber')?? $userDetail->user_phoneNumber}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('user_phoneNumber')
                <span style="color: red">{{$message}} </span>
            @enderror

        </div>

        {{-- nhập Password --}}
        <div class="mb-3">
            <label for="">Password</label>
            <input type="password" class="form-control" name="user_password" placeholder="Password..." value="{{old('user_password') ?? $userDetail->user_password}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('user_password')
                <span style="color: red">{{$message}} </span>
            @enderror

        </div>

        {{-- nhập Address --}}
        <div class="mb-3">
            <label for="">Address</label>
            <input type="text" class="form-control" name="user_address" placeholder="Address..." value="{{old('user_address') ?? $userDetail->user_address}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('user_address')
                <span style="color: red">{{$message}} </span>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
        <a href="{{route('admin.user.index')}} " class="btn btn-warning">Quay lại</a>
        @csrf
    </form>
    <br>
@endsection
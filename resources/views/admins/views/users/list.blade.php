@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection

@section('content')
    <h1>{{$title}}</h1>
    @if(session('msg'))
        <div class="alert alert-success"> {{session('msg')}}</div>
    @endif
    {{-- chuyển đến trang thêm người dùng --}}
    <a href="{{route('admin.user.add')}} " class="btn btn-primary">Thêm người dùng</a>
    <hr>
    {{-- form xử lý tìm kiếm --}}
    <form action="" method="GET" class="mb-3">
        <div class="row">

            {{-- Role --}}
            <div class="col-2">
                <select class="form-control" name="ur_id">
                    <option value="0">Role</option>
                    @if (!empty(getAllUserRoles()))
                        @foreach (getAllUserRoles() as $item)
                            <option value="{{$item->ur_id}}" {{request()->ur_id == $item->ur_id ? 'selected' : false}} {{request()->ur_id == 'active' ? 'selected' : false}}> {{$item->ur_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            {{-- trạng thái --}}
            <div class="col-2">
                <select class="form-control" name="status">
                    <option value="0">Tất cả trạng thái</option>
                    {{-- request()-> ... để lưu lại thông tin vừa nhập sau khi submit --}}
                    <option value="active" {{request()->status == 'active' ? 'selected' : false}}>Kích hoạt</option>
                    <option value="inactive" {{request()->status =='inactive' ? 'selected' : false}}>Chưa kích hoạt</option>
                </select>
            </div>
            
            {{-- Input tìm kiếm --}}
            <div class="col-2">
                <input type="search" class="form-control" name="keywords" placeholder="Từ khóa tìm kiếm..." value="{{request()->keywords}}">
            </div>

            {{-- Submit tìm kiếm --}}
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>

        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width= "4%">STT</th>
                <th width= "15%">Name</th>
                <th width= "8%">Vai trò</th>
                <th>Trạng thái</th>
                <th>Email</th>
                <th width= "12%">Phone Number</th>
                <th width= "8%">Address</th>
                <th width= "10%">Time</th>
                <th width= "5%">Sửa</th>
                <th width= "5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($userList))
            {{-- nếu có $users sẽ show ra mảng, dùng foreach để lấy mảng ra --}}
                @foreach ($userList as $key => $item)           
                    <tr>
                        <td>{{$key+1}} </td>
                        <td>{{$item->user_name}}</td>
                        <td>{{$item->role}}</td>
                        <td>{!! $item->user_status==0?'<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>':'<button class="btn btn-success btn-sm">Kích hoạt</button>' !!}</td>
                        <td>{{$item->user_email}}</td>
                        <td>{{$item->user_phoneNumber}}</td>
                        <td>{{$item->user_address}}</td>
                        <td>{{$item->user_createAt}}</td>
                        <td>
                            <a href="{{route('admin.user.edit', ['id' => $item->user_id])}}" class="btn btn-warning btn-sm">Sửa</a>
                        </td>
                        <td>
                            {{-- xóa rất nguy hiểm chúng ta cần phải tạo để xác thực --}}
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.user.delete', ['id' => $item->user_id])}}" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="10"> Không có người dùng</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{-- Chuyển tiếp giữa các trang --}}
    <div class="d-flex justify-content-center">
        {{$userList->links()}}
    </div>
@endsection
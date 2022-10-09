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
    <a href="{{route('admin.company.add')}} " class="btn btn-primary">Thêm Công ty</a>
    <hr>
    {{-- form xử lý tìm kiếm --}}
    <form action="" method="GET" class="mb-3">
        <div class="row">
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
                <th width= "16%">Name</th>
                <th width= "25%">Email</th>
                <th>Phone Number</th>
                <th width= "20%">Address</th>
                <th width= "5%">Sửa</th>
                <th width= "5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($companyList))
                @foreach ($companyList as $key => $item)           
                    <tr>
                        <td>{{$key+1}} </td>
                        <td>{{$item->cp_name}}</td>
                        <td>{{$item->cp_email}}</td>
                        <td>{{$item->cp_phoneNumber}}</td>
                        <td>{{$item->cp_address}}</td>
                        <td>
                            <a href="{{route('admin.company.edit', ['id' => $item->cp_id])}}" class="btn btn-warning btn-sm">Sửa</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.company.delete', ['id' => $item->cp_id])}}" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="10"> Không có Công ty</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{-- Chuyển tiếp giữa các trang --}}
    <div class="d-flex justify-content-center">
        {{$companyList->links()}}
    </div>
@endsection
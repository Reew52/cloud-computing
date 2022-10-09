@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection

@section('content')
    <h1>{{$title}} </h1>
    @if(session('msg'))
        <div class="alert alert-success"> {{session('msg')}}</div>
    @endif
    {{-- chuyển đến trang thêm người dùng --}}
    <a href="{{route('admin.brand.add')}}" class="btn btn-primary">Thêm thuong hieu</a>
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
                <th>Name</th>
                <th width= "5%">Sửa</th>
                <th width= "5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($brandList))
                @foreach ($brandList as $key => $item)           
                <tr>
                    <td>{{$key+1}} </td>
                    <td>{{$item->brand_name}}</td>
                    <td>
                        <a href="{{route('admin.brand.edit', ['id' => $item->brand_id])}}" class="btn btn-warning btn-sm">Sửa</a>
                    </td>
                    <td>
                        {{-- xóa rất nguy hiểm chúng ta cần phải tạo để xác thực --}}
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.brand.delete', ['id' => $item->brand_id])}}" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="4"> Không có đơn vị</td>
                </tr>
            @endif
        </tbody>
    </table>
     {{-- Chuyển tiếp giữa các trang --}}
     <div class="d-flex justify-content-center">
        {{$brandList->links()}}
    </div>
@endsection
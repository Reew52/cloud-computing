@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection

@section('content')
    <h1>{{$title}}</h1>
    @if(session('msg'))
        <div class="alert alert-success"> {{session('msg')}}</div>
    @endif
    {{-- chuyển đến trang thêm đơn vị --}}
    <a href="{{route('admin.unit.add')}} " class="btn btn-primary">Thêm đơn vị</a>
    <hr>
    {{-- form xử lý tìm kiếm --}}
    <form action="" method="GET" class="mb-3">
        <div class="row">

            {{-- Cong Ty --}}
            <div class="col-2">
                <select class="form-control" name="cp_id">
                    <option value="0">Tất cả Công ty</option>
                    @if (!empty(getAllCompanys()))
                        @foreach (getAllCompanys() as $item)
                            <option value="{{$item->cp_id}}" {{request()->cp_id == $item->cp_id ? 'selected' : false}} {{request()->cp_id == 'active' ? 'selected' : false}}> {{$item->cp_name}}</option>
                        @endforeach
                    @endif
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
                <th>Name</th>
                <th>Công ty</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th width= "5%">Sửa</th>
                <th width= "5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($unitList))
                @foreach ($unitList as $key => $item)           
                <tr>
                    <td>{{$key+1}} </td>
                    <td>{{$item->unit_name}}</td>
                    <td>{{$item->company_name}}</td>
                    <td>{{$item->unit_email}}</td>
                    <td>{{$item->unit_phoneNumber}}</td>
                    <td>{{$item->unit_address}}</td>
                    <td>
                        <a href="{{route('admin.unit.edit', ['id' => $item->unit_id])}}" class="btn btn-warning btn-sm">Sửa</a>
                    </td>
                    <td>
                        {{-- xóa rất nguy hiểm chúng ta cần phải tạo để xác thực --}}
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.unit.delete', ['id' => $item->unit_id])}}" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="10"> Không có đơn vị</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{-- Chuyển tiếp giữa các trang --}}
    <div class="d-flex justify-content-center">
        {{$unitList->links()}}
    </div>
@endsection
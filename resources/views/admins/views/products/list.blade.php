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
    <a href="{{route('admin.product.add')}} " class="btn btn-primary">Thêm Sản phẩm</a>
    <hr>
    {{-- form xử lý tìm kiếm --}}
    <form action="" method="GET" class="mb-3">
        <div class="row">

            {{-- Brands --}}
            <div class="col-2">
                <select class="form-control" name="brands">
                    <option value="0">All Brands</option>
                    @if (!empty(getAllBrands()))
                        @foreach (getAllBrands() as $item)
                            <option value="{{$item->brand_id}}" {{request()->brands == $item->brand_id ? 'selected' : false}} {{request()->brand_id == 'active' ? 'selected' : false}}> {{$item->brand_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            {{-- Color --}}
            <div class="col-2">
                <select class="form-control" name="colors">
                    <option value="0">All Colors</option>
                    @if (!empty(getAllColors()))
                        @foreach (getAllColors() as $item)
                            <option value="{{$item->color_id}}" {{request()->colors == $item->color_id ? 'selected' : false}} {{request()->color_id == 'active' ? 'selected' : false}}> {{$item->color_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            {{-- RAM --}}
            <div class="col-2">
                <select class="form-control" name="rams">
                    <option value="0">All Rams</option>
                    {{-- request()-> ... để lưu lại thông tin vừa nhập sau khi submit --}}
                    <option value="2" {{request()->rams =='2' ? 'selected' : false}}>2 GB</option>
                    <option value="4" {{request()->rams =='4' ? 'selected' : false}}>4 GB</option>
                    <option value="6" {{request()->rams =='6' ? 'selected' : false}}>6 GB</option>
                    <option value="8" {{request()->rams =='8' ? 'selected' : false}}>8 GB</option>
                </select>
            </div>

            {{-- RAM --}}
            <div class="col-1">
                <select class="form-control" name="internal_memory">
                    <option value="0">All IM</option>
                    {{-- request()-> ... để lưu lại thông tin vừa nhập sau khi submit --}}
                    <option value="32"   {{request()->internal_memory =='32'   ? 'selected' : false}}> 32 GB  </option>
                    <option value="64"   {{request()->internal_memory =='64'   ? 'selected' : false}}> 64 GB  </option>
                    <option value="128"  {{request()->internal_memory =='128'  ? 'selected' : false}}> 128 GB </option>
                    <option value="256"  {{request()->internal_memory =='256'  ? 'selected' : false}}> 256 GB </option>
                    <option value="512"  {{request()->internal_memory =='512'  ? 'selected' : false}}> 512 GB </option>
                    <option value="1024" {{request()->internal_memory =='1024' ? 'selected' : false}}> 1024 GB</option>
                </select>
            </div>

            {{-- Operating System --}}
            <div class="col-1">
                <select class="form-control" name="operating_system">
                    <option value="0">All OS</option>
                    {{-- request()-> ... để lưu lại thông tin vừa nhập sau khi submit --}}
                    <option value="Android" {{request()->operating_system =='Android' ? 'selected' : false}}> Android  </option>
                    <option value="IOS" {{request()->operating_system =='IOS' ? 'selected' : false}}> IOS </option>
                    <option value="Windows Phone" {{request()->operating_system =='Windows Phone' ? 'selected' : false}}> Windows Phone </option>
                    <option value="Symbian" {{request()->operating_system =='Symbian' ? 'selected' : false}}> Symbian </option>
                    <option value="BlackBerry OS" {{request()->operating_system =='BlackBerry OS' ? 'selected' : false}}> BlackBerry OS </option>
                    <option value="Bada" {{request()->operating_system =='Bada' ? 'selected' : false}}> Bada</option>
                </select>
            </div>

            {{-- warranty_period --}}
            <div class="col-1">
                <select class="form-control" name="warranty_period">
                    <option value="0">All WP</option>
                    {{-- request()-> ... để lưu lại thông tin vừa nhập sau khi submit --}}
                    <option value="6"  {{request()->warranty_period =='6'  ? 'selected' : false}}> 6 months  </option>
                    <option value="8"  {{request()->warranty_period =='8'  ? 'selected' : false}}> 8 months  </option>
                    <option value="12" {{request()->warranty_period =='12' ? 'selected' : false}}> 12 months </option>
                    <option value="18" {{request()->warranty_period =='18' ? 'selected' : false}}> 18 months </option>
                    <option value="24" {{request()->warranty_period =='24' ? 'selected' : false}}> 24 months </option>
                    <option value="36" {{request()->warranty_period =='36' ? 'selected' : false}}> 36 months </option>
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
                <th>Brand</th>
                <th>Color</th>
                <th>RAM</th>
                <th>Internal memory</th>
                <th>Operating System</th>
                <th>Warranty Period</th>
                <th>Origin</th>
                <th>Price</th>
                <th>Reduced Price</th>
                <th>Launch Date</th>
                <th>Image</th>
                <th width= "5%">Sửa</th>
                <th width= "5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($productList))
            {{-- nếu có $users sẽ show ra mảng, dùng foreach để lấy mảng ra --}}
                @foreach ($productList as $key => $item)           
                    <tr>
                        <td>{{$key+1}} </td>
                        <td>{{$item->pro_name}}</td>
                        <td>{{$item->brands}}</td>
                        <td>{{$item->colors}}</td>
                        <td>{{$item->pro_ram}}</td>
                        <td>{{$item->pro_iMemory}}</td>
                        <td>{{$item->pro_oSystem}}</td>
                        <td>{{$item->pro_warrantyPeriod}}</td>
                        <td>{{$item->pro_origin}}</td>
                        <td>{{$item->pro_price}}</td>
                        <td>{{$item->pro_reducedPrice}}</td>
                        <td>{{$item->pro_launchDate}}</td>
                        <td><a href="{{route('admin.product.image', ['id' => $item->pro_id])}}" class="btn btn-primary">Image</a></td>
                        <td>
                            <a href="{{route('admin.product.edit', ['id' => $item->pro_id])}}" class="btn btn-warning btn-sm">Sửa</a>
                        </td>
                        <td>
                            {{-- xóa rất nguy hiểm chúng ta cần phải tạo để xác thực --}}
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.product.delete', ['id' => $item->pro_id])}}" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="14"> Không có Sản phẩm</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{-- Chuyển tiếp giữa các trang --}}
    <div class="d-flex justify-content-center">
        {{$productList->links()}}
    </div>
@endsection
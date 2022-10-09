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
    <form action="{{route('admin.product.postEdit')}}" method="post">

        {{-- nhập Name --}}
        <div class="mb-3">
            <label for="">Name</label>
            <input type="text" class="form-control" name="pro_name" placeholder="Name..." value="{{old('pro_name') ?? $productDetail->pro_name}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('pro_name')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- brand --}}
        <div class="mb-3">
            <label for="">Brand: </label>
            <select name="brand_id" name="form-control">
                <option value="0">Brand</option>
                @if (!empty($allBrands))
                    @foreach ($allBrands as $item)
                    <option value="{{$item->brand_id}}" {{old('brand_id') || $productDetail->brand_id == $item->brand_id ?'selected':false}}> {{$item->brand_name}}</option>
                    @endforeach
                @endif
            </select>
            {{-- gọi ra lỗi của rolename --}}
            @error('brand_id')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>
        {{-- Color --}}
        <div class="mb-3">
            <label for="">Color: </label>
            <select name="color_id" name="form-control">
                <option value="0">Color</option>
                @if (!empty($allColors))
                    @foreach ($allColors as $item)
                    <option value="{{$item->color_id}}" {{old('color_id') ||$productDetail->color_id == $item->color_id?'selected':false}}> {{$item->color_name}}</option>
                    @endforeach
                @endif
            </select>
            @error('color_id')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- RAM --}}
        <div class="mb-3">
            <label for="">RAM: </label>
            <select name="pro_ram" name="form-control">
                <option value="0" >RAM</option>
                <option value="2" {{old('pro_ram') || $productDetail->pro_ram==2?'selected':false}}>2 GB</option>
                <option value="4" {{old('pro_ram') || $productDetail->pro_ram==4?'selected':false}}>4 GB</option>
                <option value="6" {{old('pro_ram') || $productDetail->pro_ram==6?'selected':false}}>6 GB</option>
                <option value="8" {{old('pro_ram') || $productDetail->pro_ram==8?'selected':false}}>8 GB</option>
            </select>
            {{-- gọi ra lỗi của trạng thái --}}
            @error('rams')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- BO nho trong --}}
        <div class="mb-3">
            <label for="">Internal memory: </label>
            <select name="pro_iMemory" name="form-control">
                <option value="0">Internal Memory</option>
                <option value="32" {{old('pro_iMemory') || $productDetail->pro_iMemory==32?'selected':false}}>32 GB</option>
                <option value="64" {{old('pro_iMemory') || $productDetail->pro_iMemory==64?'selected':false}}>64 GB</option>
                <option value="128" {{old('pro_iMemory') || $productDetail->pro_iMemory==128?'selected':false}}>128 GB</option>
                <option value="256" {{old('pro_iMemory') || $productDetail->pro_iMemory==256?'selected':false}}>256 GB</option>
                <option value="512" {{old('pro_iMemory') || $productDetail->pro_iMemory==512?'selected':false}}>512 GB</option>
                <option value="1024" {{old('pro_iMemory') || $productDetail->pro_iMemory==1024?'selected':false}}>1024 GB</option>
            </select>
            {{-- gọi ra lỗi của trạng thái --}}
            @error('pro_iMemory')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- He dieu hanh --}}
        <div class="mb-3">
            <label for="">Operating System: </label>
            <select name="pro_oSystem" name="form-control">
                <option value="0">Operating System</option>
                <option value="Android" {{ old('pro_oSystem') || $productDetail->pro_oSystem=='Android'?'selected':false}}>Android</option>
                <option value="IOS" {{old('pro_oSystem') || $productDetail->pro_oSystem=='IOS'?'selected':false}}>IOS</option>
                <option value="Windows Phone" {{old('pro_oSystem') || $productDetail->pro_oSystem=='Windows Phone'?'selected':false}}>Windows Phone</option>
                <option value="Symbian" {{old('pro_oSystem') || $productDetail->pro_oSystem=='Symbian'?'selected':false}}>Symbian</option>
                <option value="BlackBerry OS" {{old('pro_oSystem') || $productDetail->pro_oSystem=='BlackBerry OS'?'selected':false}}>BlackBerry OS</option>
                <option value="Bada" {{old('pro_oSystem') || $productDetail->pro_oSystem=='Bada'?'selected':false}}>Bada</option>
            </select>
            {{-- gọi ra lỗi của trạng thái --}}
            @error('pro_oSystem')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- He dieu hanh --}}
        <div class="mb-3">
            <label for="">Warranty Period: </label>
            <select name="pro_warrantyPeriod" name="form-control">
                <option value="0">Warranty Period</option>
                <option value="6"  {{old('pro_warrantyPeriod') || $productDetail->pro_warrantyPeriod=='6' ?'selected':false}}>6 months</option>
                <option value="8"  {{old('pro_warrantyPeriod') || $productDetail->pro_warrantyPeriod=='8' ?'selected':false}}>8 months</option>
                <option value="12" {{old('pro_warrantyPeriod') || $productDetail->pro_warrantyPeriod=='12'?'selected':false}}>12 months</option>
                <option value="18" {{old('pro_warrantyPeriod') || $productDetail->pro_warrantyPeriod=='18'?'selected':false}}>18 months</option>
                <option value="24" {{old('pro_warrantyPeriod') || $productDetail->pro_warrantyPeriod=='24'?'selected':false}}>24 months</option>
                <option value="32" {{old('pro_warrantyPeriod') || $productDetail->pro_warrantyPeriod=='32'?'selected':false}}>32 months</option>
            </select>
            {{-- gọi ra lỗi của trạng thái --}}
            @error('pro_warrantyPeriod')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- pro_quatity --}}
        <div class="mb-3">
            <label for="">Quatity</label>
            <input type="text" class="form-control" name="pro_quatity" placeholder="Quatity..." value="{{old('pro_quatity') ?? $productDetail->pro_quatity}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('pro_quatity')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- Origin --}}
        <div class="mb-3">
            <label for="">Origin</label>
            <input type="text" class="form-control" name="pro_origin" placeholder="Origin..." value="{{old('pro_origin') ?? $productDetail->pro_origin}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('pro_origin')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- price --}}
        <div class="mb-3">
            <label for="">Price</label>
            <input type="text" class="form-control" name="pro_price" placeholder="Price..." value="{{old('pro_price') ?? $productDetail->pro_price}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('pro_price')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- Reduced Price --}}
        <div class="mb-3">
            <label for="">Reduced Price</label>
            <input type="text" class="form-control" name="pro_reducedPrice" placeholder="Reduced Price..." value="{{old('pro_reducedPrice') ?? $productDetail->pro_reducedPrice}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('pro_reducedPrice')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- pro_launchDate --}}
        <div class="mb-3">
            <label for="">Reduced Price</label>
            <input type="date" class="form-control" name="pro_launchDate" placeholder="Launch Date..." value="{{old('pro_launchDate') ?? $productDetail->pro_launchDate}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('pro_launchDate')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        {{-- pro_description --}}
        <div class="mb-3">
            <label for="">Description</label>
            <input type="text" class="form-control" name="pro_description" placeholder="Description..." value="{{old('pro_description') ?? $productDetail->pro_description}}">
            {{-- gọi ra lỗi của fullname --}}
            @error('pro_description')
                <span style="color: red">{{$message}} </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{route('admin.product.index')}} " class="btn btn-warning">Quay lại</a>
        @csrf
    </form>
    <br>
@endsection
@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection

@section('content')
    <h1>{{$title}}</h1>
    @if(session('msg'))
        <div class="alert alert-success"> {{session('msg')}}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($productList))
            {{-- nếu có $users sẽ show ra mảng, dùng foreach để lấy mảng ra --}}
                @foreach ($productList as $key => $item)           
                    <tr>
                        <td>{{$item->pro_image}}</td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="1"> Không có Sản phẩm</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{-- Chuyển tiếp giữa các trang --}}
    <div class="d-flex justify-content-center">
        {{$productList->links()}}
    </div>
@endsection
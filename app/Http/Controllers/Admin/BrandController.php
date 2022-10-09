<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Brand;
use App\Http\Requests\Admin\BrandRequest;
class BrandController extends Controller
{
    //
    const _Per_Page = 6;

    public function __construct(){
        $this -> brands = new Brand();
    }

    // danh sách Thuong hieu
    public function index(Request $request){
        $title = 'Danh sách Thuong hieu';
        $keywords = null;
        // search
        if(!empty($request->keywords)){
            $keywords = $request ->keywords;
        }

        $brandList = $this -> brands -> getAllBrand($keywords, self::_Per_Page);
        return view('admins.views.brands.list', compact('title', 'brandList'));
    }

    // lấy ra thêm Thuong hieu
    public function getAdd(){
        $title = 'Thêm Thuong hieu';
        return view('admins.views.brands.add', compact('title'));
    }

    // xử lý thêm Thuong hieu
    public function postAdd(BrandRequest $request){
        $dataInsert =[
            'brand_name' => $request->brand_name,
        ];

        //trong addUser chúng ta cần truyền vào 1 mảng
        $this ->brands ->addBrand($dataInsert);
        return redirect() -> route('admin.brand.index')-> with('msg', 'Thêm thuong hieu thành công');
    }

    // lấy ra edit Thuong hieu
    public function getEdit(Request $request, $id =0){
        $title = 'Sửa thông tin Thuong hieu';
        if(!empty($id)){
            $brandDetail = $this->brands ->getEdit($id);
            if(!empty($brandDetail[0])){
                // lưu id vào session
                $request ->session()->put('brand_id', $id);
                $brandDetail = $brandDetail[0];
            }else{
                return redirect()->route('admin.brand.index')->with('msg', 'Đơn vị không tồn tại');
            }
        }else{
            return redirect()->route('admin.brand.index')->with('msg', 'Liên hết không tồn tại');
        }
        return view('admins.views.brands.edit', compact('title', 'brandDetail'));
    }

    // xử lý sửa Thuong hieu
    public function postEdit(BrandRequest $request){
        $id = session('brand_id');
        if(empty($id)){
            return back()->with ('msg', 'Liên kết không tồn tại');
        }
        $dataUpdate = [
            'brand_name' => $request-> brand_name
        ];
        $this->brands -> postEdit($dataUpdate, $id);
        return redirect() -> route('admin.brand.index')-> with('msg', 'Update thuong hieu thành công');
    }

    public function delete($id = 0){
        if(!empty($id)){
            $brandDetail =  $this ->brands ->getEdit($id);
            if(!empty($brandDetail[0])){
                // nếu có id sẽ thực sang model
                $deleteBrand = $this ->brands->deleteBrand($id);
                // kiểm tra xóa thành công hay không
                if($deleteBrand){
                    $msg = 'Xóa thương hiệu thành công';
                }else{
                    $msg = 'Bạn không thể xóa thương hiệu lúc này. Vui lòng thử lại sau';
                }
            }else{
                $msg ='Thương hiệu  không tồn tại';
            }
        }else{
            $msg = 'Liên hết không tồn tại';
        }
        return redirect()->route('admin.color.index')->with('msg', $msg);
    }
}

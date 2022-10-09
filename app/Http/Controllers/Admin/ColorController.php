<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Color;
use App\Http\Requests\Admin\ColorRequest;

class ColorController extends Controller
{
    //
    const _Per_Page = 6;

    public function __construct(){
        $this -> colors = new Color();
    }

    public function index(Request $request){
        $title = 'Danh sach mau sac';
        $keywords = null;
        // search
        if(!empty($request->keywords)){
            $keywords = $request ->keywords;
        }
        $colorList = $this -> colors -> getAllColor($keywords, self::_Per_Page);
        return view('admins.views.colors.list', compact('title', 'colorList'));
    }

    public function getAdd(){
        $title = 'Them mau sac';
        return view('admins.views.colors.add', compact('title'));
    }

    public function postAdd(ColorRequest $request){
        $dataInsert =[
            'color_name' => $request->color_name,
        ];

        //trong addUser chúng ta cần truyền vào 1 mảng
        $this ->colors ->addColor($dataInsert);
        return redirect() -> route('admin.color.index')-> with('msg', 'Thêm màu sắc thành công');
    }

    public function getEdit(Request $request, $id =0){
        $title = 'Sua mau sac';
        if(!empty($id)){
            $colorDetail = $this->colors ->getEdit($id);
            if(!empty($colorDetail[0])){
                // lưu id vào session
                $request ->session()->put('color_id', $id);
                $colorDetail = $colorDetail[0];
            }else{
                return redirect()->route('admin.color.index')->with('msg', 'Màu sắc không tồn tại');
            }
        }else{
            return redirect()->route('admin.color.index')->with('msg', 'Liên hết không tồn tại');
        }
        return view('admins.views.colors.edit', compact('title', 'colorDetail'));
    }

    public function postEdit(ColorRequest $request){
        $id = session('color_id');
        if(empty($id)){
            return back()->with ('msg', 'Liên kết không tồn tại');
        }
        $dataUpdate = [
            'color_name' => $request-> color_name
        ];
        $this->colors -> postEdit($dataUpdate, $id);
        return redirect() -> route('admin.color.index')-> with('msg', 'Update màu sắc thành công');
    }

    public function delete($id){
        if(!empty($id)){
            $colorDetail =  $this ->colors ->getEdit($id);
            if(!empty($colorDetail[0])){
                // nếu có id sẽ thực sang model
                $deleteColor = $this ->colors->deleteColor($id);
                // kiểm tra xóa thành công hay không
                if($deleteColor){
                    $msg = 'Xóa màu sắc thành công';
                }else{
                    $msg = 'Bạn không thể xóa màu sắc lúc này. Vui lòng thử lại sau';
                }
            }else{
                $msg ='Màu sắc không tồn tại';
            }
        }else{
            $msg = 'Liên hết không tồn tại';
        }
        return redirect()->route('admin.brand.index')->with('msg', $msg);
    }
}

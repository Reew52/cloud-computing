<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Unit;
use App\Http\Requests\Admin\UnitRequest;

class UnitController extends Controller
{
    //
    // private $units;

    const _Per_Page = 5;
    public function __construct(){
        $this ->units = new Unit();
    }
    
    // danh sách đơn vị
    public function index(Request $request){
        $title = 'Danh sách đơn vị';
        $filters = [];
        $keywords = null;
        // lọc công ty
        if(!empty($request->cp_id)){
            $cp_id = $request ->cp_id;
            $filters [] = ['units.cp_id', '=', $cp_id];
        }
        // search
        if(!empty($request->keywords)){
            $keywords = $request ->keywords;
        }

        $unitList = $this -> units -> getAllUnit($filters, $keywords, self::_Per_Page);
        return view('admins.views.units.list', compact('title', 'unitList'));
    }

    // thêm đơn vị
    public function getAdd(){
        $title = 'Thêm đơn vị';
        $allCompany = getAllCompanys();
        return view('admins.views.units.add', compact('title', 'allCompany'));
    }

    // sửa thêm đơn vị
    public function postAdd(UnitRequest $request){
        $dataInsert =[
            'unit_name' => $request->unit_name,
            'unit_email' => $request->unit_email,
            'cp_id' => $request->cp_id,
            'unit_phoneNumber' => $request->unit_phoneNumber,
            'unit_address' => $request->unit_address,
        ];

        //trong addUser chúng ta cần truyền vào 1 mảng
        $this ->units ->addUnit($dataInsert);

       return redirect() -> route('admin.unit.index')-> with('msg', 'Thêm đơn vị thành công');
    }

    // sửa đơn vị
    public function getEdit(Request $request, $id =0){
        $title = 'Sửa đơn vị';
        $allCompany = getAllCompanys();
        if(!empty($id)){
            $unitDetail = $this->units ->getEdit($id);
            if(!empty($unitDetail[0])){
                // lưu id vào session
                $request ->session()->put('unit_id', $id);
                $unitDetail = $unitDetail[0];
            }else{
                return redirect()->route('admin.unit.index')->with('msg', 'Đơn vị không tồn tại');
            }
        }else{
            return redirect()->route('admin.unit.index')->with('msg', 'Liên hết không tồn tại');
        }
        return view('admins.views.units.edit', compact('title', 'allCompany', 'unitDetail'));
    }

    // xử lý sửa đơn vị
    public function postEdit(UnitRequest $request){
        $id = session('unit_id');
        if(empty($id)){
            return back()->with ('msg', 'Liên kết không tồn tại');
        }
        //Tạo mảng truyền vào dữ liệu
        $dataUpdate = [
            'unit_name' => $request->unit_name,
            'unit_email' => $request->unit_email,
            'cp_id' => $request->cp_id,
            'unit_phoneNumber' => $request->unit_phoneNumber,
            'unit_address' => $request->unit_address,
        ];
        $this->units -> postEdit($dataUpdate, $id);
        return redirect()->route('admin.unit.index')->with('msg', 'Update người dùng thành công');
    }
    
    // xử lý sửa đơn vị
    public function delete($id= 0){
        // kiểm tra có id hay không
        if(!empty($id)){
            $unitDetail =  $this ->units ->getEdit($id);
            if(!empty($unitDetail[0])){
                // nếu có id sẽ thực sang model
                $deleteUnit = $this ->units->deleteUnit($id);
                // kiểm tra xóa thành công hay không
                if($deleteUnit){
                    $msg = 'Xóa Đơn vị thành công';
                }else{
                    $msg = 'Bạn không thể xóa Đơn vị lúc này. Vui lòng thử lại sau';
                }
            }else{
                $msg ='Đơn vị không tồn tại';
            }
        }else{
            $msg = 'Liên hết không tồn tại';
        }
        return redirect()->route('admin.unit.index')->with('msg', $msg);
    }

}

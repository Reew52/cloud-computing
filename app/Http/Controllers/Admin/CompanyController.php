<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Company;

use App\Http\Requests\Admin\CompanyRequest;

class CompanyController extends Controller
{
    //

    private $companys;
    // hằng số
    const _Per_Page = 7;

    public function __construct(){
        $this -> companys = new Company();
    }

    // danh sách công ty
    public function index(Request $request){
        $title = 'Danh sách Công ty';
        $keywords = null;
        // search
        if(!empty($request->keywords)){
            $keywords = $request ->keywords;
        }
        $companyList = $this ->companys -> getAllCompany($keywords, self::_Per_Page);
        return view('admins.views.companys.list', compact('title', 'companyList'));
    }

    // lấy ra thêm công ty
    public function getAdd(){
        $title = 'Thêm công ty';
        return view('admins.views.companys.add', compact('title'));
    }

    // xử lý thêm công ty
    public function postAdd(CompanyRequest $request){
        // tạo mảng để truyền 
        $dataInsert =[
            'cp_name' => $request->cp_name,
            'cp_email' => $request->cp_email,
            'cp_phoneNumber' => $request->cp_phoneNumber,
            'cp_address' => $request->cp_address,
        ];
        //trong addCompany chúng ta cần truyền vào 1 mảng
        $this ->companys ->addCompany($dataInsert);
       return redirect() -> route('admin.company.index')-> with('msg', 'Thêm người dùng thành công');
    }

    // lấy ra edit công ty
    public function getEdit(Request $request, $id =0){
        $title = 'Sửa thông tin công ty';

        if(!empty($id)){
            $companyDetail = $this->companys ->getEdit($id);
            if(!empty($companyDetail[0])){
                // lưu id vào session
                $request ->session()->put('cp_id', $id);
                $companyDetail = $companyDetail[0];
            }else{
                return redirect()->route('admin.company.index')->with('msg', 'Người dùng không tồn tại');
            }
        }else{
            return redirect()->route('admin.company.index')->with('msg', 'Liên hết không tồn tại');
        }

        return view('admins.views.companys.edit', compact('title','companyDetail'));
    }

    // xử lý sửa công ty
    public function postEdit(CompanyRequest $request){
        $id = session('cp_id');
        if(empty($id)){
            return back()->with ('msg', 'Liên kết không tồn tại');
        }
        //Tạo mảng truyền vào dữ liệu
        $dataUpdate = [
            'cp_name' => $request->cp_name,
            'cp_email' => $request->cp_email,
            'cp_phoneNumber' => $request->cp_phoneNumber,
            'cp_address' => $request->cp_address,
        ];
        $this->companys -> postEdit($dataUpdate, $id);
        return redirect()->route('admin.company.index')->with('msg', 'Update công ty thành công');

    }

    // xóa công ty 
    public function delete($id =0){
        // kiểm tra có id hay không
        if(!empty($id)){
        $companyDetail =  $this ->companys ->getEdit($id);
            if(!empty($companyDetail[0])){
                // nếu có id sẽ thực sang model
                $delete = $this ->companys->deleteCompany($id);
                // kiểm tra xóa thành công hay không
                if($delete){
                    $msg = 'Xóa người dùng thành công';
                }else{
                    $msg = 'Bạn không thể xóa người dùng lúc này. Vui lòng thử lại sau';
                }
            }else{
                $msg ='Người dùng không tồn tại';
            }
        }else{
            $msg = 'Liên hết không tồn tại';
        }
    return redirect()->route('admin.company.index')->with('msg', $msg);
    }

}

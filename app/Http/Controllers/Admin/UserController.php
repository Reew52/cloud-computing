<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Users;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    private $users;
    // hằng số
    const _Per_Page = 5;
    
    public function __construct(){
        $this ->users = new Users();
    }

    //danh sách users
    public function index(Request $request){
        $title = 'Danh sách người dùng';
        $filters = [];
        $keywords = null;
        // xử lý trạng thái
        if(!empty($request->status)){
            $status = $request -> status;
            if($status=='active'){
                $status =1;
            }else{
                $status =0;
            }
            // mảng filters có users.status = $status
            $filters [] = ['users.user_status', '=', $status];
        }
        
        // lọc role
        if(!empty($request->ur_id)){
            $ur_id = $request ->ur_id;
            $filters [] = ['users.ur_id', '=', $ur_id];
        }

        // search
        if(!empty($request->keywords)){
            $keywords = $request ->keywords;
        }

        $userList = $this -> users -> getAllUsers($filters, $keywords, self::_Per_Page);
        return view('admins.views.users.list', compact('title', 'userList'));
    }

    //Lấy ra thêm người dùng
    public function getAdd(){
        $title = 'Thêm người dùng';
        $allUserRole = getAllUserRoles();
        return view('admins.views.users.add', compact('title', 'allUserRole'));
    }

    //xử lý thêm người dùng
    public function postAdd(UserRequest $request){
       // tạo mảng để truyền 
        $dataInsert =[
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'ur_id' => $request->ur_id,
            'user_phoneNumber' => $request->user_phoneNumber,
            'user_password' => Hash::make($request->user_password),
            'user_address' => $request->user_address,
            'user_status' => $request->user_status,
            "user_createAt" => date('Y-m-d H:i:s')
        ];

        //trong addUser chúng ta cần truyền vào 1 mảng
        $this ->users ->addUser($dataInsert);

       return redirect() -> route('admin.user.index')-> with('msg', 'Thêm người dùng thành công');
    }

    // lấy ra edit user
    public function getEdit(Request $request, $id =0){
        $title = 'Sửa thông tin User';
        $allUserRole = getAllUserRoles();
        if(!empty($id)){
            $userDetail = $this->users ->getEdit($id);
            if(!empty($userDetail[0])){
                // lưu id vào session
                $request ->session()->put('user_id', $id);
                $userDetail = $userDetail[0];
            }else{
                return redirect()->route('admin.user.index')->with('msg', 'Người dùng không tồn tại');
            }
        }else{
            return redirect()->route('admin.user.index')->with('msg', 'Liên hết không tồn tại');
        }

        return view('admins.views.users.edit', compact('title', 'allUserRole','userDetail'));
    }

    // xử lý edit
    public function postEdit(UserRequest $request){    
        $id = session('user_id');
        if(empty($id)){
            return back()->with ('msg', 'Liên kết không tồn tại');
        }
        //Tạo mảng truyền vào dữ liệu
        $dataUpdate = [
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'ur_id' => $request->ur_id,
            'user_status' => $request->user_status,
            'user_phoneNumber' => $request->user_phoneNumber,
            'user_password' => $request->user_password,
            'user_address' => $request->user_address,
        ];
        $this->users -> postEdit($dataUpdate, $id);
        return redirect()->route('admin.user.index')->with('msg', 'Update người dùng thành công');
    }

    public function delete ($id =0){
        // kiểm tra có id hay không
        if(!empty($id)){
            $userDetail =  $this ->users ->getEdit($id);
            if(!empty($userDetail[0])){
                // nếu có id sẽ thực sang model
                $deleteStatus = $this ->users->deleteUser($id);
                // kiểm tra xóa thành công hay không
                if($deleteStatus){
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
        return redirect()->route('admin.user.index')->with('msg', $msg);
    }
}

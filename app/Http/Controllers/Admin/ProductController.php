<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Product;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    //
    const _Per_Page = 7;

    public function __construct(){
        $this ->products = new Product();
    }

    public function index(Request $request){
        $title = 'Danh sách sản phẩm';
        $filters = [];
        $keywords = null;
        // lọc brand
        if(!empty($request->brands)){
            $brands = $request ->brands;
            $filters [] = ['products.brand_id', '=', $brands];
        }
        // lọc color
        if(!empty($request->colors)){
            $colors = $request ->colors;
            $filters [] = ['products.color_id', '=', $colors];
        }

        // xử lý ram
        if(!empty($request->rams)){
            $rams = $request -> rams;
            if($rams=='2'){
                $rams =2;
            }elseif($rams=='4'){
                $rams =4;
            }elseif($rams=='6'){
                $rams =6;
            }else{
                $rams =8;
            }
            $filters [] = ['products.pro_ram', '=', $rams];
        }

        // xử lý internal_memory
        if(!empty($request->internal_memory)){
            $internal_memory = $request -> internal_memory;
            if($internal_memory=='32'){
                $internal_memory =32;
            }elseif($internal_memory=='64'){
                $internal_memory =64;
            }elseif($internal_memory=='128'){
                $internal_memory =128;
            }elseif($internal_memory=='256'){
                $internal_memory =256;
            }elseif($internal_memory=='512'){
                $internal_memory =512;
            }else{
                $internal_memory =1024;
            }
            $filters [] = ['products.pro_iMemory', '=', $internal_memory];
        }

        // xử lý operating_system
        if(!empty($request->operating_system)){
            $operating_system = $request -> operating_system;
            if($operating_system=='Android'){
                $operating_system ='Android';
            }elseif($operating_system=='IOS'){
                $operating_system ='IOS';
            }elseif($operating_system=='Windows Phone'){
                $operating_system ='Windows Phone';
            }elseif($operating_system=='Symbian'){
                $operating_system ='Symbian';
            }elseif($operating_system=='BlackBerry OS'){
                $operating_system ='BlackBerry OS';
            }else{
                $operating_system ='Bada';
            }
            $filters [] = ['products.pro_oSystem', '=', $operating_system];
        }

        // xử lý warranty_period
        if(!empty($request->warranty_period)){
            $warranty_period = $request -> warranty_period;
            if($warranty_period=='6'){
                $warranty_period =6;
            }elseif($warranty_period=='8'){
                $warranty_period =8;
            }elseif($warranty_period=='12'){
                $warranty_period =12;
            }elseif($warranty_period=='18'){
                $warranty_period =18;
            }elseif($warranty_period=='24'){
                $warranty_period =24;
            }else{
                $warranty_period =36;
            }
            $filters [] = ['products.pro_warrantyPeriod', '=', $warranty_period];
        }

        // search
        if(!empty($request->keywords)){
            $keywords = $request ->keywords;
        }
        

        $productList = $this -> products -> getAllProducts($filters, $keywords,self::_Per_Page);
        return view('admins.views.products.list', compact('title', 'productList'));
    }

    public function getAdd(){
        $title = 'Thêm sản phẩm';
        $allBrands = getAllBrands();
        $allColors = getAllColors();
        return view('admins.views.products.add', compact('title', 'allColors', 'allBrands'));
    }

    public function postAdd(ProductRequest $request){
        if($request->has('pro_image')){
            $file = $request ->pro_image;
            $ext = $request ->pro_image->extension();
            $file_name = md5(uniqid()).'.'.$ext;
            $file->move(public_path('uploads'), $file_name);
        }
        $request ->merge(['image' => $file_name]);
        // tạo mảng để truyền 
        $dataInsert =[
            'pro_name' => $request->pro_name,
            'brand_id' => $request->brand_id,
            'color_id' => $request->color_id,
            'pro_ram' => $request->pro_ram,
            'pro_iMemory' => $request->pro_iMemory,
            'pro_oSystem' => $request->pro_oSystem,
            'pro_warrantyPeriod' => $request->pro_warrantyPeriod,
            'pro_image' => $request->image,
            // 'pro_image1' => $request->pro_image1,
            // 'pro_image2' => $request->pro_image2,
            // 'pro_image3' => $request->pro_image3,
            // 'pro_image4' => $request->pro_image4,
            'pro_quatity' => $request->	pro_quatity,
            'pro_origin' => $request->pro_origin,
            'pro_price' => $request->pro_price,
            'pro_reducedPrice' => $request->pro_reducedPrice,
            'pro_launchDate' => $request->pro_launchDate,
            'pro_description' => $request->pro_description,
        ];

        //dd($dataInsert);

        //trong addUser chúng ta cần truyền vào 1 mảng
        $this ->products ->addProduct($dataInsert);

       return redirect() -> route('admin.product.index')-> with('msg', 'Thêm San pham thành công');
    }

    public function getImage(Request $request,$id = 0){
        $title = 'Anh sản phẩm';
        if(!empty($id)){
            $productDetail = $this->products ->getEdit($id);
            if(!empty($productDetail[0])){
                $productDetail = $productDetail[0];
            }else{
                return redirect()->route('admin.product.image')->with('msg', 'San pham không tồn tại');
            }
        }else{
            return redirect()->route('admin.product.image')->with('msg', 'Liên hết không tồn tại');
        }
        return view('admins.views.products.image', compact('title', 'productDetail'));
    }

    public function getEdit(Request $request,$id = 0){
        $title = 'Sửa sản phẩm';
        $allBrands = getAllBrands();
        $allColors = getAllColors();
        if(!empty($id)){
            $productDetail = $this->products ->getEdit($id);
            if(!empty($productDetail[0])){
                // lưu id vào session
                $request ->session()->put('pro_id', $id);
                $productDetail = $productDetail[0];
            }else{
                return redirect()->route('admin.product.index')->with('msg', 'San pham không tồn tại');
            }
        }else{
            return redirect()->route('admin.product.index')->with('msg', 'Liên hết không tồn tại');
        }
        return view('admins.views.products.edit', compact('title', 'productDetail','allBrands', 'allColors'));
    }

    public function postEdit(ProductRequest $request){
        $id = session('pro_id');
        if(empty($id)){
            return back()->with ('msg', 'Liên kết không tồn tại');
        }
        //Tạo mảng truyền vào dữ liệu
        $dataUpdate = [
            'pro_name' => $request->pro_name,
            'brand_id' => $request->brand_id,
            'color_id' => $request->color_id,
            'pro_ram' => $request->pro_ram,
            'pro_iMemory' => $request->pro_iMemory,
            'pro_oSystem' => $request->pro_oSystem,
            'pro_warrantyPeriod' => $request->pro_warrantyPeriod,
            'pro_quatity' => $request->	pro_quatity,
            'pro_origin' => $request->pro_origin,
            'pro_price' => $request->pro_price,
            'pro_reducedPrice' => $request->pro_reducedPrice,
            'pro_launchDate' => $request->pro_launchDate,
            'pro_description' => $request->pro_description,
        ];
        $this->products -> postEdit($dataUpdate, $id);
        return redirect()->route('admin.product.index')->with('msg', 'Update san pham thành công');
    }

    //xóa
    public function delete($id = 0){
        if(!empty($id)){
            $productDetail =  $this ->products ->getEdit($id);
            if(!empty($productDetail[0])){
                // nếu có id sẽ thực sang model
                $deleteProduct = $this ->products->deleteProduct($id);
                // kiểm tra xóa thành công hay không
                if($deleteProduct){
                    $msg = 'Xóa san pham thành công';
                }else{
                    $msg = 'Bạn không thể xóa san pham lúc này. Vui lòng thử lại sau';
                }
            }else{
                $msg ='San pham không tồn tại';
            }
        }else{
            $msg = 'Liên hết không tồn tại';
        }
        return redirect()->route('admin.product.index')->with('msg', $msg);
    }
}

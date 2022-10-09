<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Brand extends Model
{
    use HasFactory;
    Protected $table = 'brands';

    public function getAllBrand($keywords = null,$perPage = null){
        $brands = DB::table($this->table)
        ->select('brands.*')
        ->orderBy('brand_name', 'ASC');
        //kiem tra keywords
        if(!empty($keywords)){
            $brands =$brands->where(function($query) use ($keywords){
                $query->orWhere('brand_name', 'LIKE', $keywords.'%');
            });
        }
        // kiểm tra perPage
        if(!empty($perPage)){
            $brands = $brands -> paginate($perPage)->withQueryString();
        }else{
            $brands = $brands ->get();
        }
        
        return $brands;
    }

    public function addBrand($data){
        return DB::table($this -> table) -> insert($data);
    }

    public function getEdit($id){
        return DB::select('SELECT * FROM '.$this ->table.' WHERE brand_id = ?', [$id]);
    }

    public function postEdit($data, $id){
        return DB::table($this->table)
        ->where('brand_id', '=', $id)
        ->update($data);
    }

    public function deleteBrand($id){
        return DB::table($this->table)
        ->where('brand_id', '=', $id)
        ->delete();
    }
}

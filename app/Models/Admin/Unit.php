<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Unit extends Model
{
    use HasFactory;
    Protected $table = 'units';

    // Tạo phương thức show bảng
    public function getAllUnit( $filters = [], $keywords = null, $perPage = null){
        // DB::enableQueryLog(); 
        $units = DB::table($this->table)
         ->select('units.*', 'companys.cp_name as company_name')
        ->join('companys', 'units.cp_id', '=', 'companys.cp_id')
        ->orderBy('units.unit_name', 'ASC');
        //kiem tra filters
        if(!empty($filters)){
            $units =$units->where($filters);
        }
        //kiem tra keywords
        if(!empty($keywords)){
            $units =$units->where(function($query) use ($keywords){
                $query->orWhere('unit_name', 'LIKE', '%'.$keywords.'%');
                $query->orWhere('unit_email', 'LIKE', '%'.$keywords.'%');
                $query->orWhere('unit_phoneNumber', 'LIKE', '%'.$keywords.'%');
            });
        }

        if(!empty($perPage)){
            $units = $units ->paginate($perPage)->withQueryString();
        }else{
            $units = $units ->get();
        }
        // $sql = DB::getQueryLog();
        // dd($sql);
        return $units;
    }

    public function addUnit($data){
        return DB::table($this -> table) -> insert($data);
    }

    public function getEdit($id){
        return DB::select('SELECT * FROM '.$this ->table.' WHERE unit_id = ?', [$id]);
    }

    public function postEdit($data, $id){
        return DB::table($this->table)
        -> Where('unit_id', '=', $id)
        -> update($data);
    }

    //xóa
    public function deleteUnit($id){
        return DB::table($this->table)
        ->where('unit_id', '=', $id)
        ->delete();
    }
}

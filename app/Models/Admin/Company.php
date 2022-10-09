<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companys';

    public function getAllCompany($keywords = null, $perPage = null){
        // DB::enableQueryLog(); 
        $companys = DB::table($this->table)
         ->select('companys.*')
        ->orderBy('companys.cp_name', 'ASC');
        // kiểm tra search
        if (!empty($keywords)){
            $companys = $companys-> where(function($query) use($keywords){
                $query->orWhere('cp_name', 'LIKE', '%'.$keywords.'%');
                $query->orWhere('cp_phoneNumber', 'LIKE', '%'.$keywords.'%');
                $query->orWhere('cp_email', 'LIKE', '%'.$keywords.'%');
            });
        }
        // kiểm tra perPage
        if(!empty($perPage)){
            $companys = $companys -> paginate($perPage)->withQueryString();
        }else{
            $companys = $companys ->get();
        }
        // $sql = DB::getQueryLog();
        // dd($sql);
        return $companys;
    }

    public function addCompany($data){
        return DB::table($this -> table) -> insert($data);
    }

    public function getEdit($id){
        return DB::select('SELECT * FROM '.$this ->table.' WHERE cp_id = ?', [$id]);
    }

    public function postEdit($data, $id){
        return DB::table($this-> table)
        -> where('cp_id', '=', $id)
        -> update($data);
    }

    public function deleteCompany($id){
        return DB::table($this-> table)
        -> where('cp_id', '=', $id)
        -> delete();
    }

}

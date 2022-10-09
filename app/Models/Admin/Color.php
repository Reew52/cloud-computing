<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class Color extends Model
{
    use HasFactory;
    Protected $table = 'colors';

    public function getAllColor($keywords= null, $perPage= null){
        $colors = DB::table($this->table)
        ->select('colors.*')
        ->orderBy('color_name', 'ASC');
        //kiem tra keywords
        if(!empty($keywords)){
            $colors =$colors->where(function($query) use ($keywords){
                $query->orWhere('color_name', 'LIKE', $keywords.'%');
            });
        }
        // kiểm tra perPage
        if(!empty($perPage)){
            $colors = $colors -> paginate($perPage)->withQueryString();
        }else{
            $colors = $colors ->get();
        }
        
        return $colors;
    }

    public function addColor($data){
        return DB::table($this -> table) -> insert($data);
    }

    public function getEdit($id){
        return DB::select('SELECT * FROM '.$this ->table.' WHERE color_id = ?', [$id]);
    }

    public function postEdit($data, $id){
        return DB::table($this->table)
        ->where('color_id', '=', $id)
        ->update($data);
    }

    public function deleteColor($id){
        return DB::table($this->table)
        ->where('color_id', '=', $id)
        ->delete();
    }
}

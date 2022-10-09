<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class UserRole extends Model
{
    use HasFactory;
    

    Protected $table = 'user_role';

    public function getAll(){
        $user_role = DB::table($this -> table)
        ->orderBy('ur_name', 'ASC')
        ->get();
        return $user_role;
    }
}

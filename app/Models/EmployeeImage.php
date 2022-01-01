<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeImage extends Model
{
    use HasFactory;
    public $table="employee_image";
    public $fillable=['user_id','image'];


    public function personalInfo(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Students extends Model
{
    use HasFactory;
    protected $table = "students";
    protected $fillable = [
        "course",
        "fname",
        "mname",
        "lname",
        "sname",
        "street_number",
        "city",
        "district",
        "zipcode",
        "nationality",
        "contact_number",
        "email",
        "gender",
        "civil_status",
        "employment",
        "status",
        "birthdate",
        "birthplace",
    ];


    public function parents(){
        return $this->hasOne(Parents::class);
    }

    public function classification(){
        return $this->hasMany(Classification::class);
    }

}

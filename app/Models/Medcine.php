<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medcine extends Model
{
    use HasFactory;
    protected $fillable = [
        "enSciName","arSciName","enUseName","arUseName",
        "category_id","companyName","qtn","expiredDate",
        "price","description","user_id"
    ];
    public function user(){
        return $this->belongsToOne(User::class);
    }
    public function category(){

        return $this->belongsTo(Category::class);

    }

}

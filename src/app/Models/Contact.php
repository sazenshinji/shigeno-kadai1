<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel1',
        'tel2',
        'tel3',
        'address',
        'building',
        'detail'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeCategorySearch($query, $category_id){
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    public function scopeLastnameSearch($query, $name){
        if (!empty($name)) {
            $query->where('last_name', 'like', '%' . $name . '%');
        }
    }

    public function scopeFirstnameSearch($query, $name){
        if (!empty($name)) {
            $query->where('first_name', 'like', '%' . $name . '%');
        }
    }

    public function scopeEmailSearch($query, $email){
        if (!empty($email)) {
            $query->where('first_name', 'like', '%' . $email . '%');
        }
    }

    public function scopeGenderSearch($query, $gender_id){
        if (!empty($gender_id)) {
            $query->where('gender', $gender_id);
        }
    }
}

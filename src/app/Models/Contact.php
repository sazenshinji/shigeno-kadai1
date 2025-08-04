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
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    // カテゴリーIDで検索
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    // Lastname(姓)で検索
    public function scopeLastnameSearch($query, $name)
    {
        if (!empty($name)) {
            $query->where('last_name', 'like', '%' . $name . '%');
        }
    }

    // Firstname(名)で検索
    public function scopeFirstnameSearch($query, $name)
    {
        if (!empty($name)) {
            $query->where('first_name', 'like', '%' . $name . '%');
        }
    }

    // メールアドレスで検索
    public function scopeEmailSearch($query, $email)
    {
        if (!empty($email)) {
            $query->where('email', 'like', '%' . $email . '%');
        }
    }

    // 性別で検索
    public function scopeGenderSearch($query, $gender_id)
    {
        if (!empty($gender_id)) {
            $query->where('gender', $gender_id);
        }
    }

    // 年月日で検索
    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->where('updated_at', 'like', '%' . $date . '%');
        }
    }
}

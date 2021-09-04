<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function scopeSearch($query, $req)
    {
        return $query->where('product_name', 'LIKE', '%' . $req->product_name . '%');
    }

    public function scopeSort($query, $req)
    {
        switch ($req->sort_by) {
            case 'product_name':
                $query->orderby('product_name', 'asc');
                break;
            default:
                $query->latest();
                break;
        }
        return $query;
    }
}

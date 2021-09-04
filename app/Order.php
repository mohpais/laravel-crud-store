<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderProduct;

class Order extends Model
{
    protected $table = 'orders';

    protected $guarded = [];

    public function orderproducts()
    {
        return $this->belongsTo(Orderproduct::class, 'order_id', 'id');
    }

    public function scopeSearch($query, $req)
    {
        return $query->where('id', 'LIKE', '%' . $req->order_id . '%')
            ->where('customer_name', 'LIKE', '%' . $req->customer_name . '%');
    }

    public function scopeSort($query, $req)
    {
        switch ($req->sort_by) {
            case 'customer_name':
                $query->orderby('customer_name', 'asc');
                break;
            case 'order_date':
                $query->orderby('order_date', 'asc');
                break;
            default:
                $query->latest();
                break;
        }
        return $query;
    }
}

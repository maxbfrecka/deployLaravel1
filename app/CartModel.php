<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    
    function asDollars() {
        if ($this->price<0) return "-".asDollars(-$this->price);
        return '$' . number_format($this->price/100, 2);
      }
}
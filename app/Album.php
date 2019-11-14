<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //plural of Album becomes the name of the table by automatic
    //can change if you want to here
    protected $table = 'albums';
    //primary key
    public $primaryKey = 'id';
    //timestamps?
    public $timestamps = true;
    //
    protected $fillable = [
        'albumtitle'
    ];
    
    function asDollars() {
        if ($this->price<0) return "-".asDollars(-$this->price);
        return '$' . number_format($this->price/100, 2);
      }
}

<?php

namespace App\Models\DbGaga;

use Illuminate\Database\Eloquent\Model;

class gagaindex extends Model
{
    protected $connection = 'fina';
    protected $table = 'gagaindex';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // timestamp-felder nicht ausfüllen
    //public $timestamps = false;
    //protected $prefix = 'dimbu';
}

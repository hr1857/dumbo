<?php

namespace App\Models\DbWallneralt;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class jaa_content extends Model
{
    protected $connection = 'wallneralt';
    protected $table = 'jaa_content';
    protected $primaryKey = 'id';
    // timestamp-felder nicht ausfüllen
    public $timestamps = false;


    public function category(): HasOne
    {
        return $this->hasOne(jaa_categories::class, 'id', 'catid' );
    }
}

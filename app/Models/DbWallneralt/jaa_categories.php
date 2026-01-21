<?php

namespace App\Models\DbWallneralt;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class jaa_categories extends Model
{
    protected $connection = 'wallneralt';
    protected $table = 'jaa_categories';
    protected $primaryKey = 'id';
    // timestamp-felder nicht ausfüllen
    public $timestamps = false;


    //public function content(): BelongsTo
    //{
    //    return $this->belongsTo(jaa_content::class, 'id', 'catid' );
    //}
}

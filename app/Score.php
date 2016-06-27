<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'lvl_total','lvl_bass','lvl_drum','lvl_lead', 'lvl_ambiance','xp','id_users'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}




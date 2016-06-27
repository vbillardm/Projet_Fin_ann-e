<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'lvl_total','lvl_bass','lvl_drum','lvl_lead', 'lvl_ambiance','xp','id_user'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}




<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'id_users','name','link','score'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

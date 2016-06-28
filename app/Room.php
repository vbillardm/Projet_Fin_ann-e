<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }
    protected $fillable = [
        'id_users','name','slug','public', 'bass','drum','lead','ambiance'
    ];
}

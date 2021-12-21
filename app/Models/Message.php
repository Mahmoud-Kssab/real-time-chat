<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'body', 'sender_id', 'receiver_id' ];

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }
}

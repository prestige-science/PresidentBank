<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'user_id', 'name', 'balance'
    ];

    /**
     * Get the user who added/modified an entry.
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}

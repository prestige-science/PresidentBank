<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'user_id', 'type_id', 'account_id', 'amount'
    ];

    /**
     * Get the user who added/modified an entry.
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the account associated with the transaction.
     */
    public function account() {
        return $this->belongsTo('App\Models\Account');
    }

    /**
     * Get the type of transaction.
     */
    public function type() {
        return $this->belongsTo('App\Models\TransactionType');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundsTransfer extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'funds_transfer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'transaction_id', 'user_id'
    ];

    /**
     * Get the transaction entry of the funds transfer.
     */
    public function transaction() {
        return $this->belongsTo('App\Models\Transaction');
    }

    /**
     * Get the user account the funds were transfered to.
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}

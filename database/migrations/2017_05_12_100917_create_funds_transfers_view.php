<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundsTransfersView extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement("
            CREATE OR REPLACE VIEW vw_funds_transfers AS
            SELECT
                (SELECT users.id from users where users.id = transactions.user_id) 'from_user_id',
                (SELECT concat(users.first_name, ' ' ,users.last_name) from users where users.id = transactions.user_id) 'from_name',
                (SELECT accounts.name from accounts where accounts.id = transactions.account_id) 'from_account',
                (SELECT users.id from users where users.id = funds_transfer.user_id) 'to_user_id',
                (SELECT concat(users.first_name, ' ' ,users.last_name) from users where users.id = funds_transfer.user_id) 'to_name',
                (SELECT accounts.name from accounts where accounts.id = funds_transfer.account_id) 'to_account',
                transaction_types.name transaction_type, transactions.amount, transactions.created_at
            FROM
                transactions, funds_transfer, transaction_types
            WHERE
                transactions.id = funds_transfer.transaction_id
                AND transactions.type_id = transaction_types.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('DROP VIEW vw_funds_transfers');
    }

}

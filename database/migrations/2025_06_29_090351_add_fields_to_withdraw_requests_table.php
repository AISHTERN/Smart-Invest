<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('withdraw_requests', function (Blueprint $table) {
        if (!Schema::hasColumn('withdraw_requests', 'method_type')) {
            $table->string('method_type')->nullable();
        }

        if (!Schema::hasColumn('withdraw_requests', 'bank_name')) {
            $table->string('bank_name')->nullable();
        }

        if (!Schema::hasColumn('withdraw_requests', 'ewallet_name')) {
            $table->string('ewallet_name')->nullable();
        }

        if (!Schema::hasColumn('withdraw_requests', 'status')) {
            $table->string('status')->default('pending');
        }
    });
}
public function down()
{
    Schema::table('withdraw_requests', function (Blueprint $table) {
        $table->dropColumn([
            'method_type',
            'bank_name',
            'ewallet_name',
            'account_number',
            'account_name',
            'status',
        ]);
    });
}

};

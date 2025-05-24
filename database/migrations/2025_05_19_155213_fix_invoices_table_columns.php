<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixInvoicesTableColumns extends Migration
{
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('invoices', 'abonelik_id')) {
                $table->unsignedBigInteger('abonelik_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('invoices', 'invoice_date')) {
                $table->dateTime('invoice_date')->nullable()->after('amount');
            }
            if (!Schema::hasColumn('invoices', 'due_date')) {
                $table->dateTime('due_date')->nullable()->after('invoice_date');
            }
            if (!Schema::hasColumn('invoices', 'billing_period')) {
                $table->string('billing_period', 10)->nullable()->after('status');
            }
            if (!Schema::hasColumn('invoices', 'description')) {
                $table->string('description', 255)->nullable()->after('billing_period');
            }
            // Make subscriber_id nullable if it exists
            if (Schema::hasColumn('invoices', 'subscriber_id')) {
                $table->unsignedBigInteger('subscriber_id')->nullable()->change();
            }
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            if (Schema::hasColumn('invoices', 'abonelik_id')) {
                $table->dropColumn('abonelik_id');
            }
            if (Schema::hasColumn('invoices', 'invoice_date')) {
                $table->dropColumn('invoice_date');
            }
            if (Schema::hasColumn('invoices', 'due_date')) {
                $table->dropColumn('due_date');
            }
            if (Schema::hasColumn('invoices', 'billing_period')) {
                $table->dropColumn('billing_period');
            }
            if (Schema::hasColumn('invoices', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
}

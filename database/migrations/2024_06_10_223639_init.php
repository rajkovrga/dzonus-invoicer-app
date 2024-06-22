<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('vat_id');
            $table->string('registration_number')
                ->nullable();
            $table->string('tax_id')
                ->nullable();
            $table->string('email')
                ->nullable();
            $table->boolean('is_in_val_system')
                ->default(false);
            $table->timestampsTz();
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('company_id')
                ->references('id')
                ->on('clients');
            $table->foreignId('currency_id')
                ->nullable()
                ->references('id')
                ->on('currencies');
        });

        Schema::create('user_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->references('id')
                ->on('clients');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->string('contract_url')
                ->nullable();
            $table->timestampsTz();
        });

        Schema::create('user_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->references('id')
                ->on('clients');
            $table->string('swift')->nullable();
            $table->string('iban')->nullable();
            $table->string('number')->nullable();
            $table->timestampsTz();
        });

        DB::statement('ALTER TABLE user_bank_accounts ADD CONSTRAINT check_bank_account_fields
    CHECK (
        (swift IS NOT NULL AND iban IS NOT NULL AND number IS NULL) OR
        (swift IS NULL AND iban IS NULL AND number IS NOT NULL)
    )');

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_number');
            $table->dateTimeTz('dated');
            $table->dateTimeTz('value_date');
            $table->string('trading_place');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->timestampsTz();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('unit_id')
                ->references('id')
                ->on('units');
            $table->foreignId('invoice_id')
                ->references('id')
                ->on('invoices');
            $table->mediumInteger('price');
            $table->integer('quantity')
                ->default(1);
            $table->timestampsTz();
        });

        Schema::create('email_company_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->foreignId('currency_id')
                ->nullable()
                ->references('id')
                ->on('currencies');
        });
    }
};

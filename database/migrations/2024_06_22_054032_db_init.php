<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('address');
            $table->string('vat_id');
            $table->string('phone')->nullable();
            $table->string('registration_number');
            $table->foreignId('owner_id')
                ->nullable()
                ->references('id')
                ->on('users');
            $table->string('logo_url')
                ->nullable();
            $table->string('global_email_draft')
                ->nullable();
            $table->string('stamp_url')
                ->nullable();
            $table->string('tax_id')
                ->nullable();
            $table->dateTimeTz('registration_date');
            $table->string('registration_agent')
                ->nullable();
            $table->boolean('is_active')
                ->default(true);
            $table->timestampsTz();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('company_id')
                ->references('id')
                ->on('clients');
            $table->string('first_name');
            $table->string('last_name');
        });

        Schema::create('company_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->references('id')
                ->on('clients');
            $table->foreignId('company_id')
                ->references('id')
                ->on('clients');
            $table->string('contract_url')
                ->nullable();
            $table->timestampsTz();
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->references('id')
                ->on('clients');
            $table->string('swift')->nullable();
            $table->string('iban')->nullable();
            $table->string('number')->nullable();
            $table->timestampsTz();
        });

        DB::statement('ALTER TABLE bank_accounts ADD CONSTRAINT check_bank_account_fields
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
            $table->foreignId('client_id')
                ->references('id')
                ->on('clients');
            $table->foreignId('currency_id')
                ->nullable()
                ->references('id')
                ->on('currencies');
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
            $table->bigInteger('price');
            $table->integer('quantity')
                ->default(1);
            $table->timestampsTz();
        });

        Schema::create('company_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('company_id')
                ->references('id')
                ->on('clients');
            $table->foreignId('currency_id')
                ->nullable()
                ->references('id')
                ->on('currencies');
        });
    }

};

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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('vat_id');
            $table->string('email');
            $table->string('zip_code');
            $table->string('phone')->nullable();
            $table->string('city');
            $table->string('registration_number')
                ->unique();
            $table->foreignId('owner_id')
                ->nullable()
                ->references('id')
                ->on('users');
            $table->string('logo_url')
                ->nullable();
            $table->string('stamp_url')
                ->nullable();
            $table->string('tax_id')
                ->unique()
                ->nullable();
            $table->string('activity_code');
            $table->string('activity_description');
            $table->dateTimeTz('registration_date');
            $table->string('registration_agent')
                ->unique()
                ->nullable();
            $table->boolean('is_active')
                ->default(true);
            $table->string('contract_url')
                ->nullable();
            $table->longText('invoice_email_draft')
                ->nullable();
            $table->longText('invoice_email_subject')
                ->nullable();
            $table->timestampsTz();
        });

        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')
                ->unique();
            $table->string('address');
            $table->string('vat_id');
            $table->string('phone')->nullable();
            $table->string('registration_number')
                ->unique();
            $table->foreignId('company_owner_id')
                ->nullable()
                ->references('id')
                ->on('companies');
            $table->string('tax_id')
                ->unique()
                ->nullable();
            $table->string('registration_agent')
                ->nullable();
            $table->string('email_draft')
                ->nullable();
            $table->boolean('is_active')
                ->default(true);
            $table->timestampsTz();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('company_id')
                ->references('id')
                ->on('companies');
            $table->string('first_name');
            $table->string('last_name');
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->references('id')
                ->on('companies');
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
            $table->foreignId('company_id')
                ->references('id')
                ->on('companies');
            $table->foreignId('client_id')
                ->references('id')
                ->on('clients');
            $table->foreignId('currency_id')
                ->references('id')
                ->on('currencies');
            $table->foreignId('bank_account_id')
                ->nullable()
                ->references('id')
                ->on('bank_accounts');
            $table->timestampsTz();
            $table->softDeletesTz();
            $table->unique(['invoice_number', 'client_id', 'company_id']);
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('unit_id')
                ->references('id')
                ->on('units');
            $table->foreignId('invoice_id')
                ->references('id')
                ->on('invoices');
            $table->unsignedBigInteger('price');
            $table->integer('quantity')
                ->default(1);
            $table->boolean('is_sale')
                ->default(false);
            $table->unsignedBigInteger('converted_price');
            $table->timestampsTz();
        });

    }

};

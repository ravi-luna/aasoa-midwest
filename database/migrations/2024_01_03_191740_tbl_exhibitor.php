<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_exhibitor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exhibitor_id')->unique();
            $table->string('contact_name');
            $table->string('company_name');
            $table->string('contact_email')->unique();
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('phone_number');
            $table->string('zip_code');
            $table->enum('electricity_required', ['yes', 'no']);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_exhibitor');
    }
};

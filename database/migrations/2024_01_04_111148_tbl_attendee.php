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
        Schema::create('tbl_attendee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendee_id')->unique();
            $table->string('name');
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('attendee_name_2');
            $table->string('attendee_email_2');
            $table->string('attendee_name_3');
            $table->string('attendee_email_3');
            $table->string('attendee_name_4');
            $table->string('attendee_email_4');
            $table->enum('category', ['gas_station','c_store','liquor_store','smoke_vape_shop','other']);
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
        Schema::dropIfExists('tbl_attendee');
    }
};

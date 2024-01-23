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
        Schema::create('tbl_membership', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membership_id')->unique();
            $table->enum('assign_member', ['retailer_membership', 'supplier_membership', 'vendor_membership']);
            $table->string('corporation_name');
            $table->string('bussiness_name');
            $table->string('contact_person_name');
            $table->string('email_id')->unique();
            $table->string('phone_number');
            $table->text('bussiness_address');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_membership');
    }
};

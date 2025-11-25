<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('university');
            $table->text('description');
            $table->date('start_date')->nullable(); // Membuat kolom start_date menerima nilai null
            $table->date('end_date')->nullable();   // Membuat kolom end_date menerima nilai null
            $table->string('cv');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('address')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}

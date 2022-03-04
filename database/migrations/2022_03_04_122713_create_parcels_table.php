<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    private string $table = 'parcels';

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->string('pick');
            $table->string('deliver');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    private string $table = 'orders';

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('parcel_id');
            $table->foreign('parcel_id')->references('id')->on('parcels')
                ->onDelete('cascade');

            $table->unsignedBigInteger('biker_id')->nullable();
            $table->foreign('biker_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}

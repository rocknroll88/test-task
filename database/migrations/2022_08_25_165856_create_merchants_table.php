<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('merchant_key');
            $table->timestamps();
        });

        DB::table('merchants' )->insert([['id' => 6, 'merchant_key' => 'KaTf5tZYHx4v7pgZ'], 
        ['id' => 816, 'merchant_key' => 'rTaasVHeteGbhwBx']]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
};

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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('total_qty');
            $table->bigInteger('total_harga');
            $table->text('catatan')->nullable();
            $table->text('alamat_antar')->nullable();
            $table->date('tgl_order')->nullable();
            $table->enum('status', ['dipesankan', 'dimasak', 'dikirim', 'selesai', 'batal'])->default('dipesankan');
            $table->timestamps();

            $table->foreign('user_id')
                            ->references('id')
                            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};

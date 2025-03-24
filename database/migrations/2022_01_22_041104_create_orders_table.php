<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('receiver');
            $table->text('address');
            $table->text('catatan');
            $table->integer('total_price');
            $table->date('date');
            $table->enum('status',['belum bayar','menunggu verifikasi','dibayar','ditolak']);
            $table->text('detail_status');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('orders');
    }
}

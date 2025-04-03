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
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable(); // Bisa null untuk guest
            $table->string('visitor_id'); // Guest session identifier
            $table->string('receiver');
            $table->text('address');
            $table->text('catatan')->nullable();
            $table->integer('total_price');
            $table->date('date');
            $table->enum('status',['belum bayar','menunggu verifikasi','dibayar','ditolak']);
            $table->text('detail_status')->nullable();
            $table->timestamps();
    
            // Foreign key untuk user_id
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
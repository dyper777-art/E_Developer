<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('set null'); // link to services table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // link to users table
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 10, 2)->default(0); // store total price for the item
            $table->string('status')->default('pending'); // status column
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};

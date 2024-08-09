<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained('users');
            $table->string('mobile')->nullable();
            $table->text('lessee_comment')->nullable();
            $table->integer('rating')->nullable();
            $table->string('lessee');
            $table->string('comment')->nullable();
            $table->text('description')->nullable();
            $table->date('date_from');
            $table->date('date_to');
            $table->double('rate')->nullable();
            $table->double('paid')->nullable();
            $table->double('daily_rate')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_status')->nullable();
            $table->foreignId('flat_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }

};

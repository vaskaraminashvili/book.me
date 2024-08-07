<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('comment');
            $table->text('lessee_comment')->nullable()->after('comment');
            $table->integer('rating')->nullable()->after('lessee_comment');
        });
    }

    public function down(): void
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->dropColumn('mobile');
            $table->dropColumn('lessee_comment');
            $table->dropColumn('rating');
        });
    }

};

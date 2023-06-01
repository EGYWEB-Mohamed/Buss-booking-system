<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('reservations',function (Blueprint $table) {
            $table->foreignId('from_station')->after('confirmed')->constrained('stations')->cascadeOnDelete();
            $table->foreignId('to_station')->after('from_station')->constrained('stations')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('reservations',function (Blueprint $table) {
            $table->dropConstrainedForeignId('from_station');
            $table->dropConstrainedForeignId('to_station');
        });
    }
};

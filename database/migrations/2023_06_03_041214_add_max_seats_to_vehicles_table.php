<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('vehicles',function (Blueprint $table) {
            $table->integer('max_seats')->after('plate_number')->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('vehicles',function (Blueprint $table) {
            $table->dropColumn('max_seats');
        });
    }
};
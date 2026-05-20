<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->decimal('price_snapshot', 8, 2)->after('total_price')->default(0);
            $table->enum('status', ['pending', 'active', 'returned', 'cancelled', 'declined'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropColumn('price_snapshot');
            $table->enum('status', ['active', 'returned', 'cancelled'])->change();
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('entradas', function (Blueprint $table) {
            $table->date('fecha')->nullable();
            $table->string('lugar')->nullable();
            $table->time('hora')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('entradas', 'fecha')) {
            Schema::table('entradas', function (Blueprint $table) {
                $table->dropColumn('fecha');
            });
        }

        if (Schema::hasColumn('entradas', 'lugar')) {
            Schema::table('entradas', function (Blueprint $table) {
                $table->dropColumn('lugar');
            });
        }

        if (Schema::hasColumn('entradas', 'hora')) {
            Schema::table('entradas', function (Blueprint $table) {
                $table->dropColumn('hora');
            });
        }
    }
};

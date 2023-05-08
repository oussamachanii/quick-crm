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
        Schema::create('histories', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->string('usable_type');
            $table->string('usable_id');
            $table->string('usable_name');
            $table->integer('action');
            $table->integer('actionable_id');
            $table->integer('actionable_type');
            $table->integer('actionable_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};

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
        Schema::create('desk', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('desk_no');
            $table->string('queue_no')->default('----');
            $table->string('status')->default('inservice');
            $table->timestamp('end_service')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desk');
    }
};

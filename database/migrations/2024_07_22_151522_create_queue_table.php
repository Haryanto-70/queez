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
        Schema::create('queue', function (Blueprint $table) {
            $table->id();
            $table->uuid('quuid');
            $table->string('service_type');
            /** A B C D */
            $table->bigInteger('queue_id')->nullable();
            /** 001 002 003 dst reset per hari */
            $table->string('queue_no')->nullable();
            /** A001 B001 dst */
            $table->string('status')->default('new');
            /** new called inservice pending finish */
            $table->integer('in_counter')->default('0');
            /** service counter number */
            $table->integer('user_id')->nullable();
            /** service counter number */
            $table->time('started_at')->nullable();
            /** inservice started  */
            $table->time('finished_at')->nullable();
            /** inservice finished */
            $table->time('pending_at')->nullable();
            /**pending started */
            $table->time('resume_at')->nullable();
            /** pending finished  calculate duration   */
            $table->bigInteger('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queue');
    }
};

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
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('company')->default('Alkemi');
            $table->string('company_logo')->default('logo-puskesmas.png');
            $table->string('dashboard_name')->default('QUENET SYSTEM');
            $table->string('dashboard_description')->default('Quenet is Queue Management System Jakarta');
            $table->string('image_1')->default('advs1.png');
            $table->string('image_2')->default('advs2.png');
            $table->string('image_3')->default('advs3.png');
            $table->string('image_4')->default('advs4.png');
            $table->string('image_5')->default('advs5.png');
            $table->string('image_6')->default('advs6.png');
            $table->string('image_7')->default('advs7.png');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboards');
    }
};

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
        Schema::create('reponse_users', function (Blueprint $table) {
            $table->id();
            $table->string('question_id');
            $table->boolean('is_good');
            $table->string('user_id');
            $table->timestamp('date_repondu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reponse_users');
    }
};

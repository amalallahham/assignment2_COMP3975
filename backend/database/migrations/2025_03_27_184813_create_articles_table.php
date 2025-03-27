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
        Schema::create('articles', function (Blueprint $table) {
            $table->id('article_id'); // Custom primary key name
            $table->string('title');
            $table->text('body');
            $table->date('create_date');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('contributor_username');
    
            // Optional: foreign key constraint (if users.email must exist)
            $table->foreign('contributor_username')
                  ->references('email')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

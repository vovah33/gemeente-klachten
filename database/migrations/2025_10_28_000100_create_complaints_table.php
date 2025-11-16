<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->enum('category', ['afval', 'verlichting', 'wegen', 'groen', 'overlast']);
            $table->enum('status', ['in_behandeling', 'opgelost'])->default('in_behandeling');
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->string('reporter_name');
            $table->string('reporter_email');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('resolved_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};


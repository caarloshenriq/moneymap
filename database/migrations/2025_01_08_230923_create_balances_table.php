<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->float('amount', 8, 2)->default(0);
            $table->string('type', 1);
            $table->date('date')->nullable();
            $table->text('place');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

        // Adicionar a restrição CHECK no campo 'type'
        DB::statement('ALTER TABLE balances ADD CONSTRAINT type_check CHECK (type IN ("P", "E"))');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};

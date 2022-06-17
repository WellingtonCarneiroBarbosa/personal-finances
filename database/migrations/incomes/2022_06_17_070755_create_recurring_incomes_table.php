<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurring_incomes', function (Blueprint $table) {
            $table->id();
            $table->string('recurring_type');
            $table->date('recurring_starts_at');
            $table->date('recurring_ends_at')->nullable();
            $table->foreignId('income_id')->unique()->constrained();
            $table->foreignId('workspace_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recurring_incomes');
    }
};

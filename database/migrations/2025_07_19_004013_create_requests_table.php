<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Matter::class);
            $table->foreignIdFor(\App\Models\User::class, 'request_by')->constrained('users');
            $table->string('status')->default('pending');
            $table->string('comment')->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'approved_by')->nullable()->constrained('users');
            $table->dateTime('approved_at')->nullable();
            $table->string('approved_comment')->nullable();
            $table->string('type');
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
        Schema::dropIfExists('requests');
    }
};

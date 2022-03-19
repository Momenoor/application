<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('active', ['true', 'false'])->default('true');
            $table->timestamps();
        });
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('type')->default('office');
            $table->enum('black_list', ['true', 'false'])->default('false');
            $table->text('extra')->nullable();
            $table->foreignId('parent_id')->nullable()->references('id')->on('parties')->comment('party id as parent if the current party is belong to office, ..etc');
            $table->foreignId('user_id')->comment('assigned user')->nullable()->constrained();
            $table->timestamps();
        });

        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('category')->comment('main,certified,assistant,external,external-assistant')->default('assistant');
            $table->string('field')->comment('accounting, engineering, ......')->default('accounting');
            $table->foreignId('user_id')->nullable()->comment('assigned user')->constrained();
            $table->timestamps();
        });

        Schema::create('matters', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->string('number');
            $table->string('status')->default('current');
            $table->string('commissioning');
            $table->date('received_date')->nullable();
            $table->date('next_session_date')->nullable();
            $table->date('reported_date')->nullable();
            $table->date('submitted_date')->nullable();
            $table->decimal('external_marketing_rate', 3)->nullable();
            $table->foreignId('user_id')->comment('user whom add the matter to can access to it even if he is not a party.')->constrained();
            $table->foreignId('expert_id')->constrained();
            $table->foreignId('court_id')->constrained();
            $table->foreignId('level_id')->nullable()->constrained();
            $table->foreignId('type_id')->constrained();
            $table->foreignId('parent_id')->nullable()->references('id')->on('matters');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('unpaid');
            $table->string('type')->default('main');
            $table->string('recurring')->default('no');
            $table->foreignId('matter_id')->constrained();
            $table->foreignId('user_id')->comment('The user whom made the transaction.')->constrained();
            $table->timestamps();
        });

        Schema::create('cashes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('datetime');
            $table->decimal('amount', 10, 2);
            $table->text('description')->nullable();
            $table->enum('type', ['income', 'expense'])->default('income');
            $table->foreignId('matter_id')->constrained();
            $table->foreignId('claim_id')->constrained();
            $table->foreignId('user_id')->comment('The user whom made the transaction.')->constrained();
            $table->timestamps();
        });

        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->dateTime('datetime');
            $table->text('description')->nullable();
            $table->text('link')->nullable();
            $table->string('link_type')->nullable();
            $table->foreignId('matter_id')->constrained();
            $table->timestamps();
        });
        Schema::create('matter_party', function (Blueprint $table) {
            $table->foreignId('matter_id')->constrained();
            $table->foreignId('party_id')->constrained();
            $table->unsignedBigInteger('parent_id')->default(0)->comment('this parent id when party relate to another party.')->on('parties')->references('id');
            $table->string('type')->default('plaintiff');
            $table->timestamps();
        });

        Schema::create('matter_expert', function (Blueprint $table) {
            $table->foreignId('matter_id')->constrained();
            $table->foreignId('expert_id')->constrained();
            $table->string('type')->default('assistant');
            $table->timestamps();
        });

        Schema::create('matter_marketing', function (Blueprint $table) {
            $table->foreignId('matter_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('type')->default('marketer');
            $table->timestamps();
        });

        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('datetime');
            $table->text('text');
            $table->foreignId('matter_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
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
        Schema::dropIfExists('levels');
        Schema::dropIfExists('types');
        Schema::dropIfExists('courts');
        Schema::dropIfExists('experts');
        Schema::dropIfExists('matters');
        Schema::dropIfExists('claims');
        Schema::dropIfExists('cashse');
        Schema::dropIfExists('procedures');
        Schema::dropIfExists('parties');
        Schema::dropIfExists('matter_party');
        Schema::dropIfExists('notes');
    }
}

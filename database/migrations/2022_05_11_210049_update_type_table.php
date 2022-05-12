<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('types', function (Blueprint $table) {
            $keyExists = \DB::select(
                \DB::raw(
                    'SHOW KEYS
                    FROM types
                    WHERE Key_name=\'types_name_unique\''
                )
            );
            if (count($keyExists) > 0) {
                $table->dropUnique('types_name_unique');
            }
            $table->unique('name');
        });
        Schema::table('experts', function (Blueprint $table) {
            $keyExists = \DB::select(
                \DB::raw(
                    'SHOW KEYS
                    FROM experts
                    WHERE Key_name=\'experts_name_unique\''
                )
            );
            if (count($keyExists) > 0) {
                $table->dropUnique('experts_name_unique');
            }
            $table->unique('name');
        });
        Schema::table('courts', function (Blueprint $table) {
            $keyExists = \DB::select(
                \DB::raw(
                    'SHOW KEYS
                    FROM courts
                    WHERE Key_name=\'courts_name_unique\''
                )
            );
            if (count($keyExists) > 0) {
                $table->dropUnique('courts_name_unique');
            }
            $table->unique('name');
        });
        Schema::table('parties', function (Blueprint $table) {
            $keyExists = \DB::select(
                \DB::raw(
                    'SHOW KEYS
                    FROM parties
                    WHERE Key_name=\'parties_name_unique\''
                )
            );
            if (count($keyExists) > 0) {
                $table->dropUnique('parties_name_unique');
            }
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('types', function (Blueprint $table) {
            $table->dropUnique('types_name_unique');
        });
        Schema::table('experts', function (Blueprint $table) {
            $table->dropUnique('experts_name_unique');
        });
        Schema::table('courts', function (Blueprint $table) {
            $table->dropUnique('courts_name_unique');
        });
        Schema::table('parties', function (Blueprint $table) {
            $table->dropUnique('parties_name_unique');
        });
    }
}

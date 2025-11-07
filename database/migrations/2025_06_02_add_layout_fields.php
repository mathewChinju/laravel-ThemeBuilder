<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->json('layout')->nullable()->after('existing_components');
        });

        Schema::table('prompt_histories', function (Blueprint $table) {
            $table->json('keywords')->nullable()->after('response');
            $table->json('components')->nullable()->after('keywords');
            $table->json('existing_components')->nullable()->after('components');
            $table->json('layout')->nullable()->after('existing_components');
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('layout');
        });

        Schema::table('prompt_histories', function (Blueprint $table) {
            $table->dropColumn(['keywords', 'components', 'existing_components', 'layout']);
        });
    }
};

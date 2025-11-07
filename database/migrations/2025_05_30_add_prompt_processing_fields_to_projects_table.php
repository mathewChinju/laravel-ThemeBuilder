<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->json('keywords')->nullable()->after('prompt');
            $table->json('components')->nullable()->after('keywords');
            $table->json('existing_components')->nullable()->after('components');
            $table->json('html_content')->nullable()->after('preview_data');
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['keywords', 'components', 'existing_components', 'html_content']);
        });
    }
};

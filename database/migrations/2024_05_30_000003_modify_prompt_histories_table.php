<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('prompt_histories', function (Blueprint $table) {
            // Drop the old prompt column
            $table->dropColumn('prompt');
            
            // Add the new prompts column
            $table->json('prompts')->nullable()->after('project_id');
        });
    }

    public function down()
    {
        Schema::table('prompt_histories', function (Blueprint $table) {
            // Drop the new prompts column
            $table->dropColumn('prompts');
            
            // Add back the old prompt column
            $table->text('prompt')->nullable()->after('project_id');
        });
    }
};

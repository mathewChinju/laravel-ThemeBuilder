<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('prompt_histories', function (Blueprint $table) {
            // Drop the prompts column
            $table->dropColumn('prompts');
            
            // Add the new prompt column as text
            $table->text('prompt')->after('project_id');
        });
    }

    public function down()
    {
        Schema::table('prompt_histories', function (Blueprint $table) {
            // Drop the prompt column
            $table->dropColumn('prompt');
            
            // Add back the prompts column
            $table->json('prompts')->nullable()->after('project_id');
        });
    }
};

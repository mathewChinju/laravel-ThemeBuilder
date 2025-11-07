<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'prompt',
        'keywords',
        'components',
        'existing_components',
        'layout',
        'description',
        'preview_data',
        'html_content'
    ];

    protected $casts = [
        'keywords' => 'array',
        'components' => 'array',
        'existing_components' => 'array',
        'layout' => 'array',
        'preview_data' => 'array',
        'html_content' => 'array'
    ];

    public function promptHistories()
    {
        return $this->hasMany(PromptHistory::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromptHistory extends Model
{
    protected $fillable = [
        'project_id',
        'prompt',
        'response',
        'keywords',
        'components',
        'existing_components',
        'layout',
        'preview_data'
    ];

    protected $casts = [
        'keywords' => 'array',
        'components' => 'array',
        'existing_components' => 'array',
        'layout' => 'array',
        'preview_data' => 'array'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getPromptAttribute($value)
    {
        return $value;
    }

    public function setPromptAttribute($value)
    {
        $this->attributes['prompt'] = $value;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'cover_image', 'type_id', 'technology_id'];
    use HasFactory;

    public function Type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }



    public function Technologys(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }
}

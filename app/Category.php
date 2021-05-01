<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug'
    ];
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}

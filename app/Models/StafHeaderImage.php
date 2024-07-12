<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StafHeaderImage extends Model
{
    use HasFactory;


    public function tags_list()
    {
        return $this->hasMany(StafTagToTable::class);
    }


    // public function tags_name()
    // {
    //     // return $this->hasMany(StafTagToTable::class);
    //     return $this->hasManyThrough(StafTagToTable::class,StafTag::class);

    // }

    // public function tags(): BelongsToMany
    // {
    //     return $this->belongsToMany(StafTag::class);
    // }
    
    public function tags()
    {
        return $this->belongsToMany(StafTag::class,StafTagToTable::class, 'staf_header_image_id', 'staf_tag_id');
    }

    public function tags_names()
    {
        return $this->roles()->pluck('en_tags');
    }




    
}

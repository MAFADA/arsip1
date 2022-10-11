<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Archive extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = ['letter_number','category','title'];

    public function categories(){
        return $this->belongsTo(ArchiveCategory::class,'category');
    }

}

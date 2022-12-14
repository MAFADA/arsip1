<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveCategory extends Model
{
    use HasFactory;

    protected $fillable = ['archive_category'];

    public function archives(){
        return $this->hasMany(Archive::class);
    }
}

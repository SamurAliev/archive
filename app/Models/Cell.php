<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'slug', 'archive_id'];

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

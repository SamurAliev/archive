<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'slug','content', 'folder_id'];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

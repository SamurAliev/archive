<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'slug', 'cell_id'];

    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

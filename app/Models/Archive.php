<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'slug'];

    public function cells() {
        return $this->hasMany(Cell::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

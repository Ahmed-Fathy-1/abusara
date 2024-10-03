<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'key_en',
        'key_ar',
        'value'
    ];

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_items')->withTimestamps();;
    }

}

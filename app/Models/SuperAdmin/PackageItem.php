<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "item_id",
        "package_id",

    ];

    protected $casts = [
        'item_id' => 'array',
        'package_id' => 'array',
    ];

    public function package()
    {
        return $this->belongsToMany(Package::class);
    }
    public function item()
    {
        return $this->belongsToMany(Item::class);
    }


}

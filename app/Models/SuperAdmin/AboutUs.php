<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'mission',
        'value',
        'value_image',
        'vision',
        'vision_image',
        'team',
        'team_image',
        'image'
    ];
}

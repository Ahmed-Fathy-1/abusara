<?php

namespace App\Models\SuperAdmin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'description_ar',
        'description_en',
        'subtitle_ar',
        'subtitle_en',
        'title_ar',
        'title_en'
    ] ;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}

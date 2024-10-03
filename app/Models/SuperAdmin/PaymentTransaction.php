<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "package_id",
        "total",
        "image",
        "status"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id" , 'id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id','id');
    }
}

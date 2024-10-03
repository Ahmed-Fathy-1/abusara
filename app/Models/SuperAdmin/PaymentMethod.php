<?php

namespace App\Models\SuperAdmin;

use App\Models\SuperAdmin\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'image',
        'name_en',
        'name_ar'
    ] ;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


    // protected function getImageAttribute($value)
    // {
    //     if ($value) {
    //         return asset('media/PaymentMethod' . '/' . $value);
    //     } else {
    //         return asset('media/PaymentMethod/default.png');
    //     }
    // }

    // public function setImageAttribute($value)
    // {
    //     if ($value) {
    //         $imageName = time() . '.' . $value->getClientOriginalExtension();
    //         $value->move(public_path('media/PaymentMethod/'), $imageName);
    //         $this->attributes['image'] = $imageName;
    //     }
    // }


}

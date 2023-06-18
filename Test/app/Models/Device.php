<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function device_user_pivot()
    {
        return $this->hasMany(DeviceUserPivot::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    
    public function manager()
    {
        return $this->hasOneThrough(
            User::class,
            BranchStaff::class,
            'branch_id',
            'id',
            'id',
            'user_id'
        )->whereHas('roles', function ($query) {
            $query->where('name', 'Manager');
        });
    }
    public function staff()
    {
        return $this->hasManyThrough(
            User::class,
            BranchStaff::class,
            'branch_id',
            'id',
            'id',
            'user_id'
        );
    }
    public function getManagerAttribute()
    {
        return $this->manager()->first();
    }
}

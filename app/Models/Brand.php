<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function branchStaff()
    {
        return $this->hasManyThrough(
            BranchStaff::class,
            Branch::class,
            'brand_id',
            'branch_id',
            'id',
            'id'
        );
    }
    
    public function brandStaff()
    {
        return $this->hasMany(BrandStaff::class, 'brand_id');
    }
    
    public function managers()
    {
        return $this->brandStaff()
            ->with('user') // Eager load the related User model
            ->whereHas('user.roles', function ($query) {
                $query->where('name', 'manager');
            });
    }
}

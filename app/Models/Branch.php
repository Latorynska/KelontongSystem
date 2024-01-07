<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Branch extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['brand_id', 'owner_id', 'name', 'location'];

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
    
    public function branchStaff()
    {
        return $this->hasMany(BranchStaff::class, 'branch_id', 'id')->with('user.roles');
    }
    
    public function getManagerAttribute()
    {
        return $this->manager()->first();
    }
    
    public function transactions(){
        return $this->hasMany(Transaction::class, 'branch_id','id')->with(['transactionDetails', 'user']);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchStaff extends Model
{
    use HasFactory;
    protected $table = "branch_staffs";
    protected $guarded = ["id"];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

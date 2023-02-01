<?php

namespace Maestro\Admin\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Maestro\Admin\Database\Factories\AdminFactory;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return AdminFactory::new();
    }
}

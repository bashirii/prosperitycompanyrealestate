<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function agent() {
        return $this->belongsTo(Team::class, 'agent_id');
    }
}

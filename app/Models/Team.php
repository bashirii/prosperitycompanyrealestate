<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';

    protected $guarded = [];

    public function destination() {
        return $this->belongsTo(Destination::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}

<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Task extends Eloquent
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
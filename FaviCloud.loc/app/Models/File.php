<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'path', 'is_public', 'file_size', 'file_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

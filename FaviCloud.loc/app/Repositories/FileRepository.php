<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Foundation\Auth\User;

class FileRepository
{
    public function forUser(User $user)
    {
        return File::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}

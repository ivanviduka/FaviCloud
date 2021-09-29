<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;

class FileRepository
{
    public function forUser(User $user)
    {
        return File::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getFile($file_id){
        return File::select('file_name', 'description', 'is_public', 'file_type')->where('id', $file_id)->first();
    }

    public function getFileName($file_id){
        return File::select('file_name')->where('id', $file_id)->first();
    }

    public function getPublic($file_id){
        return File::select('is_public')->where('id', $file_id)->first();
    }
    public function getOwner($file_id){
        return File::select('user_id')->where('id', $file_id)->first();
    }
    public function getIdWithName($file_name){
        return File::select('id')->where('file_name', $file_name)->first();
    }

}

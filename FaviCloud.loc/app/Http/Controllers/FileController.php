<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    //

    protected $files;


    public function __construct(FileRepository $files)
    {
        $this->middleware('auth');

        $this->files = $files;
    }

    public function index(Request $request){

        if (!Auth::check()) {
            return view('authentication.login');
        }

        return view('dashboard.index', [
            'files' => $this->files->forUser($request->user()),
            ]);



    }

    public function addFile(Request $request){

        $this->validate($request, [
            'file' => 'required|max:100000|file|filled|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf'
        ]);
    }

}

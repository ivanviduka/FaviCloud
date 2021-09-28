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
        $this->files = $files;
    }

    public function index(Request $request){

        return view('dashboard.index', [
            'files' => $this->files->forUser($request->user()),
            ]);



    }

    public function createForm(){
        return view('dashboard.file-upload');
    }

    public function addFile(Request $request){

        $this->validate($request, [
            'file' => 'required|max:100000|file|filled|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx,xml'
        ]);

        $fileModel = new File;

        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->file_name = time().'_'.$request->file->getClientOriginalName();
            $fileModel->path = '/storage/' . $filePath;
            $fileModel->is_public = $request->has('public_check');
            $fileModel->file_size = $request->file('file')->getSize();
            $fileModel->file_type = $request->file('file')->extension();
            $fileModel->user_id = auth()->id();
            $fileModel->save();

            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;


class FileController extends Controller
{

    protected $files;

    public function __construct(FileRepository $files)
    {
        $this->files = $files;
    }

    public function index(Request $request)
    {
        return view('dashboard.index', [
            'files' => $this->files->forUser($request->user()),
        ]);

    }

    public function createForm()
    {
        return view('dashboard.file-upload');
    }

    public function addFile(Request $request)
    {
        $request->validate([
            'file' => 'required|max:100000|file|filled|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx,xml,html',
            'description' => 'max:255',

        ]);

        $fileModel = new File;

        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName);

            $fileModel->file_name = time() . '_' . $request->file->getClientOriginalName();
            $fileModel->description = $request->description;
            $fileModel->path = '/storage/app/' . $filePath;
            $fileModel->is_public = $request->has('public_check');
            $fileModel->file_size = $request->file('file')->getSize();
            $fileModel->file_type = $request->file('file')->extension();
            $fileModel->user_id = auth()->id();
            $fileModel->save();

            return back()
                ->with('success', 'File has been uploaded.')
                ->with('file', $fileName);
        }
        return back()->with('error', 'No file in request');
    }

    public function downloadFile($file_name)
    {
        $fileForDownload = $this->files->getFileWithName($file_name);

        if ((auth()->id() == $fileForDownload->user_id) || $fileForDownload->is_public) {
            $downloadLink = storage_path('app/uploads/' . $file_name);
            if (file_exists($downloadLink)) {
                return response()->download($downloadLink);
            }
        } else {
            return redirect('/unauthorized-download');
        }

    }

    public function createUpdateForm($file_id)
    {
        $currentFile = $this->files->getFile($file_id);

        $nameWithoutExtension = pathinfo($currentFile->file_name, PATHINFO_FILENAME);

        $currentName = substr($nameWithoutExtension, strpos($nameWithoutExtension, "_") + 1);
        $currentDescription = $currentFile->description;
        $currentPublic = $currentFile->is_public;

        session(['file_id' => $file_id]);
        session(['original_name' => $currentFile->file_name]);
        session(['file_type' => $currentFile->file_type]);

        $currentValues = array('file_name' => $currentName,
            'file_description' => $currentDescription,
            'file_public' => $currentPublic);

        return view('dashboard.file-update')->with('data', $currentValues);
    }

    public function updateFile(Request $request)
    {
        if (!(session()->has('file_id') && session()->has('original_name') && session()->has('file_type'))) {
            return redirect("/");
        }

        $request->validate([
            'file_name' => 'required|max:100',
            'description' => 'max:255',
        ]);

        $fileName = time() . '_' . $request->file_name . '.' . session()->get('file_type');
        Storage::move('uploads/' . session()->get('original_name'), 'uploads/' . $fileName);

        $fileModel = new File;
        $fileModel->where('id', session()->get('file_id'))->update(
            ['file_name' => $fileName,
                'description' => $request->description,
                'is_public' => $request->has('public_check')]);

        session()->forget('file_id');
        session()->forget('original_name');
        session()->forget('file_type');

        return redirect("/");
    }

    public function deleteFile($file_id)
    {
        $fileName = $this->files->getFileName($file_id);
        Storage::delete('uploads/' . $fileName->file_name);
        File::where('id', $file_id)->delete();

        return redirect("/");
    }

    public function shareFile($file_id)
    {
        $fileForShare = $this->files->getFile($file_id);

        if ($fileForShare->user_id != auth()->id()) {
            return redirect("/");
        }

        $downloadLink = route('file.download', ['file_name' => rawurlencode($fileForShare->file_name)]);

        $values = array('is_public' => $fileForShare->is_public,
            'path' => $downloadLink);

        return view('dashboard.file-share')->with('data', $values);
    }
}

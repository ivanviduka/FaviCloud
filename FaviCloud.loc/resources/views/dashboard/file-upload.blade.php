@extends('layouts.dashboard')

@section('content')

    <div class="container mt-5">
        <form action="{{route('file.upload')}}" method="post" enctype="multipart/form-data">
            <h3 class="text-center mb-5">Upload File to Favicloud</h3>
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="custom-file mb-3">
                <label for="chooseFile" class="form-label">Select file</label>
                <input type="file" name="file" class="form-control" id="chooseFile">
            </div>

            <div class="mb-3">
                <input type="text" name="description" class="form-control" placeholder="File Description"
                       id="fileDescription">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" name="public_check" id="public_check">
                <label class="form-check-label" for="public_check">
                    Make file public
                </label>
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Files
            </button>

        </form>
    </div>
@endsection

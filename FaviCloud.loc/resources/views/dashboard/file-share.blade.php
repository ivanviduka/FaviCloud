@extends('layouts.dashboard')

@section('content')

    <div class="container mt-5">

        @if($data['is_public'])
            <div class="mb-3">
                <h3 class="form-label">Link to File</h3>
                <input type="text" name="file_name" value="{{$data['path']}}" class="form-control"
                       id="fileName">
            </div>
        @else
            <div class="mb-3">
                <div class="alert alert-danger" role="alert">
                    This file is private! If you want to share it, please change file settings in dashboard, using
                    Alter File button
                </div>

                <label for="fileName" class="form-label">Link to File</label>
                <input type="text" name="file_name" class="form-control"
                       id="fileName">
            </div>
        @endif

    </div>
@endsection

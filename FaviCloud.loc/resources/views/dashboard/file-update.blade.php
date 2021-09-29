@extends('layouts.dashboard')

@section('content')

    <div class="container mt-5">
        <form action="{{route('file.update')}}" method="post" enctype="multipart/form-data">
            <h3 class="text-center mb-5">Update File</h3>
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

            <div class="mb-3">
                <label for="fileName" class="form-label">Name</label>
                <input type="text" name="description" value="{{$data['file_name']}}" class="form-control"
                       id="fileName">
            </div>

            <div class="mb-3">
                <label for="fileDescription" class="form-label">Description</label>
                <input type="text" name="description" value="{{$data['file_description']}}" class="form-control"
                       id="fileDescription">
            </div>

            <div class="form-check mb-3">

                @if(empty($data['file_public']))
                    <input class="form-check-input" type="checkbox" value="" name="public_check" id="public_check">
                    <label class="form-check-label" for="public_check">
                        Make file public
                    </label>
                @else
                    <input class="form-check-input" type="checkbox" value="" name="public_check" id="public_check"
                           checked>
                    <label class="form-check-label" for="public_check">
                        Make file public
                    </label>
                @endif
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Update File
            </button>

        </form>


    </div>
@endsection

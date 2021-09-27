
@extends('layouts.dashboard')

@section('content')

@section('content')

    @if (count($files) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                MY FILES
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>File Name</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text">
                                <div>{{ $file->file_name }}</div>
                            </td>

                            <td>
                                <form action="/file/{{ $file->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button>Delete File</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection


@endsection

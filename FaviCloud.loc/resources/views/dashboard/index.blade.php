@extends('layouts.dashboard')

@section('content')

    @if (count($files) > 0)
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-hover">

                    <thead>
                    <th scope="col">File Name</th>
                    <th scope="col">Share</th>
                    <th scope="col">Description</th>
                    <th scope="col">Size</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </thead>

                    <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td class="table-text">
                                <a href="{{route('file.download', ['file_name'=>$file->file_name])}}">{{ $file->file_name }}</a>
                            </td>

                            @if($file->is_public)
                                <td class="table-text">
                                    <form action="/share/{{ $file->id }}" method="GET">
                                        <button class="btn btn-default btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-share" viewBox="0 0 16 16">
                                                <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11
                                        2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0
                                        1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5
                                        0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5
                                        0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0
                                        3 1.5 1.5 0 0 0 0-3z"/>
                                            </svg>
                                        </button>
                                    </form>

                                </td>
                            @else
                                <td></td>
                            @endif

                            <td class="table-text">
                                <div>{{ $file->description }}</div>
                            </td>

                            <td class="table-text">
                                <div>{{ $file->file_size }}</div>
                            </td>

                            <td>
                                <!-- TODO -- UPDATE FILE NAME -->
                                <form action="/update/{{ $file->id }}" method="GET">
                                    <button>Alter File</button>
                                </form>


                            </td>

                            <td>
                                <!-- TODO -- DELETE FILE -->
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



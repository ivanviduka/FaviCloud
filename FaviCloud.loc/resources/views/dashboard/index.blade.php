
@extends('layouts.dashboard')

@section('content')

    @if (count($files) > 0)
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-hover">

                    <thead>
                        <th scope="col">File Name</th>
                        <th scope="col">Size</th>
                        <th scope="col"> </th>
                        <th scope="col"> </th>
                    </thead>

                    <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td class="table-text">
                                <a href="{{route('file.download', ['file_name'=>$file->file_name])}}">{{ $file->file_name }}</a>
                            </td>

                            <td class="table-text">
                                <div>{{ $file->file_size }}</div>
                            </td>

                            <td>
                                <!-- TODO -- UPDATE FILE NAME -->
                                <form action="" method="POST">
                                    {{ csrf_field() }}

                                    <button>Rename File</button>
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



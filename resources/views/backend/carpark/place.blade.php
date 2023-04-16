@extends('backend.layout')


@section('content')
    <table id="myTable" class="display">
        <thead>
        <tr>
            <th>Park Adı</th>
            <th>Kat Numarası</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key=>$value)
            <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->floor}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection


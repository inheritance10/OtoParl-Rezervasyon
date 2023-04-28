@extends('backend.layout')

@section('content')
    <h2 class='mb-3'>Otoparklar</h2>
    <table id="dtBasicExample" class="table" width="100%">
        <a class="btn btn-success" href="{{route('car-park-add')}}">
            Otopark Kaydı Ekle
        </a>
        <thead>
        <tr>
            <th class="th-sm">Adı
            </th>
            <th class="th-sm">Kat Sayısı
            </th>
            <th class="th-sm">Kat Park Yeri Sayısı
            </th>
            <th class="th-sm">İşlemler
            </th>

        </tr>
        </thead>
        <tbody>
        @foreach($data as $key=>$value)
            <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->floor_count}}</td>
                <td>{{$value->park_count}}</td>
                <td>
                    <a class="btn btn-danger" href="#" onclick="deleteCarPark('{{$value->id}}')">
                        Sil
                    </a>
                </td>
            </tr>
        @endforeach



        </tbody>

    </table>


@endsection


@section('js')

@endsection

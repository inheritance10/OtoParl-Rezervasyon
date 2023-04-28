@extends('backend.layout')


@section('content')
    <h3 class="alert alert-success m-5">
        Günlük Rezervasyonlar
    </h3>
    <table id="myTable" class="display">
        <thead>
        <tr>
            <th>Park Adı</th>
            <th>Kat Numarası</th>
            <th>Ad Soyad</th>
            <th>PNR Kodu</th>
            <th>Ücret</th>
            <th>Başlangıç Tarihi</th>
            <th>Bitiş Tarihi</th>
            <th>Araç Çıkışı</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key=>$value)
            <tr>
                <td>{{$value->car_park_places->name}}</td>
                <td>{{$value->car_park_places->floor}}</td>
                <td>{{$value->users->name}}</td>
                <td>{{$value->pnr_code}}</td>
                <td>{{$value->price}}</td>
                <td>{{$value->start_date}}</td>
                <td>{{$value->end_date}}</td>
                <td>
                    <a href="{{route('reservation-finish', $value->id)}}" class="btn btn-danger">
                        Çıkış Ver
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection



@extends('backend.layout')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Otopark Kaydı Düzenle</h3>

        </div>
        <div class="box-header with-border">
            <a class="btn btn-warning" href="{{route('car-park-info')}}">Geri</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <input type="hidden" class="form-control" id="id" value="{{$data->id}}">
            <div class="form-group">
                <label for="name">Adı</label>
                <input type="text" class="form-control" id="name" value="{{$data->name}}" placeholder="Ad giriniz">
            </div>
            <div class="form-group">
                <label for="floor_count">Kat Sayısı</label>
                <input type="text" class="form-control" id="floor_count" value="{{$data->floor_count}}" placeholder="Kat sayısı giriniz">
            </div>
            <div class="form-group">
                <label for="floor_count">Kat Park Yeri Sayısı</label>
                <input type="text" class="form-control" id="park_count" value="{{$data->park_count}}" placeholder="Her katın park yeri sayısı">
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button id="updateCarPark" type="submit" class="btn btn-primary">Düzenle</button>
        </div>
    </div>
@endsection


@section('css')
@endsection


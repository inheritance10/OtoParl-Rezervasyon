@extends('backend.layout')

@section('content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Otopark Kaydı Ekle</h3>

        </div>
        <div class="box-header with-border">
            <a class="btn btn-warning" href="{{route('car-park-info')}}">Geri</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Adı</label>
                    <input type="text" class="form-control" id="name" placeholder="Ad giriniz">
                </div>
                <div class="form-group">
                    <label for="floor_count">Kat Sayısı</label>
                    <input type="text" class="form-control" id="floor_count" placeholder="Kat sayısı giriniz">
                </div>
                <div class="form-group">
                    <label for="floor_count">Kat Park Yeri Sayısı</label>
                    <input type="text" class="form-control" id="park_count" placeholder="Her katın park yeri sayısı">
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button id="saveCarPark" type="submit" class="btn btn-primary">Kaydet</button>
            </div>
    </div>


@endsection


@section('css')

@endsection

@section('js')

@endsection

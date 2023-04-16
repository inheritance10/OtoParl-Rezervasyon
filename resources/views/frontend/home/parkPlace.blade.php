<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <style>
        .section {
            position: relative;
            height: 100vh;
        }

        .section .section-center {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        #booking {
            font-family: 'Montserrat', sans-serif;
            background-image: url('https://i.imgur.com/ZaRYfYW.jpg');
            background-size: cover;
            background-position: center;
        }

        #booking::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
            background: rgba(47, 103, 177, 0.6);
        }

        .booking-form {
            background-color: #fff;
            padding: 50px 20px;
            -webkit-box-shadow: 0px 5px 20px -5px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 5px 20px -5px rgba(0, 0, 0, 0.3);
            border-radius: 4px;
        }

        .booking-form .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        .booking-form .form-control {
            background-color: #ebecee;
            border-radius: 4px;
            border: none;
            height: 40px;
            -webkit-box-shadow: none;
            box-shadow: none;
            color: #3e485c;
            font-size: 14px;
        }

        .booking-form .form-control::-webkit-input-placeholder {
            color: rgba(62, 72, 92, 0.3);
        }

        .booking-form .form-control:-ms-input-placeholder {
            color: rgba(62, 72, 92, 0.3);
        }

        .booking-form .form-control::placeholder {
            color: rgba(62, 72, 92, 0.3);
        }

        .booking-form input[type="date"].form-control:invalid {
            color: rgba(62, 72, 92, 0.3);
        }

        .booking-form select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .booking-form select.form-control+.select-arrow {
            position: absolute;
            right: 0px;
            bottom: 4px;
            width: 32px;
            line-height: 32px;
            height: 32px;
            text-align: center;
            pointer-events: none;
            color: rgba(62, 72, 92, 0.3);
            font-size: 14px;
        }

        .booking-form select.form-control+.select-arrow:after {
            content: '\279C';
            display: block;
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
        }

        .booking-form .form-label {
            display: inline-block;
            color: #3e485c;
            font-weight: 700;
            margin-bottom: 6px;
            margin-left: 7px;
        }

        .booking-form .submit-btn {
            display: inline-block;
            color: #fff;
            background-color: #1e62d8;
            font-weight: 700;
            padding: 14px 30px;
            border-radius: 4px;
            border: none;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
        }

        .booking-form .submit-btn:hover,
        .booking-form .submit-btn:focus {
            opacity: 0.9;
        }

        .booking-cta {
            margin-top: 80px;
            margin-bottom: 30px;
        }

        .booking-cta h1 {
            font-size: 52px;
            text-transform: uppercase;
            color: #fff;
            font-weight: 700;
        }

        .booking-cta p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
    <link src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Otoparkçım</title>
</head>
<body>

<!--navbar-->

<nav style="margin: 8px" class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="m-1 navbar-brand" href="#">
        <img src="../../assets/img/car.png" width="70px" height="70px" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">Anasayfa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Hesabım</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Çıkış</a>
                <form id="logout-form" method="post" action="{{route('logout')}}">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>






    <div class="container">

        <div class="col-md-12 col-md-pull-7">
            <div class="booking-form">
                <form method="get" action="{{route('get-park-place', [$id,$floor])}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <span class="form-label">Tarih Seçiniz</span>
                                <input class="form-control" id="date" name="date" type="date" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <span class="form-label">Başlangıç Saati Seçiniz</span>
                                <select class="form-control" name="start_hour" type="date" required>
                                    @for($i=7; $i<=23; $i++)
                                        <option>
                                            {{$i}}
                                        </option>
                                    @endfor

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <span class="form-label">Bitiş Saati Seçiniz</span>
                                <select class="form-control" name="end_hour" type="date" required>
                                    @for($i=7; $i<=23; $i++)
                                        <option>
                                            {{$i}}
                                        </option>
                                    @endfor

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="submit-btn">Sorgula</button>
                    </div>
                </form>
            </div>

            <p class="mt-3 alert alert-info">
                {{$date}} tarihi  @if($start_hour != '' && $end_hour != '') {{$start_hour}} - {{$end_hour}} saatleri arası rezervasyon yapmaktasınız @endif
            </p>
        </div>

        <br><br>
        <div class="row">
            <h2>Müsait Park Yerleri</h2>
            @foreach($available as $data)
                <div class="col-sm-2 mt-3">
                    <div style="background-color: green"  class="card">
                        <div class="card-body">
                            <a href="{{route('reservation', ['id' => $data['id'], 'date' => $date])}}" style="text-decoration: none">
                                <h1 style="color: white">
                                    {{$data['name']}}
                                </h1>
                                <p style="color: white" class="card-text">Devam etmek için tıklayın</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <br><br>

        <div class="row">
            <h2>Dolu Park Yerleri</h2>
            @foreach($notAvailable as $data)
                <div class="col-sm-2 mt-3">
                    <div style="background-color: red" class="card">
                        <div class="card-body">
                            <a disabled href="" style="text-decoration: none">
                                <h1 style="color: white">
                                    {{$data['name']}}
                                </h1>
                                <p style="color: white" class="card-text">Devam etmek için tıklayın</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>






<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">


    <link src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Otoparkçım</title>

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

        .jqModal {
            display: none; /* By default, display will be hidden */
            position: fixed; /* Position will be fixed */
            z-index: 1; /* makes the modal box display on the top */
            padding-top: 100px; /* Location of the modal box */
            left: 0;
            top: 0;
            width: 100%; /* width 100%, resizable according to window size */
            height: 100%; /* height 100%, resizable according to window size */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* color for the Fallback */
            background-color: rgba(0,0,0,0.7); /* Opacity for the fallback */
        }
        /* CSS for Modal Dialog Content Text */
        .content {
            background-color:#FFF;
            margin: auto;
            padding: 20px;
            border: 3px solid #809;
            width: 80%;
        }
        /* CSS for Cross or exit or close Button */
        .exit {
            color: #809;
            float: right;
            font-size: 30px;
            font-weight: bold;
        }
        .exit:hover,
        .exit:focus {
            color: #000;
            cursor: pointer;
        }
        #modalBtn{

        }
    </style>
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
                <a class="nav-link" href="{{route('account')}}">Hesabım</a>
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

<div class="mt-3 container">
    <div class="section-center">
        <a onclick="$.hourReservationShow()" class="btn btn-warning" href="#">Saatlik Rezervasyon</a>
        <a onclick="$.dateReservationShow()" class="btn btn-info" href="#">Günlük Rezervasyon</a>
        <button  class="btn btn-success" id="modalBtn">Aylık Abone Ol</button>
    </div>


    <div id="modalDemo" class="jqModal">
        <div class="content">
            <span class="exit">&times;</span>
            <p style="font-size: 22px; font-weight: bold">{{\Carbon\Carbon::now()->format('Y-m-d')}} / {{\Carbon\Carbon::now()->addDays(30)->format('Y-m-d')}} tarihleri arasında abone kaydı oluşturuyorsunuz</p>
            <p class="alert alert-info" style="font-size: 18px; font-weight: bold">Ücret : 1200₺</p>
            <a  class="btn btn-success" onclick="$.confirmSubscribReservation('{{$id}}')">Aylık Abone Ol</a>
        </div>
    </div>

</div>

<div class="section-center">


    <div id="dateReservationContainer" style="display: none" class="mt-5 container">
        <div class="row">
            <h1>{{$carParkPlace->name}} İçin Günlük Rezervasyon Oluştur</h1>
            @if(count($reservation) > 0)
                <h4>Rezerv Edilen Tarihler</h4>
                @foreach($reservation as $data)
                    <div class="col-sm-4 mt-3">
                        <div class="card alert alert-danger">
                            <div class="card-body">
                                <h3>{{$data->start_date}} / {{$data->end_date}} tarihler arası rezerve</h3>
                            </div>
                        </div>
                    </div>

                @endforeach

            @endif
            <div>
                <h3>Günlük Ücret</h3>
                <p class="mb-3 mt-3 alert alert-info">
                     85₺ <br>
                </p>
            </div>


            <div  class="col-md-6 col-md-pull-7">
                <div class="booking-form">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <span class="form-label">Başlangıç Tarih Seçiniz</span>
                                    <input class="form-control" id="startDate" type="date" required>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="col-md-6 col-md-pull-7">
                <div class="booking-form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <span class="form-label">Bitiş Tarih Seçiniz</span>
                                <input class="form-control" id="endDate" type="date" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-btn">
                <a style="display: none" id="confirmDateButton" class="btn btn-success" onclick="$.confirmDateReservation('{{$id}}')">Rezervasyon  Tamamla</a>
                <a  onclick="$.priceDateCalculate()" class="btn btn-warning">Ücret Hesapla</a>
                <p style="display: none" class="alert alert-danger" id="datePriceText">

                </p>
            </div>
        </div>
    </div>

    <div id="hourReservationContainer" style="display: none"  class="mt-5 container">
        <div class="row">
            <h1>{{$carParkPlace->name}} İçin Saatlik Rezervasyon Oluştur</h1>
            <p class="alert alert-info">
                {{$date}} tarihi için rezervasyon oluşturmaktasınız
            </p>
            <div>
                <h3>Saatlik Ücretler</h3>
                <p class="mb-3 mt-3 alert alert-info">
                    0 - 1 => 33₺ <br>
                    1 - 2 => 41₺ <br>
                    2 - 4 => 45₺ <br>
                    4 - 8 => 60₺ <br>
                    8 - 12 => 75₺
                </p>
            </div>
            <div  class="col-md-6 col-md-pull-7">
                <div class="booking-form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <span class="form-label">Başlangıç Saati Seçiniz</span>
                                <select class="form-control" name="startHour" id="startHour">
                                    @for($i=7; $i <= 23 ; $i++)
                                        <option>
                                            {{$i}} : 00
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-pull-7">
                <div class="booking-form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <span class="form-label">Bitiş Saati Seçiniz</span>
                                <select class="form-control" name="endHour" id="endHour">
                                    @for($i=7; $i <= 23 ; $i++)
                                        <option>
                                            {{$i}} : 00
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3 form-btn">
                <a id="confirmHourButton" style="display: none;" disabled="true" onclick="$.confirmHourReservation('{{$id}}','{{$date}}')" class="btn btn-success">Rezervasyon  Tamamla</a>
                <a  onclick="$.priceHourCalculate()" class="btn btn-warning">Ücret Hesapla</a>
                <p style="display: none" class="alert alert-danger" id="priceText">

                </p>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

<script>
    $(document).ready(function (){
        let hourPrice = 0;
        let datePrice = 0;
        $.hourReservationShow = function ()
        {
            $('#hourReservationContainer').removeAttr('style');
            $('#dateReservationContainer').attr('style','display:none');
        }

        $.dateReservationShow = function ()
        {
            $('#dateReservationContainer').removeAttr('style');
            $('#hourReservationContainer').attr('style','display:none');
        }


        $.priceDateCalculate = function (){
            let startDate =$('#startDate').val();
            let endDate =$('#endDate').val();

            let d = new Date();

            let month = d.getMonth()+1;
            let day = d.getDate();

            let output = d.getFullYear() + '-' +
                (month<10 ? '0' : '') + month + '-' +
                (day<10 ? '0' : '') + day;

            if(startDate < output){
                toastr.error('Başlangıç Tarihi ile Şimdi tarihan küçük olamaz', 'Hata')
                return false;
            }

            if(startDate == endDate){
                toastr.error('Başlangıç Tarihi ile Bitiş Trihi aynı olamaz', 'Hata')
                return false;
            }
            if(startDate > endDate){
                toastr.error('Başlangıç tarihi  Bitiş tarihinden büyük olamaz', 'Hata')
                return false;
            }



            var startDay = new Date(startDate);
            var endDay = new Date(endDate);

            var millisBetween = startDay.getTime() - endDay.getTime();
            var days = millisBetween / (1000 * 3600 * 24);
            let dayDiff = Math.round(Math.abs(days));

            datePrice = 85 * dayDiff;
            console.log(datePrice);


            $('#confirmDateButton').removeAttr('style');

            $('#datePriceText').removeAttr('style');

            $('#datePriceText').html('Ödenecek Tutar = '+datePrice+'₺');
        }
        $.priceHourCalculate = function (){
            let startHour =$('#startHour').val().replace(': 00','');
            let endHour =$('#endHour').val().replace(': 00','');

            if(startHour == endHour){
                toastr.error('Başlangıç Saati ile Bitiş saati aynı olamaz', 'Hata')
                return false;
            }

            let diffHour = parseInt(endHour) - parseInt(startHour);

            if(0 <= diffHour && diffHour <= 1){
                hourPrice = 31
            }else if (diffHour > 1 && diffHour<=2){
                hourPrice = 41
            }else if (diffHour > 2 && diffHour<=4){
                hourPrice = 45
            }else if (diffHour > 4 && diffHour<=8){
                hourPrice = 60
            }else{
                hourPrice = 70
            }
            $('#confirmHourButton').removeAttr('style');

            $('#priceText').removeAttr('style');

            $('#priceText').html('Ödenecek Tutar = '+hourPrice+'₺');
        }


        $.confirmHourReservation = function (id,date){
            let startHour =$('#startHour').val();
            let endHour =$('#endHour').val();
            let type = 1;

            if(startHour == endHour){
                toastr.error('Başlangıç Saati ile Bitiş saati aynı olamaz', 'Hata')
                return false;
            }

            let start = $('#startHour').val().replace(': 00', '');
            let end = $('#endHour').val().replace(': 00', '');

            if(Number(start) > Number(end)){
                toastr.error('Başlangıç Saati  Bitiş saatinden büyük olamaz', 'Hata')
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: '{{route('hour-reservation-confirm')}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    startHour: start,
                    endHour: end,
                    type: type,
                    id: id,
                    date: date,
                    price: hourPrice
                },
                success: function(response){
                    if(response.status == 1){
                        toastr.success(response.message,'Başarılı');
                        window.location.href = '{{route('home')}}'
                    }else if(response.status == 2){
                        toastr.error(response.message,'Hata')
                    }else{
                        toastr.error(response.message,'Hata')
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        $.confirmDateReservation = function (id){
            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();
            let type = 2;

            if(startDate == endDate){
                toastr.error('Başlangıç tarihi ile Bitiş tarihi aynı olamaz', 'Hata')
                return false;
            }

            if(startDate > endDate){
                toastr.error('Başlangıç tarihi  Bitiş tarihinden büyük olamaz', 'Hata')
                return false;
            }




            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: '{{route('date-reservation-confirm')}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    startDate: startDate,
                    endDate: endDate,
                    type: type,
                    id: id,
                    price: datePrice
                },
                success: function(response){
                    if(response.status == 1){
                        toastr.success(response.message,'Başarılı');
                        window.location.href = '{{route('home')}}'
                    }else if(response.status == 2){
                        toastr.error(response.message,'Hata')
                    }else{
                        toastr.error(response.message,'Hata')
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }


        $.confirmSubscribReservation = function (id){
            let type = 3;

            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: '{{route('subscrib-reservation-confirm')}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    type: type,
                    id: id,
                    price: 1200
                },
                success: function(response){
                    if(response.status == 1){
                        toastr.success(response.message,'Başarılı');
                        window.location.href = '{{route('home')}}'
                    }else if(response.status == 2){
                        toastr.error(response.message,'Hata')
                    }else{
                        toastr.error(response.message,'Hata')
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }






    })


    var myModal = document.getElementById("modalDemo");
    // Set object for the button that will trigger the modal box
    var myButton = document.getElementById("modalBtn");
    // Set an element that will close the modal box
    var exitBtn = document.getElementsByClassName("exit")[0];
    // Allows display of modal box, when user clicks the button
    myButton.onclick = function() {
        myModal.style.display = "block";
    }
    // Allows the user to close the modal box, when user will click on (x) button
    exitBtn.onclick = function() {
        myModal.style.display = "none";
    }
    // Allows the user to close the modal box, even when the user clicks anywhere outside of the modal box
    window.onclick = function(event) {
        if (event.target == myModal) {
            myModal.style.display = "none";
        }
    }
</script>

</body>
</html>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Otoparkçım</title>
</head>
<body>


<section class="vh-100">
    <div style="margin-top: 150px" class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="./assets/img/car.png"
                     class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <h4>
                    Giriş
                </h4>

                    <div class="form-outline mb-4">
                        <input type="email" id="email" class="form-control form-control-lg"
                               placeholder="E-posta adresinizi giriniz" />
                        <label class="form-label" for="form3Example3">Email</label>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="password" id="password" class="form-control form-control-lg"
                               placeholder="Şifrenizi giriniz" />
                        <label class="form-label" for="form3Example4">Şifre</label>
                    </div>

                   <!-- <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check mb-0">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                            <label class="form-check-label" for="form2Example3">
                                Remember me
                            </label>
                        </div>
                        <a href="#!" class="text-body">Forgot password?</a>
                    </div>-->

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button id="logiBtn" type="button" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Giriş</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Hesabınız mı yok? <a href="{{route('register')}}" class="link-danger">Kayıt Olun</a></p>
                    </div>

            </div>
        </div>
    </div>
</section>








<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }


    // Set the options that I want

    $('#logiBtn').on('click', function (){


        let email = $('#email').val();
        let password = $('#password').val();

        if(email == '' || password == ''){
            toastr.error('Lütfen Tüm Alanları Doldurunuz', 'Hata')
            return false;
        }

        $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: '{{route('loginPost')}}',
            data: {
                "_token": "{{ csrf_token() }}",
                password: password,
                email: email
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
    })

</script>


</body>
</html>

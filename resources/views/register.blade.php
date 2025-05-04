<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Complaint Management System - UMKM</title>
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('storage/img/favicon.ico')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="{{asset('quixlab/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('quixlab/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
</head>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <div class="text-center" href="index.html">
                                    <!-- <img class="text-center" src="{{asset('storage/img/kai.png')}}" width="140" height="60" /> -->
                                    <h3>PENDAFTARAN</h3>
                                    <p>Mendaftar sebagai :</p>
                                </div>
                                @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="toastr-trigger" data-type="error" data-message="{{ $error }}" data-position-class="Email Sudah Terdaftar Sebelumnya!"></div>
                                @endforeach
                                @endif
                                @foreach ($role as $row)
                                <a href="{{url('/register/'.$row->route.'')}}"><button type="button" class="btn my-2 btn-outline-primary btn-lg" style="width: 100%;">{{ $row->nama }}</button></a>
                                @endforeach
                                <p class="mt-5 login-form__footer">Sudah punya akun? <a href="{{url('')}}" class="text-primary">Masuk </a> sekarang</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{asset('quixlab/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('quixlab/js/custom.min.js')}}"></script>
    <script src="{{asset('quixlab/js/settings.js')}}"></script>
    <script src="{{asset('quixlab/js/gleek.js')}}"></script>
    <script src="{{asset('quixlab/js/styleSwitcher.js')}}"></script>
    <script src="{{asset('quixlab/plugins/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('quixlab/plugins/toastr/js/toastr.init.js')}}"></script>
</body>

</html>
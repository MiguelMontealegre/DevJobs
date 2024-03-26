<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __(' DevJobs') }}</title>

<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
<link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">

<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<!-- CSS Files -->
<link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
</head>
    <!--_____________________________________________________________________________-->

    
<style>  
  /* Agregar imagen como fondo */
  body{
  background-image: url('/material/img/oficina.jpg');
  background-size: cover;
  background-position: top center;
  }
</style>


<body>
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">

<div class="my-5 card card-login card-hidden">
    <div class="card-header card-header-primary text-center">
      <h4 class="card-title"><strong> {{ __('Verify Your Email Address') }} </strong></h4>
      <div class="social-line">
        
        <span class="material-icons">
            perm_identity
          </span>

          <span class="material-icons">
            done_all
            </span>

      </div>
    </div>

    
      
    <div class="card-body text-center">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif
    
        <p class="card-description">    {{ __('Before proceeding, please check your email for a verification link.') }}  </p>
        <p class="mt-2"> <b> {{ __('If you did not receive the email') }} </b> </p>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf

                <br>
                <button type="submit" class="btn btn-outline-success"> {{ __('click here to request another')}} <span class="material-icons">
                    touch_app
                    </span>  </button>
            </form>

    </div>
    
</div>

</div>
</body>
   

</html>
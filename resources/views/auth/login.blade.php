<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>লগইন । জেলা প্রশাসন, ভোলা</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('custom/img/bhola-favicon.ico') }}"/>
    <link href="{{ asset('layouts/vertical-light-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('layouts/vertical-light-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('layouts/vertical-light-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/light/authentication/auth-cover.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('layouts/vertical-light-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/authentication/auth-cover.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/elements/alert.css') }}">
    <!--  END CUSTOM STYLE FILE  -->

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{ asset('custom/style.css') }}">
    
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>
                        
                    <div class="auth-cover">
    
                        <div class="position-relative">
    
                            <img src="{{ asset('custom/img/bhola logo.png') }}" alt="জেলা প্রশাসন লোগো">
    
                            <h2 class="mt-5 text-white fw-bold px-2">জেলা প্রশাসন, ভোলা</h2>
                            {{-- <p class="text-white px-2">It is easy to setup with great customer experience. Start your 7-day free trial</p> --}}
                        </div>
                        
                    </div>

                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    
                                    <h2>নথিপত্র</h2>
                                    <p>অনুগ্রহ করে আপনার ইমেইল ও পাসওয়ার্ড দিয়ে লগইন করুন</p>
                                    
                                    @if (Session::has('success'))
                                        <div class="alert alert-light-success alert-dismissible fade show">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00ab55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> 
                                            </button>
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif

                                    @if (Session::has('fail'))
                                        <div class="alert alert-light-danger alert-dismissible fade show">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#e7515a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> 
                                            </button>
                                            {{ Session::get('fail') }}
                                        </div>
                                    @endif

                                </div>

                                <form action="{{ url('login') }}" method="POST">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">ইমেইল</label>
                                            <input type="email" class="form-control" name="email" required>
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">পাসওয়ার্ড</label>
                                            <input type="password" class="form-control" name="password" required>
                                            <span class="text-danger">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                                <label class="form-check-label" for="form-check-default">
                                                    মনে রাখুন
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-primary w-100 py-4 fw-bold" style="font-size: 16px;">লগইন করুন</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>

    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>
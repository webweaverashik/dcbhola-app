@extends('layouts.layout')

@section('title', 'My Profile')

@section('page-level-custom-css')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" href="{{ asset('src/plugins/src/filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">
    {{-- <link href="../src/plugins/src/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <link rel="stylesheet" href="../src/plugins/src/sweetalerts2/sweetalerts2.css"> --}}
    
    <link href="{{ asset('src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="../src/assets/css/light/components/tabs.css" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/elements/alert.css') }}">
    
    {{-- <link href="../src/plugins/css/light/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="../src/plugins/css/light/notification/snackbar/custom-snackbar.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="../src/assets/css/light/forms/switches.css"> --}}
    {{-- <link href="../src/assets/css/light/components/list-group.css" rel="stylesheet" type="text/css"> --}}

    <link href="{{ asset('src/assets/css/light/users/account-setting.css') }}" rel="stylesheet" type="text/css" />



    <link href="{{ asset('src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css') }}" />
    {{-- <link href="../src/assets/css/dark/components/tabs.css" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/elements/alert.css') }}">
    
    {{-- <link href="../src/plugins/css/dark/sweetalerts2/custom-sweetalert.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="../src/plugins/css/dark/notification/snackbar/custom-snackbar.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="../src/assets/css/dark/forms/switches.css"> --}}
    {{-- <link href="../src/assets/css/dark/components/list-group.css" rel="stylesheet" type="text/css"> --}}

    <link href="{{ asset('src/assets/css/dark/users/account-setting.css" rel="stylesheet') }}" type="text/css" />


    <!--  END CUSTOM STYLE FILE  -->
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing layout-top-spacing">
        <form class="section general-info" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="info">
                <h6 class="">আপনার প্রোফাইল</h6>
                <div class="row">
                    <div class="col-lg-11 mx-auto">
                        <div class="row">
                            <div class="col-xl-2 col-lg-12 col-md-4">
                                <div class="profile-image  mt-4 pe-md-4">

                                    <!-- // The classic file input element we'll enhance
                                    // to a file pond, we moved the configuration
                                    // properties to JavaScript -->
                
                                    <div class="img-uploader-content">
                                        <input type="file" class="filepond"
                                            name="filepond" accept="image/png, image/jpeg, image/gif"/>
                                    </div>
                
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fullName">সম্পূর্ণ নাম</label>
                                                <input type="text" class="form-control mb-3" id="fullName" placeholder="যেমনঃ আরিফুজ্জামান" value="{{ $profile->name }}" name="name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="designation">পদবী</label>
                                                <input type="text" class="form-control mb-3" id="designation" placeholder="Designer" value="{{ $profile->designation }}" name="designation" name="designation" required>
                                            </div>
                                        </div>
                                                                               
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">ফোন</label>
                                                <input type="text" class="form-control mb-3" id="phone" placeholder="Write your phone number here" value="{{ $profile->phone }}" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">ইমেইল</label>
                                                <input type="text" class="form-control mb-3" id="email" placeholder="Write your email here" value="{{ $profile->email }}" name="email" readonly disabled>
                                            </div>
                                        </div>                                    


                                        <div class="col-md-12 mt-1">
                                            <div class="form-group text-start">
                                                <button class="btn btn-primary" type="submit">আপডেট করুন</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection





@section('scripts')
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="{{ asset('src/plugins/src/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
    {{-- <script src="../src/plugins/src/notification/snackbar/snackbar.min.js"></script> --}}
    {{-- <script src="../src/plugins/src/sweetalerts2/sweetalerts2.min.js"></script> --}}
    <script src="{{ asset('src/assets/js/users/account-settings.js') }}"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->

<script>
    document.getElementById("users_menu").className += " active";
    document.getElementById("users_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("users_ul").className += " show";
    document.getElementById("my_profile_id").className += " active";
</script>
@endsection
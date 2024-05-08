@extends('layouts.layout')

@section('title', 'My Profile')

@section('page-level-custom-css')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    {{-- <link rel="stylesheet" href="{{ asset('src/plugins/src/filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}"> --}}
    
    {{-- <link href="{{ asset('src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/light/elements/alert.css') }}">
    <link href="{{ asset('src/assets/css/light/users/account-setting.css') }}" rel="stylesheet" type="text/css" />



    {{-- <link href="{{ asset('src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css') }}" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('src/assets/css/dark/elements/alert.css') }}">
    
    <link href="{{ asset('src/assets/css/dark/users/account-setting.css" rel="stylesheet') }}" type="text/css" />


    <!--  END CUSTOM STYLE FILE  -->
@endsection


@section('content')
<div class="row layout-top-spacing">
    @if (Session::has('success'))
    <div class="col-md-12">
        <div class="alert alert-light-success alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00ab55" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> 
            </button>
            {{ Session::get('success') }}
        </div>
    </div>
    @endif


    @if (Session::has('message'))
    <div class="col-md-12">
        <div class="alert alert-light-danger alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#e7515a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            {{ Session::get('message') }}
        </div>
    </div>
    @endif


    <div class="col-xl-8 col-lg-10 col-md-12 layout-spacing">
        <form class="section general-info" action="{{ url('users/profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="info">
                <h6 class="">আপনার প্রোফাইল</h6>
                <div class="row">
                    <div class="col-lg-11 mx-auto">
                        <div class="row">
                            {{-- <div class="col-xl-4 col-lg-12 col-md-4 mx-auto mb-lg-4">
                                <div class="profile-image  mt-4 pe-md-4">

                                    <!-- // The classic file input element we'll enhance
                                    // to a file pond, we moved the configuration
                                    // properties to JavaScript -->
                                    <div class="img-uploader-content">
                                        <input type="file" class="filepond"
                                        name="photo_url" accept="image/png, image/jpeg, image/jpg, image/jpeg"/>
                                    </div>
                
                                </div>
                            </div> --}}


                            <div class="img-uploader-content mb-3">
                                <img src="http://127.0.0.1:8000/{{ Session::get('photo_url') }}" alt="{{ Session::get('name') }}" width="80" height="80" class="rounded-circle border">
                            </div>
                
                            <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="photo_url">প্রোফাইল ছবি (সর্বোচ্চ ১০০ KB)</label>
                                                <input type="file" class="form-control mb-3" accept="image/jpg, image/png, image/jpeg, image/webp" name="photo_url">
                                                @error('photo_url') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fullName">সম্পূর্ণ নাম</label><span class="text-danger">*</span>
                                                <input type="text" class="form-control mb-3" id="fullName" placeholder="যেমনঃ আরিফুজ্জামান" value="{{ $profile->name }}" name="name" required>
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="designation">পদবী</label><span class="text-danger">*</span>
                                                <input type="text" class="form-control mb-3" id="designation" placeholder="Designer" value="{{ $profile->designation }}" name="designation" name="designation" required>
                                                @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                                                               
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">ফোন</label><span class="text-danger">*</span>
                                                <input type="text" class="form-control mb-3" id="phone" placeholder="Write your phone number here" value="{{ $profile->phone }}" name="phone" required>
                                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">ইমেইল</label>
                                                <input type="text" class="form-control mb-3" id="email" placeholder="Write your email here" value="{{ $profile->email }}" name="email" readonly disabled>
                                            </div>
                                        </div> 


                                        <div class="col-md-12 mt-4">
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

    {{-- <div class="col-xl-6 col-lg-10 col-md-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>লগিন তথ্য</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
    
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">নাম</th>
                                <th scope="col">ইমেইল ও ফোন</th>
                                <th scope="col">একাউন্ট তৈরি</th>
                                <th scope="col">দায়িত্বপ্রাপ্ত শাখা</th>
                                <th class="text-center" scope="col">কার্যক্রম</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                        
                            @foreach ($officers as $officer)                                
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-2">
                                            <img alt="avatar" src="../src/assets/img/profile-7.jpeg" class="rounded-circle" />
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">{{ $officer->name }}</h6>
                                            <span>{{ $officer->designation }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $officer->email }}</p>
                                    <span>{{ $officer->phone }}</span>
                                </td>
                                <td class="text-center">
                                    <p class="mb-0">{{ $officer->created_at }}</p>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-success">শিক্ষা ও আইসিটি</span>
                                    <span class="badge badge-light-success">এডিএম</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody> --}}
                    {{-- </table>
                </div>
    
    
            </div>
        </div>
    </div> --}}
</div>
@endsection





@section('scripts')
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    {{-- <script src="{{ asset('src/plugins/src/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
    <script src="{{ asset('src/assets/js/users/account-settings.js') }}"></script> --}}
    <!--  END CUSTOM SCRIPTS FILE  -->

<script>
    document.getElementById("users_menu").className += " active";
    document.getElementById("users_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("users_ul").className += " show";
    document.getElementById("my_profile_id").className += " active";
</script>

{{-- <script>
    FilePond.create(
    document.querySelector('.filepond'),
    {
      imagePreviewHeight: 170,
      imageCropAspectRatio: '1:1',
      imageResizeTargetWidth: 200,
      imageResizeTargetHeight: 200,
      stylePanelLayout: 'compact circle',
      styleLoadIndicatorPosition: 'center bottom',
      styleProgressIndicatorPosition: 'right bottom',
      styleButtonRemoveItemPosition: 'left bottom',
      styleButtonProcessItemPosition: 'right bottom',
      files: [
          {
              // the server file reference
              source: '{{ $profile->photo_url }}',

              // set type to limbo to tell FilePond this is a temp file
              options: {
                  type: 'image/png',
              },
          },
      ],
    }
);
</script> --}}
@endsection
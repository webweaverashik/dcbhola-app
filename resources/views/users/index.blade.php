@section('page-level-custom-css')
<link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />

@endsection



@extends('layouts.layout')

@section('title', 'All Users')




@section('content')
@if ($errors->any())
    <div class="p-2">
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="row">
    <div class="col-lg-12 col-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-8 col-md-10 col-lg-8">
                        <h4>কর্মকর্তাদের প্রোফাইল</h4>
                    </div>
                @if (Session::get('role') == 1)
                    <div class="col-4 col-md-2 col-lg-4 mt-2 px-md-4 d-flex justify-content-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addOfficerModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            <span class="btn-text-inner">কর্মকর্তা</span>
                        </button>
                    </div>
                @endif   
                </div>
            </div>
            <div class="widget-content widget-content-area">
    
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="w-50">নাম ও পদবি</th>
                                <th scope="col">ইমেইল ও ফোন</th>
                                <th scope="col">একাউন্ট তৈরির সময়</th>
                                <th scope="col">দায়িত্বপ্রাপ্ত শাখা</th>
                                @if (Session::get('role') == 1) 
                                    <th class="text-center" scope="col">কার্যক্রম</th> 
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($officers as $officer)                                
                                <tr>
                                    <td class="text-wrap">
                                        <div class="media">
                                            <div class="avatar me-3">
                                                @if ($officer->photo_url != NULL)
                                                    <img alt="avatar" src="{{ url('/') . '/' . $officer->photo_url }}" class="rounded-circle" />
                                                @else
                                                    <img alt="avatar" src="{{ asset('custom/img/dummy-user.png') }}" class="rounded-circle" />
                                                @endif
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
                                    <td>
                                        <p class="mb-0">{{ $officer->created_at_bn }}</p>
                                    </td>
                                    <td class="text-wrap">
                                        @foreach ($sections as $section)
                                            @if ($section->officer_id == $officer->id)
                                                <span class="badge badge-light-success mb-1">{{ $section->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>

                                    @if (Session::get('role') == 1)
                                        <td class="text-center">
                                            <div class="action-btns">
                                                <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2 btnOfficerEditId" data-toggle="tooltip" data-placement="top" title="সংশোধন" data-bs-toggle="modal" data-bs-target="#editOfficerModal" data-id="{{ $officer->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                </a>
                                                <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2 btnPasswordReset" data-toggle="tooltip" data-placement="top" title="পাসওয়ার্ড রিসেট" data-bs-toggle="modal" data-bs-target="#btnPasswordModal" data-id="{{ $officer->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                                                </a>
                                                <a href="{{ url('users/' . $officer->id . '/delete') }}" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="মুছুন" onclick="deleteWarning(event)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </a>
                                            </div>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
    
            </div>
        </div>
    </div>


    <div class="col-lg-12 col-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-8 col-md-10 col-lg-8">
                        <h4>কর্মচারীদের প্রোফাইল</h4>
                    </div>
                @if (Session::get('role') == 1)
                    <div class="col-4 col-md-2 col-lg-4 mt-2 px-md-4 d-flex justify-content-end">
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            <span class="btn-text-inner">কর্মচারী</span>
                        </button>
                    </div>
                @endif
                </div>
            </div>
            <div class="widget-content widget-content-area">
    
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="w-50">নাম ও পদবি</th>
                                <th scope="col">ইমেইল ও ফোন</th>
                                <th scope="col">একাউন্ট তৈরির সময়</th>
                                <th scope="col">সংশ্লিষ্ট শাখা</th>
                                @if (Session::get('role') == 1)
                                    <th class="text-center" scope="col">কার্যক্রম</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffs as $staff)                                
                                <tr>
                                    <td class="text-wrap">
                                        <div class="media">
                                            <div class="avatar me-3">
                                                @if ($staff->photo_url != NULL)
                                                    <img alt="avatar" src="{{ url('/') . '/' . $staff->photo_url }}" class="rounded-circle" />
                                                @else
                                                    <img alt="avatar" src="{{ asset('custom/img/dummy-user.png') }}" class="rounded-circle" />
                                                @endif
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h6 class="mb-0">{{ $staff->name }}</h6>
                                                <span>{{ $staff->designation }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-wrap">
                                        <p class="mb-0">{{ $staff->email }}</p>
                                        <span>{{ $staff->phone }}</span>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $staff->created_at_bn }}</p>
                                    </td>
                                    <td>
                                        @foreach ($sections as $section)
                                            @if ($section->staff_id == $staff->id)
                                                <span class="badge badge-light-success">{{ $section->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>

                                    @if (Session::get('role') == 1)
                                        <td class="text-center">
                                            <div class="action-btns">
                                                <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2 btnStaffEditId" data-toggle="tooltip" data-placement="top" title="সংশোধন" data-bs-toggle="modal" data-bs-target="#editStaffModal" data-id="{{ $staff->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                </a>
                                                <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2 btnPasswordReset" data-toggle="tooltip" data-placement="top" title="পাসওয়ার্ড রিসেট" data-bs-toggle="modal" data-bs-target="#btnPasswordModal" data-id="{{ $staff->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                                                </a>
                                                <a href="{{ url('users/' . $staff->id . '/delete') }}" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="মুছুন" onclick="deleteWarning(event)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </a>
                                            </div>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
    
            </div>
        </div>
    </div>
</div>


@include('modals.users.officer-creation')
@include('modals.users.staff-creation')


@include('modals.users.officer-edit')
@include('modals.users.staff-edit')


@include('modals.users.password-reset')


@endsection





@section('scripts')

    <!-- BEGIN THEME GLOBAL STYLE -->
    <script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>  <!-- JQuery -->
    <!-- END THEME GLOBAL STYLE -->    

    <script>
        // Sidebar styles
        document.getElementById("pageBreadcrumb").innerHTML = '<li class="breadcrumb-item"><a href="{{ url('/users') }}">ইউজার</a></li>' + '<li class="breadcrumb-item active" aria-current="page">সকল ইউজার</li>';
        document.getElementById("users_menu").className += " active";
        document.getElementById("users_menu_dropdown").setAttribute("aria-expanded", true);
        document.getElementById("users_ul").className += " show";
        document.getElementById("all_users_id").className += " active";
    </script>


    <script>
        // Officer Edit Modal AJAX
        $(document).ready(function() {
            $('.btnOfficerEditId').click(function() {
                const id = $(this).attr("data-id");
                $.ajax({
                    url: '/users/ajax/' + id,
                    type: 'GET',
                    data: {
                        'id': id,
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#editOfficerFullName').val(data.name);
                        $('#editOfficerDesignation').val(data.designation);
                        $('#editOfficerPhone').val(data.phone);
                        $('#editOfficerEmail').val(data.email);
                        $('#editOfficerId').val(data.id);
                    }
                });            
            });
        });


        // Staff Edit Modal AJAX
        $(document).ready(function() {
            $('.btnStaffEditId').click(function() {
                const id = $(this).attr("data-id");
                $.ajax({
                    url: '/users/ajax/' + id,
                    type: 'GET',
                    data: {
                        'id': id,
                    },
                    success: function(data) {
                        // console.log(data);
                        $('#editStaffFullName').val(data.name);
                        $('#editStaffDesignation').val(data.designation);
                        $('#editStaffPhone').val(data.phone);
                        $('#editStaffEmail').val(data.email);
                        $('#editStaffId').val(data.id);

                        // if (data.role == 3) {
                        //     $('#section-staff-input').prop('checked', true);
                        // } else {
                        //     $('#frontdesk-staff-input').prop('checked', true);
                        // }
                    }
                });            
            });
        });


        // User Password Reset Modal
        $(document).ready(function() {
            $('.btnPasswordReset').click(function() {
                const id = $(this).attr("data-id");
                $.ajax({
                    url: '/users/ajax/' + id,
                    type: 'GET',
                    data: {
                        'id': id,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#resetUserId').val(data.id);
                        $('#resetUserName').html(data.name);
                        $('#resetUserDesignation').html(data.designation);
                    }
                });            
            });
        });
    </script>


    <script>
        function deleteWarning(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);

            Swal.fire({
                title: 'আপনি কি নিশ্চিত?',
                text: "ডিলিট করলে এই ইউজারকে আর ফিরে পাওয়া যাবে না!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'হ্যাঁ, ডিলিট করবো!',
                cancelButtonText: "ফিরে যান",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToRedirect;
                }
            })
        }
    </script>

    @if($message = session('success'))
        <script>
            Swal.fire(
            'সাকসেস!',
            '{{ $message }}',
            'success',
            )
        </script>
    @endif

@endsection
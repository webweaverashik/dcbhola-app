@section('page-level-custom-css')
<link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />

@endsection



@extends('layouts.layout')

@section('title', 'All Sections')




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
    <div class="col-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-8 col-md-10 col-lg-8">
                        <h4>জেলা প্রশাসকের কার্যালয়ের সকল শাখা</h4>
                    </div>
                @if (Session::get('role') == 1)
                    <div class="col-4 col-md-2 col-lg-4 mt-2 px-md-4 d-flex justify-content-end">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            <span class="btn-text-inner">শাখা</span>
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
                                <th scope="col" class="fw-bold">শাখার নাম</th>
                                <th scope="col" class="fw-bold">কর্মকর্তার নাম ও পদবী</th>
                                <th scope="col" class="fw-bold">কর্মচারির নাম ও পদবী</th>
                            @if (Session::get('role') == 1) 
                                <th class="text-center" scope="col">কার্যক্রম</th> 
                            @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)                                
                                <tr>
                                    <td>
                                        <span class="badge badge-light-success">{{ $section->section_name }}</span>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-bold">{{ $section->officer_name }}</p>
                                        <span>{{ $section->officer_designation }}</span>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-bold">{{ $section->staff_name }}</p>
                                        <span>{{ $section->staff_designation }}</span>
                                    </td>

                                    @if (Session::get('role') == 1)
                                        <td class="text-center">
                                            <div class="action-btns">
                                                <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2 btnStaffId" data-toggle="tooltip" data-placement="top" title="Edit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $section->section_id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                </a>
                                                {{-- <a href="{{ url('users/' . $staff->id . '/delete') }}" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteWarning(event)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </a> --}}
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


@include('modals.sections.section-creation')
@include('modals.sections.section-edit')

@endsection





@section('scripts')

<!-- BEGIN THEME GLOBAL STYLE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>

<script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>  <!-- JQuery -->
<!-- END THEME GLOBAL STYLE -->    

<script>
    document.getElementById("sections_menu").className += " active";
</script>


<script>
    // Section Modal AJAX
    $(document).ready(function() {
        $('btnSectionEdit').click(function() {
            const id = $(this).attr("data-id");
            $.ajax({
                url: '/sections/ajax/' + id,
                type: 'GET',
                data: {
                    'id': id,
                },
                success: function(data) {
                    console.log(data);
                    $('#sectionEditName').val(data.name);
                    // $('#editOfficerDesignation').val(data.designation);
                    // $('#editOfficerPhone').val(data.phone);
                }
            });            
        });
    });
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
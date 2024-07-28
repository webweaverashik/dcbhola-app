@section('page-level-custom-css')
<link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />

@endsection



@extends('layouts.layout')

@section('title', 'সকল শাখা')




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
                                <th scope="col" class="fw-bold">ক্রমিক</th>
                                <th scope="col" class="fw-bold">শাখার নাম</th>
                                <th scope="col" class="fw-bold w-50">কর্মকর্তার নাম ও পদবী</th>
                                <th scope="col" class="fw-bold w-50">কর্মচারির নাম ও পদবী</th>
                            @if (Session::get('role') == 1) 
                                <th class="fw-bold text-center" scope="col">কার্যক্রম</th> 
                            @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Define an array mapping English digits to Bengali digits
                                $engToBng = ['0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯'];
                            @endphp

                            @foreach ($sections as $section)                                
                                <tr>
                                    <td class="text-center fw-bold">
                                        {{ strtr($loop->iteration, $engToBng) }}
                                        {{-- {{ strtr((string)(int)$loop->iteration, $engToBng) }} --}}
                                    </td>
                                    <td>
                                        <span class="badge badge-light-info">{{ $section->section_name }}</span>
                                    </td>
                                    <td class="text-wrap">
                                        <p class="mb-0 fw-bold">{{ $section->officer_name }}</p>
                                        <span>{{ $section->officer_designation }}</span>
                                    </td>
                                    <td class="text-wrap">
                                        <p class="mb-0 fw-bold">{{ $section->staff_name }}</p>
                                        <span>{{ $section->staff_designation }}</span>
                                    </td>

                                    @if (Session::get('role') == 1)
                                        <td class="text-center">
                                            <div class="action-btns">
                                                <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2 btnEditSection" data-toggle="tooltip" data-placement="top" title="সংশোধন" data-bs-toggle="modal" data-bs-target="#editSectionModal" data-id="{{ $section->section_id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
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


@include('modals.sections.section-creation')
@include('modals.sections.section-edit')

@endsection





@section('scripts')

<!-- BEGIN THEME GLOBAL STYLE -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script> --}}

<script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>  <!-- JQuery -->
<!-- END THEME GLOBAL STYLE -->    

<script>
    document.getElementById("pageBreadcrumb").innerHTML = '<li class="breadcrumb-item active" aria-current="page">সকল শাখা</li>';
    document.getElementById("sections_menu").className += " active";
</script>


<script>
    // ---- Edit Section Modal AJAX -----
    $(document).ready(function() {
        $('.btnEditSection').click(function() {
            const id = $(this).attr("data-id");
            $.ajax({
                url: '/sections/ajax/' + id,
                type: 'GET',
                data: {
                    'id': id,
                },
                success: function(data) {
                    console.log(data);
                    $('#sectionHiddenId').val(data.id);
                    $('#sectionEditName').val(data.name);

                    // Setting ADC name selected
                    $('#editADCId option').each(function() {
                        if ($(this).val() == data.adc_id) {
                            $(this).prop('selected', true);
                        } else if (data.adc_id == null) {
                            $('#adc_blank').prop('selected', true);
                        }
                    });

                    // Setting officer name selected
                    $('#editOfficerId option').each(function() {
                        if ($(this).val() == data.officer_id) {
                            $(this).prop('selected', true);
                        } else if (data.officer_id == null) {
                            $('#officer_blank').prop('selected', true);
                        }
                    });

                    // Setting Staff name selected
                    $('#editStaffId option').each(function() {
                        if ($(this).val() == data.staff_id) {
                            $(this).prop('selected', true);
                        } else if (data.staff_id == null){
                            $('#staff_blank').prop('selected', true);
                        }
                    });
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
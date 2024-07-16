@section('page-level-custom-css')
    <link href="{{ asset('src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/light/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/dark/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css" />

@endsection


@extends('layouts.layout')


@section('title', 'Dashboard')

@section('content')

@php
    // Define an array mapping English digits to Bengali digits
    $engToBng = ['0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯'];
@endphp

<div class="row layout-top-spacing">
    {{-- Alert Section Starts --}}
    <div class="col-md-12">
        {{-- @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
                {{ Session::get('success') }}
            </div>
        @endif --}}

        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ Session::get('message') }}
            </div>
        @endif
    </div>
    {{-- Alert Section Ends --}}

    <div id="tabsSimple2" class="col-xl-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area border-0 p-0">
                <div class="simple-tab">
                    
                    <ul class="nav nav-tabs mb-1" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab-icon" data-bs-toggle="tab" data-bs-target="#home-tab-icon-pane2" type="button" role="tab" aria-controls="home-tab-icon-pane2" aria-selected="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sunrise"><path d="M17 18a5 5 0 0 0-10 0"></path><line x1="12" y1="2" x2="12" y2="9"></line><line x1="4.22" y1="10.22" x2="5.64" y2="11.64"></line><line x1="1" y1="18" x2="3" y2="18"></line><line x1="21" y1="18" x2="23" y2="18"></line><line x1="18.36" y1="11.64" x2="19.78" y2="10.22"></line><line x1="23" y1="22" x2="1" y2="22"></line><polyline points="8 6 12 2 16 6"></polyline></svg> ডাক/পত্র
                            </button>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab-icon" data-bs-toggle="tab" data-bs-target="#profile-tab-icon-pane2" type="button" role="tab" aria-controls="profile-tab-icon-pane2" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg> প্রক্রিয়াধীন পত্র
                            </button>
                        </li> --}}
                    </ul>
                    
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="home-tab-icon-pane2" role="tabpanel" aria-labelledby="home-tab-icon" tabindex="0">
                            <div class="widget {{-- widget-table-two --}} border-0">

                                <div class="widget-heading">
                                    <h5 class="">সকল পত্রের অবস্থা</h5>
                                </div>
                    
                                <div class="widget-content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2"><div class="th-content">শাখার নাম</div></th>
                                                    <th rowspan="2"><div class="th-content text-center">সর্বমোট</div></th>
                                                    <th colspan="4"><div class="th-content text-center"><span class="badge badge-warning">চলমান</span></div></th>
                                                    <th rowspan="2"><div class="th-content text-center"><span class="badge badge-success">সম্পন্ন</span></div></th>
                                                </tr>
                                                <tr>
                                                    <th class="rounded-0"><div class="th-content text-center"><span class="badge badge-secondary">৭ দিন যাবৎ</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-warning">৭-১৫ দিন যাবৎ</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-danger">১৫-৩০ দিন যাবৎ</span></div></th>
                                                    <th class="rounded-0"><div class="th-content text-center"><span class="badge badge-danger">৩০ দিনের বেশি</span></div></th>
                                                </tr>

                                                {{-- <tr>
                                                    <th><div class="th-content">শাখার নাম</div></th>
                                                    <th><div class="th-content text-center">সর্বমোট</div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-secondary">৭ দিন যাবৎ</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-warning">৭-১৫ দিন যাবৎ</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-danger">১৫-৩০ দিন যাবৎ</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-danger">৩০ দিনের বেশি</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-warning">চলমান</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-success">সম্পন্ন</span></div></th>
                                                </tr> --}}
                                            </thead>
                                            <tbody>
                                                @foreach ($results as $result)
                                                <tr>
                                                    <td rowspan="2" class="text-left"><span class="badge badge-light-info">{{ $result->section_name }}</span></td>
                                                    <td rowspan="2" class="text-center">{{ strtr($result->total_count, $engToBng) }}</td>
                                                    <td colspan="4" class="text-center">{{ strtr($result->total_status_1, $engToBng) }}</td>
                                                    <td rowspan="2" class="text-center">{{ strtr($result->total_status_2, $engToBng) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center rounded-0">{{ strtr($result->up_to_7_days, $engToBng) }}</td>
                                                    <td class="text-center">{{ strtr($result->up_to_15_days, $engToBng) }}</td>
                                                    <td class="text-center">{{ strtr($result->up_to_30_days, $engToBng) }}</td>
                                                    <td class="text-center rounded-0">{{ strtr($result->days_30_plus, $engToBng) }}</td>
                                                </tr>
                                                <tr></tr>
                                                @endforeach

                                                <tr>
                                                    <td class="text-center">মোট</td>
                                                    <td class="text-center">sum of total_count of all row</td>
                                                    <td colspan="4" class="text-center">sum of total_status_1 of all row</td>
                                                    <td class="text-center">sum of total_status_2 of all row</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="profile-tab-icon-pane2" role="tabpanel" aria-labelledby="profile-tab-icon" tabindex="0">
                            <div class="widget widget-table-two border-0">

                                <div class="widget-heading">
                                    <h5 class="">প্রক্রিয়াধীন পত্রের দিনভিত্তিক অবস্থা</h5>
                                </div>
                    
                                <div class="widget-content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><div class="th-content">শাখার নাম</div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-secondary">৩ দিন</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-warning">৭ দিন</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-danger">১৫ দিন</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-danger">১৫ দিনের বেশি</span></div></th>
                                                    <th><div class="th-content text-center">মোট</div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($processing_letters_duration as $result)
                                                <tr>
                                                    <td class="text-left"><span class="badge badge-light-info">{{ $result->section_name }}</td>
                                                    <td class="text-center">{{ strtr($result->up_to_3_days, $engToBng) }}</td>
                                                    <td class="text-center">{{ strtr($result->up_to_7_days, $engToBng) }}</td>
                                                    <td class="text-center">{{ strtr($result->up_to_15_days, $engToBng) }}</td>
                                                    <td class="text-center">{{ strtr($result->more_than_15_days, $engToBng) }}</td>
                                                    <td class="text-center">{{ strtr($result->total, $engToBng) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('src/plugins/src/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('src/assets/js/dashboard/dash_1.js') }}"></script>
<script src="{{ asset('src/assets/js/dashboard/dash_2.js') }}"></script>

<script src="{{ asset('custom/dashboard.js') }}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<script>
    document.getElementById("pageBreadcrumb").innerHTML = '<li class="breadcrumb-item active">ড্যাশবোর্ড</li>';
    document.getElementById("dashboard_menu").className += " active";
    // document.getElementById("letters_all_id").className += " active";
    // document.getElementById("letters_menu_dropdown").setAttribute("aria-expanded", true);
    // document.getElementById("letters_ul").className += " show";
</script>
@endsection
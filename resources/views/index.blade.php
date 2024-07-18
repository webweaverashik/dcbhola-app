@section('page-level-custom-css')
    <link href="{{ asset('src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('src/assets/css/light/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('src/assets/css/dark/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('src/assets/css/dark/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css" />

@endsection


@extends('layouts.layout')


@section('title', 'ড্যাশবোর্ড')

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
                                                    <th rowspan="2"><div class="th-content text-center">শাখা ভিত্তিক মোট</div></th>
                                                    <th colspan="4"><div class="th-content text-center"><span class="badge badge-warning">চলমান</span></div></th>
                                                    <th rowspan="2"><div class="th-content text-center"><span class="badge badge-success">সম্পন্ন</span></div></th>
                                                </tr>
                                                <tr>
                                                    <th class="rounded-0"><div class="th-content text-center"><span class="badge badge-light-secondary">৭ দিন যাবৎ</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-light-warning">১৫ দিন যাবৎ</span></div></th>
                                                    <th><div class="th-content text-center"><span class="badge badge-light-danger">৩০ দিন যাবৎ</span></div></th>
                                                    <th class="rounded-0"><div class="th-content text-center"><span class="badge badge-light-danger">৩০ দিনের বেশি</span></div></th>
                                                </tr>
                                            </thead>
                                            <tbody id="results-body">
                                                @foreach ($results as $result)
                                                <tr>
                                                    <td rowspan="2" class="text-left"><span class="badge badge-light-info">{{ $result->section_name }}</span></td>
                                                    <td rowspan="2" class="text-center total-count"><a href="/letters/show?section={{ $result->section_id }}&days=all_days&status=0" target="_blank">{{ strtr($result->total_count, $engToBng) }}</a></td>
                                                    <td colspan="4" class="text-center total-status-1"><a href="/letters/show?section={{ $result->section_id }}&days=all_days&status=1" target="_blank">{{ strtr($result->total_status_1, $engToBng) }}</a></td>
                                                    <td rowspan="2" class="text-center total-status-2"><a href="/letters/show?section={{ $result->section_id }}&days=all_days&status=2" target="_blank">{{ strtr($result->total_status_2, $engToBng) }}</a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center rounded-0"><a href="/letters/show?section={{ $result->section_id }}&days=up_to_7_days&status=1" target="_blank">{{ strtr($result->up_to_7_days, $engToBng) }}</a></td>
                                                    <td class="text-center"><a href="/letters/show?section={{ $result->section_id }}&days=up_to_15_days&status=1" target="_blank">{{ strtr($result->up_to_15_days, $engToBng) }}</a></td>
                                                    <td class="text-center"><a href="/letters/show?section={{ $result->section_id }}&days=up_to_30_days&status=1" target="_blank">{{ strtr($result->up_to_30_days, $engToBng) }}</a></td>
                                                    <td class="text-center rounded-0"><a href="/letters/show?section={{ $result->section_id }}&days=days_30_plus&status=1" target="_blank">{{ strtr($result->days_30_plus, $engToBng) }}</a></td>
                                                </tr>
                                                <tr></tr>
                                                @endforeach
                                                <tr>
                                                    <td class="text-center">সর্বমোট</td>
                                                    <td class="text-center"><a href="/letters/show?section=0&days=all_days&status=0" target="_blank" id="sum-total-count">0</a></td>
                                                    <td colspan="4" class="text-center"><a href="/letters/show?section=0&days=all_days&status=1" target="_blank" id="sum-total-status-1">0</a></td>
                                                    <td class="text-center"><a href="/letters/show?section=0&days=all_days&status=2" target="_blank" id="sum-total-status-2">0</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
{{-- <script src="{{ asset('src/plugins/src/apex/apexcharts.min.js') }}"></script> --}}
{{-- <script src="{{ asset('src/assets/js/dashboard/dash_1.js') }}"></script> --}}
{{-- <script src="{{ asset('src/assets/js/dashboard/dash_2.js') }}"></script> --}}

{{-- <script src="{{ asset('custom/dashboard.js') }}"></script> --}}
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<script>
    document.getElementById("pageBreadcrumb").innerHTML = '<li class="breadcrumb-item active">ড্যাশবোর্ড</li>';
    document.getElementById("dashboard_menu").className += " active";
    // document.getElementById("letters_all_id").className += " active";
    // document.getElementById("letters_menu_dropdown").setAttribute("aria-expanded", true);
    // document.getElementById("letters_ul").className += " show";
</script>

<script>
    // To update the sums of total_count, total_status_1, and total_status_2 dynamically using JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Function to convert Bengali numerals to English numerals
        function toEnglishNumerals(bengaliNumeral) {
            return bengaliNumeral.replace(/[০-৯]/g, d => '০১২৩৪৫৬৭৮৯'.indexOf(d));
        }

        // Function to convert English numerals to Bengali numerals
        function toBengaliNumerals(englishNumeral) {
            return englishNumeral.toString().replace(/\d/g, d => '০১২৩৪৫৬৭৮৯'[d]);
        }

        // Function to sum values in a column with a given class name
        function sumColumn(className) {
            let sum = 0;
            document.querySelectorAll(className).forEach(cell => {
                const num = parseInt(toEnglishNumerals(cell.textContent));
                if (!isNaN(num)) {
                    sum += num;
                }
            });
            return sum;
        }

        // Function to update the sums and display them in Bengali numerals
        function updateSums() {
            const sumTotalCount = sumColumn('.total-count');
            const sumTotalStatus1 = sumColumn('.total-status-1');
            const sumTotalStatus2 = sumColumn('.total-status-2');

            document.getElementById('sum-total-count').textContent = toBengaliNumerals(sumTotalCount);
            document.getElementById('sum-total-status-1').textContent = toBengaliNumerals(sumTotalStatus1);
            document.getElementById('sum-total-status-2').textContent = toBengaliNumerals(sumTotalStatus2);
        }

        updateSums();
    });


    // Refresh the page every 30 seconds (30000 milliseconds)
    setInterval(function(){
        window.location.reload();
    }, 60000); // 30000 milliseconds = 30 seconds


</script>


@endsection
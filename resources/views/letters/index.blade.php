@extends('layouts.layout')

@section('title', 'All Letters')


@section('page-level-custom-css')
<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link href="{{ asset('src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_custom.css') }}"> --}}
<link href="{{ asset('src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/custom_dt_custom.css') }}"> --}}
<link href="{{ asset('src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL CUSTOM STYLES -->
@endsection


@section('content')

<div class="row layout-top-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row justify-content-between">
                    <div class="col-md-auto col-12">
                        <h4>সকল ডাক/চিঠি</h4>
                    </div>

                    <div class="col-md-auto col-12 my-2">
                        <div class="row g-2 d-flex justify-content-end align-items-center">
                            <!-- Status Filter -->
                            <div class="col-12 col-md-auto d-flex flex-wrap align-items-center">
                                <div class="form-check form-switch form-check-inline form-switch-warning">
                                    <input class="form-check-input" type="checkbox" role="switch" id="status-1" checked>
                                    <label class="form-check-label" for="status-1">চলমান</label>
                                </div>
                                <div class="form-check form-switch form-check-inline form-switch-success">
                                    <input class="form-check-input" type="checkbox" role="switch" id="status-2" checked>
                                    <label class="form-check-label" for="status-2">সম্পন্ন</label>
                                </div>
                            </div>

                            <!-- Section Name Filter -->
                            <div class="col-12 col-md-auto">
                                <select id="section_name" class="form-control">
                                    <option value="">সকল শাখা</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date Range Filter -->
                            <div class="col-12 col-md-auto">
                                <label for="start_date" class="form-label fw-bold">পত্র প্রাপ্তির তারিখঃ</label>
                            </div>
                            <div class="col-12 col-md-auto">
                                <select id="date_range" class="form-control">
                                    <option value="last_15_days">গত ১৫ দিন</option>
                                    <option value="this_month">চলতি মাস</option>
                                    <option value="custom">কাস্টম রেঞ্জ</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-auto">
                                <input type="date" id="start_date" class="form-control d-none" placeholder="শুরু তারিখ">
                            </div>
                            <div class="col-12 col-md-auto">
                                <input type="date" id="end_date" class="form-control d-none" placeholder="শেষ তারিখ">
                            </div>

                            <!-- Uploaded By Filter -->
                            <div class="col-12 col-md-auto @if(session('role') == 4) d-none @endif">
                                <select id="uploaded_by" class="form-control">
                                    <option value="">চিঠি আপলোডকারি</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}, {{ $user->designation }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Clear Filters Button -->
                            <div class="col-12 col-md-auto">
                                <button id="clear_filters" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                    <span class="btn-text-inner">রিসেট</span>
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            

            <div class="widget-content widget-content-area table-responsive">
                <table id="style-3" class="table style-3 dt-table-hover text-center table-hover">
                    <thead>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th class="d-none">পত্র প্রাপ্তির তারিখ (en)</th>
                            <th>পত্র প্রাপ্তির তারিখ</th>
                            <th>কোথা হতে প্রাপ্ত</th>
                            <th>সংক্ষিপ্ত বিষয়</th>
                            <th class="d-none">সংশ্লিষ্ট শাখা (en)</th>
                            <th>সংশ্লিষ্ট শাখা</th>
                            <th>অবস্থা</th>
                            <th class="d-none">আপলোডকারি</th>
                            <th class="dt-no-sorting">কার্যক্রম</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Define an array mapping English digits to Bengali digits
                            $engToBng = ['0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪', '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯'];
                        @endphp
                        
                        @foreach ($letters as $letter)
                        <tr>
                            <!-- Use the iteration number and convert it to Bengali -->
                            <td>
                                {{ strtr($loop->iteration, $engToBng) }}

                                @if ($letter->type == 1)
                                    <svg title="দাপ্তরিক ডাক" id="Front-Desk-Table-Meeting--Streamline-Atlas" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 24 24" height="24" width="24"><desc>Front Desk Table Meeting Streamline Icon: https://streamlinehq.com</desc><defs></defs><path d="m5.729166666666666 21.56 0 -7.030833333333333 -0.8799999999999999 -1.7508333333333332 0 -6.150833333333333 5.270833333333333 0 0 6.150833333333333 -0.8799999999999999 1.7508333333333332 0 7.030833333333333" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"></path><path d="M12.76 10.138333333333334v-0.9166666666666666a2.6308333333333334 2.6308333333333334 0 0 1 2.6308333333333334 -2.6308333333333334 2.6399999999999997 2.6399999999999997 0 0 1 2.6399999999999997 2.6308333333333334v0.9166666666666666" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"></path><path d="M13.630833333333332 3.1166666666666663a1.7599999999999998 1.7599999999999998 0 1 0 3.5199999999999996 0 1.7599999999999998 1.7599999999999998 0 1 0 -3.5199999999999996 0" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"></path><path d="M5.729166666666666 3.1166666666666663a1.7599999999999998 1.7599999999999998 0 1 0 3.5199999999999996 0 1.7599999999999998 1.7599999999999998 0 1 0 -3.5199999999999996 0" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"></path><path d="m19.781666666666663 21.56 0 -10.541666666666666 -9.661666666666665 0" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"></path><path d="m4.849166666666666 11.018333333333333 -2.6308333333333334 0 0 10.541666666666666" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"></path><path d="m21.541666666666664 11.018333333333333 -1.7599999999999998 0 -9.661666666666665 0" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"></path><path d="m4.849166666666666 11.018333333333333 -2.6308333333333334 0 -1.7599999999999998 0" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="1"></path></svg>
                                @elseif ($letter->type == 2)
                                    <svg title="নাগরিক ডাক" id="Heart-Mail--Streamline-Atlas" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 24 24" height="24" width="24"><desc>Heart Mail Streamline Icon: https://streamlinehq.com</desc><defs></defs><path d="M12.594999999999999 6.6275A2.0166666666666666 2.0166666666666666 0 0 0 11 7.333333333333333a2.0166666666666666 2.0166666666666666 0 0 0 -1.595 -0.7058333333333333A1.7691666666666666 1.7691666666666666 0 0 0 7.498333333333333 8.25c0 2.355833333333333 3.5016666666666665 3.6666666666666665 3.5016666666666665 3.6666666666666665s3.5016666666666665 -1.3108333333333333 3.5016666666666665 -3.6666666666666665a1.7691666666666666 1.7691666666666666 0 0 0 -1.9066666666666667 -1.6225Z" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="2"></path><path d="m18.874166666666667 9.249166666666666 0 11.375833333333333 -15.748333333333333 0 0 -11.375833333333333" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="2"></path><path d="M18.874166666666667 8.378333333333334v0.8708333333333332l-6.416666666666666 6.416666666666666a2.1266666666666665 2.1266666666666665 0 0 1 -1.4941666666666664 0.6233333333333334 2.1266666666666665 2.1266666666666665 0 0 1 -1.4941666666666664 -0.6233333333333334l-6.416666666666666 -6.416666666666666v-0.8708333333333332l6.416666666666666 -6.416666666666666a2.0991666666666666 2.0991666666666666 0 0 1 2.988333333333333 0Z" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="2"></path><path d="m18.874166666666667 20.625 -5.683333333333334 -5.683333333333334" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="2"></path><path d="m8.809166666666666 14.941666666666666 -5.683333333333334 5.683333333333334" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="1"></path></svg>
                                @endif
                            </td>
                            <td class="d-none">{{ $letter->received_date }}</td>
                            <td>{{ $letter->received_date_bn }}</td>
                            <td class="text-wrap">{{ $letter->sender_name }}</td>
                            <td class="text-wrap">{{ $letter->short_title }}</td>
                            <td class="d-none"><span class="badge badge-light-info">{{ $letter->section_to }}</span></td>
                            <td><span class="badge badge-light-info">{{ $letter->section_name }}</span></td>
                            <td>
                                @if ($letter->status == 1)
                                    <span class="shadow-none badge badge-warning">চলমান</span>
                                @elseif ($letter->status == 2)
                                    <span class="shadow-none badge badge-success">সম্পন্ন</span>
                                @endif
                            </td>
                            <td class="text-wrap d-none">{{ $letter->uploaded_by }}</td>
                            <td>
                                <div class="action-btns">
                                    
                                    <a href="{{ $letter->file_url }}" target="_blank" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="ডাউনলোড">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                    </a>  {{-- File Download Button --}}

                                    <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2 btnViewLetter" data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#viewLetterModal" data-id="{{ $letter->id }}" title="দেখুন">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </a> {{-- View Button --}}
                                                               
                                @if ($letter->status == 1 && session('role') == 3)
                                    <a href="{{ url('letters/' . $letter->id . '/edit') }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="সংশোধন">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    </a> {{-- Edit Button --}}

                                    <a href="{{ url('letters/' . $letter->id . '/delete') }}" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" onclick="deleteWarning(event)" title="মুছুন">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a> {{-- Delete Button --}}
                                @endif

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@include('modals.letters.letter-view')

@endsection





@section('scripts')
<script>
    document.getElementById("pageBreadcrumb").innerHTML = '<li class="breadcrumb-item"><a href="{{ url('/letters') }}">চিঠি\/ডাক</a></li>' + '<li class="breadcrumb-item active" aria-current="page">সকল চিঠি/ডাক</li>';
    document.getElementById("letters_menu").className += " active";
    document.getElementById("letters_all_id").className += " active";
    document.getElementById("letters_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("letters_ul").className += " show";
</script>

{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
<script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>  <!-- JQuery -->
<script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>

<script>

    // ------- Letter Filter Buttons JS Codes Starts -------
    $(document).ready(function() {
        function getLast15Days() {
            var today = new Date();
            var last15DaysStart = new Date();
            last15DaysStart.setDate(today.getDate() - 14); // Subtract 14 to include today
            return { start: last15DaysStart, end: today };
        }

        function getThisMonth() {
            var start = new Date();
            start.setDate(1); // Set to the first day of the month
            var end = new Date();
            end.setMonth(end.getMonth() + 1);
            end.setDate(0); // Set to the last day of the month
            return { start: start, end: end };
        }

        function setCustomRangeToThisMonth() {
            var thisMonth = getThisMonth();
            $('#start_date').val(thisMonth.start.toISOString().split('T')[0]);
            $('#end_date').val(thisMonth.end.toISOString().split('T')[0]);
        }

        setCustomRangeToThisMonth();

        var table = $('#style-3').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "পৃষ্ঠা নং _PAGE_ এর _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "সার্চ করুন...",
                "sLengthMenu": "ফলাফল :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [10, 20, 50, 100],
            "pageLength": 10,
        });

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var status = data[7];
                var status1 = $('#status-1').is(':checked');
                var status2 = $('#status-2').is(':checked');

                if ((status1 && status === 'চলমান') || 
                    (status2 && status === 'সম্পন্ন')) {
                    return true;
                }
                return false;
            }
        );

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var section_name = $('#section_name').val();
                var section_name_data = data[5]; // Adjust according to the actual data index

                if (section_name === "" || section_name_data === section_name) {
                    return true;
                }
                return false;
            }
        );

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var dateRange = $('#date_range').val();
                var minDate, maxDate;

                if (dateRange === 'last_15_days') {
                    var last15Days = getLast15Days();
                    minDate = last15Days.start;
                    maxDate = last15Days.end;
                } else if (dateRange === 'this_month') {
                    var thisMonth = getThisMonth();
                    minDate = thisMonth.start;
                    maxDate = thisMonth.end;
                } else if (dateRange === 'custom') {
                    minDate = new Date($('#start_date').val());
                    maxDate = new Date($('#end_date').val());
                }

                var date = new Date(data[1]);
                if (
                    (dateRange === 'last_15_days' || dateRange === 'this_month') &&
                    date >= minDate && date <= maxDate
                ) {
                    return true;
                } else if (
                    dateRange === 'custom' &&
                    (!isNaN(minDate.getTime()) && date >= minDate) &&
                    (!isNaN(maxDate.getTime()) && date <= maxDate)
                ) {
                    return true;
                }
                return false;
            }
        );

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var uploaded_by = $('#uploaded_by').val();
                var uploaded_by_data = data[8]; // Adjust according to the actual data index

                if (uploaded_by === "" || uploaded_by_data === uploaded_by) {
                    return true;
                }
                return false;
            }
        );

        $('#date_range').on('change', function() {
            if ($(this).val() === 'custom') {
                $('#start_date, #end_date').removeClass('d-none');
            } else {
                $('#start_date, #end_date').addClass('d-none');
                if ($(this).val() === 'this_month') {
                    setCustomRangeToThisMonth();
                }
            }
            table.draw();
        });

        $('#status-1, #status-2, #start_date, #end_date, #uploaded_by, #section_name').on('change', function() {
            table.draw();
        });

        $('#clear_filters').on('click', function() {
            $('#status-1, #status-2').prop('checked', true);
            $('#section_name').val('');
            $('#date_range').val('last_15_days');
            setCustomRangeToThisMonth();
            $('#start_date, #end_date').addClass('d-none');
            $('#uploaded_by').val('');
            table.draw();
        });

        // Trigger initial draw
        table.draw();
    });

    // ------- Letter Filter Buttons JS Codes Ends -------



    // ------- Letter View Modal Data Showing Starts -------
    $('.btnViewLetter').click(function() {
        const letterId = $(this).attr("data-id");


        // Define an array mapping English digits to Bengali digits
        var engToBng = {'0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪', '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯'};

        // Function to convert English number to Bengali
        function convertToBengali(number) {
            var bengaliNumber = '';
            var numberString = number.toString();
            for (var i = 0; i < numberString.length; i++) {
                var digit = numberString[i];
                bengaliNumber += engToBng[digit];
            }
            return bengaliNumber;
        }

        $.ajax({
            url: '/letters/ajax/' + letterId,
            method: 'GET',
            success: function(response) {
                // Handle the letter details
                var letter = response.letter;
                // var typeText = letter.type === 1 ? "দাপ্তরিক ডাক" : "নাগরিক ডাক";
                var typeText = letter.type === 1 ? '<span class="badge outline-badge-primary">দাপ্তরিক ডাক</span>' : "<span class='badge outline-badge-secondary'>নাগরিক ডাক</span>";
                var serialNoDisplay = letter.type === 1 ? "none" : "";
                var memorandumNoDisplay = letter.type === 2 ? "none" : "";

                var letterHtml = `
                    <table class="table table-bordered">
                        <tr>
                            <td><span class="fw-bold">আপলোডের সময়ঃ </span>${letter.created_at_bn}</td>
                            <td><span class="fw-bold">পত্রের ধরণঃ </span>${typeText}</td>
                        </tr>
                        <tr>
                            <td class="w-50" style="display: ${memorandumNoDisplay};"><span class="fw-bold">স্মারক নংঃ </span>${letter.memorandum_no}</td>
                            <td class="w-50" style="display: ${serialNoDisplay};"><span class="fw-bold">ক্রমিক নংঃ </span>${letter.serial_no}</td>
                            <td class="w-50"><span class="fw-bold">পত্র প্রাপ্তির তারিখঃ </span>${letter.received_date_bn}</td>
                        </tr>
                        <tr>
                            <td class="w-50 text-wrap"><span class="fw-bold">কোথা হতে প্রাপ্তঃ </span>${letter.sender_name}</td>
                            <td class="w-50"><span class="fw-bold">প্রেরণের তারিখঃ </span>${letter.sent_date_bn}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><span class="fw-bold text-wrap">আপলোডকারিঃ </span>${letter.uploader_name}, ${letter.uploader_designation}</td>
                        </tr>
                    </table>
                `;
                $('#letter-details').html(letterHtml);
                $('#viewShortTitle').html(`${letter.short_title}`);
                $('#viewSectionName').html(`${letter.section_name}`);

                if (`${letter.status}` == 1) {
                    $('#statusProcessing').removeClass('d-none');
                    $('#statusCompleted').addClass('d-none');
                    $('#comments').removeClass('d-none');
                }
                else if (`${letter.status}` == 2) {
                    $('#statusProcessing').addClass('d-none');
                    $('#statusCompleted').removeClass('d-none');
                    $('#comments').removeClass('d-none');
                }

                // Handle the comments
                var comments = response.comments;
                if (comments.length === 0) {
                    $('#comments').addClass('d-none');
                } else {
                    $('#comments').removeClass('d-none');
                    var commentsHtml = `
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td colspan="4" class="text-center border-0"><h6 class="fw-bold">মন্তব্য সমূহঃ</h6></td>
                                </tr>
                                <tr>
                                    <th scope="col">ক্রমিক</th>
                                    <th scope="col">সময়</th>
                                    <th scope="col">মন্তব্য</th>
                                    <th scope="col">কর্মকর্তা</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                    comments.forEach(function(comment, index) {
                        var serialNo = index + 1;
                        var serialNoBn = convertToBengali(serialNo); // Convert serial number to Bengali
                        var badgeHtml = (index === 0) ? '<span class="badge bg-light-primary">সর্বশেষ</span>' : '';
                        commentsHtml += `
                            <tr>
                                <td>${serialNoBn}</td>
                                <td>${comment.created_at_bn}</td>
                                <td>${comment.comment} ${badgeHtml}</td>
                                <td>${comment.comment_by_name}, ${comment.commenter_designation}</td>
                            </tr>
                        `;
                    });

                    commentsHtml += `
                            </tbody>
                        </table>
                    `;
                    $('#comments').html(commentsHtml);
                }
            },
            error: function(xhr, status, error) {
                console.error('An error occurred:', status, error);
            }
        });

    });
    // ------- Letter View Modal Data Showing Ends -------
    
</script>






<script>
    function deleteWarning(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);

        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            text: "ডিলিট করলে এই চিঠি/ডাক আর ফিরে পাওয়া যাবে না!",
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

{{-- <script src="{{ asset('custom/ajax.js') }}"></script> --}}








@endsection
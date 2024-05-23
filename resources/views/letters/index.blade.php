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
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="status-1" checked>
                                    <label class="form-check-label" for="status-1">নতুন</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="status-2" checked>
                                    <label class="form-check-label" for="status-2">প্রক্রিয়াধীন</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="status-3" checked>
                                    <label class="form-check-label" for="status-3">নিষ্পন্ন</label>
                                </div>
                            </div>

                            <!-- Date Range Filter -->
                            <div class="col-12 col-md-auto">
                                <label for="start_date" class="form-label fw-bold">পত্র প্রাপ্তির তারিখঃ</label>
                            </div>
                            <div class="col-12 col-md-auto">
                                <select id="date_range" class="form-control">
                                    <option value="last_7_days">গত ৭ দিন</option>
                                    <option value="this_month">এই মাস</option>
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
                            <div class="col-12 col-md-auto">
                                <select id="uploaded_by" class="form-control">
                                    <option value="">চিঠি আপলোডকারি</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}, {{ $user->designation }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Clear Filters Button -->
                            <div class="col-12 col-md-auto">
                                <button id="clear_filters" class="btn btn-outline-secondary">রিসেট করুন</button>
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
                            <th>সংশ্লিষ্ট শাখা</th>
                            <th>ফাইল</th>
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
                            <td>{{ strtr($loop->iteration, $engToBng) }}</td>
                            <td class="d-none">{{ $letter->received_date }}</td>
                            <td>{{ $letter->received_date_bn }}</td>
                            <td class="text-wrap">{{ $letter->sender_name }}</td>
                            <td class="text-wrap">{{ $letter->short_title }}</td>
                            <td><span class="badge badge-light-success">{{ $letter->section_name }}</span></td>
                            {{-- <td><a href="{{ $letter->file_url }}" target="_blank"><img src="{{ asset('custom/img/pdf-icon.png') }}" alt="Download" width="40"></a></td> --}}
                            <td><a href="{{ $letter->file_url }}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#a1a1a1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg></td>
                            <td>
                                @if ($letter->status == 1)
                                    <span class="shadow-none badge badge-primary">নতুন</span>
                                @elseif ($letter->status == 2)
                                    <span class="shadow-none badge badge-warning">প্রক্রিয়াধীন</span>
                                @elseif ($letter->status == 3)
                                    <span class="shadow-none badge badge-success">নিষ্পন্ন</span>
                                @endif
                            </td>
                            {{-- @foreach ($users as $user)
                                @if ($letter->uploaded_by == $user->id)
                                    <td class="text-wrap">{{ $user->name }}</td>
                                    @endif
                                    @endforeach --}}
                            <td class="text-wrap d-none">{{ $letter->uploaded_by }}</td>
                            <td>
                                <div class="action-btns">
                                    <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2 btnViewLetter" data-toggle="tooltip" data-placement="top" data-bs-toggle="modal" data-bs-target="#viewLetterModal" data-id="{{ $letter->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </a>
                                
                                @if ($letter->status != 3)
                                    @if ($letter->status == 1)
                                        <a href="{{ url('letters/' . $letter->id . '/edit') }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                    @elseif ($letter->status == 2 && session('role') == 2 || session('role') == 1)
                                            <a href="{{ url('letters/' . $letter->id . '/edit') }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            </a>
                                    @endif            
                                @endif

                                @if (Session::get('role') == 1 || Session::get('role') == 2)
                                    @if ($letter->status == 1)
                                        <a href="{{ url('letters/' . $letter->id . '/delete') }}" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" onclick="deleteWarning(event)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    @endif
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
    $(document).ready(function() {
        function getLast7Days() {
            var today = new Date();
            var last7Days = new Date();
            last7Days.setDate(today.getDate() - 7);
            return { start: last7Days, end: today };
        }

        function getThisMonth() {
            var today = new Date();
            var firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
            var lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            return { start: firstDay, end: lastDay };
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
                var status3 = $('#status-3').is(':checked');

                if ((status1 && status === 'নতুন') || 
                    (status2 && status === 'প্রক্রিয়াধীন') || 
                    (status3 && status === 'নিষ্পন্ন')) {
                    return true;
                }
                return false;
            }
        );

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var dateRange = $('#date_range').val();
                var minDate, maxDate;

                if (dateRange === 'last_7_days') {
                    var last7Days = getLast7Days();
                    minDate = last7Days.start;
                    maxDate = last7Days.end;
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
                    (dateRange === 'last_7_days' || dateRange === 'this_month') &&
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

        $('#status-1, #status-2, #status-3, #start_date, #end_date, #uploaded_by').on('change', function() {
            table.draw();
        });

        $('#clear_filters').on('click', function() {
            $('#status-1, #status-2, #status-3').prop('checked', true);
            $('#date_range').val('last_7_days');
            setCustomRangeToThisMonth();
            $('#start_date, #end_date').addClass('d-none');
            $('#uploaded_by').val('');
            table.draw();
        });

        // Trigger initial draw
        table.draw();
    });
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

<script src="{{ asset('custom/ajax.js') }}"></script>



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
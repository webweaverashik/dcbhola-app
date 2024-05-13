@extends('layouts.layout')

@section('title', 'All Letters')


@section('page-level-custom-css')
<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_custom.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/custom_dt_custom.css') }}">

<!-- END PAGE LEVEL CUSTOM STYLES -->
@endsection


@section('content')

<div class="row layout-top-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>সকল ডাক/চিঠি</h4>
                    </div>
                </div>
            </div>

            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3 dt-table-hover text-center table-hover">
                    <thead>
                        <tr>
                            <th>ক্রমিক নং</th>
                            <th>স্মারক নং</th>
                            <th>পত্র প্রাপ্তির তারিখ</th>
                            <th>কোথা হতে প্রাপ্ত</th>
                            <th>সংক্ষিপ্ত বিষয়</th>
                            <th>সংশ্লিষ্ট শাখা</th>
                            <th>আপলোডকারি</th>
                            <th>ফাইল</th>
                            <th>অবস্থা</th>
                            <th class="dt-no-sorting">কার্যক্রম</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($letters as $letter)
                        <tr>
                            <td class="checkbox-column text-center"> {{ $loop->iteration }} </td>
                            <td class="text-center">{{ $letter->memorandum_no }}</td>
                            <td>{{ $letter->received_date }}</td>
                            <td>{{ $letter->sender_name }}</td>
                            <td>{{ $letter->short_title }}</td>
                            <td><span class="badge badge-light-success">{{ $letter->section_name }}</span></td>
                            <td><strong>{{ $letter->uploader_user }}</strong><br>{{ $letter->designation }}</td>
                            <td><a href="{{ $letter->file_url }}" target="_blank"><img src="{{ asset('custom/img/pdf-icon.png') }}" alt="Download" width="40"></a></td>
                            <td class="text-center"><span class="shadow-none badge badge-primary">নতুন</span></td>
                            <td class="text-center">
                                <div class="action-btns">
                                    <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </a>
                                    <a href="{{ url('letters/' . $letter->id . '/edit') }}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    </a>
                                    
                                    @if (Session::get('role') == 1 || Session::get('role') == 2)
                                        <a href="{{ url('letters/' . $letter->id . '/delete') }}" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteWarning(event)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
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

@endsection





@section('scripts')
<script>
    document.getElementById("letters_menu").className += " active";
    document.getElementById("letters_all_id").className += " active";
    document.getElementById("letters_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("letters_ul").className += " show";
</script>

{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
<script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>  <!-- JQuery -->
<script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>


<script>
    // var e;
    c3 = $('#style-3').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
    "<'table-responsive'tr>" +
    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "পৃষ্ঠা নং _PAGE_ এর _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "সার্চ করুন...",
           "sLengthMenu": "ফলাফল :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [10, 20, 50, 100],
        "pageLength": 10
    });

    multiCheck(c3);
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
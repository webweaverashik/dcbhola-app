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
                                {{-- {{ strtr($loop->iteration, $engToBng) }} --}}
                                {{ strtr((string)(int)$loop->iteration, $engToBng) }}
                                
                                @if ($letter->type == 1)
                                <span title="দাপ্তরিক ডাক">
                                    <svg height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                    <rect x="42.221" y="8.017" style="fill:#D9DCDF;" width="307.841" height="401.904"/>
                                    <rect x="42.221" y="153.386" style="fill:#B3B9BF;" width="307.841" height="256.534"/>
                                    <rect x="76.426" y="179.04" style="fill:#D9DCDF;" width="427.557" height="290.739"/>
                                    <path style="fill:#FFC44F;" d="M179.04,221.795v-51.307c0-9.446-7.656-17.102-17.102-17.102H25.119
                                        c-9.446,0-17.102,7.656-17.102,17.102v51.307v265.086c0,9.446,7.656,17.102,17.102,17.102h410.455
                                        c9.446,0,17.102-7.656,17.102-17.102V238.898c0-9.446-7.656-17.102-17.102-17.102H179.04z"/>
                                    <g>
                                        <path style="fill:#F7AB49;" d="M25.119,469.779V153.386c-9.446,0-17.102,7.656-17.102,17.102v316.392
                                            c0,9.446,7.656,17.102,17.102,17.102h410.455c9.446,0,17.102-7.656,17.102-17.102H42.221
                                            C32.775,486.881,25.119,479.225,25.119,469.779z"/>
                                        <circle style="fill:#F7AB49;" cx="76.426" cy="427.023" r="25.653"/>
                                        <circle style="fill:#F7AB49;" cx="153.386" cy="341.511" r="25.653"/>
                                        <circle style="fill:#F7AB49;" cx="230.347" cy="392.818" r="25.653"/>
                                        <circle style="fill:#F7AB49;" cx="307.307" cy="298.756" r="25.653"/>
                                        <circle style="fill:#F7AB49;" cx="384.267" cy="392.818" r="25.653"/>
                                    </g>
                                    <path d="M503.983,171.023h-42.756c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h34.739v274.706h-35.273V238.898
                                        c0-13.851-11.268-25.119-25.119-25.119H187.056v-26.722h231.415c4.427,0,8.017-3.589,8.017-8.017s-3.589-8.017-8.017-8.017h-60.392
                                        V8.017c0-4.427-3.589-8.017-8.017-8.017H161.937c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h180.109v154.99h-154.99
                                        v-0.534c0-13.851-11.268-25.119-25.119-25.119H50.238V16.033h68.944c4.427,0,8.017-3.589,8.017-8.017S123.609,0,119.182,0h-76.96
                                        c-4.427,0-8.017,3.589-8.017,8.017V145.37h-9.086C11.268,145.37,0,156.638,0,170.489v51.307c0,4.427,3.589,8.017,8.017,8.017
                                        s8.017-3.589,8.017-8.017v-51.307c0-5.01,4.076-9.086,9.086-9.086h136.818c5.01,0,9.086,4.076,9.086,9.086v51.307
                                        c0,4.427,3.589,8.017,8.017,8.017h256.534c5.01,0,9.086,4.076,9.086,9.086v247.983c0,5.01-4.076,9.086-9.086,9.086H25.119
                                        c-5.01,0-9.086-4.076-9.086-9.086v-222.33c0-4.427-3.589-8.017-8.017-8.017S0,260.124,0,264.551v222.33
                                        C0,500.732,11.268,512,25.119,512h410.455c13.851,0,25.119-11.268,25.119-25.119v-9.086h43.29c4.427,0,8.017-3.589,8.017-8.017
                                        V179.04C512,174.612,508.411,171.023,503.983,171.023z"/>
                                    <path d="M298.756,67.34c4.427,0,8.017-3.589,8.017-8.017s-3.589-8.017-8.017-8.017h-76.96c-4.427,0-8.017,3.589-8.017,8.017
                                        s3.589,8.017,8.017,8.017H298.756z"/>
                                    <path d="M85.511,93.528c0,4.427,3.589,8.017,8.017,8.017h205.228c4.427,0,8.017-3.589,8.017-8.017c0-4.427-3.589-8.017-8.017-8.017
                                        H93.528C89.101,85.511,85.511,89.101,85.511,93.528z"/>
                                    <path d="M298.756,119.716H93.528c-4.427,0-8.017,3.589-8.017,8.017c0,4.427,3.589,8.017,8.017,8.017h205.228
                                        c4.427,0,8.017-3.589,8.017-8.017C306.772,123.305,303.183,119.716,298.756,119.716z"/>
                                    <path d="M76.426,393.353c-9.56,0-18.705,4.09-25.089,11.221c0,0-0.001,0.001-0.001,0.002c-5.533,6.179-8.58,14.151-8.58,22.447
                                        c0,18.566,15.105,33.67,33.67,33.67s33.67-15.105,33.67-33.67c0-6.466-1.859-12.731-5.295-18.107l31.83-38.196
                                        c5.046,2.906,10.784,4.462,16.755,4.462c10.749,0,20.33-5.07,26.499-12.936l18.885,18.885c-1.352,3.643-2.095,7.58-2.095,11.687
                                        c0,8.296,3.047,16.267,8.58,22.448l0.001,0.001c6.387,7.132,15.531,11.221,25.091,11.221s18.705-4.09,25.089-11.221
                                        c0,0,0.001-0.001,0.001-0.002c5.533-6.179,8.58-14.152,8.58-22.447c0-6.739-1.967-13.16-5.622-18.633l32.771-45.879
                                        c10.161,5.57,22.854,5.442,32.897-0.341l35.239,42.288c-5.406,5.975-8.705,13.892-8.705,22.566c0,18.566,15.105,33.67,33.67,33.67
                                        c18.566,0,33.67-15.105,33.67-33.67s-15.105-33.671-33.67-33.671c-4.083,0-7.999,0.732-11.623,2.069l-36.955-44.346
                                        c3.438-5.361,5.288-11.591,5.288-18.116c0-18.566-15.105-33.67-33.67-33.67c-18.566,0-33.67,15.105-33.67,33.67
                                        c0,6.739,1.967,13.16,5.622,18.633l-32.771,45.879c-12.342-6.766-28.004-4.939-38.5,4.405l-21.288-21.288
                                        c0.232-1.592,0.357-3.218,0.357-4.873c0-18.566-15.105-33.67-33.67-33.67s-33.67,15.105-33.67,33.67
                                        c0,6.525,1.85,12.755,5.288,18.116l-31.823,38.187C88.135,394.909,82.398,393.353,76.426,393.353z M401.904,392.818
                                        c0,9.725-7.912,17.637-17.637,17.637c-9.725,0-17.637-7.912-17.637-17.637c0-9.725,7.912-17.637,17.637-17.637
                                        C393.992,375.182,401.904,383.094,401.904,392.818z M307.307,281.119c9.725,0,17.637,7.912,17.637,17.637
                                        c0,4.743-1.859,9.195-5.233,12.534c-6.763,6.693-17.955,6.718-24.75,0.055c-0.001-0.001-0.001-0.001-0.002-0.002
                                        c-3.41-3.347-5.289-7.817-5.289-12.586C289.67,289.031,297.582,281.119,307.307,281.119z M230.347,375.182
                                        c4.642,0,9.027,1.793,12.346,5.048c0.001,0.001,0.001,0.001,0.002,0.002c3.41,3.347,5.289,7.817,5.289,12.586
                                        c0,4.344-1.596,8.518-4.494,11.755l0,0c-6.914,7.723-19.373,7.723-26.286,0l0,0c-2.898-3.237-4.494-7.411-4.494-11.755
                                        C212.71,383.094,220.622,375.182,230.347,375.182z M76.426,444.66c-9.725,0-17.637-7.912-17.637-17.637
                                        c0-4.344,1.596-8.518,4.494-11.755l0,0c3.347-3.739,8.136-5.882,13.143-5.882c4.674,0,9.079,1.812,12.403,5.103
                                        c0.084,0.083,0.176,0.157,0.264,0.236c0.049,0.044,0.095,0.091,0.144,0.134c0.108,0.138,0.213,0.277,0.331,0.409
                                        c2.898,3.237,4.494,7.411,4.494,11.755C94.063,436.748,86.151,444.66,76.426,444.66z M153.386,323.875
                                        c9.725,0,17.637,7.912,17.637,17.637c0,9.725-7.912,17.637-17.637,17.637c-9.61,0-17.637-8.026-17.637-17.637
                                        C135.749,331.787,143.661,323.875,153.386,323.875z"/>
                                    </svg>
                                </span>
                                @elseif ($letter->type == 2)
                                <span title="নাগরিক ডাক">
                                    <svg height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                        <path style="fill:#E4D1F3;" d="M373.106,8.17h-32.681L384,465.382l32.681-5.127V51.745C416.681,27.68,397.171,8.17,373.106,8.17z"/>
                                        <path style="fill:#F89890;" d="M128,51.745C128,27.68,75.81,8.17,51.745,8.17L40.851,46.298l10.894,38.128H128V51.745z"/>
                                        <path style="fill:#FFC5BF;" d="M8.17,51.745v32.681h43.574V8.17C27.68,8.17,8.17,27.68,8.17,51.745z"/>
                                        <path style="fill:#F1E8F9;" d="M340.426,8.17H51.745c24.065,0,43.574,19.509,43.574,43.574v408.511
                                            c0,24.065,19.509,43.574,43.574,43.574L384,465.382V51.745C384,27.68,364.491,8.17,340.426,8.17z"/>
                                        <path style="fill:#FFC5BF;" d="M471.149,427.574l-43.574,76.255h32.681c24.065,0,43.574-19.509,43.574-43.574v-32.681H471.149z"/>
                                        <path style="fill:#FFD8D4;" d="M471.149,460.255v-32.681H182.468v32.681c0,24.065-19.509,43.574-43.574,43.574h288.681
                                            C451.64,503.83,471.149,484.32,471.149,460.255z"/>
                                        <path style="fill:#9E52B6;" d="M256,49.021c-52.56,0-95.319,42.76-95.319,95.319S203.44,239.66,256,239.66
                                            c19.213,0,37.739-5.698,53.576-16.479c3.73-2.539,4.695-7.621,2.156-11.351c-2.54-3.73-7.621-4.695-11.351-2.156
                                            c-6.226,4.239-12.958,7.516-20.013,9.802c8.214-16.598,12.817-41.458,13.628-66.964h40.555
                                            c-1.333,12.971-5.829,25.356-13.218,36.209c-2.539,3.73-1.574,8.812,2.156,11.351c3.731,2.54,8.813,1.574,11.351-2.156
                                            c10.78-15.837,16.479-34.363,16.479-53.576C351.319,91.781,308.56,49.021,256,49.021z M334.557,136.17h-40.561
                                            c-0.81-25.493-5.41-50.343-13.616-66.94C309.54,78.718,331.311,104.73,334.557,136.17z M256,65.362
                                            c2.644,0,8.41,5.329,13.457,20.012c4.713,13.711,7.567,31.512,8.196,50.797h-43.306c0.63-19.286,3.484-37.087,8.196-50.797
                                            C247.59,70.691,253.356,65.362,256,65.362z M231.62,69.23c-8.206,16.598-12.805,41.446-13.616,66.94h-40.561
                                            C180.689,104.73,202.46,78.718,231.62,69.23z M177.443,152.511h40.561c0.81,25.493,5.41,50.343,13.616,66.94
                                            C202.46,209.962,180.689,183.951,177.443,152.511z M269.457,203.308c-5.047,14.682-10.813,20.012-13.457,20.012
                                            s-8.41-5.329-13.457-20.012c-4.713-13.711-7.567-31.512-8.196-50.797h43.306C277.024,171.797,274.169,189.598,269.457,203.308z"/>
                                        <path d="M367.66,370.383H272.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C375.83,374.041,372.172,370.383,367.66,370.383z"/>
                                        <path d="M239.66,370.383H144.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C247.83,374.041,244.172,370.383,239.66,370.383z"/>
                                        <path d="M367.66,321.362H272.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C375.83,325.02,372.172,321.362,367.66,321.362z"/>
                                        <path d="M239.66,321.362H144.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C247.83,325.02,244.172,321.362,239.66,321.362z"/>
                                        <path d="M367.66,272.34H272.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C375.83,275.999,372.172,272.34,367.66,272.34z"/>
                                        <path d="M239.66,272.34H144.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C247.83,275.999,244.172,272.34,239.66,272.34z"/>
                                        <path d="M503.83,419.404H182.468c-4.512,0-8.17,3.658-8.17,8.17v32.681c0,19.521-15.883,35.404-35.404,35.404
                                            s-35.404-15.883-35.404-35.404V51.745c0-13.687-5.351-26.14-14.059-35.404h283.676c19.521,0,35.404,15.883,35.404,35.404v343.149
                                            c0,4.512,3.658,8.17,8.17,8.17c4.512,0,8.17-3.658,8.17-8.17V51.745C424.851,23.213,401.638,0,373.106,0H51.745
                                            C23.213,0,0,23.213,0,51.745v32.681c0,4.512,3.658,8.17,8.17,8.17h54.468c4.512,0,8.17-3.658,8.17-8.17s-3.658-8.17-8.17-8.17H16.34
                                            V51.745c0-19.521,15.883-35.404,35.404-35.404s35.404,15.883,35.404,35.404v408.511c0,28.531,23.213,51.745,51.745,51.745h321.362
                                            C488.787,512,512,488.787,512,460.255v-32.681C512,423.062,508.342,419.404,503.83,419.404z M495.66,460.255
                                            c0,19.521-15.883,35.404-35.404,35.404H176.598c8.703-9.263,14.041-21.722,14.041-35.404v-24.511H495.66V460.255z"/>
                                    </svg>
                                </span>
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

{{-- Page Level Custom JS Starts --}}
{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
<script src="{{ asset('src/plugins/src/global/vendors.min.js') }}"></script>  <!-- JQuery -->
<script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>
{{-- Page Level Custom JS Ends --}}


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


        // Here's how you can modify your DataTables configuration to include a custom sorting function for the column displaying the iteration number:
        $.fn.dataTable.ext.type.order['bengali-numeric-pre'] = function (data) {
            // Convert Bengali digits to English digits for sorting
            var engDigits = {'০': '0', '১': '1', '২': '2', '৩': '3', '৪': '4', '৫': '5', '৬': '6', '৭': '7', '৮': '8', '৯': '9'};
            var engData = data.replace(/[০-৯]/g, function (match) {
                return engDigits[match];
            });
            return parseInt(engData, 10);
        };

        
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
            "columnDefs": [
                {
                    "targets": 0, // Adjust the target column index as per your table structure
                    "type": "bengali-numeric"
                }
            ]
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
                var typeText = letter.type === 1 ? `<span title="দাপ্তরিক ডাক">
                                    <svg height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                    <rect x="42.221" y="8.017" style="fill:#D9DCDF;" width="307.841" height="401.904"/>
                                    <rect x="42.221" y="153.386" style="fill:#B3B9BF;" width="307.841" height="256.534"/>
                                    <rect x="76.426" y="179.04" style="fill:#D9DCDF;" width="427.557" height="290.739"/>
                                    <path style="fill:#FFC44F;" d="M179.04,221.795v-51.307c0-9.446-7.656-17.102-17.102-17.102H25.119
                                        c-9.446,0-17.102,7.656-17.102,17.102v51.307v265.086c0,9.446,7.656,17.102,17.102,17.102h410.455
                                        c9.446,0,17.102-7.656,17.102-17.102V238.898c0-9.446-7.656-17.102-17.102-17.102H179.04z"/>
                                    <g>
                                        <path style="fill:#F7AB49;" d="M25.119,469.779V153.386c-9.446,0-17.102,7.656-17.102,17.102v316.392
                                            c0,9.446,7.656,17.102,17.102,17.102h410.455c9.446,0,17.102-7.656,17.102-17.102H42.221
                                            C32.775,486.881,25.119,479.225,25.119,469.779z"/>
                                        <circle style="fill:#F7AB49;" cx="76.426" cy="427.023" r="25.653"/>
                                        <circle style="fill:#F7AB49;" cx="153.386" cy="341.511" r="25.653"/>
                                        <circle style="fill:#F7AB49;" cx="230.347" cy="392.818" r="25.653"/>
                                        <circle style="fill:#F7AB49;" cx="307.307" cy="298.756" r="25.653"/>
                                        <circle style="fill:#F7AB49;" cx="384.267" cy="392.818" r="25.653"/>
                                    </g>
                                    <path d="M503.983,171.023h-42.756c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h34.739v274.706h-35.273V238.898
                                        c0-13.851-11.268-25.119-25.119-25.119H187.056v-26.722h231.415c4.427,0,8.017-3.589,8.017-8.017s-3.589-8.017-8.017-8.017h-60.392
                                        V8.017c0-4.427-3.589-8.017-8.017-8.017H161.937c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h180.109v154.99h-154.99
                                        v-0.534c0-13.851-11.268-25.119-25.119-25.119H50.238V16.033h68.944c4.427,0,8.017-3.589,8.017-8.017S123.609,0,119.182,0h-76.96
                                        c-4.427,0-8.017,3.589-8.017,8.017V145.37h-9.086C11.268,145.37,0,156.638,0,170.489v51.307c0,4.427,3.589,8.017,8.017,8.017
                                        s8.017-3.589,8.017-8.017v-51.307c0-5.01,4.076-9.086,9.086-9.086h136.818c5.01,0,9.086,4.076,9.086,9.086v51.307
                                        c0,4.427,3.589,8.017,8.017,8.017h256.534c5.01,0,9.086,4.076,9.086,9.086v247.983c0,5.01-4.076,9.086-9.086,9.086H25.119
                                        c-5.01,0-9.086-4.076-9.086-9.086v-222.33c0-4.427-3.589-8.017-8.017-8.017S0,260.124,0,264.551v222.33
                                        C0,500.732,11.268,512,25.119,512h410.455c13.851,0,25.119-11.268,25.119-25.119v-9.086h43.29c4.427,0,8.017-3.589,8.017-8.017
                                        V179.04C512,174.612,508.411,171.023,503.983,171.023z"/>
                                    <path d="M298.756,67.34c4.427,0,8.017-3.589,8.017-8.017s-3.589-8.017-8.017-8.017h-76.96c-4.427,0-8.017,3.589-8.017,8.017
                                        s3.589,8.017,8.017,8.017H298.756z"/>
                                    <path d="M85.511,93.528c0,4.427,3.589,8.017,8.017,8.017h205.228c4.427,0,8.017-3.589,8.017-8.017c0-4.427-3.589-8.017-8.017-8.017
                                        H93.528C89.101,85.511,85.511,89.101,85.511,93.528z"/>
                                    <path d="M298.756,119.716H93.528c-4.427,0-8.017,3.589-8.017,8.017c0,4.427,3.589,8.017,8.017,8.017h205.228
                                        c4.427,0,8.017-3.589,8.017-8.017C306.772,123.305,303.183,119.716,298.756,119.716z"/>
                                    <path d="M76.426,393.353c-9.56,0-18.705,4.09-25.089,11.221c0,0-0.001,0.001-0.001,0.002c-5.533,6.179-8.58,14.151-8.58,22.447
                                        c0,18.566,15.105,33.67,33.67,33.67s33.67-15.105,33.67-33.67c0-6.466-1.859-12.731-5.295-18.107l31.83-38.196
                                        c5.046,2.906,10.784,4.462,16.755,4.462c10.749,0,20.33-5.07,26.499-12.936l18.885,18.885c-1.352,3.643-2.095,7.58-2.095,11.687
                                        c0,8.296,3.047,16.267,8.58,22.448l0.001,0.001c6.387,7.132,15.531,11.221,25.091,11.221s18.705-4.09,25.089-11.221
                                        c0,0,0.001-0.001,0.001-0.002c5.533-6.179,8.58-14.152,8.58-22.447c0-6.739-1.967-13.16-5.622-18.633l32.771-45.879
                                        c10.161,5.57,22.854,5.442,32.897-0.341l35.239,42.288c-5.406,5.975-8.705,13.892-8.705,22.566c0,18.566,15.105,33.67,33.67,33.67
                                        c18.566,0,33.67-15.105,33.67-33.67s-15.105-33.671-33.67-33.671c-4.083,0-7.999,0.732-11.623,2.069l-36.955-44.346
                                        c3.438-5.361,5.288-11.591,5.288-18.116c0-18.566-15.105-33.67-33.67-33.67c-18.566,0-33.67,15.105-33.67,33.67
                                        c0,6.739,1.967,13.16,5.622,18.633l-32.771,45.879c-12.342-6.766-28.004-4.939-38.5,4.405l-21.288-21.288
                                        c0.232-1.592,0.357-3.218,0.357-4.873c0-18.566-15.105-33.67-33.67-33.67s-33.67,15.105-33.67,33.67
                                        c0,6.525,1.85,12.755,5.288,18.116l-31.823,38.187C88.135,394.909,82.398,393.353,76.426,393.353z M401.904,392.818
                                        c0,9.725-7.912,17.637-17.637,17.637c-9.725,0-17.637-7.912-17.637-17.637c0-9.725,7.912-17.637,17.637-17.637
                                        C393.992,375.182,401.904,383.094,401.904,392.818z M307.307,281.119c9.725,0,17.637,7.912,17.637,17.637
                                        c0,4.743-1.859,9.195-5.233,12.534c-6.763,6.693-17.955,6.718-24.75,0.055c-0.001-0.001-0.001-0.001-0.002-0.002
                                        c-3.41-3.347-5.289-7.817-5.289-12.586C289.67,289.031,297.582,281.119,307.307,281.119z M230.347,375.182
                                        c4.642,0,9.027,1.793,12.346,5.048c0.001,0.001,0.001,0.001,0.002,0.002c3.41,3.347,5.289,7.817,5.289,12.586
                                        c0,4.344-1.596,8.518-4.494,11.755l0,0c-6.914,7.723-19.373,7.723-26.286,0l0,0c-2.898-3.237-4.494-7.411-4.494-11.755
                                        C212.71,383.094,220.622,375.182,230.347,375.182z M76.426,444.66c-9.725,0-17.637-7.912-17.637-17.637
                                        c0-4.344,1.596-8.518,4.494-11.755l0,0c3.347-3.739,8.136-5.882,13.143-5.882c4.674,0,9.079,1.812,12.403,5.103
                                        c0.084,0.083,0.176,0.157,0.264,0.236c0.049,0.044,0.095,0.091,0.144,0.134c0.108,0.138,0.213,0.277,0.331,0.409
                                        c2.898,3.237,4.494,7.411,4.494,11.755C94.063,436.748,86.151,444.66,76.426,444.66z M153.386,323.875
                                        c9.725,0,17.637,7.912,17.637,17.637c0,9.725-7.912,17.637-17.637,17.637c-9.61,0-17.637-8.026-17.637-17.637
                                        C135.749,331.787,143.661,323.875,153.386,323.875z"/>
                                    </svg>
                                </span> দাপ্তরিক ডাক` : `<span title="নাগরিক ডাক">
                                    <svg height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                        <path style="fill:#E4D1F3;" d="M373.106,8.17h-32.681L384,465.382l32.681-5.127V51.745C416.681,27.68,397.171,8.17,373.106,8.17z"/>
                                        <path style="fill:#F89890;" d="M128,51.745C128,27.68,75.81,8.17,51.745,8.17L40.851,46.298l10.894,38.128H128V51.745z"/>
                                        <path style="fill:#FFC5BF;" d="M8.17,51.745v32.681h43.574V8.17C27.68,8.17,8.17,27.68,8.17,51.745z"/>
                                        <path style="fill:#F1E8F9;" d="M340.426,8.17H51.745c24.065,0,43.574,19.509,43.574,43.574v408.511
                                            c0,24.065,19.509,43.574,43.574,43.574L384,465.382V51.745C384,27.68,364.491,8.17,340.426,8.17z"/>
                                        <path style="fill:#FFC5BF;" d="M471.149,427.574l-43.574,76.255h32.681c24.065,0,43.574-19.509,43.574-43.574v-32.681H471.149z"/>
                                        <path style="fill:#FFD8D4;" d="M471.149,460.255v-32.681H182.468v32.681c0,24.065-19.509,43.574-43.574,43.574h288.681
                                            C451.64,503.83,471.149,484.32,471.149,460.255z"/>
                                        <path style="fill:#9E52B6;" d="M256,49.021c-52.56,0-95.319,42.76-95.319,95.319S203.44,239.66,256,239.66
                                            c19.213,0,37.739-5.698,53.576-16.479c3.73-2.539,4.695-7.621,2.156-11.351c-2.54-3.73-7.621-4.695-11.351-2.156
                                            c-6.226,4.239-12.958,7.516-20.013,9.802c8.214-16.598,12.817-41.458,13.628-66.964h40.555
                                            c-1.333,12.971-5.829,25.356-13.218,36.209c-2.539,3.73-1.574,8.812,2.156,11.351c3.731,2.54,8.813,1.574,11.351-2.156
                                            c10.78-15.837,16.479-34.363,16.479-53.576C351.319,91.781,308.56,49.021,256,49.021z M334.557,136.17h-40.561
                                            c-0.81-25.493-5.41-50.343-13.616-66.94C309.54,78.718,331.311,104.73,334.557,136.17z M256,65.362
                                            c2.644,0,8.41,5.329,13.457,20.012c4.713,13.711,7.567,31.512,8.196,50.797h-43.306c0.63-19.286,3.484-37.087,8.196-50.797
                                            C247.59,70.691,253.356,65.362,256,65.362z M231.62,69.23c-8.206,16.598-12.805,41.446-13.616,66.94h-40.561
                                            C180.689,104.73,202.46,78.718,231.62,69.23z M177.443,152.511h40.561c0.81,25.493,5.41,50.343,13.616,66.94
                                            C202.46,209.962,180.689,183.951,177.443,152.511z M269.457,203.308c-5.047,14.682-10.813,20.012-13.457,20.012
                                            s-8.41-5.329-13.457-20.012c-4.713-13.711-7.567-31.512-8.196-50.797h43.306C277.024,171.797,274.169,189.598,269.457,203.308z"/>
                                        <path d="M367.66,370.383H272.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C375.83,374.041,372.172,370.383,367.66,370.383z"/>
                                        <path d="M239.66,370.383H144.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C247.83,374.041,244.172,370.383,239.66,370.383z"/>
                                        <path d="M367.66,321.362H272.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C375.83,325.02,372.172,321.362,367.66,321.362z"/>
                                        <path d="M239.66,321.362H144.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C247.83,325.02,244.172,321.362,239.66,321.362z"/>
                                        <path d="M367.66,272.34H272.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C375.83,275.999,372.172,272.34,367.66,272.34z"/>
                                        <path d="M239.66,272.34H144.34c-4.512,0-8.17,3.658-8.17,8.17c0,4.512,3.658,8.17,8.17,8.17h95.319c4.512,0,8.17-3.658,8.17-8.17
                                            C247.83,275.999,244.172,272.34,239.66,272.34z"/>
                                        <path d="M503.83,419.404H182.468c-4.512,0-8.17,3.658-8.17,8.17v32.681c0,19.521-15.883,35.404-35.404,35.404
                                            s-35.404-15.883-35.404-35.404V51.745c0-13.687-5.351-26.14-14.059-35.404h283.676c19.521,0,35.404,15.883,35.404,35.404v343.149
                                            c0,4.512,3.658,8.17,8.17,8.17c4.512,0,8.17-3.658,8.17-8.17V51.745C424.851,23.213,401.638,0,373.106,0H51.745
                                            C23.213,0,0,23.213,0,51.745v32.681c0,4.512,3.658,8.17,8.17,8.17h54.468c4.512,0,8.17-3.658,8.17-8.17s-3.658-8.17-8.17-8.17H16.34
                                            V51.745c0-19.521,15.883-35.404,35.404-35.404s35.404,15.883,35.404,35.404v408.511c0,28.531,23.213,51.745,51.745,51.745h321.362
                                            C488.787,512,512,488.787,512,460.255v-32.681C512,423.062,508.342,419.404,503.83,419.404z M495.66,460.255
                                            c0,19.521-15.883,35.404-35.404,35.404H176.598c8.703-9.263,14.041-21.722,14.041-35.404v-24.511H495.66V460.255z"/>
                                    </svg>
                                </span> নাগরিক ডাক`;
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
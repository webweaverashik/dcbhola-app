@extends('layouts.layout')

@section('title', 'Upload New Letters')


@section('content')
<div class="row">

    <div class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>নতুন ডাক/পত্র আপলোড</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form class="row g-3" action="{{ url('letters/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="col-md-6">
                        <label class="form-label">পত্রের ধরন</label><span class="text-danger">*</span><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" value="1" id="official_letter" checked>
                            <label class="form-check-label" for="official_letter">
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
                                </span> দাপ্তরিক ডাক
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" value="2" id="civil_letter">
                            <label class="form-check-label" for="civil_letter">
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
                                </span> নাগরিক ডাক
                            </label>
                        </div>
                        
                        {{-- <input type="radio" class="form-control" id="type" name="type" value="{{ old('type') }}"> --}}
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="memorandum_no" class="form-label">স্মারক নং</label>
                        <input type="text" class="form-control" id="memorandum_no" placeholder="যেমনঃ ৫৬.০৪.০৯০০.০০০.০৬.০০৩.২২-২০০" name="memorandum_no" value="{{ old('memorandum_no') }}">
                        @error('memorandum_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="serial_no" class="form-label">ক্রমিক নং</label>
                        <input type="text" class="form-control" id="serial_no" placeholder="পত্র গ্রহণ রেজিস্টারের ক্রমিক নং লিখুন" name="serial_no" value="{{ old('serial_no') }}">
                        @error('serial_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="received_date" class="form-label">পত্র প্রাপ্তির তারিখ</label><span class="text-danger">*</span>
                        <input type="date" class="form-control" id="received_date" name="received_date" value="{{ old('received_date') }}" required>
                        @error('received_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="sender_name" class="form-label">কোথা হতে প্রাপ্ত</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="sender_name" placeholder="প্রেরণকারী ব্যক্তি বা দপ্তরের নাম লিখুন" name="sender_name" value="{{ old('sender_name') }}" required>
                        @error('sender_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="sent_date" class="form-label">প্রেরণের তারিখ</label><span class="text-danger">*</span>
                        <input type="date" class="form-control" id="sent_date" placeholder="Apartment, studio, or floor" name="sent_date" value="{{ old('sent_date') }}" required>
                        @error('sent_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="short_title" class="form-label">সংক্ষিপ্ত বিষয়</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="short_title" placeholder="পত্রের বিষয়টি সংক্ষেপে লিখুন" name="short_title" value="{{ old('short_title') }}" required>
                        @error('short_title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="section_to" class="form-label">যে শাখায় পত্র রক্ষিত হইল</label><span class="text-danger">*</span>
                        <select id="section_to" class="form-select" name="section_to" required>
                            <option value="" selected disabled>নির্বাচন করুন</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                        @error('section_to') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">           
                        <label for="file_url" class="form-label">স্ক্যানকৃত ডাক/চিঠি আপলোড করুন (শুধুমাত্র PDF ও সর্বোচ্চ ৩ MB)</label><span class="text-danger">*</span>
                        <input type="file" id="file_url" class="form-control file-upload-input" accept=".pdf" name="file_url" required>
                        @error('file_url') <span class="text-danger">{{ $message }}</span> @enderror                      
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">আপলোড করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection




@section('scripts')
<script>
    document.getElementById("pageBreadcrumb").innerHTML = '<li class="breadcrumb-item"><a href="{{ url('/letters') }}">চিঠি\/ডাক</a></li>' + '<li class="breadcrumb-item active" aria-current="page">নতুন আপলোড</li>';
    document.getElementById("letters_menu").className += " active";
    document.getElementById("letters_upload_id").className += " active";
    document.getElementById("letters_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("letters_ul").className += " show";
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const officialLetterRadio = document.getElementById('official_letter');
        const civilLetterRadio = document.getElementById('civil_letter');
        const memorandumNoField = document.getElementById('memorandum_no').parentElement;
        const serialNoField = document.getElementById('serial_no').parentElement;

        function toggleFields() {
            if (officialLetterRadio.checked) {
                memorandumNoField.style.display = 'block';
                serialNoField.style.display = 'none';
            } else if (civilLetterRadio.checked) {
                memorandumNoField.style.display = 'none';
                serialNoField.style.display = 'block';
            }
        }

        // Initial call to set the correct state on page load
        toggleFields();

        // Event listeners for the radio buttons
        officialLetterRadio.addEventListener('change', toggleFields);
        civilLetterRadio.addEventListener('change', toggleFields);
    });
</script>

@endsection
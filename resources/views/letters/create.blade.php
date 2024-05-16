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
                        <label for="memorandum_no" class="form-label">স্মারক নং</label>
                        <input type="text" class="form-control" id="memorandum_no" placeholder="যেমনঃ ৫৬.০৪.০৯০০.০০০.০৬.০০৩.২২-২০০" name="memorandum_no" value="{{ old('memorandum_no') }}">
                        @error('memorandum_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="received_date" class="form-label">পত্র প্রাপ্তির তারিখ</label><span class="text-danger">*</span>
                        <input type="date" class="form-control" id="received_date" name="received_date" value="{{ old('received_date') }}" required>
                        @error('received_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="sender_name" class="form-label">কোথা হতে প্রাপ্ত</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="sender_name" placeholder="যেমনঃ মোঃ বজলুর রহমান, বোরহানউদ্দিন" name="sender_name" value="{{ old('sender_name') }}" required>
                        @error('sender_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="sent_date" class="form-label">প্রেরণের তারিখ</label><span class="text-danger">*</span>
                        <input type="date" class="form-control" id="sent_date" placeholder="Apartment, studio, or floor" name="sent_date" value="{{ old('sent_date') }}" required>
                        @error('sent_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="short_title" class="form-label">সংক্ষিপ্ত বিষয়</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="short_title" placeholder="যেমনঃ জমি শ্রেণী পরিবর্তনের জন্য আবেদন" name="short_title" value="{{ old('short_title') }}" required>
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
                        <label for="file_url" class="form-label">ডাক/চিঠি আপলোড করুন (শুধুমাত্র PDF ও সর্বোচ্চ ৩ MB)</label><span class="text-danger">*</span>
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
    document.getElementById("letters_menu").className += " active";
    document.getElementById("letters_upload_id").className += " active";
    document.getElementById("letters_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("letters_ul").className += " show";
</script>

@endsection
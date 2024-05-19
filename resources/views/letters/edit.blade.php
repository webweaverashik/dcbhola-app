@extends('layouts.layout')

@section('title', 'Edit Letters')


@section('content')
<div class="row">
@if ($errors->any())
    <div class="p-2">
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>ডাক/পত্র সংশোধন</h4>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form class="row g-3" action="{{ url('letters/' . $letter->id . '/edit') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-md-6">
                        <label for="memorandum_no" class="form-label">স্মারক নং</label>
                        <input type="text" class="form-control" id="memorandum_no" placeholder="যেমনঃ ৫৬.০৪.০৯০০.০০০.০৬.০০৩.২২-২০০" name="memorandum_no" value="{{ $letter->memorandum_no }}">
                        @error('memorandum_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="received_date" class="form-label">পত্র প্রাপ্তির তারিখ</label><span class="text-danger">*</span>
                        <input type="date" class="form-control" id="received_date" name="received_date" value="{{ $letter->received_date }}" required>
                        @error('received_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="sender_name" class="form-label">কোথা হতে প্রাপ্ত</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="sender_name" placeholder="যেমনঃ মোঃ বজলুর রহমান, বোরহানউদ্দিন" name="sender_name" value="{{ $letter->sender_name }}" required>
                        @error('sender_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="sent_date" class="form-label">প্রেরণের তারিখ</label><span class="text-danger">*</span>
                        <input type="date" class="form-control" id="sent_date" placeholder="Apartment, studio, or floor" name="sent_date" value="{{ $letter->sent_date }}" required>
                        @error('sent_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="short_title" class="form-label">সংক্ষিপ্ত বিষয়</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="short_title" placeholder="যেমনঃ জমি শ্রেণী পরিবর্তনের জন্য আবেদন" name="short_title" value="{{ $letter->short_title }}" required>
                        @error('short_title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="section_to" class="form-label">যে শাখায় পত্র রক্ষিত হইল</label><span class="text-danger">*</span>
                        <select id="section_to" class="form-select" name="section_to" required>
                            <option selected disabled>নির্বাচন করুন</option>
                            @foreach ($sections as $section)
                                @if (Session::get('role') == 3)
                                    <option value="{{ $section->id }}" selected >{{ $section->name }}</option>
                                @else
                                    <option value="{{ $section->id }}" @if ($letter->section_to == $section->id) selected @endif >{{ $section->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('section_to') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                {{-- Only Admin and Section Officer are allowed to comment and change status --}}
                @if (session('role') == 1 || session('role') == 2)
                    <div class="col-md-6">
                        <label for="status" class="form-label">পত্রের অবস্থা নির্বাচন করুন</label><span class="text-danger">*</span>
                        <br>

                        <div class="form-check form-check-info form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="form-check-radio-pending" @if ($letter->status == 1) checked @endif value="1">
                            <label class="form-check-label" for="form-check-radio-pending">
                                নতুন
                            </label>
                        </div>
                        <div class="form-check form-check-warning form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="form-check-radio-new" @if ($letter->status == 2) checked @endif value="2">
                            <label class="form-check-label" for="form-check-radio-new">
                                প্রক্রিয়াধীন
                            </label>
                        </div>
                        <div class="form-check form-check-success form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="form-check-radio-complete" @if ($letter->status == 3) checked @endif value="3">
                            <label class="form-check-label" for="form-check-radio-complete">
                                নিষ্পন্ন
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">           
                        <label for="comment" class="form-label">মন্তব্য যুক্ত করুন</label><span class="text-danger">*</span>
                        <textarea class="form-control" name="comment" id="comment" rows="3" required></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror                      
                    </div>
                @endif

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">আপডেট করুন</button>
                        <a href="{{ url('/letters') }}" class="btn btn-outline-success">ফিরে যান</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection




@section('scripts')
<script>
    document.getElementById("pageBreadcrumb").innerHTML = '<li class="breadcrumb-item"><a href="{{ url('/letters') }}">চিঠি\/ডাক</a></li>' + '<li class="breadcrumb-item active" aria-current="page">চিঠি সংশোধন</li>';
    document.getElementById("letters_menu").className += " active";
    document.getElementById("letters_all_id").className += " active";
    document.getElementById("letters_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("letters_ul").className += " show";
</script>

@endsection
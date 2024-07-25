@extends('layouts.layout')

@section('page-level-custom-css')
    
@endsection


@section('title', 'রিপোর্ট প্যানেল')



@section('content')

<div class="row layout-top-spacing">
    <h1>রিপোর্ট প্যানেলের কাজ চলমান</h1>
</div>
@endsection


@section('scripts')
<script>
    document.getElementById("pageBreadcrumb").innerHTML = '<li class="breadcrumb-item active">রিপোর্ট প্যানেল</li>';
    document.getElementById("report_menu").className += " active";
</script>

@endsection
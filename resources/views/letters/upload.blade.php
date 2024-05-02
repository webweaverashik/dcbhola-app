@extends('layouts.layout')

@section('title', 'Upload New Letters')







@section('scripts')
<script>
    document.getElementById("letters_menu").className += " active";
    document.getElementById("letters_upload_id").className += " active";
    document.getElementById("letters_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("letters_ul").className += " show";
</script>
@endsection
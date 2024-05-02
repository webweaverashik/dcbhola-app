@extends('layouts.layout')

@section('title', 'All Letters')







@section('scripts')
<script>
    document.getElementById("letters_menu").className += " active";
    document.getElementById("letters_all_id").className += " active";
    document.getElementById("letters_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("letters_ul").className += " show";
</script>
@endsection
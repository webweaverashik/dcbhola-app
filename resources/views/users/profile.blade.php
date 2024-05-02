@extends('layouts.layout')

@section('title', 'My Profile')







@section('scripts')
<script>
    document.getElementById("users_menu").className += " active";
    document.getElementById("users_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("users_ul").className += " show";
    document.getElementById("my_profile_id").className += " active";
</script>
@endsection
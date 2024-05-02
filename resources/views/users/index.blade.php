@extends('layouts.layout')

@section('title', 'All Users')







@section('scripts')
<script>
    document.getElementById("users_menu").className += " active";
    document.getElementById("users_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("users_ul").className += " show";
    document.getElementById("all_users_id").className += " active";
</script>
@endsection
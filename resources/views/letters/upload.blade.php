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
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="memorandum_no" class="form-label">স্মারক নং</label>
                        <input type="email" class="form-control" id="memorandum_no" placeholder="৫৬.০৪.০৯০০.০০০.০৬.০০৩.২২-২০০" name="memorandum_no">
                    </div>
                    <div class="col-md-6">
                        <label for="received_date" class="form-label">Received Date</label>
                        <input type="date" class="form-control" id="received_date" name="received_date">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Address 2</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">State</label>
                        <select id="inputState" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="inputZip" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Sign in</button>
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
@extends('layouts.layout')

@section('title', 'All Users')


@section('content')
<div class="row">
    <div class="col-lg-12 col-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>কর্মকর্তাদের প্রোফাইল</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
    
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">নাম ও পদবি</th>
                                <th scope="col">ইমেইল ও ফোন</th>
                                <th scope="col">একাউন্ট তৈরির সময়</th>
                                <th scope="col">দায়িত্বপ্রাপ্ত শাখা</th>
                                <th class="text-center" scope="col">কার্যক্রম</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($officers as $officer)                                
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-3">
                                            @if ($officer->photo_url != NULL)
                                                <img alt="avatar" src="http://127.0.0.1:8000/{{ $officer->photo_url }}" class="rounded-circle" />
                                            @else
                                                <img alt="avatar" src="{{ asset('custom/img/dummy-user.png') }}" class="rounded-circle" />
                                            @endif
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">{{ $officer->name }}</h6>
                                            <span>{{ $officer->designation }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $officer->email }}</p>
                                    <span>{{ $officer->phone }}</span>
                                </td>
                                <td class="text-center">
                                    <p class="mb-0">{{ $officer->created_at }}</p>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-success">শিক্ষা ও আইসিটি</span>
                                    <span class="badge badge-light-success">এডিএম</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        {{-- <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a> --}}
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
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


    <div class="col-lg-12 col-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>কর্মচারীদের প্রোফাইল</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
    
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">নাম ও পদবি</th>
                                <th scope="col">ইমেইল ও ফোন</th>
                                <th scope="col">একাউন্ট তৈরির সময়</th>
                                <th scope="col">সংশ্লিষ্ট শাখা</th>
                                <th class="text-center" scope="col">কার্যক্রম</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach ($staffs as $staff)                                
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-3">
                                            @if ($staff->photo_url != NULL)
                                                <img alt="avatar" src="http://127.0.0.1:8000/{{ $staff->photo_url }}" class="rounded-circle" />
                                            @else
                                                <img alt="avatar" src="{{ asset('custom/img/dummy-user.png') }}" class="rounded-circle" />
                                            @endif
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">{{ $staff->name }}</h6>
                                            <span>{{ $staff->designation }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $staff->email }}</p>
                                    <span>{{ $staff->phone }}</span>
                                </td>
                                <td class="text-center">
                                    <p class="mb-0">{{ $staff->created_at }}</p>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-success">আইসিটি</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        {{-- <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a> --}}
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
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
</div>

@endsection





@section('scripts')
<script>
    document.getElementById("users_menu").className += " active";
    document.getElementById("users_menu_dropdown").setAttribute("aria-expanded", true);
    document.getElementById("users_ul").className += " show";
    document.getElementById("all_users_id").className += " active";
</script>
@endsection
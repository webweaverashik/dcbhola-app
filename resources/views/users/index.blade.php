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
                                <th scope="col">নাম</th>
                                <th scope="col">পদবী</th>
                                <th scope="col">ইমেইল</th>
                                <th scope="col">ফোন</th>
                                <th class="text-center" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-2">
                                            <img alt="avatar" src="../src/assets/img/profile-7.jpeg" class="rounded-circle" />
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">Shaun Park</h6>
                                            <span>shaun.park@mail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">CEO</p>
                                    <span class="text-success">Management</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-success">Online</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-success">Online</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
    
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-2">
                                            <img alt="avatar" src="../src/assets/img/profile-11.jpeg" class="rounded-circle" />
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">Alma Clarke</h6>
                                            <span>almaClarke@mail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">Lead Developer</p>
                                    <span class="text-secondary">Programmer</span>
                                </td>
                                <td>
                                    <p class="mb-0">Lead Developer</p>
                                    <span class="text-secondary">Programmer</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-secondary">Waiting</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
    
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-2">
                                            <img alt="avatar" src="../src/assets/img/profile-5.jpeg" class="rounded-circle" />
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">Vincent Carpenter</h6>
                                            <span>vincent@mail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">HR</p>
                                    <span class="text-danger">Management</span>
                                </td>
                                <td>
                                    <p class="mb-0">HR</p>
                                    <span class="text-danger">Management</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-danger">Offline</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
    
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-2">
                                            <img alt="avatar" src="../src/assets/img/profile-34.jpeg" class="rounded-circle" />
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">Xavier</h6>
                                            <span>xavier@mail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">Lead Designer</p>
                                    <span class="text-info">Graphic</span>
                                </td>
                                
                                <td class="text-center">
                                    <span class="badge badge-light-info">On Hold</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-info">On Hold</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
    
                           
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
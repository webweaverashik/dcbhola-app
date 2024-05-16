<!-- Officer Creation Modal -->
<div class="modal modal-lg fade" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="editStaffLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStaffLabel">কর্মচারী তথ্য সংশোধন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form class="section general-info" action="{{ url('users/edit/staff') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editStaffId">
                    <div class="info">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="role" class="form-label">কর্মচারীর ধরন</label><span class="text-danger">*</span>
                                                    <br>
                                                    <div class="form-check form-check-info form-check-inline">
                                                        <input class="form-check-input" type="radio" name="role" id="section-staff-input" value="3">
                                                        <label class="form-check-label" for="section-staff-input">
                                                            শাখা কর্মচারী
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-warning form-check-inline">
                                                        <input class="form-check-input" type="radio" name="role" id="frontdesk-staff-input" value="4">
                                                        <label class="form-check-label" for="frontdesk-staff-input">
                                                            ফ্রন্ট ডেস্ক
                                                        </label>
                                                    </div>
                                                    @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editStaffFullName">সম্পূর্ণ নাম</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="editStaffFullName" placeholder="যেমনঃ মো. নূরনবী" value="{{ old('name') }}" name="name" required>
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editStaffDesignation">পদবী</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="editStaffDesignation" placeholder="যেমনঃ অফিস সহকারী কাম কম্পিউটার অপারেটর" value="{{ old('designation') }}" name="designation" name="designation" required>
                                                        @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                                                       
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editStaffPhone">ফোন</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="editStaffPhone" placeholder="কর্মচারীর মোবাইল নং" value="{{ old('phone') }}" name="phone" required>
                                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editStaffEmail">ইমেইল</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="editStaffEmail" placeholder="কর্মচারীর ইমেইল এড্রেস" value="{{ old('email') }}" name="email">
                                                    </div>
                                                </div> 
                                                <div class="col-md-12 mt-4">
                                                    <div class="form-group text-start">
                                                        <button class="btn btn-secondary" type="submit">আপডেট করুন</button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of User Creation Modal -->
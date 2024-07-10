<!-- Officer Creation Modal -->
<div class="modal modal-lg fade" id="addOfficerModal" tabindex="-1" role="dialog" aria-labelledby="addOfficerLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficerLabel">নতুন কর্মকর্তা যুক্তকরণ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form class="section general-info" action="{{ url('users/add/officer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="info">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="role" class="form-label">কর্মকর্তার ধরন</label><span class="text-danger">*</span>
                                                    <br>
                                                    <div class="form-check form-check-info form-check-inline">
                                                        <input class="form-check-input" type="radio" name="role" id="adc-user-input" value="2">
                                                        <label class="form-check-label" for="adc-user-input">
                                                            অতিরিক্ত জেলা প্রশাসক
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-warning form-check-inline">
                                                        <input class="form-check-input" type="radio" name="role" id="section-officer-input" value="3" checked>
                                                        <label class="form-check-label" for="section-officer-input">
                                                            সহকারী কমিশনার
                                                        </label>
                                                    </div>
                                                    @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="photo_url">প্রোফাইল ছবি (সর্বোচ্চ ১০০ KB)</label>
                                                        <input type="file" class="form-control mb-3" accept="image/jpg, image/png, image/jpeg, image/webp" name="photo_url">
                                                        @error('photo_url') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="officerFullName">সম্পূর্ণ নাম</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="officerFullName" placeholder="কর্মকর্তার সম্পুর্ণ নাম লিখুন" value="{{ old('name') }}" name="name" required>
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="officerDesignation">পদবী</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="officerDesignation" placeholder="পদবী লিখুন" value="{{ old('designation') }}" name="designation" name="designation" required>
                                                        @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                                                       
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="officerPhone">ফোন</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="officerPhone" placeholder="কর্মকর্তার মোবাইল নং" value="{{ old('phone') }}" name="phone" required>
                                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="officerEmail">ইমেইল</label><span class="text-danger">*</span>
                                                        <input type="email" class="form-control mb-3" id="officerEmail" placeholder="কর্মকর্তার ইমেইল এড্রেস" value="{{ old('email') }}" name="email">
                                                    </div>
                                                </div> 
                                                <div class="col-md-12 mt-4">
                                                    <div class="form-group text-start">
                                                        <button class="btn btn-success" type="submit">যুক্ত করুন</button>
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
            <div class="modal-footer">
                <button class="btn btn-light-dark" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
                বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>
<!-- End of User Creation Modal -->
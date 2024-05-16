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
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="photo_url">প্রোফাইল ছবি (সর্বোচ্চ ১০০ KB)</label>
                                                        <input type="file" class="form-control mb-3" accept="image/jpg, image/png, image/jpeg, image/webp" name="photo_url">
                                                        @error('photo_url') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>                                    
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fullName">সম্পূর্ণ নাম</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="fullName" placeholder="যেমনঃ মো. আলমগীর হোসেন" value="{{ old('name') }}" name="name" required>
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="designation">পদবী</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="designation" placeholder="যেমনঃ অতিরিক্ত জেলা প্রশাসক (রাজস্ব)" value="{{ old('designation') }}" name="designation" name="designation" required>
                                                        @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                                                       
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">ফোন</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="phone" placeholder="কর্মকর্তার মোবাইল নং" value="{{ old('phone') }}" name="phone" required>
                                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">ইমেইল</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="email" placeholder="কর্মকর্তার ইমেইল এড্রেস" value="{{ old('email') }}" name="email">
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
            {{-- <div class="modal-footer">
                <button class="btn btn-light-dark" data-bs-dismiss="modal">ওকে</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div> --}}
        </div>
    </div>
</div>
<!-- End of User Creation Modal -->
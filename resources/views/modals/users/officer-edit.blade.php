<!-- Officer Update Modal -->
<div class="modal modal-lg fade" id="editOfficerModal" tabindex="-1" role="dialog" aria-labelledby="editOfficerLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOfficerLabel">কর্মকর্তার তথ্য সংশোধন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form class="section general-info" action="{{ url('users/edit/officer') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editOfficerId">
                    <div class="info">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editOfficerFullName">সম্পূর্ণ নাম</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="editOfficerFullName" placeholder="কর্মকর্তার নাম" name="name" required>
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editOfficerDesignation">পদবী</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="editOfficerDesignation" placeholder="যেমনঃ অতিরিক্ত জেলা প্রশাসক (রাজস্ব)" value="{{ old('designation') }}" name="designation" name="designation" required>
                                                        @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                                                       
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editOfficerPhone">ফোন</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="editOfficerPhone" placeholder="কর্মকর্তার মোবাইল নং" value="{{ old('phone') }}" name="phone" required>
                                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="editOfficerEmail">ইমেইল</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="editOfficerEmail" placeholder="কর্মকর্তার ইমেইল এড্রেস" value="{{ old('email') }}" name="email">
                                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div> 
                                                <div class="col-md-12 mt-4">
                                                    <div class="form-group text-start">
                                                        <button class="btn btn-success" type="submit">আপডেট করুন</button>
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
<!-- End of User Update Modal -->
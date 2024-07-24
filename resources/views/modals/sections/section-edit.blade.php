<!-- Section Edit Modal -->
<div class="modal fade" id="editSectionModal" tabindex="-1" role="dialog" aria-labelledby="editSectionLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSectionLabel">শাখার তথ্য সংশোধন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form class="section general-info" action="{{ url('sections/edit') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="sectionHiddenId">
                    <div class="info">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="sectionEditName">শাখার সংশোধিত নাম</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="sectionEditName" placeholder="শাখার নাম" value="{{ old('name') }}" name="name" required>
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
        
                                                <div class="col-md-12">
                                                    <label for="editADCId" class="form-label">সংশ্লিষ্ট অতিরিক্ত জেলা প্রশাসক</label><span class="text-danger">*</span>
                                                    <select id="editADCId" class="form-select mb-3" name="adc_id" required>
                                                        <option id="adc_blank" value="" selected disabled>নির্বাচন করুন</option>
                                                    @foreach ($adc_users as $adc)
                                                        <option value="{{ $adc->id }}">{{ $adc->name . ', ' . $adc->designation}}</option>
                                                    @endforeach
                                                    </select>
                                                    @error('adc_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
        
                                                <div class="col-md-12">
                                                    <label for="editOfficerId" class="form-label">শাখার দায়িত্বপ্রাপ্ত কর্মকর্তা</label><span class="text-danger">*</span>
                                                    <select id="editOfficerId" class="form-select mb-3" name="officer_id" required>
                                                        <option id="officer_blank" value="" selected disabled>নির্বাচন করুন</option>
                                                    @foreach ($officers as $officer)
                                                        <option value="{{ $officer->id }}">{{ $officer->name . ', ' . $officer->designation}}</option>
                                                    @endforeach
                                                    </select>
                                                    @error('officer_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="editStaffId" class="form-label">কর্মচারী</label><span class="text-danger">*</span>
                                                    <select id="editStaffId" class="form-select" name="staff_id" required>
                                                        <option id="staff_blank" value="" selected disabled>নির্বাচন করুন</option>
                                                    @foreach ($staffs as $staff)
                                                        <option value="{{ $staff->id }}">{{ $staff->name . ', ' . $staff->designation }}</option>
                                                    @endforeach
                                                    </select>
                                                    @error('staff_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-md-12 mt-4">
                                                    <div class="form-group text-start">
                                                        <button class="btn btn-primary" type="submit">আপডেট করুন</button>
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
<!-- End of Section Edit Modal -->
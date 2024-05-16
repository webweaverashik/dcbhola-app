<!-- Section Creation Modal -->
<div class="modal modal-lg fade" id="editSectionModal" tabindex="-1" role="dialog" aria-labelledby="editSectionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSectionLabel">শাখা তথ্য সংশোধন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form class="section general-info" action="{{ url('sections/edit') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="info">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="sectionName">শাখার সংশোধিত নাম</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control mb-3" id="sectionName" placeholder="শাখার নাম" value="{{ old('name') }}" name="name" required>
                                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <label for="officer_id" class="form-label">দায়িত্বপ্রাপ্ত কর্মকর্তা</label><span class="text-danger">*</span>
                                                    <select id="officer_id" class="form-select" name="officer_id" required>
                                                        <option value="" selected disabled>নির্বাচন করুন</option>
                                                    {{-- @foreach ($officers as $officer)
                                                        <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                                                    @endforeach --}}
                                                    </select>
                                                    @error('officer_id') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="staff_id" class="form-label">কর্মচারী</label><span class="text-danger">*</span>
                                                    <select id="staff_id" class="form-select" name="staff_id" required>
                                                        <option value="" selected disabled>নির্বাচন করুন</option>
                                                    {{-- @foreach ($staffs as $staff)
                                                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                                    @endforeach --}}
                                                    </select>
                                                    @error('staff_id') <span class="text-danger">{{ $message }}</span> @enderror
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
    </div>
</div>
<!-- End of Section Creation Modal -->
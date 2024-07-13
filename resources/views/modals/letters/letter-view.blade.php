<!-- View Letter Modal -->
<div class="modal fade modal-xl" id="viewLetterModal" tabindex="-1" role="dialog" aria-labelledby="viewLetterLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLetterLabel">
                    পত্রের বিষয়ঃ <i class="fw-normal" id="viewShortTitle">সংক্ষিপ্ত বিষয়</i>
                    <span class="badge badge-light-success" id="viewSectionName">শাখা</span>
                    <span class="shadow-none badge badge-warning d-none" id="statusProcessing">চলমান</span>
                    <span class="shadow-none badge badge-success d-none" id="statusCompleted">সম্পন্ন</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body" >
                <div id="letter-details">
                </div>
                
                <div id="comments">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light-dark" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
                বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>
<!-- End of View Letter Modal -->
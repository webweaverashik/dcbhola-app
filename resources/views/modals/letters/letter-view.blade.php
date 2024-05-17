
<!-- View Letter Modal -->
<div class="modal fade modal-xl" id="viewLetterModal" tabindex="-1" role="dialog" aria-labelledby="viewLetterLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLetterLabel">
                    বিষয়ঃ <i class="fw-normal">{{ $letter->short_title }}</i>
                    <span class="badge badge-light-success">{{ $letter->section_name }}</span>
                    @if ($letter->status == 1)
                        <span class="shadow-none badge badge-primary">নতুন</span>
                    @elseif ($letter->status == 2)
                        <span class="shadow-none badge badge-warning">প্রক্রিয়াধীন</span>
                    @elseif ($letter->status == 3)
                        <span class="shadow-none badge badge-success">নিষ্পন্ন</span>
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered text-break">
                    <tr>
                        <td class="w-50"><span class="fw-bold">চিঠি/স্মারক নংঃ</span> {{ $letter->memorandum_no }}</td>
                        <td class="w-50"><span class="fw-bold">পত্র প্রাপ্তির তারিখঃ</span> {{ $letter->received_date }}</td>
                    </tr>
                    <tr>
                        <td class="w-50"><span class="fw-bold">কোথা হতে প্রাপ্তঃ</span> {{ $letter->sender_name }}</td>
                        <td class="w-50"><span class="fw-bold">প্রেরণের তারিখঃ</span> {{ $letter->sent_date }}</td>
                    </tr>
                    <tr>
                        <td class="w-50"><span class="fw-bold">আপলোডের সময়ঃ</span> {{ $letter->created_at }}</td>
                        <td class="w-50"><span class="fw-bold">প্রেরণের তারিখঃ</span> {{ $letter->sent_date }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light-dark" data-bs-dismiss="modal">ওকে</button>
                {{-- <button type="button" class="btn btn-primary">Save</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- End of View Letter Modal -->
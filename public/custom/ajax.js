$(document).ready(function() {
    $('.btnViewLetter').click(function() {
        const letterId = $(this).attr("data-id");


        // Define an array mapping English digits to Bengali digits
        var engToBng = {'0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪', '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯'};

        // Function to convert English number to Bengali
        function convertToBengali(number) {
            var bengaliNumber = '';
            var numberString = number.toString();
            for (var i = 0; i < numberString.length; i++) {
                var digit = numberString[i];
                bengaliNumber += engToBng[digit];
            }
            return bengaliNumber;
        }

        $.ajax({
            url: '/letters/ajax/' + letterId,
            method: 'GET',
            success: function(response) {
                // Handle the letter details

                var letter = response.letter;
                var letterHtml = `
                    
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2"><span class="fw-bold">আপলোডের সময়ঃ </span>${letter.created_at_bn}</td>
                        </tr>
                        <tr>
                            <td class="w-50"><span class="fw-bold">চিঠি/স্মারক নংঃ </span>${letter.memorandum_no}</td>
                            <td class="w-50" ><span class="fw-bold">পত্র প্রাপ্তির তারিখঃ </span>${letter.received_date_bn}</td>
                        </tr>
                        <tr>
                            <td class="w-50 text-wrap"><span class="fw-bold">কোথা হতে প্রাপ্তঃ </span>${letter.sender_name}</td>
                            <td class="w-50"><span class="fw-bold">প্রেরণের তারিখঃ </span>${letter.sent_date_bn}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><span class="fw-bold text-wrap">আপলোডকারিঃ </span>${letter.uploader_name}, ${letter.uploader_designation}</td>
                        </tr>
                    </table>
                `;
                $('#letter-details').html(letterHtml);
                $('#viewShortTitle').html(`${letter.short_title}`);
                $('#viewSectionName').html(`${letter.section_name}`);

                    if (`${letter.status}` == 1) {
                        $('#statusNew').removeClass('d-none');
                        $('#statusProcessing').addClass('d-none');
                        $('#statusCompleted').addClass('d-none');
                        $('#comments').addClass('d-none');
                    }
                    else if (`${letter.status}` == 2) {
                        $('#statusNew').addClass('d-none');
                        $('#statusProcessing').removeClass('d-none');
                        $('#statusCompleted').addClass('d-none');
                        $('#comments').removeClass('d-none');
                    }
                    else if (`${letter.status}` == 3) {
                        $('#statusNew').addClass('d-none');
                        $('#statusProcessing').addClass('d-none');
                        $('#statusCompleted').removeClass('d-none');
                        $('#comments').removeClass('d-none');
                    }

                // Handle the comments
                var comments = response.comments;
                var commentsHtml = `
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td colspan="4" class="text-center border-0"><h6 class="fw-bold">মন্তব্য সমূহঃ</h6></td>
                            </tr>
                        <tr>
                            <th scope="col">ক্রমিক</th>
                            <th scope="col">সময়</th>
                            <th scope="col">মন্তব্য</th>
                            <th scope="col">কর্মকর্তা</th>
                        </tr>
                        </thead>
                        <tbody>
                `;

                comments.forEach(function(comment, index) {
                    var serialNo = index + 1;
                    var serialNoBn = convertToBengali(serialNo); // Convert serial number to Bengali
                    var badgeHtml = (index === 0) ? '<span class="badge bg-light-primary">সর্বশেষ</span>' : '';
                    commentsHtml += `
                        <tr>
                            <td>${serialNoBn}</td>
                            <td>${comment.created_at_bn}</td>
                            <td>${comment.comment} ${badgeHtml}</td>
                            <td>${comment.comment_by_name}, ${comment.commenter_designation}</td>
                        </tr>
                    `;
                });

                commentsHtml += `
                        </tbody>
                    </table>
                `;

                $('#comments').html(commentsHtml);
            },
            error: function(xhr, status, error) {
                console.error('An error occurred:', status, error);
            }
        });
    });
});
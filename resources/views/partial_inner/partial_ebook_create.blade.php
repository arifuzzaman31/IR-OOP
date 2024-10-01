@push('script')
<script>
    function countWords(str) {
        // Use a regular expression to match words
        var matches = str.match(/\b\w+\b/g);
        // Return the number of matches (i.e., words)
        return matches ? matches.length : 0;
    }
    $(document).ready(function(e) {
        var form_templete = @json($templete);
        var form_templete_structure = form_templete.structure;
        // console.log(form_templete.structure)


        // Customer Input/Textarea Lenght Limitation\
        $(document).on('input', 'input, textarea', function(e) {


            // let maxlength = $(this).attr('max_length');
            let currentlength = countWords($(this).val());
            let form_name = $(this).attr('name');

            let input_templete = form_templete_structure.find(obj => obj.form_name == form_name);
            let maxlength = input_templete.max_word_count;

            if (maxlength && parseInt(currentlength) > parseInt(maxlength)) {
                e.preventDefault();

                // console.log("maxlength", maxlength);
                // let current_value = $(this).val();
                // $(this).val(current_value.substring(0, parseInt(maxlength)));

                Snackbar.show({
                    text: 'Sorry! You are excedding the word limit.',
                    pos: 'bottom-right',
                    backgroundColor: "#f20000"
                });
            }

            if (maxlength) {
                if ($(this).siblings('.custom-counter').length > 0) {
                    $(this).parent().find('.custom-counter').html(`${currentlength}</span>/${maxlength} max words`);
                } else {
                    $(this).after($(`<small class="form-text text-muted text-right custom-counter"><span>${currentlength}</span>/${maxlength} max words</small>`));
                }
            }
        });


        // Handle paste event
        $(document).on('paste', 'input, textarea', function(e) {
            let currentlength = countWords($(this).val());
            let form_name = $(this).attr('name');
            let input_templete = form_templete_structure.find(obj => obj.form_name == form_name);
            let maxlength = input_templete.max_word_count;

            var pastedData = e.originalEvent.clipboardData.getData('text');

            if (maxlength && currentlength + countWords(pastedData) > parseInt(maxlength)) {
                e.preventDefault(); // Prevent pasting if it exceeds max length

                // var remainingLength = maxlength - $(this).val().length;
                // $(this).val($(this).val() + pastedData.substring(0, remainingLength));

                Snackbar.show({
                    text: 'Sorry! You are excedding the word limit.',
                    pos: 'bottom-right',
                    backgroundColor: "#f20000"
                });
            }
        });
    });
</script>
@endpush
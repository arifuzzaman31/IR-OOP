<!-- Rate Now Modal -->
<div class="modal fade" id="modal_rate_now" tabindex="-1" role="dialog" aria-labelledby="rate_now_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="#" id="cf-form" method="POST">
                <!-- @csrf -->
                <div class="modal-header">
                    <h5 class="modal-title" id="rate_now_label">Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="rating_query" id="rating_query">Do you think this image is okay?</h4>
                    <div class="form-group">
                        <label for="change_status">Comment / Evaluation</label>
                        <textarea class="form-control" name="ebook_comment" id="ebook_comment" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ebook_mark">Rating</label>
                        <select class="form-control" name="ebook_mark" id="ebook_mark">
                            <option value="0">Select</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="ebook_id" id="ebook_id" value="{{ $ebook->id }}">
                    <input type="hidden" name="jury_id" id="jury_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="ebook_field_name" id="ebook_field_name" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="reset" id="reset_form" class="btn btn-danger" value="Reset" />
                    <button type="submit" id="update_feedback" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>


@push('script')
<script>
    let ebook = @json($ebook);
    let evaluation = [];
    $(document).ready(function(e) {

        $(".evaluation_form .form-control").addClass("custom_form_input readonly-bg-white");

        let output_fields = $('.custom_form_input');

        $.each(output_fields, function(key, field) {

            let field_name = $(field).attr('name');
            $(field).val(ebook.form_data[field_name]).attr('readonly', 'true');

            if (field_name != "ebook_author_name" && field_name != "ebook_date") {
                // console.log("field Name", field_name);
                $(field).before(`<a href="#" class="btn btn-sm btn-primary float-right rate_now mb-2" data-toggle="modal" data-target="#modal_rate_now" data-field_name="${field_name}" >Rate Now</a>`)
            }
        });

    });

    $(document).on('click', '.rate_now', function(e) {
        let field_name = $(this).attr('data-field_name');
        let template_structure = ebook.templates_mave.structure;

        $('#ebook_field_name').val(field_name);
        let stucture_item = template_structure.find((item) => {
            if (item.form_name == field_name) {
                return item;
            }
        });

        $('#rating_query').text(stucture_item.evaluation_query);

        let dynamic_option = '';
        let i = 1;
        if (stucture_item.mark != null) {
            while (i <= stucture_item.mark) {
                dynamic_option += `<option value="${i}">${i}</option> `;
                i++;
            }

            $('#ebook_mark').empty().html(dynamic_option);
        }

        // Find and set value in the form
        let evaluated_item = evaluation.find(function(item) {
            return item.field == field_name;
        });

        $('#ebook_comment').text(evaluated_item ? evaluated_item.ebook_comment : "");
        $('#ebook_mark').val(evaluated_item ? evaluated_item.ebook_mark : "").change();
    });

    $(document).on('click', '#update_feedback', function(e) {
        e.preventDefault();
        let field = $('#ebook_field_name').val();
        let new_data = {
            "field": field,
            "ebook_comment": $('#ebook_comment').val(),
            "ebook_mark": $('#ebook_mark').val()
        }

        // Remove the existing one
        evaluation = evaluation.filter(function(item) {
            return item.field !== field;
        });

        // Push New Data
        evaluation.push(new_data);
        $(`.rate_now[data-field_name=${field}]`).switchClass("btn-primary", "btn-success", 1000, "easeInOutQuad").text("Rated");
        $('#reset_form').click();
        $('#modal_rate_now').modal('toggle');
        console.log(evaluation);
    });


    // Final Submission
    $(document).on('click', '#submit_evaluation', async function(e) {
        let url = "{{ url('admin/evaluate') }}";

        let total_mark = 0;
        evaluation.map(function(item) {
            return total_mark += parseInt(item.ebook_mark);
        });

        console.log("total mark", total_mark);

        let data = {
            "jury_id": $('#jury_id').val(),
            "ebook_id": $('#ebook_id').val(),
            evaluation,
            total_mark,
            "status": 1
        };

        let response = await custom_ajax('POST', url, data);
        if (response.status == 200) {
            Snackbar.show({
                text: 'Evaluation Recorded Successfully.',
                pos: 'bottom-right',
                backgroundColor: "#35a598"
            });
            window.location.href = "{{  url('admin/ebooks') }}";
        } else {
            Snackbar.show({
                text: 'Something went wrong! Please try again later',
                pos: 'bottom-right',
                backgroundColor: "#f20000"
            });
        }
    })



    // Old not in use
    $(document).on('click', '#update_feedback_old', async function(e) {
        e.preventDefault();



        let url = "{{ url('admin/evaluation') }}";
        let field = $('#ebook_field_name').val();
        let data = {
            "ebook_id": $('#ebook_id').val(),
            "jury_id": $('#jury_id').val(),
            "field": field,
            "ebook_comment": $('#ebook_comment').val(),
            "ebook_mark": $('#ebook_mark').val(),
        };


        let response = await custom_ajax('POST', url, data);
        if (response.status == 200) {
            Snackbar.show({
                text: 'Evaluation Recorded Successfully.',
                pos: 'bottom-right',
                backgroundColor: "#35a598"
            });
            $('#modal_rate_now').modal('toggle');
            $(`.rate_now[data-field_name=${field}]`).switchClass("btn-primary", "btn-success", 1000, "easeInOutQuad").text("Rated");
        } else {
            Snackbar.show({
                text: 'Something went wrong! Please try again later',
                pos: 'bottom-right',
                backgroundColor: "#f20000"
            });
        }
    });
</script>



@endpush
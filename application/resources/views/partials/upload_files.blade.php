<div class="row">
    <div class="col-md-6 form-group custom_upload_files">
        <label>{{ $label ?: "Upload Your File" }}</label>
        <input type="file" class="form-control" name="file" id="upload_files">
        <div id="progress-wrp" class="d-none">
            <div class="progress-bar"></div>
            <div class="status">0%</div>
        </div>
    </div>

    @php
    $preview_visible = (!empty($preview_url)) ? "" : "d-none";
    @endphp

    <div class="col-md-6 {{ $preview_visible }}" id="custom_image_view_section">
        <label>Preview </label>
        <div class="bg-ash rounded text-center p-2">
            <a href="#" target="_blank" id="uploaded_image_url">
                <img class="img-fluid rounded p-4" id="uploaded_image_preview" src="{{ asset($preview_url) }}" width="250px" alt="">
            </a>
        </div>
    </div>
    <div class="d-none">
        <input type="text" class="form-control" name="{{ $name }}" value="{{ $value ?: '' }}" id="upload_image_id">
    </div>
</div>





<script>
    // $(document).ready(function(e) {
    //     let upload_image_id = "{{ $value }}";

    //     if (upload_image_id) {
    //         $('#upload_image_id').val(upload_image_id);
    //     }
    // });

    $("#upload_files").on("change", function(e) {

        if ($("#progress-wrp").toggleClass("d-none")) {
            $("#progress-wrp").removeClass("d-none");
        }

        var file = $(this)[0].files[0];
        var upload = new Upload(file);

        // maby check size or type here with upload.getSize() and upload.getType()

        // execute upload
        upload.doUpload();
    });


    var Upload = function(file) {
        this.file = file;
    };

    Upload.prototype.getType = function() {
        return this.file.type;
    };
    Upload.prototype.getSize = function() {
        return this.file.size;
    };
    Upload.prototype.getName = function() {
        return this.file.name;
    };
    Upload.prototype.doUpload = function() {
        var that = this;
        var formData = new FormData();
        var UPLOAD_API_URL = APP_URL + "api/media/upload";

        // add assoc key values, this will be posts values
        formData.append("file", this.file, this.getName());
        formData.append("upload_file", true);

        $.ajax({
            type: "POST",
            url: UPLOAD_API_URL,
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', that.progressHandling, false);
                }
                return myXhr;
            },
            success: function(data) {
                // alert("Media uploaded successfully!");
                // let res_data = JSON.parse(data);
                let res_data = data;
                $('#preview_image').append(`<img id="theImg" src="${APP_URL + res_data.media.file_path}" />`);
                $('#uploaded_image_url').attr('href', APP_URL + res_data.media.file_path);
                $('#uploaded_image_preview').attr('src', APP_URL + res_data.media.file_path);
                $('#upload_image_id').val(res_data.media.id);

                if ($('#custom_image_view_section').hasClass('d-none')) {
                    $('#custom_image_view_section').removeClass('d-none');
                }
            },
            error: function(xhr, status, error) {
                // handle error
                if (status === "timeout") {
                    // alert(msg_timeout);
                } else {
                    // alert(msg_error);
                }

                Snackbar.show({
                    text: 'Something went wrong! Please try again later',
                    pos: 'bottom-right',
                    backgroundColor: "#f20000"
                });
            },
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });
    };

    Upload.prototype.progressHandling = function(event) {
        var percent = 0;
        var position = event.loaded || event.position;
        var total = event.total;
        var progress_bar_id = "#progress-wrp";
        if (event.lengthComputable) {
            percent = Math.ceil(position / total * 100);
        }
        // update progressbars classes so it fits your code
        $(progress_bar_id + " .progress-bar").css("width", +percent + "%");
        $(progress_bar_id + " .status").text(percent + "%");
    };
</script>
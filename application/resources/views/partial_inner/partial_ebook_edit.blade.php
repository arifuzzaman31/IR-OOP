@push('script')

<script type="text/javascript">
    $(document).ready(function(e) {
        let ebook_form_data_exists = @json($ebook_form_data);
        console.log(ebook_form_data_exists);

        $('.ebook_create_form .form-control.dynamic_data').get().forEach(function(entry, index, array) {
            try {
                let component_value = ebook_form_data_exists[entry.name];
                if (component_value) {
                    entry.value = component_value;
                }
            } catch (err) {
                console.log(err);
            }

        });
        // console.log("Input Type: ", entry.type);
        // console.log("Tagname: ", entry.tagName);
        // console.log("Name: ", entry.name);
        // console.log("Value: ", entry.value);
    });
</script>

@endpush
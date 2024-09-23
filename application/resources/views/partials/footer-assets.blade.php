 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

 <script src="{{ asset('admin-assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
 <script src="{{ asset('admin-assets/assets/js/app.js')}}"></script>

 <!-- <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script> -->
 <script src="https://media-library.cloudinary.com/global/all.js"></script>
 <script>
     var baseUrl = "{{ url('/') }}" + '/admin/';
     var clName = "diyc1dizi";
     var clPreset = "467722864351132";
     $(document).ready(function() {
         App.init();
     });
 </script>
 <script src="{{ asset('admin-assets/assets/js/custom.js')}}"></script>
 <!-- END GLOBAL MANDATORY SCRIPTS online@aranya.com.bd Online@aranya123-->

 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
 <script src="{{ asset('admin-assets/assets/js/scrollspyNav.js')}}"></script>
 <script>
     checkall('todoAll', 'todochkbox');
     $('[data-toggle="tooltip"]').tooltip()
 </script>
 <script src="{{ asset('admin-assets/plugins/apex/apexcharts.min.js')}}"></script>
 <script src="{{ asset('admin-assets/assets/js/dashboard/dash_1.js')}}"></script>



 <script>
     $(document).ready(function() {
         $('#cf-form,.cf-form').submit(function(e) {
             e.preventDefault();

             // Serialize the form data
             //  var form = $(this);
             //  console.log(form);
             const formData = new FormData(e.target);
             const URL = $(this).attr('action');
             const METHOD = $(this).attr('method') || 'POST';

             console.log("Form Data: ", formData);
             //  console.log("URL: ", URL);
             // return false;
             // Send an AJAX request
             $.ajax({
                 headers: {
                     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                 },
                 type: METHOD,
                 url: URL,
                 data: formData,
                 dataType: 'json',
                 processData: false,
                 contentType: false,

                 success: function(response) {
                     // Handle the response message
                     $('#cf-response-message').text(response.message);
                     console.log("Response Data: ", response);
                     Snackbar.show({
                         text: 'Your request has been completed successfully.',
                         pos: 'bottom-right',
                         backgroundColor: "#35a598"
                     });
                     setTimeout(window.location.reload(),300);
                    //  window.location.reload();
                 },
                 error: function(xhr, status, error) {
                     // Handle errors if needed
                     console.error(xhr.responseText);
                     alert("Something Went Wrong! Please try again later...");
                 }
             });
         });
     });

     function custom_ajax(METHOD, URL, DATA) {
         return $.ajax({
             headers: {
                 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
             },
             type: METHOD,
             url: URL,
             data: JSON.stringify(DATA),
             dataType: 'json',
             processData: false,
             contentType: "application/json; charset=UTF-8",
         });
     }

     $('.datatable_custom').DataTable({
         "lengthChange": true,
         "responsive": true,
         layout: {
             topStart: 'search',
             topEnd: {
                 buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis', 'pageLength']
             },

         },
         lengthMenu: [10, 25, 50, 100, {
             label: 'All',
             value: -1
         }],

     });

     // Password show and hide
     $(document).on('click', '.toggle-password', function(e) {
         let element_password = document.getElementById($(this).attr('data-toogle-input'));

         if (element_password.type === "password") {
             element_password.type = "text";
         } else {
             element_password.type = "password";
         }
     });
 </script>
<!-- plugins:js -->
<script src="<?php echo base_url();?>/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo base_url();?>/assets/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?php echo base_url();?>/assets/js/off-canvas.js"></script>
<script src="<?php echo base_url();?>/assets/js/misc.js"></script>
<!-- CK Editor for this page-->
<!-- <script src="<?php echo base_url();?>/assets/js/ckeditor.js"></script> -->

<script src="<?php echo base_url();?>/assets/js/toastr.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/dataTables.bootstrap4.min.js"></script>
<!-- Custom js for this page-->
<script src="<?php echo base_url();?>/assets/js/dashboard.js"></script>

<!-- End custom js for this page-->

<script>

    $(document).ready( function () {
        $('.datatable').DataTable();
    } );

    $('.add__new__feature__btn').click((e)=>{
        e.preventDefault();
        $('.add__new__feature').show();
        $('.add__new__feature__btn').hide();
    });

    $('.add__new__feature__cancel').click((e)=>{
        e.preventDefault();
        $('.add__new__feature').hide();
        $('.add__new__feature__btn').show();
    });


    $(document).ready( function () {
        $('.dataTable').DataTable();
    });

    
</script> 

<script>
$(document).ready(function() {
 $('#school_name').on('keypress', function(e) {
  var regex = new RegExp("^[a-zA-Z ]*$");
  var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
  if (regex.test(str)) {
    return true;
  }
  e.preventDefault();
  return false;
 });
 
 $('#school_name').on('focusout', function(e) {
    var mystr = $('#school_name').val();
    var newStr = mystr.replace(/  +/g, ' ');
    $('#school_name').val(newStr);
 });
 

    
    
});
</script>  

<script>
    $(".save__post").click(function(e) {
        var id = $(this).attr('id');
        var formData = new FormData( $("#post_form")[0]);
        formData.append('save_type',id);
        //console.log(formData);
        var url = "<?php echo base_url();?>Upload/add_new_post";
        $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   
                if(data === "success"){
                    $("#post_form").trigger('reset');

                    Swal.fire(
                    'Success!',
                    'Post Published Succesfully!',
                    'success'
                    )

                    $('.ck-content').empty();
                    $('#editor').html('');
                }
                else{
                    Swal.fire(
                    'Try Again!',
                    'Some error occured. Please try again!',
                    'error'
                    )
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            $('.ck-content').focusout(()=>{
                console.log('stopped typing');
                $('#editor').html($('.ck-content').html());
            })
        } )
        .catch( error => {
               // console.error( error );
        } );

    // POST STATUS UPDATE
    $('.post__status__select').change(function(e){
        var post_id = $(this).attr('post_id');
        var save_type = $('.post__status__select').val();
        var formData = new FormData( $("#post_form")[0]);
        formData.append('post_id',post_id);
        formData.append('save_type',save_type);
        var url = "<?php echo base_url();?>Upload/change_post_status";
        $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   
                if(data === "success"){
                    // toastr.success("Post Status Changed Succefully");
                    Swal.fire(
                    'Success!',
                    'Post Status Changed Succefully!',
                    'success'
                    )
                }
                else{
                    // toastr.error("Some error occured. Please try again.");
                    Swal.fire(
                    'Try Again!',
                    'Post Status Changed Failed!',
                    'error'
                    )
                }
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });


    // POST DELETE FUNCTION
    $('.post_delete').click(function(e){
        var post_id = $(this).attr('post_id');
        var element = $(this).parent().parent();
        var url = "<?php echo base_url();?>Upload/delete_post/";
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.value) {
                console.log(post_id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"post_id" : post_id} , 
                    async : true,
                    context: this,
                    success: function(data)
                    {   
                        console.log(data);
                        if(data === "success"){
                            Swal.fire(
                            'Deleted!',
                            'Post has been deleted.',
                            'success'
                            )

                            element.remove();
                        }
                        else{
                            Swal.fire(
                            'Try Again!',
                            'Post Status Changed Failed!',
                            'error'
                            )
                        }
                    }
                });
            }
        e.preventDefault(); // avoid to execute the actual submit of the form.
        });
    });


    // UPDATE POST
    $(".update__post").click(function(e) {
        var id = $(this).attr('id');
        var formData = new FormData($("#update_post_form")[0]);
        formData.append('save_type',id);
        console.log(formData.values());
        var url = "<?php echo base_url();?>Upload/update_post";
        $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   
                console.log(data);
                if(data === "success"){
                    $("#post_form").trigger('reset');
                    Swal.fire(
                    'Success!',
                    'Post Published Succesfully!',
                    'success'
                    )

                    $('.ck-content').empty();
                    $('#editor').html('');
                }
                else{
                    console.log(data);
                    Swal.fire(
                    'Try Again!',
                    'Some error occured. Please try again!',
                    'error'
                    )
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });


    // ADD CLIENT
    $(".add_client").click(function(e) {
        var id = $(this).attr('id');
        var formData = new FormData( $("#add_client_form")[0]);
        //console.log(formData);
        var url = "<?php echo base_url();?>Upload/add_new_client";
        $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   console.log(data);
                if(data === "success"){
                    $("#add_client_form").trigger('reset');

                    Swal.fire(
                    'Success!',
                    'Post Published Succesfully!',
                    'success'
                    )

                    $('.ck-content').empty();
                    $('#editor').html('');
                }
                else{
                    Swal.fire(
                    'Try Again!',
                    'Some error occured. Please try again!',
                    'error'
                    )
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });


    // CLIENT STATUS

    // POST STATUS UPDATE
    $('.client__status__select').change(function(e){
        console.log($(this));
        var client_id = $(this).attr('client_id');
        var status = $('.client__status__select').val();
        console.log($(this).attr('unid'));
        var formData = new FormData();
        formData.append('client_id',client_id);
        formData.append('status',status);
        var url = "<?php echo base_url();?>Upload/change_client_status";
        $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   
                console.log(data);
                if(data === "success"){
                    // toastr.success("Post Status Changed Succefully");
                    Swal.fire(
                    'Success!',
                    'Post Status Changed Succefully!',
                    'success'
                    )
                }
                else{
                    // toastr.error("Some error occured. Please try again.");
                    Swal.fire(
                    'Try Again!',
                    'Post Status Changed Failed!',
                    'error'
                    )
                }
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });


    // CLIENT DELETE
    // POST DELETE FUNCTION
    $('.client_delete').click(function(e){
        var client_id = $(this).attr('client_id');
        var element = $(this).parent().parent();
        var url = "<?php echo base_url();?>Upload/delete_client/";
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.value) {
                console.log(client_id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"client_id" : client_id} , 
                    async : true,
                    context: this,
                    success: function(data)
                    {   
                        console.log(data);
                        if(data === "success"){
                            Swal.fire(
                            'Deleted!',
                            'Client has been deleted.',
                            'success'
                            )

                            element.remove();
                        }
                        else{
                            Swal.fire(
                            'Try Again!',
                            'Client deletion Failed!',
                            'error'
                            )
                        }
                    }
                });
            }
        e.preventDefault(); // avoid to execute the actual submit of the form.
        });
    });


    // UPDATE CLIENT STATE
    $(".update_client").click(function(e) {
        var client_id = $(this).attr('client_id');
        var formData = new FormData($("#update_client_form")[0]);
        formData.append('client_id',client_id);
        console.log(formData.values());
        var url = "<?php echo base_url();?>Upload/update_client";
        $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   
                console.log(data);
                if(data === "success"){
                    $("#post_form").trigger('reset');
                    Swal.fire(
                    'Success!',
                    'Post Published Succesfully!',
                    'success'
                    )

                    $('.ck-content').empty();
                    $('#editor').html('');
                }
                else{
                    console.log(data);
                    Swal.fire(
                    'Try Again!',
                    'Some error occured. Please try again!',
                    'error'
                    )
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });




    // UPDATE CLIENT STATE
    $(".save_home_video").click(function(e) {
        var formData = new FormData($("#home_video_form")[0]);
        var url = "<?php echo base_url();?>Upload/update_home_video";
        $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   
                console.log(data);
                if(data === "success"){
                    Swal.fire(
                    'Success!',
                    'Post Published Succesfully!',
                    'success'
                    )
                }
                else{
                    console.log(data);
                    Swal.fire(
                    'Try Again!',
                    'Some error occured. Please try again!',
                    'error'
                    )
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });



    // ADD NEW FEATURE

    // ADD CLIENT
    $(".add__new__feature__save").click(function(e) {
        var formData = new FormData( $("#package_feature_form")[0]);
        //console.log(formData);
        var url = "<?php echo base_url();?>Upload/add_new_fetaure";
        $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   console.log(data);
                if(data === "success"){
                    $("#package_feature_form").trigger('reset');

                    Swal.fire(
                    'Success!',
                    'Post Published Succesfully!',
                    'success'
                    )

                    $('.ck-content').empty();
                    $('#editor').html('');
                    fetchfeatureList();                    
                }
                else{
                    Swal.fire(
                    'Try Again!',
                    'Some error occured. Please try again!',
                    'error'
                    )
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

    // GET FEATURE LIST

    async function fetchfeatureList() {
        const URL = "<?php echo base_url();?>Upload/get_feature_list";
        const fetchResult = fetch(URL);
        const response = await fetchResult;
        const jsonData = await response.json();
        console.log(jsonData);
        $('.feature__list').html(jsonData);
    }



    $('body').on("click", '.remove__feature', function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
        var feature_id = $(this).attr('feature_id');
        var element = $(this).parent();
        var url = "<?php echo base_url();?>Upload/delete_feature/";
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.value) {
                //console.log(feature_id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"feature_id" : feature_id} , 
                    async : true,
                    context: this,
                    success: function(data)
                    {   
                        console.log(data);
                        if(data === "success"){
                            Swal.fire(
                            'Deleted!',
                            'Feature has been deleted.',
                            'success'
                            )

                            element.remove();
                        }
                        else{
                            Swal.fire(
                            'Try Again!',
                            'Feature deletion Failed!',
                            'error'
                            )
                        }
                    }
                });
            }
       
        });
    });



    $('body').on("click", '.remove__feature__from__package', function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var feature_id = $(this).attr('feature_id');
        var package_id = $(this).attr('package_id');
        var element = $(this).parent();
        var url = "<?php echo base_url();?>Upload/remove_feature_from_package/";
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to remove this feature from package.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {

            if (result.value) {
                //console.log(feature_id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"feature_id" : feature_id, "package_id" : package_id} , 
                    async : true,
                    context: this,
                    success: function(data)
                    {   
                        console.log(data);
                        if(data === "success"){
                            Swal.fire(
                            'Removed',
                            'Feature has been removed.',
                            'success'
                            )

                            element.remove();
                            fetchFeatureListNotInpackage(package_id);
                        }
                        else{
                            Swal.fire(
                            'Try Again!',
                            'Feature removal Failed!',
                            'error'
                            )
                        }
                    }
                });
            }

        });
        });


        async function fetchFeatureListNotInpackage(package_id) {
            const URL = `<?php echo base_url();?>Upload/get_feature_not_in_package/${package_id}`;
            const fetchResult = fetch(URL);
            const response = await fetchResult;
            const jsonData = await response.json();
            console.log(jsonData);
            $('.feature__list__not__in__package').html(jsonData);
        }




        $('body').on("click", '.add__to__package', function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var feature_id = $(this).attr('feature_id');
        var package_id = $(this).attr('package_id');
        var element = $(this).parent().parent();
        var url = "<?php echo base_url();?>Upload/add__feature__to__package";
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to add this feature to this package.",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add it!'
        }).then((result) => {

            if (result.value) {
                //console.log(feature_id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"feature_id" : feature_id, "package_id" : package_id} , 
                    async : true,
                    context: this,
                    success: function(data)
                    {   
                        console.log(data);
                        if(data === "success"){
                            Swal.fire(
                            'Feature Added!',
                            'Feature has been added.',
                            'success'
                            )

                            element.remove();
                            fetchFeaturePackageList(package_id);
                        }
                        else{
                            Swal.fire(
                            'Try Again!',
                            'Feature addition Failed!',
                            'error'
                            )
                        }
                    }
                });
            }

        });
        });


        async function fetchFeaturePackageList(package_id) {
            const URL = `<?php echo base_url();?>Upload/get_package_feature/${package_id}`;
            const fetchResult = fetch(URL);
            const response = await fetchResult;
            const jsonData = await response.json();
            console.log(jsonData);
            $('.feature__list__in__package').html(jsonData);
        }



        $(".save__package__data").click(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var package_id = $(this).attr('package_id');
            var formData = new FormData($("#save_product_data")[0]);
            formData.append('package_id',package_id);
            //console.log(formData);

            var url = "<?php echo base_url();?>Upload/save_package_data";
            
            $.ajax({
                type: "POST",
                url: url,
                data: formData , 
                async : true,
                cache : false,
                contentType : false,
                processData : false,
                success: function(data)
                {   
                    if(data === "success"){
                        $("#save_product_data").trigger('reset');
                        Swal.fire(
                        'Success!',
                        'Data Saved Succesfully!',
                        'success'
                        )
                    }
                    else{
                        Swal.fire(
                        'Try Again!',
                        'Some error occured. Please try again!',
                        'error'
                        )
                    }
                }
            }); 
        });
  $(".add__School__btn").click(function(e) {
        var id = $(this).attr('id');
        var formData = new FormData( $("#add_member_form")[0]);
        console.log(formData);
        var url = "<?php echo base_url();?>home/add_new_admin/create";
          $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   console.log(data);
                if(data== "success"){
                    $("#add_member_form").trigger('reset');

                    Swal.fire(
                    'Success!',
                    'Post Published Succesfully!',
                    'success'
                    )
                    $('.ck-content').empty();
                    $('#editor').html('');
                }
                else{
                    Swal.fire(
                    'Try Again!',
                    'Some error occured. Please try again!',
                    'error'
                    )
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

  $(".add__School__btn2").click(function(e) {
      
        var id = $(this).attr('id');
        var formData = new FormData( $("#add_member_form")[0]);
        console.log(formData);
        var url = "<?php echo base_url();?>home/add_new_admin/do_update";
          $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   console.log(data);
                if(data== "success"){
                    $("#add_member_form").trigger('reset');

                    Swal.fire(
                    'Success!',
                    'Post Published Succesfully!',
                    'success'
                    )
                    $('.ck-content').empty();
                    $('#editor').html('');
                }
                else{
                    Swal.fire(
                    'Try Again!',
                    'Some error occured. Please try again!',
                    'error'
                    )
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
      $(".add__School__btn3").click(function(e) {
        var id = $(this).attr('id');
        var formData = new FormData( $("#add_school_with_subdomain")[0]);
        console.log(formData);
        var url = "<?php echo base_url();?>home/add_new_school_with_subdomain/create_school";
          $.ajax({
            type: "POST",
            url: url,
            data: formData , 
            async : true,
            cache : false,
            contentType : false,
            processData : false,
            success: function(data)
            {   console.log(data);
                if(data== "success"){
                    $("#add_member_form").trigger('reset');

                    Swal.fire(
                    'Success!',
                    'Post Published Succesfully!',
                    'success'
                    )
                    $('.ck-content').empty();
                    $('#editor').html('');
                }
                else{
                    Swal.fire(
                    'Try Again!',
                    'Some error occured. Please try again!',
                    'error'
                    )
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
</script>

<div class="content-wrapper">

    <div class="col-12 text-right p0">
        
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6><strong>Add New Admin</strong></h6>
                    <hr>
                
                    <form  id="add_member_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div class="form-group">
                            <label for="school_name">Name</label>
                            <input type="text" class="form-control" name="user_name" placeholder="Admin Name">
                        </div>

                        <div class="form-group">
                            <label for="school_email">Email ID</label>
                            <input type="text" class="form-control" name="user_email" placeholder="Admin Email">
                        </div>

                        <div class="form-group">
                            <label for="school_phone">Phone Number</label>
                            <input type="text" class="form-control" name="user_phone" placeholder="Admin Email">
                        </div>


                        <div class="form-group">
                            <label for="school_state">Admin Role</label>
                            <select class="form-control" name="user_role">
                                <option value="1">Super Admin</option>
                                <option value="2">Sub Admin</option>
                               
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="contact_person_designation">Admin Password</label>
                            <input type="password" class="form-control" name="user_password" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label for="contact_person_designation">Confirm Password</label>
                            <input type="password" class="form-control" name="user_password_confirm" placeholder="Enter Password Again">
                        </div>
                        
                  
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    
                    <div class="featured__image__wrapper">
                        <h6><strong>Admin Image</strong></h6>
                        <hr>
                        <div class="featured__image">
                            <img src="<?php echo base_url();?>assets/images/dummy_post_img.png"" alt="">
                        </div>
                       <input type="file" name="photo" class="file-upload-default">
                    </div>

                    <div class="save__options mt-4">
                        <hr>
						
                        <a href="" class="btn btn-success mr-2 add__School__btn">Add Admin</a>
                        <a href="" class="btn btn-danger mt-2 mb-2">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	  </form>
</div>


<script>
ClassicEditor
    .create( document.querySelector( '#editor' ), {

    } )
    .then( editor => {
        window.editor = editor;
    } )
    .catch( err => {
        console.error( err.stack );
    } );
	
	  // ADD CLIENT
  
</script>

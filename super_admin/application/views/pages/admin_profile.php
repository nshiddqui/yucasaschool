<div class="content-wrapper">

    <div class="col-12 text-right p0">
        
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6><strong>Admin Profile</strong></h6>
                    <hr>
            
                   <form  id="add_member_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div class="form-group">
                            <label for="school_name">Name</label>
                            <input type="text" class="form-control" name="user_name"  value="<?php echo $client_datass->user_name;?>" placeholder="Admin Name" >
                             <input type="hidden" class="form-control" name="user_id"  value="<?php echo $client_datass->user_id;?>" placeholder="Admin Name" >
                        </div>

                        <div class="form-group">
                            <label for="school_email">Email ID</label>
                            <input type="text" class="form-control" name="user_email" value="<?php echo $client_datass->user_email;?>"  placeholder="Admin Email" readonly>
                        </div>

                        <div class="form-group">
                            <label for="school_phone">Phone Number</label>
                            <input type="text" class="form-control" name="user_phone" value="<?php echo $client_datass->user_phone;?>"  placeholder="Admin Email" >
                        </div>

                          <?php $select= $client_datass->user_role;?>
                          <?php $user_id= $client_datass->user_id;?>
                        <div class="form-group">
                            <label for="school_state">Admin Role</label>
                            <select class="form-control" name="user_role" readonly>
								<option <?php if($select == "1"){echo 'selected';}?> value="1">Super Admin</option>
                                <option <?php if($select == "2"){echo 'selected';}?> value="2">Sub Admin</option>                     
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
                        <h6><strong><?php echo $client_datass->user_name;?> Image</strong></h6>
                        <hr>
                        <div class="featured__image">
                            <img src="<?php echo base_url();?>uploads/admin_image/<?php echo $client_datass->user_id;?>.jpg"" alt="">
                        </div>
                       <input type="file" name="photo" class="file-upload-default">
                    </div>

                    <div class="save__options mt-4">
                        <hr>
                        <a href="" class="btn btn-success mr-2 add__School__btn2">Update Details</a>
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
</script>

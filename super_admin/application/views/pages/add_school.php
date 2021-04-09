<div class="content-wrapper">

    <div class="col-12 text-right p0">
        
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6><strong>Add New School</strong></h6>
                    <hr>
                <form  action="https://digitalflares.com/college_erp/super_admin/home/add_new_school_with_subdomain/create_school" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  
                        <div class="form-group">
                            <label for="school_name">School Name</label>
                            <input type="text" class="form-control" id="school_name" name="school_name" placeholder="School Name">
                        </div>

                        <div class="form-group">
                            <label for="school_email">Email ID</label>
                            <input type="text" class="form-control"id="school_email" name="school_email" placeholder="School Email">
                        </div>

                        <div class="form-group">
                            <label for="school_phone">Phone Number</label>
                            <input type="text" class="form-control" id="school_phone" name="school_phone" placeholder="School Phone">
                        </div>

                        <div class="form-group">
                            <label for="contact_person_name">Contact Person Name</label>
                            <input type="text" class="form-control" name="school_contact_persion" placeholder="Enter Name">
                        </div>

                       
                        
                        <div class="form-group">
                            <label for="school_address">School Address</label>
                            <textarea class="form-control" name="school_address" rows="5" placeholder="School Address"></textarea>
                        </div>

                        <hr>
                        <h6><strong>School Package Information</strong></h6>
                        <hr>
                        <div class="form-group">
                            <label for="school_state">Select Unity ERP Package</label>
                            <select class="form-control" name="school_package" onchange="fetchContent()">
                                <option value="basic">Basic</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advance">Advance</option>
                            </select>
                        </div>


                     <hr class="mt-5">
                        <h6><strong>Database Configuration </strong></h6>
                        <hr>
                        <div class="form-group">
                            <label for="contact_person_designation">Database Name</label>
                            <input type="text" class="form-control" name="db_name" placeholder="Enter Database" >
                        </div>

                        <div class="form-group">
                            <label for="contact_person_designation">Database User</label>
                            <input type="text" class="form-control" name="db_user" placeholder="database User name">
                        </div>

                        <div class="form-group">
                            <label for="contact_person_designation">Database Password</label>
                            <input type="password" class="form-control" name="db_password" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label for="contact_person_designation">Database Confirm Password</label>
                            <input type="password" class="form-control" name="db_password_confirm" placeholder="Enter Password Again">
                        </div>
                        
                    
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    
                    <div class="featured__image__wrapper">
                        <h6><strong>School Logo</strong></h6>
                        <hr>
                        <div class="featured__image">
                            <img src="<?php echo base_url();?>assets/images/dummy_post_img.png" alt="">
                        </div>
                        <input type="file" name="photo" class="file-upload-default">
                    </div>

                    <div class="save__options mt-4">
                        <hr>
                        <input type="submit" class="btn btn-success name="submit" value="Add School">
                        <a href="" class="btn btn-success mr-2 add__School__btn3">Add School</a>
                        <a href="" class="btn btn-danger mt-2 mb-2">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
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

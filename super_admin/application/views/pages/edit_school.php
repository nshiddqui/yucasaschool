<div class="content-wrapper">

    <div class="col-12 text-right p0">
        
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6><strong>Add New School</strong></h6>
                    <hr>
                
                    <form class="forms-sample">
                        <div class="form-group">
                            <label for="school_name">School Name</label>
                            <input type="text" class="form-control" name="school_name" placeholder="School Name">
                        </div>

                        <div class="form-group">
                            <label for="school_email">Email ID</label>
                            <input type="text" class="form-control" name="school_email" placeholder="School Email">
                        </div>

                        <div class="form-group">
                            <label for="school_phone">Phone Number</label>
                            <input type="text" class="form-control" name="school_phone" placeholder="School Email">
                        </div>

                        <div class="form-group">
                            <label for="contact_person_name">Contact Person Name</label>
                            <input type="text" class="form-control" name="contact_person_name" placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <label for="contact_person_designation">Contact Person Designation</label>
                            <input type="text" class="form-control" name="contact_person_designation" placeholder="Enter Designation">
                        </div>

                        <div class="form-group">
                            <label for="school_state">School State</label>
                            <select class="form-control" name="school_state">
                                <option>Delhi</option>
                                <option>Punjab</option>
                                <option>Haryana</option>
                                <option>Uttar Pradesh</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="school_city">School State</label>
                            <select class="form-control" name="school_city">
                                <option>New Delhi</option>
                                <option>Amritsar</option>
                                <option>Gurgaon</option>
                                <option>Noida</option>
                            </select>
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
                            <select class="form-control" name="school_state">
                                <option value="basic">Basic</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advance">Advance</option>
                            </select>
                        </div>

                        <div class="feature__list__wrapper mt-2">
                            <p><strong>Feature included in this package</strong></p>
                            <hr>
                            <ul class="feature__list">
                                <li>Student and Admission Management </li>
                                <li>Student and Admission Management </li>
                                <li>Student and Admission Management </li>
                                <li>Student and Admission Management </li>
                                <li>Student and Admission Management </li>
                                <li>Student and Admission Management </li>
                            </ul>
                        </div>
                        
                    </form>
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
                            <img src="<?php echo base_url();?>assets/images/dummy_post_img.png"" alt="">
                        </div>
                        <input type="file" name="img[]" class="file-upload-default">
                    </div>

                    <div class="save__options mt-4">
                        <hr>
                        <a href="" class="btn btn-success mr-2 add__School__btn">Save</a>
                        <a href="" class="btn btn-danger mt-2 mb-2">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
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

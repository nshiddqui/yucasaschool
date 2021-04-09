<div class="content-wrapper">
            
                
                <?php
if(isset($_POST['school']) && !empty($_POST['school'])) {
     $school= $_POST['school']; 
    $user_role= $_POST['user_role']; 
}
?>
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-cube text-danger icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right">Total Schools</p>
                    <div class="fluid-container">
                    <h3 class="font-weight-medium text-right mb-0">26</h3>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-receipt text-warning icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right">Student Registered</p>
                    <div class="fluid-container">
                    <h3 class="font-weight-medium text-right mb-0">3455</h3>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-poll-box text-success icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right">Teachers Registered</p>
                    <div class="fluid-container">
                    <h3 class="font-weight-medium text-right mb-0">652</h3>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                <div class="float-left">
                    <i class="mdi mdi-account-location text-info icon-lg"></i>
                </div>
                <div class="float-right">
                    <p class="mb-0 text-right">Parents Registered</p>
                    <div class="fluid-container">
                    <h3 class="font-weight-medium text-right mb-0">3652</h3>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <!-- Post Types -->
            <div class="card-body">
                <form method="POST" action="">
                <div class="row">

                    <div class="form-group col-3">
                        <label for="exampleFormControlSelect2"><strong>Select School</strong></label>
                        <select class="form-control" name="school" id="exampleFormControlSelect2">
                            <option>All School Data</option>
                            <option value="unityerp">Unity ERP</option>
                            <option value="dps-rohini">DPS-Rohini</option>
                         
                        </select>
                    </div>

                    <div class="form-group col-3">
                        <label for="exampleFormControlSelect2"><strong>User Type</strong></label>
                        <select class="form-control" name="user_role" id="exampleFormControlSelect2">
                             <option>Select User Type </option>
                            <option value="student">Student's Data</option>
                            <option value="parent">Parent's Data</option>
                            <option value="teacher">Teacher's Data</option>
                        </select>
                    </div>

                
                    <div class="form-group col-3">
                        <label for="exampleFormControlSelect2"><strong></strong></label>
                        <div >
                            <button type="submit" class="btn btn-success btn-block" style="height:35px;">Fetch Data</button>
                        </div>             
                    </div>
                  
                </div>
                  </form>
                <hr>
             
                <div class="table-responsive">
                <table class="table table-hover table-striped blog__post__list dataTable">
                    <thead>
                    <tr>
                        <th>S.L No.</th>
                            <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody>


<?php
error_reporting(0);
  $i=1; 
 if($school !='' || $user_role !=''){ 
     if($user_role=='student'){ 
$url = "https://edurama.in/$school/Web_api/getStudentOwnDashboardData";
}elseif($user_role=='parent'){
 $url = "https://edurama.in/$school/Web_api/getParentOwnDashboardData";   
}elseif($user_role=='teacher'){
 $url = "https://edurama.in/$school/Web_api/getTeacherOwnDashboardData";   
 }
     } 

$content = file_get_contents($url);
$json_data = json_decode($content, true);
    
foreach($json_data as $mydata)

    {

    foreach($mydata as $mydata2){
   

?>  

   <tr>
                        <td><?php echo $i;?></td>
                        <td><img src="<?php echo $mydata2[photo];?>"></td>
                        <td><?php echo $mydata2[name];?></td>
                        <td><?php echo $mydata2[email];?></td>
                        <td><?php echo $mydata2[phone];?></td>
                        <td><?php echo $mydata2[address];?></td>
                        
                    </tr>
    <?php
     $i++;    
    }  
       
    } 
               
?>
                    
            
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

    </div>
</div>
<?php
 //echo "<pre>";
 // print_r($notification); 
// echo "</pre>";
 ?>
<div class="bell-box">
    <section class="content">
	  <div class="row">
      <div class="col-md-12">
		<div class="pull-left">
				<h3 style="margin:0px 0 20px 0">Notification</h3>
			</div>
            <div class="pull-right">
              <div class="btn-group">
			    <button type="button" class="btn btn-green btn-filter" data-target="all">All</button>
                <button type="button" class="btn btn-success btn-filter" data-target="student">Student</button>
                <button type="button" class="btn btn-warning btn-filter" data-target="teacher">Teacher</button>
                <button type="button" class="btn btn-danger btn-filter" data-target="parent">Parent</button>
              </div>
            </div>
	  </div>
	  </div>
	   <div class="row">
	  <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="table-container">
              <table class="table table-filter datatable">
			  <thead>
				<th></th>
			  </thead>
                <tbody>
				        <?php foreach ($notification as $key => $dt) { 

                    if($dt->create_by_role == STUDENT){  ?>
                     <tr data-status="student">
    				          <td><div class="media">
                       <a href="<?php echo base_url('index.php/').$dt->url_link;?>" class="pull-left">
                        <img src="<?php echo $this->crud_model->get_image_url('student',$dt->create_user_id);?>" class="img-circle" width="30" />  </a>   
                         <div class="media-body"> <span class="media-meta pull-right"><?php echo $dt->create_at;?></span>    
                           <h4 class="title"><?php echo $dt->title;?> <span class="pull-right student">( <?php echo @$this->db->get_where('student',array('student_id'=>$dt->create_user_id))->row()->name;?> )</span> </h4>     
                            <p class="summary"><?php echo $dt->msg;?><span class="label label-default">New</span></p></div> 
                             </div>
                           </td>
                      </tr>
    				         <?php } 
                     if($dt->create_by_role == TEACHER){
                      ?> 
                      <tr data-status="teacher">
                      	<td><div class="media"> <a href="<?php echo base_url('index.php/').$dt->url_link;?>" class="pull-left">
    				            	<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo"> </a>    <div class="media-body"> <span class="media-meta pull-right"><?php echo $dt->create_at;?></span>      <h4 class="title"> <?php echo $dt->title;?> <span class="pull-right teacher">( <?php echo @$this->db->get_where('teacher',array('teacher_id'=>$dt->create_user_id))->row()->name;?> )</span> </h4>      <p class="summary"><?php echo $dt->msg;?></p>    </div>  </div></td>
                       </tr>
                     <?php } if($dt->create_by_role == PARENTT){
                      ?>
                       <tr data-status="parent">
                        <td><div class="media"> <a href="<?php echo base_url('index.php/').$dt->url_link;?>" class="pull-left">
    					           	<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo"> </a>    <div class="media-body"> <span class="media-meta pull-right"><?php echo $dt->create_at;?></span>      <h4 class="title"> <?php echo $dt->title;?> <span class="pull-right parent">(  <?php echo @$this->db->get_where('parent',array('parent_id'=>$dt->create_user_id))->row()->name;?> )</span> </h4>      <p class="summary"><?php echo $dt->msg;?><span class="label label-default">New</span></p></div>  </div></td>
                      </tr>
					  
					  <?php } if($dt->create_by_role == 1){
                      ?>
                       <tr data-status="parent">
                        <td><div class="media"> <a href="<?php echo base_url('index.php/').$dt->url_link;?>" class="pull-left">
    					           	<img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo"> </a>    <div class="media-body"> <span class="media-meta pull-right"><?php echo $dt->create_at;?></span>      <h4 class="title"> <?php echo $dt->title;?> <span class="pull-right parent">(  <?php echo @$this->db->get_where('parent',array('parent_id'=>$dt->create_user_id))->row()->name;?> )</span> </h4>      <p class="summary"><?php echo $dt->msg;?><span class="label label-default">New</span></p></div>  </div></td>
                      </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
</div>
<script>
$(document).ready(function () {

	$('.star').on('click', function () {
      $(this).toggleClass('star-checked');
    });

    $('.ckbox label').on('click', function () {
      $(this).parents('tr').toggleClass('selected');
    });

    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });

 });
</script>
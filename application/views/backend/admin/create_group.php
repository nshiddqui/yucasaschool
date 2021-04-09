<form class="" action="<?php echo site_url('admin/group_message/create_group') ?>" method="post">
  <div class="form-group">
    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('group_name');?></label>

    <div class="col-sm-8">
      <input type="text" class="form-control" name="group_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
      data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" required>
    </div>
  </div>
  <ul class="nav nav-tabs bordered">
            <li class="">
                <a href="#student" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="entypo-users"></i></span>
                    <span class="hidden-xs"> Students</span>
                </a>
            </li>
        

            <li class="">
                <a href="#teacher" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs">Teacher</span>
                </a>
            </li>
        

            <li class="">
                <a href="#parent" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs">Parents</span>
                </a>
            </li>
             </ul>


             <div class="tab-content">

<?php
  $user_array = ['student', 'teacher', 'parent'];
  
  for ($i=0; $i < sizeof($user_array); $i++):
    $user_list = $this->db->get($user_array[$i])->result_array();
    ?> 

        <div class="tab-pane <?php if($i ==0){echo 'active';} ?>" id="<?php echo $user_array[$i]; ?>" >

    <div class="col-md-12" style="margin-top: 10px;">
    <table  class="table table-striped datatable">
      <!-- <span class="col-md-6" style="font-size: 13px; color: #616161; text-align: left; padding: 0; margin: 0;"><u><?php echo ucfirst($user_array[$i]) .' List'; ?></u></span> -->
      <span class="col-md-4 pull-right" style="text-align: right; color: #616161;">
        <input type="checkbox" id = "<?php echo $user_array[$i]; ?>" onchange="checkAllBoxes(this)">&nbsp;<?php echo get_phrase('check_all'); ?>
      </span>
      <thead>
        <tr>
          <th><?php echo get_phrase('select'); ?></th>
          <th><?php echo get_phrase('email'); ?></th>
          <th><?php echo get_phrase('name'); ?></th>
		  <?php if($user_array[$i]=='student'){ ?> 
          <th><?php echo get_phrase('Class'); ?></th>
		  <?php } ?>
        </tr>
      </thead>
      <?php foreach ($user_list as $user):?>
        <tr>
          <td width = "20%"><input type="checkbox" class="<?php echo $user_array[$i]; ?>" name="user[]" value="<?php echo $user_array[$i].'_'.$user[$user_array[$i].'_id']; ?>"></td>
          <td width = "25%"><?php echo $user['email'] ?></td>
          <td width = "55%"><?php echo $user['name'] ?></td>
		   <?php if($user_array[$i]=='student'){ ?>
		  <?php $id= $user['student_id'] ;?>
		    <?php $student = $this->db->get_where('enroll',array('student_id'=>$id))->row();
			$class_id=$student->class_id;
           $class_id = $this->db->get_where('class',array('class_id'=>$class_id))->row(); ?>
          <td width = "55%"> <?=$class_id->name;?></td>
		  <?php } ?>
        </tr>
      <?php endforeach ?>
    </table>
  </div>
  </div>
  
<?php endfor; ?>
</div>
<div class="col-md-4 col-md-offset-4" style="text-align: center;">
  <button type="submit" name="submit" class="btn btn-success btn-md"><?php echo get_phrase('done'); ?></button>
</div>
</form>

<script type="text/javascript">
  function checkAllBoxes(check){
    var checkboxes = document.getElementsByTagName('input');

    if (check.checked) {
          $('.'+check.id).prop("checked", true);

     } else {
        $('.'+check.id).prop("checked", false);
     }
  }

    (()=>{
      $('.datatable').dataTable();
    })();

</script>

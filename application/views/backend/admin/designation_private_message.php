     <?php 

     $designation_id = $_POST['designation'];




     if($designation_id == 'student'){

      
      $section_id = $_POST['section_id'];
      $class_id = $_POST['class'];

    // $user_list = $this->db->get($designation_id,)->result_array();

         $user_list = $this->db->get_where('enroll', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();

    
     } else {

    
     $user_list = $this->db->get($designation_id)->result_array();
    }
?>

<link rel=”stylesheet” href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">


<span class="col-md-6" style="font-size: 17px; color: #616161; text-align: left; padding: 0; margin: 0;"><u><?php echo ucfirst($designation_id) .' List'; ?></u></span>



    <table class="order-column" id="example">
        
  
      <thead>
         <tr>
                <th>
                  
                  <?php if(ucfirst($designation_id) == 'Student'){

                  echo get_phrase('Student Name');

                  ?>
                  <h6> <input type="checkbox" onchange="checkAll(this)" name="chk[]" >  Select All <button type="button"   style="
    margin-left: 130px;
" onclick="deleteselect()">Send SMS</button></h6>

                 <?php } else {?>
                   <h6> <input type="checkbox" onchange="teacherall(this)" name="chk[]" >  Select All <button type="button"  style="margin-left: 130px;" onclick="deleteteacherselect()">Send SMS</button></h6>
                   <?php
                     echo get_phrase('Teacher Name');
                  } ?></th>
                <?php if(ucfirst($designation_id) == 'Student'){?>
                <th>
                   <h6> <input type="checkbox" onchange="parentall(this)" name="chk[]" >  Select All <button type="button"   style="
    margin-left: 130px;
" onclick="deleteparentselect()">Send SMS</button></h6>
                  <?php echo get_phrase('Parent Name'); ?></th>
              <?php }?>
             </tr>
         
        
      </thead>
 <tbody>
      <?php foreach ($user_list as $user):?>
        
        <tr>
                  
          <td>
            <?php if(ucfirst($designation_id) == 'Student'){?>
           
            <input type="checkbox" name="input" value="<?php echo $user['student_id']; ?>" style="
    margin-left: -67px;
">

            <?php } elseif (ucfirst($designation_id) == 'Teacher') {?>

                         <input type="checkbox" name="teacherselect" value="<?php echo $user['teacher_id']; ?>" style="
    margin-left: -67px;
">

            <?php } else {?>
                
               <?php } ?>              
            <a href="<?php echo site_url('admin/message/message_read'.$row['message_thread_code']); ?>/<?php echo ucfirst($designation_id); ?>/<?php 
             if(ucfirst($designation_id) == 'Student'){


                echo $user['student_id'];

                } else if(ucfirst($designation_id) == 'Teacher') {
                   echo $user['teacher_id'];
                    } else {
                     echo $user['parent_id'];
                    }
                 ?>" style="padding:10px;"><?php 
                 if(ucfirst($designation_id) == 'Student'){
                   $name = $this->db->get_where('student', array('student_id' => $user['student_id']))->row()->name;

                   echo $name;
                 }else {
                  echo $user['name'];

                 }               

                  ?></a>
                      
          </td>
          <?php if(ucfirst($designation_id) == 'Student'){?>
            <?php $parent_id = $this->db->get_where('student', array('student_id' => $user['student_id']))->row()->parent_id;
             ?>
           <td>
            <input type="checkbox" name="parentselect" value="<?php echo $parent_id; ?>" style="margin-right: 17px;">
<a href="<?php echo site_url('admin/message/message_read'.$row['message_thread_code']); ?>/parent/<?php echo $parent_id; ?>" style="padding:10px;">

              <?php 
                 if(ucfirst($designation_id) == 'Student'){?>


                  <?php 
                   $name = $this->db->get_where('student', array('student_id' => $user['student_id']))->row()->name;
                    $parent_id = $this->db->get_where('student', array('student_id' => $user['student_id']))->row()->parent_id;

                   $parent_name = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->name;

                   echo $parent_name;
                 }else {
                  echo $user['name'];

                 }               

                  ?></a>
                      
          </td>
        <?php } ?>
        </tr>

      <?php endforeach ?>
       </tbody>
    </table>


    <script type="text/javascript">
    function checkAll(ele) {
     var checkboxes = document.getElementsByName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
            
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }


     function teacherall(ele) {
     var checkboxes = document.getElementsByName('teacherselect');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
            
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
   
    

     function parentall(ele) {

     var checkboxes = document.getElementsByName('parentselect');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
            
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
   

       function deleteselect(){

       var items=document.getElementsByName('input');
            var selectedItems=[];
            for(var i=0; i<items.length; i++){
              if(items[i].type=='checkbox' && items[i].checked==true)

                selectedItems.push(items[i].value);
                            
            }

            alert(selectedItems);
            window.location = "<?php echo site_url('admin/message/message_read'); ?>/student/?test="+selectedItems;
         }


         function deleteteacherselect(){
       var items=document.getElementsByName('teacherselect');
            var selectedItems=[];
            for(var i=0; i<items.length; i++){
              if(items[i].type=='checkbox' && items[i].checked==true)

                selectedItems.push(items[i].value);
                            
            }

            alert(selectedItems);
            window.location = "<?php echo site_url('admin/message/message_read'); ?>/teacher/?test="+selectedItems;
         }


         function deleteparentselect(){
       var items=document.getElementsByName('parentselect');
            var selectedItems=[];
            for(var i=0; i<items.length; i++){
              if(items[i].type=='checkbox' && items[i].checked==true)

                selectedItems.push(items[i].value);
                            
            }

            alert(selectedItems);
            window.location = "<?php echo site_url('admin/message/message_read'); ?>/parent/?test="+selectedItems;
         }




      
      $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>

    <style type="text/css">
      
      .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter{
        padding:2px 2px;
        height: 0px;
      }

      .sorting_1 {
    border-top: 1px solid #ddd;
    background: white;
    font-size: 15px;
}

div.dataTables_wrapper div.dataTables_length select{
  margin-top: 10px;
  width: 50px;

}
    </style>
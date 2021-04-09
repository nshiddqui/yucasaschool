<?php $activeTab = "study_material"; ?>
<div class="page-header-content container-fluid">
   <div class="page-header">
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="#"><i class="entypo-home"></i>Home</a></li>
        <li class="active">Study Material</li>
        <a href="#" class="pull-right"><i class="entypo-chat"></i> Support</a>
      </ul>
      <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
    </div>
  </div>

  <!-- Including Navigation Tab -->
<?php include base_path().'application/views/backend/navigation_tab/academic_nav_tab.php'; ?> 
  <!-- Including Navigation Tab -->
</div>
<br>
<button onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_study_material_add');?>');"
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_study_material'); ?>
</button>
<div style="clear:both;"></div>

<table class="table table-bordered" id="table-2">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('title');?></th>
            <th><?php echo get_phrase('description');?></th>
            <th><?php echo get_phrase('class');?></th>
            <th><?php echo get_phrase('subject');?></th>
            <th><?php echo get_phrase('download');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
         foreach ($study_material_info as $row) { ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo date("d M, Y", $row['timestamp']); ?></td>
                <td><?php echo $row['title']?></td>
                <td><?php echo $row['description']?></td>
                <td>
                    <?php echo $name = $this->db->get_where('class' , array('class_id' => $row['class_id'] ))->row()->name;
                    
                        
                        $multi_section  = $this->db->query("select name from section where section_id IN (".$row['section_id'].")")->result();
                        foreach ($multi_section as $key => $dt) {
                            echo '( '; 
                              echo  $dt->name;
                              
                               echo ' )';
                            }    
                      

                        ?>
                </td>
               

                <td>
                    <?php $name = $this->db->get_where('subject' , array('subject_id' => $row['subject_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td>
				
                    <a href="<?php echo base_url().'uploads/document/'.$row['file_name']; ?>" target="_blank" class="btn btn-blue btn-icon icon-left">
                        <i class="entypo-download"></i>
                        <?php echo get_phrase('download');?>
                    </a>
                </td>
                <td>


                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                            <!-- STUDENT MARKSHEET LINK  -->
                            <li>
                               <a  onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_study_material_edit/'.$row['document_id']);?>');"
                                    class="">
                                        <i class="entypo-pencil"></i>
                                        <?php echo get_phrase('edit');?>
                                </a>
                            </li>


                            <li class="divider"></li>
                            <li>
                             <a href="<?php echo site_url('admin/study_material/delete/'.$row['document_id']);?>" class="" onclick="return confirm('Are you sure to delete?');">
                                <i class="entypo-cancel"></i>
                                <?php echo get_phrase('delete');?>
                             </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        $("#table-2").dataTable();
    });
</script>

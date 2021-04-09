<?php   $this->db->select('G.*');
        $this->db->from('guardians AS G');
        //$this->db->join('users AS U', 'U.id = G.user_id', 'left');
        //$this->db->join('roles AS R', 'R.id = U.role_id', 'left');
        $this->db->where('G.id', $param2);
 $guardian = $this->db->get()->row();
?>
<div class="" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li class="active"><a href="#tab_guardian"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> <?php echo $this->lang->line('guardian'); ?> <?php echo $this->lang->line('information'); ?></a> </li>
          </ul>
    <br/>

    <div class="tab-content">
        <div  class="tab-pane fade in active" id="tab_guardian" >    
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th><?php echo $this->lang->line('name'); ?> </th>
                        <td><?php echo $guardian->name; ?></td>
                    </tr>
                
                    <tr>
                        <th><?php echo $this->lang->line('phone'); ?></th>
                        <td><?php echo $guardian->phone; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('profession'); ?></th>
                        <td><?php echo $guardian->profession; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?></th>
                        <td><?php echo $guardian->present_address; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?></th>
                        <td><?php echo $guardian->permanent_address; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('relation'); ?></th>
                        <td><?php echo $guardian->relation; ?></td>
                    </tr>
                     <tr>
                        <th><?php echo $this->lang->line('student'); ?></th>
                        <td><?php echo  @$this->db->get_where('student',array('student_id' => $guardian->student_id))->row()->name; ?></td>
                    </tr>
                                    

                    <tr>
                        <th><?php echo $this->lang->line('photo'); ?></th>
                        <td>
                            <?php if($guardian->photo){ ?>
                            <img src="<?php echo UPLOAD_PATH; ?>/guardian-photo/<?php echo $guardian->photo; ?>" alt="" width="70" /><br/><br/>
                            <?php } ?>  
                        </td>
                    </tr> 
                        <tr>
                        <th>Guardian Id</th>
                        <td>
                            <?php if($guardian->doc_photo){ ?>
                            <img src="<?php echo UPLOAD_PATH; ?>/guardian-photo/<?php echo $guardian->doc_photo; ?>" alt="" width="70" /><br/><br/>
                            <?php } ?>  
                        </td>
                    </tr>					
                    <tr>
                        <th><?php echo $this->lang->line('other_info'); ?></th>
                        <td><?php echo $guardian->other_info; ?>   </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
       
    </div>
</div>
    
    

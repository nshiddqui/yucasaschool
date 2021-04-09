<?php
$month = isset($_POST['month'])? $_POST['month']:'';
$designation_id = isset($_POST['designation_id'])?$_POST['designation_id']:'';
$session_year = isset($_POST['sessional_year']) ? $_POST['sessional_year'] : '';
if($month == 'all'){
    $datefrm = $session_year . '-01-01';
    $dateto = $session_year . '-12-31';
} else {
    $datefrm = $session_year . '-' . $month .'-01';
    $dateto = $session_year . '-' . $month .'-31';
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('list_advance_payment');?>
            	</div>
            </div>

			<div class="panel-body">
				
                    <div class="filter_form">
            <?php echo form_open(); ?>
            <div class="row">
            	<div class="col-md-3">
            		<div class="form-group">
            		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('designation');?></label>
            			<select name="designation_id" class="form-control selectboxit" id = "designation_id">
            				<option value=""><?php echo get_phrase('All');?></option>
            				<?php
            				$designationArray = array();
            					$designation = $this->db->get('designations')->result_array();
            					foreach($designation as $row):
                                                 $designationArray[$row['id']] = $row['name'];       
            				?>
                                            
            				<option value="<?php echo $row['id'];?>" <?= $designation_id == $row['id']?'selected':'' ?>><?php echo $row['name'];?></option>
                                            
            				<?php endforeach;?>
            			</select>
            		</div>
            	</div>
                <div class="col-md-2">
                         <div class="form-group">
                            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('month'); ?></label>
                            <select name="month" class="form-control selectboxit">
                                <option value="all">
                                          All
                                    </option>
                                <?php
                                for ($i = 1; $i <= 12; $i++):
                                    if ($i == 1)
                                        $m = 'january';
                                    else if ($i == 2)
                                        $m = 'february';
                                    else if ($i == 3)
                                        $m = 'march';
                                    else if ($i == 4)
                                        $m = 'april';
                                    else if ($i == 5)
                                        $m = 'may';
                                    else if ($i == 6)
                                        $m = 'june';
                                    else if ($i == 7)
                                        $m = 'july';
                                    else if ($i == 8)
                                        $m = 'august';
                                    else if ($i == 9)
                                        $m = 'september';
                                    else if ($i == 10)
                                        $m = 'october';
                                    else if ($i == 11)
                                        $m = 'november';
                                    else if ($i == 12)
                                        $m = 'december';
                                    ?>
                                    <option value="<?php echo $i; ?>"
                                          <?php if($month == $i) echo 'selected'; ?>  >
                                                <?php echo get_phrase($m); ?>
                                    </option>
                                    <?php
                                endfor;
                                ?>
                            </select>
                         </div>
                    </div>
                
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('sessional_year'); ?></label>
                            <select class="form-control selectboxit" name="sessional_year">
                                <?php
                                $sessional_year_options = explode('-', $running_year); ?>
                                <option value="<?php echo $sessional_year_options[0]; ?>" <?= $session_year == $sessional_year_options[0] ?'selected' : '' ?>><?php echo $sessional_year_options[0]; ?></option>
                                <option value="<?php echo $sessional_year_options[1]; ?>" <?= $session_year == $sessional_year_options[1] ?'selected' : '' ?> ><?php echo $sessional_year_options[1]; ?></option>
                            </select>
                        </div>
                    </div>
                <div class="col-md-2">
            	    <div class="form-group">
            	        <label class="control-label" style="margin-bottom: 5px;">&nbsp;</label>
            		    <button type="submit" id = "submit" class="btn btn-info btn-block"><?php echo get_phrase('Get Report');?></button>
            		</div>
            	</div>
            
            </div>
            <?php echo form_close();?>
            </div>   
					<hr>
					<?php
					if(!empty($month)){
					
					?>
					<table class="table table-bordered datatable" >
    <thead>
        <tr>
            <th style="width: 60px;">#</th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('amount');?></div></th>
            <th><div><?php echo get_phrase('date');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        $option = array();
        if(!empty($designation_id)){
            $option['designation_id'] = $this->input->post('designation_id');
        }
        if(!empty($datefrm) && !empty($dateto)){
            $option['DATE(date) <='] = $dateto;
            $option['DATE(date) >='] = $datefrm;
        }
        $librarians   =   $this->db->get_where('advance_pay',$option)->result_array();
        foreach($librarians as $row): ?>
            <tr>
                <td><?php echo $count++;?></td>
                <td><?php 
                $designationTable = $designationArray[$row['designation_id']];
                if ($this->db->table_exists(lcfirst($designationTable))){
                    echo $this->db->get_where(lcfirst($designationTable),[lcfirst($designationTable).'_id'=>$row['employee_id']])->row_array()['name'];
                }
                ?></td>
                <td><?php echo $row['amount'];?></td>
                <td><?php echo $row['date'];?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php
}
?>

            </div>
        </div>
    </div>
</div>
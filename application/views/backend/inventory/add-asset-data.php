<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">
            <h3><?= $_GET['title']?></h3>
                <form <?php if($asset_mode==1){?>action="<?php echo base_url();?>inventory/add_asset_inventory_damaged"<?php }else{ ?> action="<?php echo base_url();?>inventory/add_asset_inventory"<?php } ?> class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
					<div class="form-group">
                        <label class="control-label col-sm-3">Asset type</label>
                        <div class="col-sm-5">
                            <select name="asset_id" class="form-control col-md-7 col-xs-12" id = "class_selection" required>
                                <option value="">--SELECT ASSET TYPE--</option>
                                <?php
                                $classes = $this->db->get('asset_type')->result_array();
                                foreach ($classes as $row):
                                    ?>
                                  <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $id){echo 'selected';} ?>><?php echo $row['asset_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
					
					<div class="form-group" id="type_name">
						<label for="field-2" class="col-sm-3 control-label">Asset <?php if($asset_mde==0){?>need<?php } ?> <?php if($asset_mde==1){?>damaged<?php } ?> location Type </label>

						<div class="col-sm-5">
							<select name="asset_loc" class="form-control col-md-7 col-xs-12" required>
                                            <option value="">--select--</option>
                                            <option value="1">Class</option>
                                            <option value="2">Hostel</option>
                                            <option value="3">Other Room</option>
                                        </select>
						</div>
					</div>
					
					
					<div class="form-group class_section" style="display:none;">
            <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
            <div class="col-sm-5">
                <select name="class_id" class="form-control" onchange="select_section(this.value)"  id = "class_selection" required>
                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                    <?php
                    $classes = $this->db->get('class')->result_array();
                    foreach ($classes as $row):
                        ?>
                      <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

                    <div class="form-group class_section" style="display:none;">
                    <label class="control-label col-sm-3" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>
                    <div class="col-sm-5">
                            <select name="section_id" id="section_holder" class=" form-control" required>
                                    <option value=""><?php echo get_phrase('select_section'); ?></option>
                            </select>
                        </div>
                    </div>
        
                    <div class="form-group hostel_section" style="display:none;">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('select_hostel'); ?></label>
                        <div class="col-sm-5">
                            <select name="hostel_id" class="form-control" onchange="select_room(this.value)"  id = "hostel_selection" required>
                                <option value=""><?php echo get_phrase('select_hostel'); ?></option>
                                <?php
                                $classes = $this->db->get('hostels')->result_array();
                                foreach ($classes as $row):
                                    ?>
                                  <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
            
                    <div class="form-group hostel_section" style="display:none;">
                        <label class="control-label col-sm-3" style="margin-bottom: 5px;"><?php echo get_phrase('select_room'); ?></label>
                        <div class="col-sm-5">
                            <select name="room_id" id="room_holder" class=" form-control" required>
                                <option value=""><?php echo get_phrase('select_room'); ?></option>
                            </select>
                        </div>
                    </div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Quantity</label>

						<div class="col-sm-5">
							<input type="number" class="form-control" name="quantity" required>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Description/ Reason</label>

						<div class="col-sm-5">
							<textarea class="form-control" id="description" name="description" placeholder="Description/ Reason"></textarea>
						</div>
					</div>
					
					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Submit</button>
						</div>
					</div>
                </form>            </div>
        </div>
    </div>
    <script>
    function select_section(class_id) {
    if (class_id !== '') {
    c_id = class_id;
    $.ajax({
        url: '<?php echo base_url();?>inventory/get_section/' + class_id,
        success:function (response)
        {
            jQuery('#section_holder').html(response);
        }
    });
    }
}


function get_subjectid_by_teacher(value){
      $.ajax({       
      type   : "POST",
      url    : "<?php echo base_url();?>inventory/get_inventory",
      data   : {'subject_id' : value},               
      // async  : false,
      success: function(response){  
        console.log(response);                                                 
        $('#inv_name').append(response);
       }
     });
   }

$('[name=asset_loc]').on('change',function(){
    var selectedCountry = $(this).children("option:selected").val();
    if(selectedCountry=='1'){
        $('.class_section').show();
        $('.hostel_section').hide();
        $('#description').prop('required',false);
    } else if(selectedCountry=='2'){
        $('.class_section').hide();
        $('.hostel_section').show();
        $('#description').prop('required',false);
    } else {
        $('.class_section').hide();
        $('.hostel_section').hide();
        $('#description').prop('required',true);
    }
})

function reload_url() {
    class_selection = $('#class_selection').val();
    section_id = $('#section_id').val();
    template_id = $('#template_id').val();
    if(class_selection != "" && section_id != ""){
      window.location.href = "<?php echo base_url();?>admin/class_timetable/"+class_selection+"/" + section_id+"/"+template_id;
    }
}

function select_section(class_id) {
    if (class_id !== '') {
        c_id = class_id;
        $.ajax({
            method:'POST',
            url: '<?php echo base_url();?>ajax/get_class_by_section/',
            data:{
                'class_id':class_id
            },
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
}

function select_room(class_id){
    if (class_id !== '') {
        c_id = class_id;
        $.ajax({
            method:'POST',
            url: '<?php echo base_url();?>ajax/get_total_room_by_hostel/',
            data:{
                'hostel_id':class_id
            },
            success:function (response)
            {
                jQuery('#room_holder').html(response);
            }
        });
    }
}

    </script>
<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">

                <form action="" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
					<input type='hidden' name='id' value='<?php echo $id?>'>
					<div class="form-group">
            <!--<label class="control-label col-sm-3" style="margin-bottom: 5px;">Asset type</label>-->
            <select name="asset_id" class="form-control col-md-7 col-xs-12" id = "class_selection" required>
                <option value="">--SELECT ASSET TYPE--</option>
                <?php
                $classes = $this->db->get('asset_type')->result_array();
                foreach ($classes as $row):
                    ?>
                  <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $inventory->asset_id){echo 'selected';} ?>><?php echo $row['asset_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
					
					<div class="form-group" id="type_name">
						<label for="field-2" class="col-sm-3 control-label">Asset <?php if($asset_mde==0){?>need<?php } ?> <?php if($asset_mde==1){?>damaged<?php } ?> location Type </label>

						<div class="col-sm-5">
							<select name="asset_loc" class="form-control col-md-7 col-xs-12" required>
                                            <option value="" >--select--</option>
                                            <option value="1" <?php if($inventory->asset_loc == 1){echo 'selected';} ?>>Class</option>
                                            <option value="2" <?php if($inventory->asset_loc == 2){echo 'selected';} ?>>Hostel</option>
                                        </select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Quantity</label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="quantity" value="<?php echo $inventory->quantity; ?>">
						</div>
					</div>
					

        <div class="form-group class_section" style="<?php if($inventory->asset_loc == 2){echo 'display:none';} ?>">
            <!--<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('class'); ?></label>-->
            <select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)"  id = "class_selection" required>
                <option value=""><?php echo get_phrase('select_class'); ?></option>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                  <option value="<?php echo $row['class_id']; ?>" <?php if($row['class_id'] == $inventory->class_id){echo 'selected';} ?>><?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
   

<div id="section_holder" class="class_section" style="<?php if($inventory->asset_loc == 2){echo 'display:none';} ?>">
    <div class="col-md-3">

        <div class="form-group">
            <!--<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('section'); ?></label>-->
            <select name="section_id" id="section_id" class="form-control selectboxit" required>
                <?php
                $sections = $this->db->get_where('section', array(
                            'class_id' => $inventory->class_id
                        ))->result_array();
                foreach ($sections as $row):
                    ?>
                    <option <?php if($row['section_id'] == $inventory->section_id){echo 'selected';} ?> value="<?php echo $row['section_id']; ?>"
                          >
                            <?php echo $row['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

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



function reload_url() {
    class_selection = $('#class_selection').val();
    section_id = $('#section_id').val();
    template_id = $('#template_id').val();
    if(class_selection != "" && section_id != ""){
      window.location.href = "<?php echo base_url();?>admin/class_timetable/"+class_selection+"/" + section_id+"/"+template_id;
    }
}

$('[name=asset_loc]').on('change',function(){
    var selectedCountry = $(this).children("option:selected").val();
    if(selectedCountry=='2'){
        $('.class_section').hide();
    } else {
        $('.class_section').show();
    }
})
    </script>

<!--<div class="col-md-3">-->
<!--	<div class="form-group">-->
<!--	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Select Employee');?></label>-->
		<select name="section_id" id="section_id" class="form-control selectboxit" onchange = "//sectio_id()">
            <option value="">Select Employee</option>
			<?php 
				$designation_name = $this->db->get_where('designations' , array(
					'id' => $class_id))->result_array();


            $designations_name = $designation_name[0]['name'];

            $designations_data = $this->db->get(lcfirst($designations_name))->result_array();

            $primary_id = lcfirst($designations_name)."_id";

				foreach($designations_data as $row):
			?>


			<option value="<?php echo $row[$primary_id];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
<!--	</div>-->
<!--</div>-->

<script type="text/javascript">
   
    $(document).ready(function () {

        // SelectBoxIt Dropdown replacement
        if ($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function (i, el)
            {
                var $this = $(el),
                        opts = {
                            showFirstOption: attrDefault($this, 'first-option', true),
                            'native': attrDefault($this, 'native', false),
                            defaultText: attrDefault($this, 'text', ''),
                        };

                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }
        $('#section_id').removeClass('visible');

    });

</script>
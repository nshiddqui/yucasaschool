<?php //$subjects = $this->db->get_where('subjects', array('class_id' => $class_id))->result_array(); ?>

<?php 
 $subjects = $this->db->query("select * from subject where FIND_IN_SET($class_id,class_id) order by subject_id ASC")->result();
 ?>
<select class="form-control selectboxit" name="subject_id">
    <?php 
	 if(!empty($subjects)) {
	foreach ($subjects as $obj) { ?>
        <option value="<?php echo $obj->subject_id; ?>"><?php echo $obj->name; ?></option>
	 <?php } }  ?>
</select>
<script type="text/javascript">

    // ajax form plugin calls at each modal loading,
    $(document).ready(function() {

        // SelectBoxIt Dropdown replacement
        if($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function(i, el)
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
    });

</script>

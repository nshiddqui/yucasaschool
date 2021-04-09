<?php echo form_open(site_url('admin/change_session') , array('id' => 'session_change'));?>
<li>
	
	<div class="form-group">
		<select name="running_year" class="form-control" onchange="submit()">
		  	<?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
		  		  $total_years  = $this->db->query("select * from academic_years where status = 1 order by session_year asc")->result();
		  	?>
		  	<option value=""><?php echo get_phrase('select_running_session');?></option>
		  	<?php foreach ($total_years as  $dt):?>
		      	<option value="<?php echo $dt->start_year;?>-<?php echo $dt->end_year;?>"
		        <?php if($running_year == $dt->start_year.'-'.$dt->end_year) echo 'selected';?>>
		          	<?php echo $dt->start_year;?>-<?php echo $dt->end_year;?>
		        </option>
		  <?php endforeach;?>
		</select>
	</div>
	
	
</li>
<?php echo form_close();?>



<script type="text/javascript">

    function submit()
    {
    	$('#session_change').submit();
    }
	
</script>
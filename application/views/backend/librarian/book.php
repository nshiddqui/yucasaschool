<hr />
<div class="row">
    <div class="col-md-12">

        <!---CONTROL TABS START-->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('book_list');?>
                        </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_book');?>
                        </a></li>
						
						 <li>
                <a href="#add_bulk" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_bulk_book');?>
                        </a></li>
        </ul>
        <!---CONTROL TABS END-->


        <div class="tab-content">
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="books">
                    <thead>
                        <tr>
                            <th width="40"><div><?php echo get_phrase('book_id');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('author');?></div></th>
                            <th><div><?php echo get_phrase('description');?></div></th>
                            <th><div><?php echo get_phrase('total_book');?></div></th>
                            <th><div><?php echo get_phrase('class');?></div></th>
                            <!--<th><div><?php echo get_phrase('status');?></div></th>-->
                            <th><div><?php echo get_phrase('download');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(site_url('librarian/book/create') , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name"
                                        data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('author');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="author"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('price');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="price"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id" id = "class_id" class="form-control selectboxit" style="width:100%;">
                                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                                        <?php
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row):
                                        ?>
                                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                             <div class="form-group"> <label class="col-sm-3 control-label">File</label> <div class="col-sm-5"> <input type="file" name="file_name" class="form-control"> </div> </div>

                                <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" id = "submit" class="btn btn-info"><?php echo get_phrase('add_book');?></button>
                              </div>
                                </div>
                    </form>
                </div>
            </div>
			
			       <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add_bulk" style="padding: 5px">
                <div class="box-content">
                <?php echo form_open(site_url('librarian/bulk_book_add_using_csv/import') ,
			array('class' => 'form-inline validate', 'style' => 'text-align:center;',  'enctype' => 'multipart/form-data'));?>
<div class="col-md-6">
<div class="row">
<ul class="list-btn">
	<li>
		
		
<a href="http://desktop-22kuple/edurama_pos_full/uploads/library_book_bulk.csv" download>
<button type="button" class="btn btn-primary"><?php echo get_phrase('generate_').'CSV '.get_phrase('file'); ?>
	
		</button>
</a>

</a>
	</li>
	<li>
	<input type="file" name="userfile" class="form-control file2 inline btn btn-info" data-label="<i class='entypo-tag'></i> Select CSV File"
	                   	data-validate="required" data-message-required="<?php echo get_phrase('required'); ?>"
	               		accept="text/csv, .csv" />
	</li>
	<li>
		<button type="submit" class="btn btn-success" name="import_csv" id="import_csv"><?php echo get_phrase('import_CSV'); ?></button>
	</li>
</ul>
</div>
</div>
<?php echo form_close();?>
<div class="col-md-6">
<div class="row">
	<div class="col-md-12">
	<blockquote class="blockquote-blue">
		<p style="font-weight: 700; font-size: 15px;">
			<?php echo get_phrase('please_follow_the_instructions_for_adding_bulk_books:'); ?>
		</p>
			<ol>
				<li style="padding: 5px;"><?php echo get_phrase('at_first_select_the_class_and_section').'.'; ?></li>
				<li style="padding: 5px;"><?php echo get_phrase('after_selecting_class_and_section_click_').'"Generate CSV File".'; ?></li>
				<li style="padding: 5px;"><?php echo get_phrase('open_the_downloaded_').'"bulk_student.csv" File. '.get_phrase('enter_student_details_as_written_in_there_and_remember_take_the_parent_ID_from_parent_table').'.';?></li>
				<li style="padding: 5px;"><?php echo get_phrase('save_the_edited_').'"bulk_student.csv" File.';?></li>
				<li style="padding: 5px;"><?php echo get_phrase('click_the_').'"Select CSV File" '.get_phrase('and_choose_the_file_you_just_edited').'.';?></li>
				<li style="padding: 5px;"><?php echo get_phrase('import_that_file.');?></li>
				<li style="padding: 5px;"><?php echo get_phrase('hit_').'"Import CSV File".';?></li>
			</ol>
			<p style="color: #FF5722; font-weight: 500;">
				***<?php echo get_phrase('this_system_keeps_track_of_duplication_in_email_ID.').' '.get_phrase('so_please_enter_unique_email_ID_for_every_student').'.'; ?>
			</p>
	</blockquote>		
	</div>
</div>
</div>


<a href="" download="library_book_bulk.csv" style="display: none;" id = "bulk">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script type = 'text/javascript'>
    var class_id = '';
    jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#books').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo site_url('librarian/get_books') ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "book_id" },
                { "data": "name" },
                { "data": "author" },
                { "data": "description" },
                { "data": "total_copies" },
                { "data": "class" },
                { "data": "download" },
                { "data": "options" },
            ],
            "columnDefs": [
                {
                    "targets": [1,2,3,5,6,7],
                    "orderable": false
                },
            ]
        });

        $("#submit").attr('disabled', 'disabled');
    });

    function book_edit_modal(book_id) {
        showAjaxModal('<?php echo site_url('modal/popup/modal_edit_book/');?>' + book_id);
    }

    function book_delete_confirm(book_id) {
        confirm_modal('<?php echo site_url('librarian/book/delete/');?>' + book_id);
    }

    function check_validation(){
        if(class_id !== ''){
            $('#submit').removeAttr('disabled');
        }
        else{
            $("#submit").attr('disabled', 'disabled');
        }
    }
    $('#class_id').change(function(){
        class_id = $('#class_id').val();
        check_validation();
    });
</script>
<script type="text/javascript">
var class_selection = '';
jQuery(document).ready(function($) {
$('#submit_button').attr('disabled', 'disabled');

});

	$("#generate_csv").click(function(){
		
			$.ajax({
			  	url: '<?php echo site_url('temp_controller/generate_bulk_book_csvsss/');?>',
			  	success: function(response) {
			    	toastr.success("<?php echo get_phrase('file_generated'); ?>");
						$("#bulk").attr('href', response);
						jQuery('#bulk')[0].click();
			    	//document.location = response;
			  	}
			});
		
	});
</script>
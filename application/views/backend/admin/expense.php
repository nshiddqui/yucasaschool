
<a href="javascript:;" onclick="showAjaxModal('<?php echo site_url('modal/popup/expense_add/');?>');"
class="btn btn-primary pull-right">
<i class="entypo-plus-circled"></i>
<?php echo get_phrase('add_new_expense');?>
</a>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase($_GET['title']);?>
            	</div>
            </div>
            <?php echo form_open(null , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

<div class="panel-body">
				
                
                                <div class="form-group">
                        <label class=" control-label"><?php echo "Date From";?></label>
                       

                            <input type="text" class="form-control datepicker" name="datefrm" value="<?= $_POST['datefrm']?>" data-format="yyyy-mm-dd">
                       
                    </div>
                  </br>
                </br>
                    <div class="form-group">
                        <label class=" control-label"><?php echo "Date To";?></label>
                      
                           <input type="text" class="form-control datepicker" id="dateto" value="<?= $_POST['dateto']?>"  name="dateto" data-format="yyyy-mm-dd">
                     
                    </div>
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('submit');?></button>
						</div>
					</div>

                

            </div>
            
<?php if(isset($_POST['datefrm']) && !empty($_POST['datefrm']) && isset($_POST['dateto']) && !empty($_POST['dateto'])) {?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h3 id="school_title">Total Net Expenses : <?php 
         $sum = $this->db->query("SELECT SUM(amount) as sum FROM payment WHERE `payment_type` = 'expense' AND timestamp BETWEEN '".strtotime($_POST['datefrm'])."' AND '".strtotime($_POST['dateto'])."'")->result_array();
        
        if(empty($sum[0]['sum'])){
          echo "0";
        } else {
          echo $sum[0]['sum'];
        }
        echo "INR" ?> 
    </h3>
</div>
<div>
					<div class="form-group">
                        <div class="col-sm-6">
                            <select name="expense_category_id" class="form-control selectboxit" required>
                                <option value=""><?php echo get_phrase('select_expense_category');?></option>
                                <?php 
                                	$categories = $this->db->get('expense_category')->result_array();
                                	foreach ($categories as $row):
                                ?>
                                <option value="<?php echo $row['expense_category_id'];?>" <?= isset($_POST['expense_category_id']) && $_POST['expense_category_id']==$row['expense_category_id'] ? 'selected':'' ?>><?php echo $row['name'];?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Filter');?></button>
						</div>
                        </div>
                </div>
                <?php echo form_close(); ?>
<table class="table table-bordered" id="expenses">
    <thead>
        <tr>
            <th width="40"><div><?php echo get_phrase('payment_id');?></div></th>
            <th><div><?php echo get_phrase('title');?></div></th>
            <th><div><?php echo get_phrase('category');?></div></th>
            <th><div><?php echo get_phrase('method');?></div></th>
            <th><div><?php echo get_phrase('amount');?></div></th>
            <th><div><?php echo get_phrase('date');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
</table>
</div>
            </div>
            </div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->
<script type="text/javascript">

	jQuery(document).ready(function($) {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#expenses').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url": "<?php echo site_url('admin/get_expenses/'.strtotime($_POST['datefrm']).'/'.strtotime($_POST['dateto'])).'/'.$_POST['expense_category_id'] ?>",
                "dataType": "json",
                "type": "POST",
            },
            "columns": [
                { "data": "payment_id" },
                { "data": "title" },
                { "data": "category" },
                { "data": "method" },
                { "data": "amount" },
                { "data": "date" },
                { "data": "options" },
            ],
            "columnDefs": [
                {
                    "targets": [2,5,6],
                    "orderable": false
                },
            ]
        });
    });

    function expense_edit_modal(payment_id) {
        showAjaxModal('<?php echo site_url('modal/popup/expense_edit/');?>' + payment_id);
    }

    function expense_delete_confirm(payment_id) {
        confirm_modal('<?php echo site_url('admin/expense/delete/');?>' + payment_id);
    }

</script>
<?php } else {
echo form_close();
} ?>
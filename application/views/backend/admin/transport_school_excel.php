<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
            		<?php
            		    if(!empty($_GET['title'])){
            		        echo get_phrase($_GET['title']);
            		        $title = $_GET['title'];
            		    }else{
            		        echo get_phrase('transport_report');
            		        $title = '';
            		    }
            		?>
            	</div>

                <div class="panel-title">
                    <a href="<?php echo site_url('admin/download_transport_school_excel?datefrm='. $datefrm .'&dateto=' .$dateto) ?>">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('export_excel_report');?>
                </a>
                </div>
            </div>

            <style type="text/css">
                
                .main-content ul.nav.nav-tabs > li > a {
                    color: #882e2e;
                    font-size: 10px;
                }
                .bi-light-gray{
                    background:#bac3cf;
                }
            </style>

			<div class="panel-body">

                <ul class="nav nav-tabs">
    <li class="<?= empty($title)?'active':''?> btn bi-blue"><h4><a data-toggle="tab" href="#home">Filled in school</a></h4></li>
    <li style="margin-left:1%" class="btn bi-yellow"><h4><a data-toggle="tab" href="#menu1">Filled at petrol pump</a></h4></li>
    <li class="<?= $title=="Total Service Expenditure"?'active':''?> btn bi-pink" style="margin-left:1%"><h4><a data-toggle="tab" href="#menu2">Expenditure On Service</a></h4></li>
    <li style="margin-left:1%" class="<?= $title=="Vehicle Travelled"?'active':''?> btn bi-green"><h4><a data-toggle="tab" href="#menu3">Total distance travelled bus</a></h4></li>
    <li class=" btn bi-blue" style="margin-left:1%"><h4><a data-toggle="tab" href="#menu4">Vehicle information</a></h4></li>
  </ul>

  <div class="tab-content" style="margin-top:25px">
    <div id="home" class="tab-pane fade <?= empty($title)?'in active':''?>">
    
    <table class="table table-bordered">
        <thead>
          <tr>
       
            <th><?php echo get_phrase('Serial Number'); ?></th>
            <th><?php echo get_phrase('Date'); ?></th>
            <th><?php echo get_phrase('Month'); ?></th>
            <th><?php echo get_phrase('Year'); ?></th>
            <th><?php echo get_phrase('Vehicle number'); ?></th>
            <th><?php echo get_phrase('Product Name'); ?></th>
            <th><?php echo get_phrase('Total Purchased'); ?></th>
            <th><?php echo get_phrase('Distributed'); ?></th>
            <th><?php echo get_phrase('Total Available'); ?></th>
          </tr>
        </thead>
        <tbody>

            <?php 

           
           $data = $this->db->query("SELECT * FROM travelled WHERE inventory_type=1 AND usage_location=2 AND created_at  BETWEEN '$datefrm' AND '$dateto'")->result_array();
        $data_inventory = $this->db->query("SELECT inventory_type,created_at,SUM(name) total FROM inventory_travel WHERE created_at  BETWEEN '$datefrm' AND '$dateto' group by inventory_type")->result_array();

       

            foreach ($data_inventory as $val){
                $name = $val['inventory_type'] == 1 ? 'Diesel' : 'Mobil oil';
            ?>
            <tr>

            <td><?php echo "all"; ?></td>
            <td><?php echo $val['created_at']; ?></td>

            <?php 

            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();
                    if($val['inventory_type']==1){
                      $invname='Diesel';
                      $count_chalk=$val['total'];
                  } 

                  if($val['inventory_type']==2) {
                    $invname='Mobil oil';
                    $count_duster=$val['total'];
                }
            ?>
            <td><?php $dateValue = strtotime($val['created_at']);

$monthName = date('F',$dateValue);
echo $monthName; ?></td>
            <td><?php 
             $parts = explode('-', $val['created_at']);
               echo $parts[0];
             ?></td>
            <td><?php echo ''; ?></td>
            <td><?php echo $invname; ?></td>

            <?php 
             
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            
            // $paid='UNPAID';
            // if($val['cash']!='' && is_numeric($val['cash'])){
            //     $paid='PAID';
            // }

            
            
             if($val['inventory_type']==1){?>
                        <td><?php echo $count_chalk; ?></td>
          <?php  }
            if($val['inventory_type']==2){?>
                        <td><?php echo $count_duster; ?></td>     
           <?php }?>
            


            <td><?php echo ''; ?></td>
            <td><?php echo ''; ?></td>
            
        </tr>
        <?php } ?>

        <?php
            foreach ($data as $val){

             $name = $val['inventory_type'] == 1 ? 'Diesel' : 'Mobil oil';
       
            //$count = $val['inven_id'] == 1 ? 'Chalk' : 'Duster';
            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();
         
               

            $test = '';
            
              if($val['inventory_type'] == 1){
                $count_chalk = $count_chalk - $val['diesel'];
            }
            if($val['inventory_type'] == 2){

                 $count_duster = $count_duster - $val['diesel'];
            }
            
            if($val['inventory_type'] == 1){
            $cnt= $count_chalk;
            }
             if($val['inventory_type'] == 2){
            $cnt=$count_duster;
            }

               
            ?>
            <tr>

            <td><?php echo $val['id']; ?></td>
            <td><?php echo $val['created_at']; ?></td>

         
            <td><?php 
            $dateValue = strtotime($val['created_at']);

$monthName = date('F',$dateValue);
echo $monthName;
 ?></td>
            <td><?php $parts = explode('-', $val['created_at']);
               echo $parts[0]; ?></td>
            <td><?php echo $val['vehicle_no']; ?></td>

            <?php 
             
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            
            // $paid='UNPAID';
            // if($val['cash']!='' && is_numeric($val['cash'])){
            //     $paid='PAID';
            // }

            ?>
            <td><?php echo $name; ?></td>
            <td><?php echo ''; ?></td>
            <td><?php echo $val['diesel']; ?></td>
            <td><?php echo  $cnt; ?></td>
           
        </tr>
        <?php } ?>
         
        </tbody>
      </table>


    </div>

    <div id="menu1" class="tab-pane fade">

    <table class="table table-bordered">
        <thead>
          <tr>
      
            <th><?php echo get_phrase('Serial Number'); ?></th>
            <th><?php echo get_phrase('Date'); ?></th>
            <th><?php echo get_phrase('Month'); ?></th>
            <th><?php echo get_phrase('Year'); ?></th>
            <th><?php echo get_phrase('Vehicle number'); ?></th>
            <th><?php echo get_phrase('Product Name'); ?></th>
            <th><?php echo get_phrase('Total Purchased'); ?></th>
            <th><?php echo get_phrase('Distributed'); ?></th>
            <th><?php echo get_phrase('Total Amount paid'); ?></th>
          </tr>
        </thead>
            <tbody>

            <?php 

           $data_new = $this->db->query("SELECT * FROM travelled WHERE usage_location=1 AND created_at  BETWEEN '$datefrm' AND '$dateto'")->result_array();

            foreach ($data_new as $val){
                $name = $val['inventory_type'] == 1 ? 'Diesel' : 'Mobil oil';
            ?>
            <tr>

            <td><?php echo $val['id']; ?></td>
            <td><?php echo $val['created_at']; ?></td>

            <?php 

            $class_name = $this->db->get_where('vehicles', array('id' => $val['vehicle_no']))->result_array();
            ?>
            <td><?php $dateValue = strtotime($val['created_at']);

$monthName = date('F',$dateValue);
echo $monthName; ?></td>
            <td><?php $parts = explode('-', $val['created_at']);
               echo $parts[0]; ?></td>
            <td><?php echo $val['vehicle_no']; ?></td>

            <?php 
             
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            
            // $paid='UNPAID';
            // if($val['cash']!='' && is_numeric($val['cash'])){
            //     $paid='PAID';
            // }

            ?>
            <td><?php echo $name; ?></td>
            <td><?php echo $val['diesel']; ?></td>
            <td><?php echo $val['diesel']; ?></td>
            <td><?php echo $val['cash']; ?></td>
           
        </tr>
        <?php } ?>
         
        </tbody>
      </table>

    </div>


    <div id="menu2" class="tab-pane fade <?= $title=="Total Service Expenditure"?'in active':''?>">
      <table class="table table-bordered">
        <thead>
          <tr>
       
            <th><?php echo get_phrase('Serial Number'); ?></th>
            <th><?php echo get_phrase('Date'); ?></th>
            <th><?php echo get_phrase('Month'); ?></th>
            <th><?php echo get_phrase('Year'); ?></th>
            <th><?php echo get_phrase('Vehicle number'); ?></th>
            <th><?php echo get_phrase('Service Date'); ?></th>
            <th><?php echo get_phrase('Total Expenditure'); ?></th>
            <th><?php echo get_phrase('Next Service Date'); ?></th>
            <th><?php echo get_phrase('Remarks'); ?></th>
            <th><?php echo get_phrase('Fitness'); ?></th>
          </tr>
        </thead>
         <tbody>

            <?php 

           $data_vehicle = $this->db->query("SELECT * FROM vehicle_service WHERE status='1' AND created_at  BETWEEN '$datefrm' AND '$dateto'")->result_array();

            foreach ($data_vehicle as $val){
                $name = $val['inventory_type'] == 1 ? 'Diesel' : 'Mobil oil';
            ?>
            <tr>

            <td><?php echo $val['id']; ?></td>
            <td><?php echo $val['created_at']; ?></td>

            <?php 

            $class_name = $this->db->get_where('vehicles', array('id' => $val['vehicle_no']))->result_array();
            ?>
            <td><?php $dateValue = strtotime($val['created_at']);

$monthName = date('F',$dateValue);
echo $monthName; ?></td>
            <td><?php $parts = explode('-', $val['created_at']);
               echo $parts[0]; ?></td>
            <td><?php echo $class_name[0]['number']; ?></td>

            <?php 
             
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            
            $paid='UNPAID';
            if($val['cash']!='' && is_numeric($val['cash'])){
                $paid='PAID';
            }

            ?>
            <td><?php echo $val['service_date']; ?></td>
            <td><?php echo $val['total_cost']; ?></td>
            <td><?php echo $val['next_service_date']; ?></td>
            <td><?php echo $val['remark']; ?></td>
            <td><?php echo $val['fitness']; ?></td>

        </tr>
        <?php } ?>
         
        </tbody>
      </table>
    </div>
    <div id="menu3" class="tab-pane fade <?= $title=="Vehicle Travelled"?'in active':''?>">
          <table class="table table-bordered">
        <thead>
          <tr>
   
            <th><?php echo get_phrase('Serial Number'); ?></th>
            <th><?php echo get_phrase('Date'); ?></th>
            <th><?php echo get_phrase('Month'); ?></th>
            <th><?php echo get_phrase('Year'); ?></th>
            <th><?php echo get_phrase('Vehicle number'); ?></th>
            <th><?php echo get_phrase('Start Run'); ?></th>
            <th><?php echo get_phrase('End run'); ?></th>
            <th><?php echo get_phrase('Total run'); ?></th>
            <th><?php echo get_phrase('Need To Be Paid'); ?></th>
            <th><?php echo get_phrase('Total Advanced Payment'); ?></th>
            <th><?php echo get_phrase('Due Amount'); ?></th>
            <th><?php echo get_phrase('Status'); ?></th>
          </tr>
        </thead>
          <tbody>

            <?php 

            $data = $this->db->query("SELECT * FROM travelled WHERE inventory_type=1 AND created_at  BETWEEN '$datefrm' AND '$dateto'")->result_array();

            foreach ($data as $val){
                $name = $val['inventory_type'] == 1 ? 'Diesel' : 'Mobil oil';
            ?>
            <tr>

            <td><?php echo $val['id']; ?></td>
            <td><?php echo $val['created_at']; ?></td>

            <?php 

            $class_name = $this->db->get_where('vehicles', array('id' => $val['vehicle_no']))->result_array();
            ?>
            <td><?php $dateValue = strtotime($val['created_at']);

$monthName = date('F',$dateValue);
echo $monthName; ?></td>
            <td><?php $parts = explode('-', $val['created_at']);
               echo $parts[0]; ?></td>
            <td><?php echo $val['vehicle_no']; ?></td>

            <?php 
             
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            
            $paid='UNPAID';
            if( ($val['advanced_payment'] + $val['due_amount']) == $val['cash'] || $val['cash'] <  ($val['advanced_payment'] + $val['due_amount'])){
                $paid='PAID';
            }

            ?>
            <td><?php echo $val['start_km']; ?></td>
            <td><?php echo $val['end_km']; ?></td>
            <td><?php echo $val['total_distance']; ?></td>
            <td id="cash_<?= $val['id'] ?>"><?php echo $val['cash']; ?></td>
            <?php /*
            $total_advance = $this->db->query("SELECT SUM(amount) as total FROM advance_pay WHERE date = '".$val['created_at']."' AND designation_id ='9' AND employee_id = (SELECT driver FROM vehicles WHERE id='".$val['vehicle_id']."')")->result_array();
            echo "<td>{$total_advance[0]['total']}</td>"; */
            ?>
            <td id="advance_<?= $val['id'] ?>"><?php echo $val['advanced_payment']; ?></td>
            <td contenteditable="true" onfocusout="updateDueAmount('<?= $val['id'] ?>',this)"><?= $val['due_amount'] ?></td>
            <td id="status_<?= $val['id'] ?>"><?php echo $paid; ?></td>

        </tr>
        <?php } ?>
         
        </tbody>
      </table>
    </div>

      <div id="menu4" class="tab-pane fade">
          <table class="table table-bordered">
        <thead>
          <tr>
      
            <th><?php echo get_phrase('Serial Number'); ?></th>
            <th><?php echo get_phrase('Date'); ?></th>
            <th><?php echo get_phrase('Month'); ?></th>
            <th><?php echo get_phrase('Year'); ?></th>
            <th><?php echo get_phrase('Vehicle number'); ?></th>
            <th><?php echo get_phrase('Owner name'); ?></th>
            <th><?php echo get_phrase('Contact no'); ?></th>
            <th><?php echo get_phrase('Alternate Contact no'); ?></th>
            <th><?php echo get_phrase('Driver name'); ?></th>
            <th><?php echo get_phrase('Route'); ?></th>
          </tr>
        </thead>
        <tbody>

            <?php 

            $this->db->select('vehicles.*,routes.title,routes.id as ide,employees.name');
            $this->db->from('vehicles');
            $this->db->join('routes','vehicles.id=routes.vehicle_ids','Left');
            $this->db->join('employees','employees.id=vehicles.driver','Left');
            $query=$this->db->get();
            $data=$query->result_array();
            foreach ($data as $val){
                $name = $val['inventory_type'] == 1 ? 'Diesel' : 'Mobil oil';
            ?>
            <tr>

            <td><?php echo $val['id']; ?></td>
            <td><?php echo $val['created_at']; ?></td>

            <?php 

            $class_name = $this->db->get_where('vehicles', array('id' => $val['vehicle_no']))->result_array();
            ?>
            <td><?php $dateValue = strtotime($val['created_at']);

$monthName = date('F',$dateValue);
echo $monthName; ?></td>
            <td><?php $parts = explode('-', $val['created_at']);
               echo $parts[0]; ?></td>
            <td><?php echo $val['number']; ?></td>

            <?php 
             
            $test = '';

            if($val['start_km'] == '1'){
                $test = 'Avaiable';

            } else {
                $test = "Damaged";

            }
            
            if($val['title']!=''){
                $paid='Not assigned';
            }else{
                $paid=$val['title'];
            }

            ?>
            <td><?php echo $val['owner_name']; ?></td>
            <td><?php echo $val['contact']; ?></td>
            <td><?php echo $val['alternate_contact']; ?></td>
            <td><?php echo $val['name']; ?></td>
            <td><?php echo $paid; ?></td>

        </tr>
        <?php } ?>
         
        </tbody>
      </table>
    </div>


  </div>
				
            </div>
        </div>
    </div>
</div>
<script>
    function updateDueAmount(id,ev){
        var amount = parseInt($(ev).html());
        var advance = parseInt($('#advance_'+id).html());
        var total = parseInt($('#cash_'+id).html());
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('admin/update_travelled_amount'); ?>",
            data   : { id : id,
                        amount:amount
                    },               
            async  : false,
            success: function(response){     
                console.log((advance+amount ));
                console.log(total);
              if((advance+amount ) >= total ){
                  $('#status_'+id).html('PAID');
              }else {
                  $('#status_'+id).html('UNPAID');
              }
            }
        });   
    }
</script>
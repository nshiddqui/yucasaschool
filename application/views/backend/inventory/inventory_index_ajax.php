<?php 

        $data = $this->db->query("SELECT * FROM inventory_warehouse WHERE created_at  BETWEEN '$datefrm' AND '$dateto'")->result_array();
        $data_inventory = $this->db->query("SELECT inventory_type,created_at,SUM(name) total FROM inventory WHERE created_at  BETWEEN '$datefrm' AND '$dateto' group by inventory_type")->result_array();
        //print_r($data_inventory);die;
            
       ?>
       <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export"><thead>
        <tr><th>Serial Number</th>
        <th>Date</th>
        <th>Class</th>
        <th>Product Name</th>
        <th>Total purchased</th>
        <th>Distributed</th>
        <th>Total Available</th></tr> <thead><tbody>
        
        <?php
        $invname='';
        $rows = 1;
        $count_chalk=0;
        $count_duster=0;
        
        $inventryAsset = array();
        
        foreach($inventory_type as $invetryType){
            $inventryAsset[$invetryType->id] = $invetryType->name;
        }
        
        foreach ($data_inventory as $value){
            $invname = $inventryAsset[$value['inventory_type']];
            ${$inventryAsset[$value['inventory_type']]} = $value['total'];
            
            echo "<tr><td>".$rows."</td><td>".$value['created_at']."</td><td></td><td>".$invname."</td><td>".$value['total']."</td><td></td></tr>";
            
           $rows++;
        }
             
          ?>
          
         
          <?php
       
        foreach ($data as $val){
            
            
            //$inventory_name = $this->db->get_where('inventory', array('id' => $val['inven_id']))->result_array();
            $name = $inventryAsset[$val['inven_id']];
            ${$inventryAsset[$val['inven_id']]}=${$inventryAsset[$val['inven_id']]}-$val['quantity'];
            
            //$count = $val['inven_id'] == 1 ? 'Chalk' : 'Duster';
            $class_name = $this->db->get_where('class', array('class_id' => $val['class_id']))->result_array();
            $test = '';

            
            $cnt=${$inventryAsset[$val['inven_id']]};
           
            echo "<tr><td>".$rows."</td><td>".$val['created_at']."</td><td>".$class_name['0']['name']."</td><td>".$name."</td><td></td><td>".$val['quantity']."</td><td>".$cnt."</td></tr>";
            
            $rows++;
        } 
      
        ?>
          </tbody>
        </table>
        
        <div class="col-md-12"><div class="col-md-6">
            <?php 
            foreach($inventryAsset as $key =>$val){
                echo "<br>";
                echo "$val count left: ".${$inventryAsset[$key]};
            }
            ?>
            <br>
        <div class="col-md-6">
        
            <form action="<?= base_url('/admin/download_inventory_excel') ?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
             <input type="hidden" name="datefrm" value="<?php echo $datefrm;?>">
             <input type="hidden" name="dateto" value="<?php echo $dateto;?>">
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" onclick="" class="btn btn-info">Download</button>
						</div>
					</div>

                </form>
            
        </div>
        </div>
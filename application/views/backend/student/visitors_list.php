<hr />
<div class="row">
    <div class="col-md-12">
        <div class="tab-content">
            <div class="tab-pane active" id="home">

                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('visitor_name');?></div></th>
                            <th class="span3"><div><?php echo get_phrase('address');?></div></th>
                            <th><div><?php echo get_phrase('date');?></div></th>
							<th><div><?php echo get_phrase('time');?></div></th>
							<th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('description');?></div></th>
                        </tr>
                
                    </thead>
                     <tbody>
                      <?php  if($visitors != ""){
                        foreach($visitors as $dt){
                            ?>
                         <tr>
                            <td><div><?php echo $dt->name;?></div></td>
                            <td class="span3"><?php echo $dt->coming_from;?></td>
                            <td><?php echo date('d F Y',strtotime($dt->created_at));?></td>
                            <td><?php echo $dt->check_in;?></td>
                            <td><?php echo $dt->phone;?></td>
                            <td><?php echo $dt->note;?></td>
                         </tr>
                      <?php  }} ?>
                     </tbody>
                </table>

            </div>
      
           


        </div>


    </div>
</div>


<script type="text/javascript">


    // jQuery(document).ready(function($) {
    //     $('.datatable').DataTable();
    // });
</script>

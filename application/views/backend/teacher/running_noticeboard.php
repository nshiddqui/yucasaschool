
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('title'); ?></div></th>
            <th><div><?php echo get_phrase('date'); ?></div></th>
         
        <th><div><?php echo get_phrase('options'); ?></div></th>
</tr>
</thead>
<tbody>
    <?php
    $count = 1;
    $notices = $this->db->get_where('noticeboard')->result_array();
    foreach ($notices as $row):
	        ?>
	<?php  $create_timestamp= date('d M Y', $row['create_timestamp']);
	       $todays= date('d M Y'); 
		 if($create_timestamp >= $todays){
		?>

        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $row['notice_title']; ?></td>
            <td><?php echo date('d M,Y', $row['create_timestamp']); ?></td>
         
                     <td>
                                    <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_view_notice/'.$row['notice_id']); ?>');"
                                       class="btn btn-default">
                                        <?php echo get_phrase('view_notice'); ?>
                                    </a>
                                </td>
        </tr>
    <?php 
		}
		endforeach; ?>
</tbody>
</table>


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
		 if($create_timestamp < $todays){
		?>

        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $row['notice_title']; ?></td>
            <td><?php echo date('d M,Y', $row['create_timestamp']); ?></td>
      
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/modal_view_notice/' . $row['notice_id']); ?>');">
                                <i class="entypo-credit-card"></i>
                                <?php echo get_phrase('print/view_notice'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('admin/noticeboard/remove_from_archived/' . $row['notice_id']);?>" >
                                <i class="entypo-home"></i>
                                <?php echo get_phrase('remove_from_archive'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <!-- EDITING LINK -->
                        <li>
                            <a href="<?php echo site_url('admin/noticeboard_edit/' . $row['notice_id']);?>">
                                <i class="entypo-pencil"></i>
                                <?php echo get_phrase('edit'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>

                        <!-- DELETION LINK -->
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo site_url('admin/noticeboard/delete/' . $row['notice_id']);?>');">
                                <i class="entypo-trash"></i>
                                <?php echo get_phrase('delete'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php 
		}
		endforeach; ?>
</tbody>
</table>

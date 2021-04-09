<?php   $route       = $this->db->get_where('routes', array('id' => $param2))->row();
?>

<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?> </th>
            <td><?php echo $route->title; ?></td>
        </tr>        
        <tr>
            <th><?php echo $this->lang->line('route_start'); ?></th>
            <td><?php echo $route->route_start; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('route_end'); ?></th>
            <td><?php echo $route->route_end; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $route->note; ?></td>
        </tr>             
    </tbody>
</table>
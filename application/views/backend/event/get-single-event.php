<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo $this->lang->line('event'); ?> <?php echo $this->lang->line('title'); ?></th>
            <td><?php echo $event->title; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('event_for'); ?> </th>
            <td><?php echo $event->name ? $event->name : $this->lang->line('all'); ?></td>
        </tr>       
        <tr>
            <th><?php echo $this->lang->line('event_place'); ?> </th>
            <td><?php echo $event->event_place; ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('from_date'); ?> </th>
            <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($event->event_from)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('to_date'); ?> </th>
            <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($event->event_to)); ?></td>
        </tr>
        <tr>
            <th><?php echo $this->lang->line('image'); ?></th>
            <td>
                <?php if($event->image){ ?>
                <img src="<?php echo UPLOAD_PATH; ?>/event/<?php echo $event->image; ?>" alt=""  /><br/><br/>
                <?php } ?>
            </td>
        </tr>        
        <tr>
            <th><?php echo $this->lang->line('note'); ?></th>
            <td><?php echo $event->note; ?></td>
        </tr>               
    </tbody>
</table>

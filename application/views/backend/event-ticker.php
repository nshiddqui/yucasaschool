<?php 
$notice_list = get_notice_list(5);


?>
<div class="col-lg-4 col-md-3 col-sm-3">
    <div class="ticker-container">
        <!-- <div class="ticker-caption">
            <p>Breaking News</p>
        </div> -->
        <ul>
            <?php 
            $notice_number = 0;
            foreach($notice_list as $notice) {
                ?>
                <div class="notice_item">
                    <li 
                    notice_title="<?php echo $notice->notice_title;?>" 
                    notice="<?php echo $notice->notice;?>"
                    notice_image = ""
                    >
                        <?php echo $notice->notice_title;?>
                    </li>
                </div>  
                <?php 
            } ?>
           
        </ul>
    </div>
</div>


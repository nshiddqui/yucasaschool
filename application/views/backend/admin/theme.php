<!-- <pre>
<?php print_r($themes); ?>
</pre> -->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-cubes"></i><small> <?php echo $this->lang->line('manage_theme'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>

        <div class="x_content">
            <div class="row">                
                <?php if(isset($themes) && !empty($themes)){ ?>
                    <?php foreach($themes as $obj ){  ?>
                    <?php if($obj->slug != 'custom-theme'){?>
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="theme-box">
                            <img src="<?php echo IMG_URL; ?>theme/<?php echo $obj->slug; ?>.png" alt="" width="285px" height="247px"/>
                            <h4><?php echo $obj->name; ?></h4>
                            <a href="<?php echo site_url('theme/activate/'.$obj->id); ?>"><button class="btn btn-success" style="background: <?php echo $obj->background_color; ?>;border: 1px solid <?php echo $obj->background_color; ?>;">  <?php echo ($obj->is_active) ? '<i class="fa fa-check"></i> '. $this->lang->line('active') : $this->lang->line('activate'); ?></button></a>
                        </div>
                    </div>

                    <?php }?>
                    <?php } ?>
                <?php } ?>
            </div> 
            </div> 

            <div class="container">
                <div class="custom-options row col-10">
                    <form action="<?php base_url();?>theme/add_custom" method="post">
                        <h4>Custom Theme Option</h4>
                        <div class="row color-box">
                            <div class="col-sm-2">
                                <h6>Background Color</h6>
                            </div>
                            <div class="col-sm-9">
                                <input class="jscolor" name="bgcolor" value="<?php echo $themes[2]->background_color?>">
                            </div>
                        </div>
                        <div class="row color-box">
                            <div class="col-sm-2">
                                <h6>Font Color</h6>
                            </div>
                            <div class="col-sm-9">
                                <input class="jscolor" name="fontcolor" value="<?php echo $themes[2]->font_color?>">
                            </div>
                        </div>

                        <div class="row color-box">
                            <div class="col-sm-2">
                                <h6>Icon Color</h6>
                            </div>
                            <div class="col-sm-9">
                                <input class="jscolor" name="iconcolor" value="<?php echo $themes[2]->icon_color?>">
                            </div>
                        </div>

                        <div class="row color-box">
                            <div class="col-sm-2">
                                <h6>Menu Drop Down Color</h6>
                            </div>
                            <div class="col-sm-9">
                                <input class="jscolor" name="mddccolor" value="<?php echo $themes[2]->menu_drop_down_color?>">
                            </div>
                        </div>
                        
                        <div class="row color-box">
                            <div class="col-sm-2">
                                <h6></h6>
                            </div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success">Save Color Scheme</button>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>

            
        </div>
    </div>
</div>


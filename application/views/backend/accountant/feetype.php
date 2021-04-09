<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
           
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_feetype_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="entypo-menu"></i>  <?php echo $this->lang->line('fee_type'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'accounting', 'feetype')){ ?>
                            <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_feetype"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="entypo-plus-circled"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('fee_type'); ?></a> </li>                          
                        <?php } ?>
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_feetype"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('fee_type'); ?></a> </li>                          
                        <?php } ?>                
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_feetype_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('fee_type'); ?></th>
                                        <th><?php echo $this->lang->line('note'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($feetypes) && !empty($feetypes)){ ?>
                                        <?php foreach($feetypes as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>                                          
                                            <td><?php echo $obj->title; ?></td>                                           
                                            <td><?php echo $obj->note; ?></td>
                                            <td>      
                                                <!-- <?php if($obj->head_type == 'fee'){ ?>
                                                    <?php if(has_permission(VIEW, 'accounting', 'feetype')){ ?>
                                                        <a  onclick="get_feetype_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-feetype-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>

                                                        <a onclick='showAjaxModal("http://desktop-22kuple/edurama_full/index.php/modal/popup/get-single-feetype/<?php echo $obj->id; ?>");' class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                        </a> 

                                                    <?php  } ?>
                                                    <?php if(has_permission(EDIT, 'accounting', 'feetype')){ ?>
                                                        <a href="<?php echo site_url('feetype/edit/'.$obj->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                       
                                                    <?php } ?>
                                                    <?php if(has_permission(DELETE, 'accounting', 'feetype')){ ?>
                                                        <a href="<?php echo site_url('feetype/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                    <?php } ?>                                                
                                                <?php } ?>-->


                                                 <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                                        <li>
                                                             <!-- <?php if(has_permission(VIEW, 'accounting', 'feetype')){ ?>
                                                            <a  onclick="get_feetype_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-feetype-modal-lg"  class=""><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a> -->

                                                            <a onclick='showAjaxModal("http://desktop-22kuple/edurama_full/index.php/modal/popup/get-single-feetype/<?php echo $obj->id; ?>");' class=""><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                            </a>
                                                             </li>
                                                        <?php  } ?>
                                                       

                                                        <li>
                                                            <?php if(has_permission(EDIT, 'accounting', 'feetype')){ ?>
                                                                <a href="<?php echo site_url('accountant/feetype_edit/'.$obj->id); ?>" class=""><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                               
                                                            <?php } ?>
                                                        </li>

                                                
                                                        <li class="divider"></li>

                                                        <li>
                                                            <?php if(has_permission(DELETE, 'accounting', 'feetype')){ ?>
                                                                <a href="<?php echo site_url('accountant/feetype_delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class=""><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                            <?php } ?>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_feetype">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('accountant/feetype_add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('fee_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($post['title']) ?  $post['title'] : ''; ?>" placeholder="<?php echo $this->lang->line('fee_type'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""><?php echo $this->lang->line('class'); ?> <?php echo $this->lang->line('name'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 6px;">                                       
                                        <strong>: <?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('amount'); ?></strong>
                                    </div>
                                </div> 
                                <?php $classes = json_decode(json_encode( $classes),FALSE) ; ?>
                                <?php foreach($classes as $obj){ ?>
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="<?php $obj->name; ?>"><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">                                      
                                        <input type="hidden" name="class_id[<?php echo $obj->class_id; ?>]" id="<?php echo $obj->class_id; ?>" value="<?php echo $obj->class_id; ?>" />
                                        <input type="text" class="form-control col-md-7 col-xs-12" name="fee_amount[<?php echo $obj->class_id; ?>]" id="<?php echo $obj->class_id; ?>" value="" required="required" />
                                        <div class="help-block"><?php echo form_error($obj->name); ?></div>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('feetype'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_feetype">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('accountant/feetype_edit/'.$feetype->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('fee_type'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($feetype->title) ?  $feetype->title : $post['title']; ?>" placeholder="<?php echo $this->lang->line('income_head'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>
                               
                                <?php


                                foreach($classes as $obj){ ?>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="<?php $obj->name; ?>"><?php echo $this->lang->line('class'); ?> <?php echo $obj->name; ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        <?php $fee_amount = get_fee_amount($feetype->id, $obj->class_id);?>
                                        <input type="hidden" name="amount_id[<?php echo $obj->class_id; ?>]" value="<?php echo @$fee_amount->id; ?>" />
                                        <input type="hidden" name="class_id[<?php echo $obj->class_id; ?>]" value="<?php echo $obj->class_id; ?>" />
                                        <input type="text" class="form-control col-md-7 col-xs-12" name="fee_amount[<?php echo $obj->class_id; ?>]" id="<?php echo $obj->class_id; ?>" value="<?php echo @$fee_amount->fee_amount; ?>" />
                                        <div class="help-block"><?php echo form_error($obj->name); ?></div>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($feetype->note) ?  $feetype->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($feetype) ? $feetype->id : $id; ?>" name="id" />
                                        <a href="<?php echo site_url('feetype'); ?>"  class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-feetype-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('fee'); ?> <?php echo $this->lang->line('type'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_feetype_data">
            
        </div>       
      </div>
    </div>
</div>
<hr>
<div class="row">
	<div class="col-md-6">
		<?php echo form_open(site_url('admin/student/create/') , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('student_name');?></label>

						<div class="col-sm-6">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus required>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('parent');?></label>

						<div class="col-sm-6">
							<select name="parent_id" class="form-control select2" required>
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
								$parents = $this->db->get('parent')->result_array();
								foreach($parents as $row):
									?>
                            		<option value="<?php echo $row['parent_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>

						<div class="col-sm-6">
							<select name="class_id" class="form-control" data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
                            		<option value="<?php echo $row['class_id'];?>">
											<?php echo $row['name'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('section');?></label>
		                    <div class="col-sm-6">
		                        <select name="section_id" class="form-control" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>

			                    </select>
			                </div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student_id');?></label>

						<div class="col-sm-6">
							<input type="text" class="form-control" name="student_code" value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" data-validate="required" id="class_id"
								data-message-required="<?php echo get_phrase('value_required');?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('date_of_admission');?></label>

						<div class="col-sm-6">
							<input type="text" class="form-control datepicker" name="student_code" id="date_of_admission">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>

						<div class="col-sm-6">
							<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>

						<div class="col-sm-6">
							<select name="sex" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="male"><?php echo get_phrase('male');?></option>
                              <option value="female"><?php echo get_phrase('female');?></option>
                          </select>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

						<div class="col-sm-6">
							<input type="text" class="form-control" name="address" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

						<div class="col-sm-6">
							<input type="text" class="form-control" name="phone" value="" >
						</div>
					</div>
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('apply_now');?></button>
						</div>
					</div>
                <?php echo form_close();?>
	</div>
	<div class="col-md-6 certificates" align="center">
		<div class="col-md-12" id="img" style="border: 1px solid rgb(204, 204, 204); border-radius: 5px; background: url(&quot;https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1468665773.jpg&quot;) 0% 0% / 100% 100% no-repeat; padding-top: 220px; padding-bottom: 150px;">
		<h2>aftaab</h2>
		<h4><strong>rahul</strong></h4>
		<ul class="list-unstyled">
			<li style="font-weight:bold; color:#000; padding-bottom:10px;">PRIVILEGED WITH</li>
			<li style="font-weight:bold; color:#662B00;padding-bottom:10px;">30 Trees</li>
			<li style="font-weight:bold; color:#000;padding-bottom:10px;">AT</li>
			<li style="font-weight:bold; color:#662B00;padding-bottom:10px;">Koriya District of chhattisgarh</li>
			<li style="font-weight:bold; color:#000;padding-bottom:10px;">WITH <br> GREEN WISHES FROM</li>
		</ul>
		<h3><strong><span id="sendername">sonu</span></strong></h3>
		
		<ul class="list-unstyled">
			<li><span id="messager">good for health</span></li>
		</ul>
		</div>
	</div>
</div>
<br/>
<!--  Demos -->
    <section id="demos">
        <div class="large-12 columns">
		 <h1 class="text-center">Choose Certificate Cover</h1>
          <div class="owl-carousel owl-theme">
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1413888530al.jpg" alt="" onclick="imagechange('1413888530al.jpg')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1435642783.jpg" alt="" onclick="imagechange('1435642783.jpg')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1468665773.jpg" alt="" onclick="imagechange('1468665773.jpg')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1442207422h_chaturthi.jpg" alt="" onclick="imagechange('1442207422h_chaturthi.jpg')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1440395279shtami.jpg" alt="" onclick="imagechange('1440395279shtami.jpg')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1468665773.jpg" alt="" onclick="imagechange('1468665773.jpg')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1417517992tmas_Certificate_New.jpg" alt="" onclick="imagechange('1417517992tmas_Certificate_New.jpg')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1444040873.jpg" alt="" onclick="imagechange('1444040873.jpg')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1444305374hra2.jpg" alt="" onclick="imagechange('1444305374hra2.jpg')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1451712820016.jpg" alt="" onclick="imagechange('1451712820016.jpg')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1452595335_republic-day-upload.png" alt="" onclick="imagechange('1452595335_republic-day-upload.png')">
            </div>
            <div class="item">
              <img class="img-responsive" src="https://plantyourtrees.com/assets/sitesfile/image/certificates/medium/1413888657.jpg" alt="" onclick="imagechange('1413888657.jpg')">
            </div>
          </div>
          <script>
            $(document).ready(function() {
              $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 3,
                    nav: false
                  },
                  1000: {
                    items: 5,
                    nav: true,
                    loop: false,
                    margin: 20
                  }
                }
              })
            })
          </script>
        </div>
    </section>
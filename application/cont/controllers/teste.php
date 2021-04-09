<?php echo $header;  ?>
<style>

</style>
<div class="container">
  <ul class="breadcrumb">  
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="row">
        <?php if ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-5'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-5'; ?>
        <?php } ?>
        <div class="col-sm-2 small-img col-xs-12">
          <div id="gallery_02">
            <?php $text=''; if ($images) { 
          $count = count($images);
           $images=array_reverse($images);
          ?>
            <?php $i=0; foreach ($images as $img_id => $image) { 
          if($img_id<$count){ if($i<$count-1){
if (strpos($image['popup'], 'vendors') !== false) {
	if (strpos($image['popup'], 'vendors') !== false) {  $var=str_replace(" ","-",$heading_title).'-'.$i;
$vend=explode('#',$image["popup"]);
 }
?>
           <?php  $text= '<li class="image-additional"><a href="" class="thumbnail videohide showme" data-id="'.$var.'" data-zoom-image="'.$image["popup"].'" data-image="'.$image["popup"].'" title="'.$heading_title.'"> <img src="'.$image["thumb"].'" class="show" title="'.$heading_title.'" alt="'.$heading_title.'" /></a></li>';?>
<?php }else{ ?>
<li class="image-additional"><a href="" class="thumbnail videohide <?php if (strpos($image['popup'], 'vendors') !== false) {  echo "showme";}?>" data-id="<?php if (strpos($image['popup'], 'vendors') !== false) {  echo str_replace(" ","-",$heading_title).'-'.$i; }?>" data-zoom-image="<?php echo $image['popup']; ?>" data-image="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>"> <img src="<?php echo $image['thumb']; ?>" class="show" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
<?php } ?>
            <?php  } } $i++;}
if(file_exists(DIR_UPLOAD_VENDOR.$vend[0])){
echo $text;
}

			}?>
          </div>
          <div>
            <?php if ($images) { 
          $count = count($images);
          ?>
            <?php foreach ($images as $img_id => $image) { 
//if($img_id==$count-1){ earlier one code//
          if($img_id==$count){?>
            <li class="image-additional"><a href="javascript:void(0);" id="videoshow" class="thumbnail"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
            <?php } } }?>
          </div>
        </div>
        <div class="<?php echo $class; ?> col-xs-12">
          <?php if ($thumb || $images) { ?>
          <ul class="thumbnails">
            <?php if ($thumb) { ?>
            <li class="text-center"><div class="img-drag"></div><a id="proimg" class="thumbnail" href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>"><img id="img1" data-zoom-image="<?php echo $popup; ?>" src="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>"/></a>

              <iframe id="provideo" width="300" height="500" src="" autoplay loop style="display: none">
                
              </iframe>
            </li>
            <?php } ?>
            <?php foreach ($products as $product) { ?>
            <?php } ?>
          </ul>
          <?php } ?>
        </div>
        <?php if ($column_left || $column_right) { ?>
        <?php $class = 'col-sm-5'; ?>
        <?php } else { ?>
        <?php $class = 'col-sm-4 pro-detail col-xs-12'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?>">
          <h1><a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></h1>
          <h2><?php echo $heading_title; ?></h2>
          <ul class="list-unstyled">
            <?php if ($manufacturer) { ?>
            <!--<li><a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></li>-->
            <?php } ?>
        <li><?php echo $text_model; ?> <?php echo $model; ?></li>
        <li><?php echo $text_deltime; ?> <?php echo $deltime; ?></li>
          </ul>
          <?php if ($price) { ?>
          <ul class="list-unstyled">
            <?php if (!$special) { ?>
            <li>
              <h2><?php echo $price; ?></h2>
            </li>
            <?php } else { ?>
            <!--<li><span style="text-decoration: line-through;"><?php echo $price; ?></span></li>-->
            <li>
              <h2><?php echo $special; ?></h2>
            </li>
            <?php } ?>
            <?php if ($tax) { ?>
            <!--<li><?php echo $text_tax; ?> <?php echo $tax; ?></li>-->
            <?php } ?>
            <?php if ($points) { ?>
            <!--<li><?php echo $text_points; ?> <?php echo $points; ?></li>-->
            <?php } ?>
            <?php if ($discounts) { ?>
            <!--<li>
              <hr>
            </li>-->
            <?php foreach ($discounts as $discount) { ?>
            <!--<li><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><?php echo $discount['price']; ?></li>-->
            <?php } ?>
            <?php } ?>
          </ul>
          <?php } ?>
          <br>
          <div id="product">
            <?php if ($options) { ?>
            <?php foreach ($options as $option) { ?>
            <?php if ($option['type'] == 'select') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>" style="width: 70%;
    float: left;
    margin-right: 10px;"> 
              <!--<label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>-->
              <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
                <option value="">Choose Size</option>
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                <?php } ?>
                </option>
                <?php } ?>
              </select>
            </div>
            <p class="sg" onclick="pop('popDiv')" style="margin-top:10px;line-height: 50px;"><span>View Size Guide</span></p>
            <?php } ?>
            <?php if ($option['type'] == 'radio') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php if ($option_value['image']) { ?>
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" />
                    <?php } ?>
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'checkbox') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php if ($option_value['image']) { ?>
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" />
                    <?php } ?>
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'text') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'textarea') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <textarea name="option[<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control"><?php echo $option['value']; ?></textarea>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'file') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
              <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'date') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group date">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'datetime') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group datetime">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'time') { ?>
            <div class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group time">
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php if ($recurrings) { ?>
            <hr>
            <h3><?php echo $text_payment_recurring; ?></h3>
            <div class="form-group required">
              <select name="recurring_id" class="form-control">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($recurrings as $recurring) { ?>
                <option value="<?php echo $recurring['recurring_id']; ?>"><?php echo $recurring['name']; ?></option>
                <?php } ?>
              </select>
              <div class="help-block" id="recurring-description"></div>
            </div>
            <?php } ?>
            <div class="form-group"> 
              <!--<label class="control-label" for="input-quantity"><?php echo $entry_qty; ?></label>
              <input type="text" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />-->
              <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
              <br />
              <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block"><?php echo $button_cart; ?></button>
              <button type="button" id="button-wishlist"  class="btn btn-default" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product_id; ?>');"><?php echo $button_wishlist; ?></button>
              <button type="button" id="button-compare" data-toggle="tooltip" class="btn btn-default hidden" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product_id; ?>');"><?php echo $button_compare; ?></button>
            </div>
            <div class="panel-group" id="accordion"> 
              <!--<div class="panel single-accordion"> <a href="#accordion-1" data-parent="#accordion" data-toggle="collapse" class="accordion-head">SIZE & FIT INFORMATION</a>
                <div class="collapse in" id="accordion-1">
                  <div class="accordion-body fix">
                    <p>
                    <li>text 1</li>
                    <li>text 2</li>
                    <li>text 3</li>
                    </p>
                  </div>
                </div>
              </div>-->
              <div class="panel single-accordion"> <a href="#accordion-2" data-parent="#accordion" data-toggle="collapse" class="accordion-head">EDITORS' NOTES</a>
                <div class="collapse in" id="accordion-2">
                  <div class="accordion-body fix">
                    <p><?php echo $description; ?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12" style="padding: 0;">
              <h2>Share This Product</h2>
              <!-- Go to www.addthis.com/dashboard to customize your tools -->
              <div class="addthis_inline_share_toolbox"></div>
            </div>
            <?php if ($minimum > 1) { ?>
            <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_minimum; ?></div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php if ($products) { ?>
      <h2 class="text-center"><?php echo $text_related; ?></h2>
      <br>
      <div class="row">
        <?php $i = 0; ?>
        <?php foreach ($products as $product) { ?>
        <?php if ($column_left && $column_right) { ?>
        <?php $class = 'col-xs-8 col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
        <?php $class = 'col-xs-6 col-md-4'; ?>
        <?php } else { ?>
        <?php $class = 'col-xs-6 col-sm-3'; ?>
        <?php } ?>
        <div class="<?php echo $class; ?>">
          <div class="product-thumb transition">
            <div class="image" style="position: relative;"> <a href="<?php echo $product['href']; ?>"> <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive thumb-mmosolution"  /> <img src="<?php echo ($product['mmos_thumb_related']) ?  $product['mmos_thumb_related']  : $product['thumb'] ; ?>" class="img-responsive" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /> </a> </div>
            <div class="caption">
              <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
              <?php if ($product['rating']) { ?>
              <div class="rating">
                <?php for ($j = 1; $j <= 5; $j++) { ?>
                <?php if ($product['rating'] < $j) { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                <?php } ?>
                <?php } ?>
              </div>
              <?php } ?>
              <?php if ($product['price']) { ?>
              <p class="price">
                <?php if (!$product['special']) { ?>
                <?php echo $product['price']; ?>
                <?php } else { ?>
                <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                <?php } ?>
              </p>
              <?php } ?>
            </div>
            <div class="button-group">
              <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo $product['minimum']; ?>');"><span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span> <i class="fa fa-shopping-cart"></i></button>
              <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
              <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
            </div>
          </div>
        </div>
        <?php if (($column_left && $column_right) && (($i+1) % 2 == 0)) { ?>
        <div class="clearfix visible-md visible-sm"></div>
        <?php } elseif (($column_left || $column_right) && (($i+1) % 3 == 0)) { ?>
        <div class="clearfix visible-md"></div>
        <?php } elseif (($i+1) % 4 == 0) { ?>
        <div class="clearfix visible-md"></div>
        <?php } ?>
        <?php $i++; ?>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($tags) { ?>
      <p><?php echo $text_tags; ?>
        <?php for ($i = 0; $i < count($tags); $i++) { ?>
        <?php if ($i < (count($tags) - 1)) { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
        <?php } else { ?>
        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
        <?php } ?>
        <?php } ?>
      </p>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<script type="text/javascript">
$('#videoshow').click(function(){
    $('#proimg').hide();
    $('.zoomContainer').hide();
    $('#provideo').show();
  });
$('.videohide').click(function(){
    $('#provideo').hide();
    $('#img1').show();
$('#proimg').show();
    $('.zoomContainer').show();
  });
$('.showme').click(function(){
var a=$(this).attr("data-id");
var b=$(this).attr("data-image");

    $('.show').hide();
$('#img1').hide();
$('#provideo').attr("src", b);
    $('#provideo').show();
    $('.zoomContainer').hide();
  });
$('#provideo').click(function() {
    if (this.paused) {
        this.play();
    } else {
        this.pause();
    }
});
</script> 
<script type="text/javascript"><!--
$('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#recurring-description').html('');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();

			if (json['success']) {
				$('#recurring-description').html(json['success']);
			}
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('#button-cart').on('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();
			$('.form-group').removeClass('has-error');

			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
						var element = $('#input-option' + i.replace('_', '-'));

						if (element.parent().hasClass('input-group')) {
							element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						} else {
							element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
						}
					}
				}

				if (json['error']['recurring']) {
					$('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
				}

				// Highlight any found errors
				$('.text-danger').parent().addClass('has-error');
			}

			if (json['success']) {
				$('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');

				$('#cart > ul').load('index.php?route=common/cart/info ul li');

        $('#cart').addClass('open');
			}
		},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
	});
});
//--></script> 
<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').val(json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script> 
<script type="text/javascript"><!--
$('#review').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').on('click', function() {
	$.ajax({
		url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
		type: 'post',
		dataType: 'json',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
			}
		}
	});
});

$(document).ready(function() {
	$('.thumbnails').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled:true
		}
	});
});
//--></script>
<script type="text/javascript">
$(document).ready(function() {
$("#img1").elevateZoom({ gallery: 'gallery_02', cursor: 'pointer', galleryActiveClass: "active" });
$("#img1").bind("click", function(e) {
var ez = $('#img1').data('elevateZoom');
ez.closeAll();
$.fancybox(ez.getGalleryList());
return false;
});
});
</script> 
<script type="text/javascript">
      function pop(div) {
        document.getElementById(div).style.display = 'block';
      }
      function hide(div) {
        document.getElementById(div).style.display = 'none';
      }
      //To detect escape button
      document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.keyCode == 27) {
          hide('popDiv');
        }
      };
    </script> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58f59b538c02862f"></script>
<style type="text/css">#at-expanding-share-button{display: none;}</style>
<?php echo $footer; ?> 
<div id="popDiv" class="ontop">
  <div class="popbg"></div>
  <div id="popup"><a onClick="hide('popDiv')" class="close">Close</a>
    <div class="col-md-12">
      <div class="panel with-nav-tabs panel-danger">
        <div class="panel-heading">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#women_size_guide" data-toggle="tab">WOMEN'S SIZE GUIDE</a></li>
            <li><a href="#men_size_guide" data-toggle="tab">MEN'S SIZE GUIDE</a></li>
          </ul>
        </div>
        <div class="panel-body">
          <div class="tab-content">
            <div class="tab-pane fade in active" id="women_size_guide">
              <div id="women_size_guide">
                <h4>WOMEN'S CLOTHING SIZE CHART</h4>
                <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>&nbsp;</td>
                      <td><strong>XS</strong></td>
                      <td><strong>S</strong></td>
                      <td><strong>M</strong></td>
                      <td><strong>L</strong></td>
                      <td><strong>XL</strong></td>
                      <td><strong>XXL</strong></td>
                      <td><strong>XXXL</strong></td>
                    </tr>
                    <tr>
                      <td><strong>UK</strong></td>
                      <td>8</td>
                      <td>10</td>
                      <td>12</td>
                      <td>14</td>
                      <td>16</td>
                      <td>18</td>
                      <td>20</td>
                    </tr>
                    <tr>
                      <td><strong>US</strong></td>
                      <td>4</td>
                      <td>6</td>
                      <td>8</td>
                      <td>10</td>
                      <td>12</td>
                      <td>14</td>
                      <td>16</td>
                    </tr>
                    <tr>
                      <td><strong>ITALY</strong></td>
                      <td>40</td>
                      <td>42</td>
                      <td>44</td>
                      <td>46</td>
                      <td>48</td>
                      <td>50</td>
                      <td>52</td>
                    </tr>
                    <tr>
                      <td><strong>FRANCE</strong></td>
                      <td>36</td>
                      <td>38</td>
                      <td>40</td>
                      <td>42</td>
                      <td>44</td>
                      <td>46</td>
                      <td>48</td>
                    </tr>
                    <tr>
                      <td><strong>AUSTRALIA</strong></td>
                      <td>12</td>
                      <td>14</td>
                      <td>16</td>
                      <td>18</td>
                      <td>20</td>
                      <td>22</td>
                      <td>24</td>
                    </tr>
                    <tr>
                      <td><strong>JAPAN</strong></td>
                      <td>7</td>
                      <td>9</td>
                      <td>11</td>
                      <td>13</td>
                      <td>15</td>
                      <td>17</td>
                      <td>19</td>
                    </tr>
                  </tbody>
                </table>
                </div>
                <div class="sub-heading">WOMEN'S SIZE GUIDE (INCHES)</div>
                <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>&nbsp;</td>
                      <td><strong>XS</strong></td>
                      <td><strong>S</strong></td>
                      <td><strong>M</strong></td>
                      <td><strong>L</strong></td>
                      <td><strong>XL</strong></td>
                    </tr>
                    <tr>
                      <td><strong>BUST</strong></td>
                      <td>32</td>
                      <td>34</td>
                      <td>36</td>
                      <td>38</td>
                      <td>40</td>
                    </tr>
                    <tr>
                      <td><strong>WAIST</strong></td>
                      <td>25</td>
                      <td>26</td>
                      <td>28</td>
                      <td>30</td>
                      <td>32</td>
                    </tr>
                    <tr>
                      <td><strong>HIP</strong></td>
                      <td>34</td>
                      <td>36</td>
                      <td>38</td>
                      <td>40</td>
                      <td>42</td>
                    </tr>
                  </tbody>
                </table>
                </div>
                <div class="sub-heading">WOMENS SHOE SIZE GUIDE</div>
                <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><strong>INDIA</strong></td>
                      <td>3</td>
                      <td>4</td>
                      <td>5</td>
                      <td>6</td>
                      <td>7</td>
                      <td>8</td>
                    </tr>
                    <tr>
                      <td><strong>UK</strong></td>
                      <td>3</td>
                      <td>4</td>
                      <td>5</td>
                      <td>6</td>
                      <td>7</td>
                      <td>8</td>
                    </tr>
                    <tr>
                      <td><strong>US</strong></td>
                      <td>6</td>
                      <td>7</td>
                      <td>8</td>
                      <td>9</td>
                      <td>10</td>
                      <td>11</td>
                    </tr>
                    <tr>
                      <td><strong>FRANCE</strong></td>
                      <td>37</td>
                      <td>38</td>
                      <td>39</td>
                      <td>40</td>
                      <td>41</td>
                      <td>42</td>
                    </tr>
                    <tr>
                      <td><strong>ITALY</strong></td>
                      <td>36</td>
                      <td>37</td>
                      <td>38</td>
                      <td>39</td>
                      <td>40</td>
                      <td>41</td>
                    </tr>
                  </tbody>
                </table>
                </div>
                <p class="text">This is a standard size guide for the basic body measurements. Length will vary according to style. There may also be variations in some brands commonly with Indian clothing so please refer to the Product Measurements displayed on the product page. Alternatively, you may contact our customer care for specific queries at <a href="mailto:customercare@lasostashop.com">customercare@lasostashop.com</a></p>
              </div>
            </div>
            <div class="tab-pane fade in" id="men_size_guide">
              <div id="men_size_guide">
                <h4>Men's Trouser Size Chart</h4>
                <div class="table-responsive">
                <table class="shoes table">
                  <tbody>
                    <tr>
                      <th class="country">&nbsp;</th>
                      <td><strong>CHEST (Inches)</strong></td>
                      <td><strong>CHEST (Cms.)</strong></td>
                      <td><strong>NECK (Inches)</strong></td>
                      <td><strong>NECK (Cms.)</strong></td>
                    </tr>
                    <tr>
                      <th class="country"><strong>S</strong></th>
                      <td>38</td>
                      <td>96.5</td>
                      <td>15</td>
                      <td>38</td>
                    </tr>
                    <tr>
                      <th class="country"><strong>M</strong></th>
                      <td>40</td>
                      <td>102</td>
                      <td>16</td>
                      <td>40.6</td>
                    </tr>
                    <tr>
                      <th class="country"><strong>L</strong></th>
                      <td>42</td>
                      <td>107</td>
                      <td>17</td>
                      <td>43</td>
                    </tr>
                    <tr>
                      <th class="country"><strong>XL</strong></th>
                      <td>44</td>
                      <td>112</td>
                      <td>18</td>
                      <td>46</td>
                    </tr>
                  </tbody>
                </table>
                </div>
                <div class="sub-heading">Men's Trouser Size Chart</div>
                <div class="table-responsive">
                <table class="shoes table">
                  <tbody>
                    <tr>
                      <th class="country">&nbsp;</th>
                      <td><strong>WAIST (Inches)</strong></td>
                    </tr>
                    <tr>
                      <th class="country"><strong>S</strong></th>
                      <td>30-32</td>
                    </tr>
                    <tr>
                      <th class="country"><strong>M</strong></th>
                      <td>32-34</td>
                    </tr>
                    <tr>
                      <th class="country"><strong>L</strong></th>
                      <td>34-36</td>
                    </tr>
                    <tr>
                      <th class="country"><strong>XL</strong></th>
                      <td>36-38</td>
                    </tr>
                  </tbody>
                </table>
                </div>
                <div class="sub-heading">Men's Shoe Size Chart</div>
                <div class="table-responsive">
                <table class="shoes table">
                  <tbody>
                    <tr>
                      <th class="country"><strong>UK</strong></th>
                      <td>6</td>
                      <td>7</td>
                      <td>8</td>
                      <td>9</td>
                      <td>10</td>
                      <td>11</td>
                      <td>12</td>
                    </tr>
                    <tr>
                      <th class="country"><strong>EU</strong></th>
                      <td>40</td>
                      <td>41</td>
                      <td>42</td>
                      <td>43</td>
                      <td>44</td>
                      <td>45</td>
                      <td>46</td>
                    </tr>
                    <tr>
                      <th class="country"><strong>US</strong></th>
                      <td>7</td>
                      <td>8</td>
                      <td>9</td>
                      <td>10</td>
                      <td>11</td>
                      <td>12</td>
                      <td>13</td>
                    </tr>
                    <tr>
                      <th class="country"><strong>Foot Lenght(mm)</strong></th>
                      <td>246</td>
                      <td>254</td>
                      <td>262</td>
                      <td>271</td>
                      <td>279</td>
                      <td>288</td>
                      <td>296</td>
                    </tr>
                  </tbody>
                </table>
                </div>
                <p class="text">There may be variations in some brands commonly with Indian clothing so please refer to the Product Measurements displayed on the product page. Alternatively, you may contact our customer care for specific queries at <a href="mailto:customercare@lasostashop.com">customercare@lasostashop.com</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php



$image = 'attachments/profile_images/' . $vendor_image;
$description = false;
foreach($trans_load as $key => $arrayMember){
	if($arrayMember["description"]) $description = true;
}

if (empty($vendor_image) || !file_exists($image) || $description == false) {

?>
	<div class="alert alert-danger">
		<span class="glyphicon glyphicon-alert"></span>&nbsp;&nbsp;<?= lang('vendors_no_access') ?>
		<a href="<?= LANG_URL . '/vendor/profile' ?>"><?= lang('vendor_profile') ?></a>
	</div>
<?php
}else{
?>   

	<div class="content vendors-filter">
		<form  class="form-box"  method="POST" action="<?= LANG_URL . '/vendor/vendors' ?>">
			<div class="row">
				<div class="col-md-5 col-xs-12">
			        <div class="form-group">
			            <label><?= lang('vendors_filter_name') ?></label>
			            <input type="text" class="form-control" value="<?= $filter['vendors_filter_name'] ?>" name="vendors_filter_name" placeholder="">
			        </div>
			    </div>
			    <div class="col-md-5 col-xs-12">
			        <div class="form-group">
			            <label><?= lang('vendors_filter_description') ?></label>
			            <input type="text" class="form-control" value="<?= $filter['vendors_filter_description'] ?>" name="vendors_filter_description" placeholder="">
			        </div>		
			    </div>
			   	<div class="col-md-2 col-xs-12">
	                <div class="text-center submit-settings">
	                    <button type="submit" name="vendors_filter_submit" class="btn btn-green btn-sm">
	                    	<span class="glyphicon glyphicon-filter"></span>&nbsp;&nbsp;<?= lang('vendors_filter_submit') ?>
	                    </button>
	                    <button type="submit" name="vendors_filter_reset" class="btn btn-grey btn-sm">
	                    	<span class="glyphicon glyphicon-remove-circle"></span>
	                    </button>
	                </div>
	            </div>
			</div>
		</form>
	</div>

	<?php

	foreach ($vendors as $row) { ?>
		<div class="content">
	        <?php
	        if (empty($row->url))   {
	        	$href = "";
	        }else{
	        	$href = 'href="' . LANG_URL . '/vendor/' . $row->url . '"';
	        }
	        ?>
			<a <?= $href ?> class="item-info">
				<div class="row"> 
				    <div class="col-md-3">
	                    <?php
	                    $image = 'attachments/profile_images/' . $row->profile_image;
	                    $imageWidth = 300;
	                    if (empty($row->profile_image) || !file_exists($image)) {
	                        $image = 'attachments/no-profile-image.png';
	                        $imageWidth = 80;
	                    }
	                    ?>
				    	<img src="<?= base_url($image) ?>" class="img-responsive" style="max-width:<?= $imageWidth ?>px; margin-bottom: 5px;">
				    	<?php
				    	if (!empty($row->city)) {
				    		$infoString = $row->surname . ' ' . $row->name . ', ' . $row->city;
						}else{
							$infoString = $row->surname . ' ' . $row->name;
						}
	                    ?>
	                    <?= $infoString ?>
			        </div>        
				    <div class="col-md-9">
	                    <?php
	                    if ((empty($row->description) && empty($row->name) && empty($row->surname)) || empty($row->url))   {
	                    	$description = $row->email;
	                    }else{
	                    	$description = $row->description;
	                    }
	                    ?>
				    	<?= $description ?>	    	
			        </div>        
			    </div>
			</a>
		</div>
	<?php 
	}
} ?>   

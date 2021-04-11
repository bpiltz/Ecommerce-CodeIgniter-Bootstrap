

<?php
foreach ($dialogs as $row) { ?>
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
                    $imageWidth = 80;
                    if (empty($row->profile_image) || !file_exists($image)) {
                        $image = 'attachments/no-profile-image.png';
                        $imageWidth = 80;
                    }
                    ?>
			    	<img src="<?= base_url($image) ?>" class="img-responsive" style="max-width:<?= $imageWidth ?>px; margin-bottom: 5px;">
		        </div>
		        <div class="col-md-3">
                    <?= $row->senderName ?>
		        </div>
			    <div class="col-md-3">
			    	<?= $row->time ?>	    	
		        </div>
		        <div class="col-md-3">
			    	<?= $row->unread ?>	    	
		        </div>
		    </div>
		</a>
	</div>
<?php } ?>   

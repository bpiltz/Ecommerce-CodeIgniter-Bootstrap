

<div class="row"> 
    <div class="col-md-6 col-md-offset-3">
    	<div class="row"> 
	       	<div class="col-md-12">
		        <div class="text-center submit-settings">
		        	<?php
		        	$previous = "javascript:history.go(-1)";
					if(isset($_SERVER['HTTP_REFERER'])) {
		    			$previous = $_SERVER['HTTP_REFERER'];
					}
					?>
					<a href="<?= $previous ?>" class="vendor-back" >
		            <button type="submit" name="vendors_filter_submit" class="btn btn-green btn-sm" >
		              	<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;<?= lang('back') ?>
		            </button>
		        </a>
		        </div>
        	</div>
	    </div>

	    <div class="content">
	    	<div class="row"> 
	       	    <div class="col-md-6">
			    	<h1>
			    		<?= $vendor[0]->surname ?> <?= $vendor[0]->name ?>
			    	</h1>
			    	<div class="form-group">
					    <div>
			    			<?= $vendor[0]->street ?> <?= $vendor[0]->number ?>
			    		</div>
			    		<div>
			    			<?= $vendor[0]->post_code ?> <?= $vendor[0]->city ?>
			    		</div>
			    		<div>	    			
			    			<?= $vendor[0]->country ?>
			    		</div>
			    	</div>
			   	</div>
			   	<div class="col-md-6">
                    <?php
                    $image = 'attachments/profile_images/' . $vendor[0]->profile_image;
                    if (empty($vendor[0]->profile_image) || !file_exists($image)) {
                        $image = 'attachments/no-profile-image.png';
                    }
                    ?>
			    	<img src="<?= base_url($image) ?>" class="img-responsive" style="max-width:300px; margin-bottom: 5px;">   	
			   	</div>
			</div>
	    	<div class="form-group">
	    		<h3>
		    		<?= lang('vendor_description') ?>
		    	</h3>
	    		<?= $vendor[0]->description ?>	
        	</div>
    		<h3>
	    		<?= lang('contacts') ?>
	    	</h3>
	    	<div class="row"> 
	       	    <div class="col-md-6">
			    	<div>
			    		<label><?= lang('email_address') ?>:</label>
			    		<?= $vendor[0]->email ?>	    	
		        	</div>
			    	<div>
			    		<label><?= lang('vendor_telegram') ?>:</label>
			    		<?= $vendor[0]->telegram ?>	    	
		        	</div> 
			    	<div>
			    		<label><?= lang('vendor_website') ?>:</label>
			    		<?= $vendor[0]->website ?>	    	
		        	</div> 
	        	</div>
	       	    <div class="col-md-6">
			    	<div>
			    		<label><?= lang('vendor_phone') ?>:</label>
			    		<?= $vendor[0]->phone ?>	    	
		        	</div>
			    	<div>
			    		<label><?= lang('vendor_mobile') ?>:</label>
			    		<?= $vendor[0]->mobile ?>	    	
		        	</div>
	        	</div>
	        </div>        
       	</div>        
    </div>
</div>

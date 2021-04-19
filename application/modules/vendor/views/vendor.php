

<div class="row"> 
    <div class="col-md-12">
        <div class="text-center submit-settings">
        	<?php

        	$previous = "javascript:history.go(-1)";
			if(isset($_SERVER['HTTP_REFERER']) && stristr($_SERVER['HTTP_REFERER'], $vendor[0]->url) === false) {
    			$previous = $_SERVER['HTTP_REFERER'];
    			$_SESSION['HTTP_REFERER_VENDOR'] = $previous;
			}else if(isset($_SESSION['HTTP_REFERER_VENDOR'] )){
				$previous = $_SESSION['HTTP_REFERER_VENDOR'];
			}

			?>
			<a href="<?= $previous ?>" class="vendor-back" >
            <button type="submit" name="back" class="btn btn-green btn-sm" >
              	<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;<?= lang('back') ?>
            </button>
	        </a>
	    </div>
	</div>
</div>
<div class="row"> 
    <div class="col-md-6">
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
			    	<img src="<?= base_url($image) ?>" class="img-responsive profile-image" >   	
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
	<?php
	//echo $vendor[0]->id . " " . $this->vendor_id;
	if($vendor[0]->id != $this->vendor_id){ ?>
	    <div class="col-md-6">
		    <div class="content chat-box ">
	      	  	<form  class="form-box"  method="POST" action="<?= LANG_URL . '/vendor/' . $vendor[0]->url  ?>" enctype="multipart/form-data">
	      	  		<div class="row"> 
		       	    	<div class="col-md-12">
		       	    		<div class="form-group">
	                    		<label><?= lang('vendor_subject') ?></label>
	                    		<input type="text" class="form-control" value="" name="subject" placeholder="">
	                		</div>
	                	</div>
	                </div>
	                <div class="row"> 
	                	<div class="col-md-10">
		                    <div class="form-group">
		                    	<label><?= lang('vendor_message') ?></label>
		                        <textarea class="form-control" name="message"></textarea>
		                    </div>
		                </div>
		                <div class="col-md-2">
		                    <div class="text-center submit-message">
		                    	<button type="submit" name="sendMessage" class="btn btn-green btn-sm"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;<?= lang('send') ?></button>
		                	</div>
		               	</div>
		        	</div> 
	            </form>
	       	</div>
			<?php
			foreach ($messages as $row) { ?>
			<div class="row message-box">
				<?php
				if($row->sender_id != $this->vendor_id){ ?>
			    	<div class="col-xs-10">
			   	<?php
				} else { ?>
					<div class="col-xs-offset-2 col-xs-10">
				<?php } ?>
						<div class="content">
							<div class="row message-header">
								<div <div class="col-xs-6">
									<b><?= $row->subject ?> </b>
								</div>
								<div <div class="col-xs-6 message-time">
							    	<?php
						    		$time = strtotime($row->cdate);
						    		echo date("m.d.Y, H:i:s", $time);
							    	?>
								</div>
				        	</div>
							<div class="row">
								<div <div class="col-xs-12">
									<?= $row->body ?>
								</div>
							</div>
				        </div>        
				    </div>
				</div>
			<?php } ?>
	    </div>
	<?php } ?>
</div>

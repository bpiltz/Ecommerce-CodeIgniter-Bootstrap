

<div class="row"> 
    <div class="col-md-6 col-md-offset-3">
	    <div class="content">
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


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
                </div>
            </div>
		</div>
	</form>
</div>

<?php
foreach ($vendors as $row) { ?>
	<div class="content">
		<div class="row"> 
		    <div class="col-md-3">
		    	<?= $row->surname ?> <?= $row->name ?>, <?= $row->city ?>		    	
	        </div>        
		    <div class="col-md-9">
		    	<?= $row->description ?>	    	
	        </div>        
	    </div>
	</div>
<?php } ?>   

<?php
if ($this->session->flashdata('result_delete')) {
    ?> 
    <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div> 
    <?php
}
?>
<div class="row"> 
    <div class="col-md-6 col-md-offset-3">
        <div class="content">
            <form  class="form-box"  method="POST" action="<?= LANG_URL . '/vendor/me' ?>">
                <div class="form-group">
                    <label><?= lang('vendor_name') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_name ?>" name="vendor_name" placeholder="<?= lang('enter_vendor_name') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_url') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_url ?>" name="vendor_url" placeholder="<?= lang('enter_vendor_url') ?>">
                </div>        
                <div class="text-center submit-settings">
                    <button type="submit" name="saveVendorDetails" class="btn btn-green btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;<?= lang('save') ?></button>
                </div>       
            </form>
        </div>        
    </div>
</div>
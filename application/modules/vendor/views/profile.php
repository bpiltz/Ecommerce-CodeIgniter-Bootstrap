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
                    <label><?= lang('vendor_surname') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_surname ?>" name="vendor_surname" placeholder="<?= lang('enter_vendor_surname') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_name') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_name ?>" name="vendor_name" placeholder="<?= lang('enter_vendor_name') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_url') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_url ?>" name="vendor_url" placeholder="<?= lang('enter_vendor_url') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_street') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_street ?>" name="vendor_street" placeholder="<?= lang('enter_vendor_street') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_number') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_number ?>" name="vendor_number" placeholder="<?= lang('enter_vendor_number') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_city') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_city ?>" name="vendor_city" placeholder="<?= lang('enter_vendor_city') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_post_code') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_post_code ?>" name="vendor_post_code" placeholder="<?= lang('enter_vendor_post_code') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_country') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_country ?>" name="vendor_country" placeholder="<?= lang('enter_vendor_country') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_phone') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_phone ?>" name="vendor_phone" placeholder="<?= lang('enter_vendor_phone') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_mobile') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_mobile ?>" name="vendor_mobile" placeholder="<?= lang('enter_vendor_mobile') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_website') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_website ?>" name="vendor_website" placeholder="<?= lang('enter_vendor_website') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_telegram') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_telegram ?>" name="vendor_telegram" placeholder="<?= lang('enter_vendor_telegram') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_gender') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_gender ?>" name="vendor_gender" placeholder="<?= lang('enter_vendor_gender') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_birthday') ?></label>
                    <input class="form-control datepicker" value="<?= date( 'd.m.Y', strtotime($vendor_birthday)) ?>" name="vendor_birthday">
                </div>        
                <div class="text-center submit-settings">
                    <button type="submit" name="saveVendorDetails" class="btn btn-green btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;<?= lang('save') ?></button>
                </div>       
            </form>
        </div>        
    </div>
</div>

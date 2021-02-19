<?php if ($this->session->flashdata('update_vend_err')) { ?> 
    <div class="alert alert-danger"><?= implode('<br>', $this->session->flashdata('update_vend_err')) ?></div>
<?php } ?>
<?php if ($this->session->flashdata('update_vend_details')) { ?>
    <div class="alert alert-success"><?= $this->session->flashdata('update_vend_details') ?></div>
<?php } ?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<div class="row"> 
    <div class="col-md-6 col-md-offset-3">
        <div class="content">
            <form  class="form-box"  method="POST" action="<?= LANG_URL . '/vendor/me' ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label><?= lang('vendor_surname') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_surname ?>" name="vendor_surname" placeholder="<?= lang('enter_vendor_surname') ?>">
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_name') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_name ?>" name="vendor_name" placeholder="<?= lang('enter_vendor_name') ?>">
                </div>
                <div class="form-group">
                    <label><?= lang('vendor_profile_image') ?></label>
                    <?php
                    $image = 'attachments/profile_images/' . $vendor_image;
                    if (empty($vendor_image) || !file_exists($image)) {
                        $image = 'attachments/nno-profile-image.png';
                    }
                    ?>
                    <img src="<?= base_url($image) ?>" class="img-responsive" style="max-width:300px; margin-bottom: 5px;">
                    <input type="file" name="userfile">
                </div>
                <div class="form-group available-translations">
                    <label><?= lang('language_selector') ?></label><br/>
                    <?php foreach ($languages as $language) { ?>
                        <button type="button" data-locale-change="<?= $language->abbr ?>" class="btn btn-default locale-change text-uppercase <?= $language->abbr == MY_DEFAULT_LANGUAGE_ABBR ? 'active' : '' ?>">
                            <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">
                            <?= $language->abbr ?>
                        </button>
                    <?php } ?>
                </div>
                <?php
                $i = 0;
                foreach ($languages as $language) {
                    ?>
                    <div class="locale-container locale-container-<?= $language->abbr ?>" <?= $language->abbr == MY_DEFAULT_LANGUAGE_ABBR ? 'style="display:block;"' : '' ?>>
                        <input type="hidden" name="translations[]" value="<?= $language->abbr ?>">
                        <label><?= lang('enter_vendor_description') ?> <img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="<?= $language->name ?>"></label>
                         <div class="form-group">
                            <textarea class="form-control" name="vendor_description[]" id="vendor_description<?= $i ?>"><?= $trans_load != null && isset($trans_load[$language->abbr]['description']) ? $trans_load[$language->abbr]['description'] : '' ?></textarea>
                        </div>
                        <script>
                            CKEDITOR.replace('vendor_description<?= $i ?>');
                            CKEDITOR.config.entities = false;
                        </script>
                    </div>
                    <?php
                    $i++;
                }
                ?>
                <div class="form-group">
                    <label><?= lang('vendor_url') ?></label>
                    <input type="text" class="form-control" value="<?= $vendor_url ?>" name="vendor_url" placeholder="<?= lang('enter_vendor_url') ?>">
                </div>      
                <div class="row"> 
                    <div class="form-group col-md-6">
                        <label><?= lang('vendor_street') ?></label>
                        <input type="text" class="form-control" value="<?= $vendor_street ?>" name="vendor_street" placeholder="<?= lang('enter_vendor_street') ?>">
                    </div>        
                    <div class="form-group col-md-6">
                        <label><?= lang('vendor_number') ?></label>
                        <input type="text" class="form-control" value="<?= $vendor_number ?>" name="vendor_number" placeholder="<?= lang('enter_vendor_number') ?>">
                    </div>
                </div>      
                <div class="row"> 
                    <div class="form-group col-md-6">
                        <label><?= lang('vendor_city') ?></label>
                        <input type="text" class="form-control" value="<?= $vendor_city ?>" name="vendor_city" placeholder="<?= lang('enter_vendor_city') ?>">
                    </div>        
                    <div class="form-group col-md-6">
                        <label><?= lang('vendor_post_code') ?></label>
                        <input type="text" class="form-control" value="<?= $vendor_post_code ?>" name="vendor_post_code" placeholder="<?= lang('enter_vendor_post_code') ?>">
                    </div>  
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
                    <select class="form-control" name="vendor_gender">
                      <option value=""></option>
                      <option value="female" <?= $vendor_gender=="female" ? "selected" : "" ?> ><?= lang('vendor_gender_female') ?></option>
                      <option value="male" <?= $vendor_gender=="male" ? "selected" : "" ?> > <?= lang('vendor_gender_male') ?></option>
                    </select>
                </div>        
                <div class="form-group">
                    <label><?= lang('vendor_birthday') ?></label>
                    <input class="form-control datepicker" value="<?= $vendor_birthday == '' ? '' : date( 'd.m.Y', strtotime($vendor_birthday)) ?>" name="vendor_birthday">
                </div>        
                <div class="text-center submit-settings">
                    <button type="submit" name="saveVendorDetails" class="btn btn-green btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;<?= lang('save') ?></button>
                </div>
                <div class="form-group">
                    <label><a href="change-password"><?= lang('user_change_password_page') ?></a></label>          
                </div>      
            </form>
        </div>        
    </div>
</div>

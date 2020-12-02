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
        </div>        
    </div>
</div>
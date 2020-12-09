<div class="auth-page">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4"> 
            <?php
            if ($this->session->flashdata('error_change')) {
                ?>
                <div class="alert alert-danger"><?= implode('<br>', $this->session->flashdata('error_change')) ?></div>
                <?php
            }
            ?>
            <div class="vendor-login">
                <h1><?= lang('user_set_password_page') ?></h1><br>
                <form method="POST" action="">
                    <?php if(isset($_SESSION['logged_vendor'])){ ?>
                        <input type="password" name="u_password" placeholder="<?= lang('password_original') ?>">
                    <?php } ?>
                    <input type="password" name="u_password_new" placeholder="<?= lang('password_new') ?>">
                    <input type="password" name="u_password_repeat" placeholder="<?= lang('password_new_repeat') ?>">
                    <input type="submit" name="change" class="login submit" value="<?= lang('set_password') ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="<?= MY_LANGUAGE_ABBR ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $description ?>">
        <title><?= $title ?></title>
        <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/materialdesignicons.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/vendors.css') ?>">
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <nav class="navbar navbar-blue">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <i class="fa fa-lg fa-bars"></i>
                        </button>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="<?= LANG_URL . '/vendor/vendors' ?>"><i class="mdi mdi-account-multiple"></i> <?= lang('vendor_vendors') ?></a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="<?= LANG_URL . '/vendor/messages' ?>"><i class="mdi mdi-account-multiple"></i> <?= lang('vendor_messages') ?></a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="<?= LANG_URL . '/vendor/add/product' ?>"><i class="mdi mdi-plus"></i> <?= lang('vendor_add_product') ?></a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="<?= LANG_URL . '/vendor/products' ?>"><i class="mdi mdi-format-list-bulleted"></i> <?= lang('vendor_products') ?></a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="<?= LANG_URL . '/vendor/orders' ?>"><i class="mdi mdi-cart-plus"></i> <?= lang('vendor_orders') ?></a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="<?= LANG_URL . '/vendor/profile' ?>"><i class="mdi mdi-account"></i> <?= lang('vendor_profile') ?></a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?= LANG_URL . '/vendor/logout' ?>"><?= lang('vendor_logout') ?></a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="<?= LANG_URL . '/vendor/me' ?>"><i class="mdi mdi-gauge"></i> <?= lang('vendor_dashboard') ?></a></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="page-titles">
                        <h2><?= $title ?></h2>
                    </div>
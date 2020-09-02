<?php /* Smarty version 2.6.31, created on 2020-09-02 12:14:19
         compiled from header.tpl */ ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Webinar Shop</title>

    <!-- Bootstrap core CSS -->
    <link href="/scripts/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/scripts/css/shop-homepage.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Webinar-shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/products/edit.php">Добавить товар
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/categories/edit.php">Добавить категорию</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/categories/index.php">Список категорий</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3 menu-block">

            <h1 class="my-4">Webinar-shop</h1>
            <div class="list-group">
                <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
                    <a href="/categories/view.php?category_id=<?php echo $this->_tpl_vars['category']->getId(); ?>
" class="list-group-item"><?php echo $this->_tpl_vars['category']->getName(); ?>
</a>
                <?php endforeach; endif; unset($_from); ?>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9 content-block">

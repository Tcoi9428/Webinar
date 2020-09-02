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
                {foreach from=$categories item=category}
                    <a href="/categories/view.php?category_id={$category->getId()}" class="list-group-item">{$category->getName()}</a>
                {/foreach}
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9 content-block">

{*<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Shop</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/album/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">

    {literal}
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            .card-body{
                border: 2px solid #000;
            }
            .card-field{
                display: flex;
                flex-wrap: wrap;
                border: 1px solid #000;
                margin-bottom: 5px;
                align-items: center;
                justify-content: center;
                padding: 5px 10px;
                text-align: center;
            }
            .card-text{
                margin-right: 10px;
                margin-bottom: 0px;
            }
            .field-title{
                font-weight: 700;
            }
            .category-card{
                display: flex;
                justify-content: space-between;
                background: #000;
                color: #fff;
                align-items: center;
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 20px;
            }
            .category-card:nth-child(2n){
                background: #ccc;
                color: #000000;
            }
            .category-name{
                flex-grow: 1;
                margin-bottom: 0;
            }
            .bottom-btn{
                margin-top: 20px;
            }
            .shop-cart{
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                padding: 30px;
                div{
                    display: flex;
                }
            }
            section.jumbotron.text-center{
                margin-bottom: 0;
                padding: 20px 2rem;
            }
            .product-btn{
                margin-right: 10px;
            }
            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
    {/literal}
    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">Информация</h4>
                    <p class="text-muted">Данный тестовый интернет магазин предназначен для прокачки бэкенд навыков</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Меню</h4>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-white">Список товаров</a></li>
                        <li><a href="/categories/index.php" class="text-white">Категории</a></li>
                        <li><a href="/vendors/index.php" class="text-white">Производители</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
            <a href="/" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <strong>На главную</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<main role="main">
    <section class="jumbotron text-center">
        {if $user->getId()}
            <div>Вы авторизированны как : <a href="/user/edit.php" class="">{$user->getName()}</a></div>
            <a href="user/logout.php" class="">Выйти</a>
        {else}
        <form class="form-inline justify-content-center" method="post" action="/user/login.php">
            <label class="sr-only" for="inlineFormInputName2">Login</label>
            <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Login" name="login">
            <label class="sr-only" for="inlineFormInputGroupUsername2"></label>
            <div class="input-group mb-2 mr-sm-2">
                <input type="password" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
            {*<div class="form-check mb-2 mr-sm-2">
                <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                <label class="form-check-label" for="inlineFormCheck">
                    Remember me
                </label>
            </div>
        </form>
            <a href="/user/edit.php" class="register">Регистрация</a>
        {/if}
    </section>
    <div class="album py-5 bg-light">
        <div class="container">*}
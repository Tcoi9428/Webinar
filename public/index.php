<?php
use App\Controller\Product;

require_once $_SERVER['DOCUMENT_ROOT'] . '/../App/bootstrap.php';
Product::list(3);

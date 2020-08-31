<?php


namespace App\Service;


class ResponceService
{
    public static function redirect(string $path)
    {
        header('Location: ' . $path);
        exit;
    }
}
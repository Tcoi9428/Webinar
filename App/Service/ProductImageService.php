<?php

namespace App\Service;

use App\Db\MySql;
use App\Product\ProductImage;

class ProductImageService
{
    public static function getById($id)
    {
        $query = "SELECT * FROM product_images WHERE id = $id";
        return DataBase()->fetchRow($query,ProductImage::class);
    }
    public static function updateById(int $id , array $product_image): int
    {
        if(isset($product_image['id'])){
            unset($product_image['id']);
        }
        return DataBase()->update('product_images',$product_image ,'id='.$id);
    }
    public static function add(array $product_image) :int
    {
        if(isset($product_image['id'])){
            unset($product_image['id']);
        }

        return DataBase()->insert('product_images',$product_image);
    }
    public static function deleteById(int $id)
    {
        $path = APP_UPLOAD_PRODUCT_DIR . '/' . $id;

        self::deleteDir($path);

        self::deleteByProductId($id);
    }

    public static function deleteByProductId(int $product_id)
    {
        return DataBase()->deleteItem('product_images','product_id='. $product_id);
    }
    public static function addImagesForProduct($product_id)
    {
        $product_id = $product_id;
        $uploadImages = RequestService::getFiles('images');

        $imageNames = $uploadImages['name'];
        $imageTmpNames = $uploadImages['tmp_name'];


        $path = APP_UPLOAD_PRODUCT_DIR . '/' . $product_id;
            if(!file_exists($path)){
                mkdir($path);
            }

        for($i = 0; $i < count($imageNames); $i++){
            $imageName = basename($imageNames[$i]);
            $imageTmpName = $imageTmpNames[$i];

            $imagePath = $path . '/' . $imageName;

            move_uploaded_file($imageTmpName ,$imagePath);

            $data = [
                'product_id' =>$product_id,
                'name'=> $imageName,
                'path'=> str_replace(APP_PUBLIC_DIR,'',$imagePath)
            ];
            self::add($data);
        }
    }
    private static function deleteDir($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? deleteDir("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}
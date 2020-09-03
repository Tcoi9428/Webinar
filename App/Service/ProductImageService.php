<?php

namespace App\Service;

use App\Db\MySql;
use App\Model\ProductImage;

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
        return DataBase()->deleteItem('product_images','id='.$id);
    }

    public static function deleteByProductId(int $product_id)
    {
        $path = APP_UPLOAD_PRODUCT_DIR . '/' . $product_id;

        self::deleteDir($path);

        return DataBase()->deleteItem('product_images','product_id='. $product_id);
    }

    public static function getImagesByProductId($product_id)
    {
        $query = "SELECT * FROM product_images WHERE product_id = $product_id";
        $images = DataBase()->fetchAll($query,ProductImage::class);
        return $images;
    }
    public static function addImagesForProduct($product_id)
    {
        $uploadImages = RequestService::getFiles('images');
        if( $uploadImages['error'][0] > 0){
            return false;
        }

            $imageNames = $uploadImages['name'];
            $imageTmpNames = $uploadImages['tmp_name'];

            $getImages = self::getImagesByProductId($product_id);
            $path = APP_UPLOAD_PRODUCT_DIR . '/' . $product_id;
            if (!file_exists($path)) {
                mkdir($path);
            }
            for ($i = 0; $i < count($imageNames); $i++) {
                $imageName = basename($imageNames[$i]);
                $imageTmpName = $imageTmpNames[$i];

                $imagePath = $path . '/' . $imageName;

                move_uploaded_file($imageTmpName, $imagePath);

                $currentImagesNames = [];
                foreach ($getImages as $currentImageName) {
                    $currentImagesNames[] = $currentImageName->getName();
                }

                $diffImageNames = array_diff($imageNames, $currentImagesNames);
                if (in_array($imageName, $diffImageNames)) {
                    $data = [
                        'product_id' => $product_id,
                        'name' => $imageName,
                        'path' => str_replace(APP_PUBLIC_DIR, '', $imagePath)
                    ];
                    self::add($data);
                }
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
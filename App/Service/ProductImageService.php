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
        /**
         * @var ProductImage $productImage
         */
        $productImage = self::getById($id);

        $filePath = APP_PUBLIC_DIR . $productImage->getPath();

        if(file_exists($filePath)){
            unlink($filePath);
        }
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
        $path = self::getUploadDirForProductImages($product_id);
        self::uploadImagesFormUrl($product_id , $path);
        self::uploadImagesFromFileSystem($product_id , $path);
    }

    public static function findByFilenameInProduct(int $product_id , string $filename)
    {
        $query = "SELECT * FROM product_images WHERE product_id = $product_id AND name = '$filename'";
        return DataBase()->fetchRow($query,ProductImage::class);
    }

    public static function uploadImagesFromFileSystem(int $product_id , string $path)
    {
        $uploadImages = RequestService::getFiles('images')  ;
        if( $uploadImages['error'][0] > 0){
            return false;
        }
        $imageNames = $uploadImages['name'];
        $imageTmpNames = $uploadImages['tmp_name'];

        for ($i = 0; $i < count($imageNames); $i++) {
            $imageName = basename($imageNames[$i]);
            $imageTmpName = $imageTmpNames[$i];

            $filename = $imageName;
            $counter = 0;
            while (true){
                $duplicateImage =  self::findByFilenameInProduct($product_id ,$filename);
                if(empty($duplicateImage)) {
                    break;
                }
                $info =  pathinfo($imageName);
                $filename = $info['filename'];
                $filename .= '_' . $counter . '.' . $info['extension'];

                $counter++;
            }
            $imagePath = $path . '/' . $filename;
            move_uploaded_file($imageTmpName, $imagePath);

            $data = [
                'product_id' => $product_id,
                'name' => $filename,
                'path' => str_replace(APP_PUBLIC_DIR ,'',$imagePath),
            ];
            self::add($data);
        }
    }

    public static function uploadImagesFormUrl(int $product_id , string $path)
    {
        $imageUrl = RequestService::getStringFromPost('image_url');
        $imageContentTypes = [
            'image/apng' => '.apng',
            'image/bmp' => '.bmp',
            'image/gif' => '.gif',
            'image/jpeg' => '.jpg',
            'image/png' => '.png',
            'image/webp' => '.webp',
            'image/svg+xml' => '.svg'
        ];

        $headers = @get_headers($imageUrl);

        if($headers !== false){

            foreach ($headers as $header){
                $regx = '/(?<=Content-Type: ).+/';
                preg_match($regx, $header,$contentType);
                if(!empty($contentType)){
                    $imageType = $contentType[0];
                }
            }

            $imageExt = $imageContentTypes[$imageType];
            if(!is_null($imageExt)){
                $data = [
                    'product_id' => $product_id,
                    'name' => '',
                    'path' => '',
                ];
                $productImageId  = self::add($data);

                $filename = $product_id . '_' . $productImageId . '_upload' . time() . $imageExt;
                $imagePath = $path . '/' . $filename;

                file_put_contents($imagePath, fopen($imageUrl,'r'));

                $updateData = [
                    'name' => $filename,
                    'path' => str_replace(APP_PUBLIC_DIR ,'',$imagePath)
                ];
                self::updateById($productImageId,$updateData);
            }
        }
    }

    private static function getUploadDirForProductImages($product_id)
    {
        $path = APP_UPLOAD_PRODUCT_DIR . '/' . $product_id;
        if (!file_exists($path)) {
            mkdir($path);
        }
        return$path;
    }

    private static function deleteDir($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? deleteDir("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}
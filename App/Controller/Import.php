<?php


namespace App\Controller;


use App\Model\Category as CategoryModel;
use App\Model\Product as ProductModel;
use App\Service\CategoryService;
use App\Service\ProductService;
use App\Service\RequestService;
use App\Service\ResponceService;

class Import
{
    public static function view()
    {
        smarty()->display('import/index.tpl');
    }
    public static function upload()
    {
//        $file = RequestService::getFiles('import_file');
//        if(is_null($file) || empty($file['name'])){
//            die('import file not uploaded');
//        }
//
//        $uploadDir = APP_UPLOAD_DIR . '/import';
//
//        if (!file_exists($uploadDir)){
//            mkdir($uploadDir);
//        }
//
//        $importFilename = 'i_' . time() . '.' . $file['name'];
//        $importDir = $uploadDir . '/' . $importFilename;
//        move_uploaded_file($file['tmp_name'],$importDir);

        $filePath = APP_UPLOAD_DIR . '/import/i_1600001900.Import.csv';


        $file =fopen($filePath ,'r');


        $withHeaders = true;

        $settings = [
          0 => 'name',
          1 => 'category_name',
          2 => 'article',
          3 => 'price',
          4 => 'amount',
          5 => 'description',
          6 => 'image_urls'
        ];
        $mainField = 'name';

        if ($withHeaders){
            $headers = fgetcsv($file);
        }
        $productData = [];


        while ($row = fgetcsv($file)){
            foreach ($settings as $index =>$key){
                $productData[$key] = $row[$index];
            }

            $product = new ProductModel();
            $product->setName(DataBase()->escape($productData['name']));
            $product->setArticle(DataBase()->escape($productData['article']));
            $product->setPrice(DataBase()->escape($productData['price']));
            $product->setAmount(DataBase()->escape($productData['amount']));
            $product->setDescription(DataBase()->escape($productData['description']));

            $categoryName = $productData['category_name'];

            $category = CategoryService::getByName($categoryName);
            if(empty($category)){
                $category = new CategoryModel();
                $category->setName($categoryName);
                $categoryId = CategoryService::save($category);
            }
            else{
                /**
                 * @var $category CategoryModel
                 */
                $categoryId = $category->getId();
            }
            $product->addCategoryId($categoryId);

            $productData['image_urls'] = explode("\n",$productData['image_urls']);
            $productData['image_urls'] = array_map(function($item){
                return trim($item);
            },$productData['image_urls']);
            $productData['image_urls']= array_filter($productData['image_urls'] ,function($item){
                return !empty($item);
            });

            $product->setImages($productData['image_urls']);

            $targetProduct = ProductService::getByField($mainField , $product->getName());
            if(is_null($targetProduct)){
                ProductService::save($product);
            } else{
                $productId = $targetProduct->getId();
                $product->setId($productId);
                ProductService::save($product);
            }
        }
        ResponceService::redirect('/');
    }
}
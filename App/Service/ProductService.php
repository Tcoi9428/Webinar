<?php


namespace App\Service;

use App\Model\Category;
use App\Model\Model;
use App\Model\Product;
use App\Model\ProductImage;
use App\Service\ProductImageService;

class ProductService
{

    private  function __construct()
    {
    }

    public static function getCount()
    {
        $query = "SELECT COUNT(*) as count FROM products";

        /**
         * @var $result Model
         */
        $result = DataBase()->fetchRow($query,Model::class);

        return (int) $result;

    }
    public static  function getList(int $start = 0 , int $limit = 20)
    {

        $query = "SELECT * FROM products ORDER BY id LIMIT $start , $limit";

        $products = DataBase()->fetchAll($query , Product::class);
        self::getCategoryIdsForProducts($products);
        return $products;
    }

    /**
     * @param int $product_id
     * @return Product
     */
    public static function getEditItem( int $product_id) : Product
    {
        $query = " SELECT * FROM products WHERE id=$product_id";
        $product = DataBase()->fetchRow($query, Product::class);
        self::getCategoriesIdsForProduct($product);
        return $product;
    }
    public static function save(Product $product )
    {
        $data = [
            'name'=> $product->getName(),
            'price'=> $product->getPrice(),
            'amount'=> $product->getAmount(),
            'article'=> $product->getArticle(),
            'description' => $product->getDescription()
        ];

        $product_id = $product->getId();

        if (is_null($product_id)|| $product_id < 0){
            $product_id = DataBase()->insert('products',$data);
             ProductImageService::addImagesForProduct($product_id);
        }
        else{
            DataBase()->update('products' , $data , 'id='.$product_id);
            ProductImageService::addImagesForProduct($product_id);
            self::clearCategoryList($product);
        }
        self::insertCategories($product_id , $product->getCategoriesIds());

        return static::getEditItem($product_id);
    }
    public static function delete()
    {
        $delete_id = RequestService::getIntFromPost('product_id');
        if($delete_id){
            DataBase()->deleteItem('products','id='. $delete_id);
            DataBase()->deleteItem('products_categories','product_id='.$delete_id);
            ProductImageService::deleteByProductId($delete_id);
        }
    }
    public static function deleteProductImage(){
        $image_id = RequestService::getIntFromPost('product_image_id');
        if($image_id){
            ProductImageService::deleteById($image_id);
        }
    }
    private static function insertCategories(int $product_id , array $category_ids)
    {
        $category_ids = array_unique($category_ids);
        foreach ($category_ids as $category_id){
            DataBase()->insert('products_categories',[
                'product_id' => $product_id,
                'category_id' => $category_id
            ]);
        }
    }


    private static function getCategoriesIdsForProduct(Product $product) {
        $product_id = $product->getId();
        $query = "SELECT category_id FROM products_categories WHERE product_id = $product_id";
        $category_ids = DataBase()->fetchAll($query , Model::class);

        foreach ($category_ids as $link) {
            $product->addCategoryId($link->category_id);
        }
    }
    /**
     * @param Product[] $products
     */
    private static function getCategoryIdsForProducts(array $products) {

        $product_ids = array_map(function($item) {
            /**
             * @var $item Product
             */
            return (int) $item->getId();
        }, $products);
        $product_ids = array_unique($product_ids);

        if (count($product_ids) > 0) {
            $product_ids = implode(',', $product_ids);
            $query = "SELECT * FROM products_categories WHERE product_id IN ($product_ids)";
            $links = DataBase()->fetchAll($query , Model::class);

            foreach ($links as $pair) {
                $product_id = $pair->product_id;
                $category_id = $pair->category_id;
                foreach ($products as $product) {
                    if ($product->getId() != $product_id) {
                        continue;
                    }
                    $product->addCategoryId($category_id);
                }
            }
        }
    }
    private  static function clearCategoryList(Product $product){
        $product_id = $product->getId();
        DataBase()->deleteItem('products_categories','product_id='.$product_id);
    }
}
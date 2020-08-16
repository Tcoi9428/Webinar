<?php


namespace App\Service;

use App\Model\Category;
use App\Model\Model;
use App\Model\Product;

class CategoryService
{
    private function  __construct()
    {
    }
    public static function getList()
    {
        $query = "SELECT * FROM categories";
        $categories = DataBase()->fetchAll($query ,Category::class);
        return $categories;
    }
    public static function getEditItem( int $category_id):Category
    {
        $category_id =$category_id;
        $query = " SELECT * FROM categories WHERE id=$category_id";
        $category = DataBase()->fetchRow($query ,Category::class);
        return $category;
    }

    public static function save(Category $category)
    {
        $category_id = RequestService::getIntFromPost('category_id');
        $data = [
            'name'=>$category->getName()
        ];
        if($category_id > 0){
            return DataBase()->update('categories',$data , 'id='. $category_id);
        }else{
            return DataBase()->insert('categories' , $data);
        }
    }
    public  static function delete()
    {
        $delete_id = RequestService::getIntFromPost('delete_id');
        if($delete_id){
            $query = "DELETE FROM categories WHERE id = '$delete_id'";
        }
        return DataBase()->query($query);
    }

    public static function getProductsListByCategories($category_id)
    {
        $category_id = $category_id;
        $query = "SELECT * FROM products INNER JOIN products_categories ON products.id = products_categories.product_id AND products_categories.category_id = $category_id";
        $products = DataBase()->fetchAll($query ,Product::class);
        return $products;
    }

    public static function getRandom()
    {
        $query = "SELECT * FROM categories ORDER BY RAND() LIMIT 1";
        return DataBase()->fetchRow($query,Category::class);
    }
}
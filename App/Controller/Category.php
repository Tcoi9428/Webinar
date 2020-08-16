<?php


namespace App\Controller;


use App\Service\ProductService;
use App\Service\RequestService;
use App\Service\CategoryService;
use  App\Model\Category as CategoryModel;

class Category
{
    public static function list()
    {
        $categories = CategoryService::getList();
        smarty()->assign_by_ref('categories' , $categories);
        smarty()->display('categories/index.tpl');
    }

    public static function view()
    {
        $category_id = RequestService::getIntFromGet('category_id');
        $categories = CategoryService::getList();
        $products = CategoryService::getProductsListByCategories($category_id);
        smarty()->assign_by_ref('products',$products);
        smarty()->assign_by_ref('categories',$categories);
        smarty()->display('categories/view.tpl');
    }

    public  static function edit()
    {
        $category_id = RequestService::getIntFromGet('category_id');
        if($category_id){
           $category =  CategoryService::getEditItem($category_id);
        }else{
            $category = new CategoryModel();
        }
        smarty()->assign_by_ref('category' , $category);
        smarty()->display('categories/edit.tpl');
    }
    public static  function editing()
    {
        $category_id = RequestService::getIntFromPost('category_id');
        $name = RequestService::getStringFromPost('name');

        $category = new CategoryModel();
        $category->setId($category_id);
        $category->setName($name);

        CategoryService::save($category);
        self::redirectToList();
    }
    public  static  function delete()
    {
        CategoryService::delete();
        self::redirectToList();
    }
    private static function redirectToList()
    {
        RequestService::redirect('/categories/');
    }
}

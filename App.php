<?php
require_once 'Products.php';


class App{
     
    public static $show=20;
    public static $category_name=null;
    private static $errors = array();


    public static function main()
    {
        try{
            self::$show = self::getLimit() ?? self::$show;
        }catch(Exception $e){
            array_push(self::$errors,array("Show" => $e -> getMessage()));
        }
        try {
            self::$category_name = self::getCategory() ?? self::$category_name;
        } catch (Exception $e) {
            array_push(self::$errors, array("category" => $e->getMessage()));
        }
        $data = self::getProducts(self::$show, self::$category_name);
        if (self::$errors) self::render(self::$errors);
        else self::render($data);
        
    }
    public static function getProducts()
    {
        
           $products=new Products(self::$show, self::$category_name);
        //    print_r($products->finalProductAPI());
           return $products->finalProductAPI();
    }
    public static function getLimit (){
        if(isset($_GET['show'])){
           $show =  filter_var($_GET['show'], FILTER_SANITIZE_STRING);
            if ((!is_numeric($show) || $show < 1 || $show > 24)) {
                throw new Exception("Show must be a number between 1-20!");
        }
        return $show;
    }
    }
       public static function getCategory()
    {
        if (isset($_GET['category'])) {
            $category =  filter_var($_GET['category'], FILTER_SANITIZE_STRING);
            if (!($category =="men" || $category == "women"|| $category == "jewelery" || $category == "electronics" )) {
                throw new Exception("write a suitable category");
            }
            
            if ($category=="men") return 'men\'s clothing';
            if ($category=="women") return 'women\'s clothing';
            else return $category;
        }
    }
    public static function render($data)

    {
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header("Referrer-Policy: no-referrer");
        echo 'hi hi';
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

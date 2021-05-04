<?php
class Products{
    private $products;
    private $show;
    private $category;
    private $product_category;

    public function __construct($show,  $category){
        $this->products = json_decode(@file_get_contents("api.json"),true);
        $this->show = $show;
        $this->category = $category;
        $this->product_category = array();
        // print_r($this->products);
        // echo '-----------------------------------------------------------------------';
    }
    
    public function finalProductAPI(){
        // $array=array();
        if($this->category){
                foreach ($this->products as $product ){
                    // echo '<br>';
                    if($product['category'] == $this->category){
                    array_push($this->product_category,$product);
                    // print_r ($array);
                    // echo '************************************************';
                    }
                }
        }
        if ($this->show){
            
            if($this->category) 
                // $array = array_splice($array, $this->show);
                $this->product_category = array_slice($this->product_category,0, $this->show);
            else
                $this->product_category = array_slice($this->products, 0, $this->show);
        }
        else{
            $this->product_category = $this->products;
        }        
                return $this->product_category;
            }
}
?>

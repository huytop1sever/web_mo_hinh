<?php
class Product {
    public $name;

    public $price;
    public $quantity;

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getInfor(){
        return "Name: " . $this->name . "<br>" .
               "Price: " . $this->price . "<br>" .

               "Quantity: " . $this->quantity;
    }

    public function getTotalPrice(){
        return $this->price * $this->quantity;
    }
}
$product = new Product();
$product->setName("Laptop");
$product->setPrice(1000);
$product->setQuantity(5);



echo $product->getInfor() . "<br>";
echo "Total Price: " . $product->getTotalPrice();
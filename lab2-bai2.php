<?php

class product{
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

    public function getInfo() {
        return "Name: " . $this->name . "<br>" .
               "Price: " . $this->price . "<br>" .
               "Quantity: " . $this->quantity;
    }

    public function getTotalPrice() {
        return $this->price * $this->quantity;
    }
}

//sử dụng lớp product
$product = new product();
$product->setName("Laptop");
$product->setPrice(1000);
$product->setQuantity(5);

// Hiển thị thông tin của sản phẩm và tổng giá
echo $product->getInfo() . "<br>";
echo "Total Price: " . $product->getTotalPrice();

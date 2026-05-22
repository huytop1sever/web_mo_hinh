<?php
class Product{
    public $name;
    public $price;
    public $quantity;

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = (float) $price;
    }

    public function setQuantity($quantity) {
        $this->quantity = (int) $quantity;
    }

    public function getInfo() {
        return "Product Name: " . $this->name . "<br>" .
               "Price: $" . number_format($this->price, 2) . "<br>" .
               "Quantity: " . $this->quantity;
    }

    public function calculateTotal() {
        return $this->price * $this->quantity;
    }
}
$product = new Product();
$product->setName("Laptop");
$product->setPrice(19.99);
$product->setQuantity(10);

echo $product->getInfo() . "<br>";
echo "Total: $".$product->calculateTotal();
?>
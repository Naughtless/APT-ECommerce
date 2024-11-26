<?php

class CartItem {
  /*
   * Properties
   */
  private $product;
  private $amount;

  /*
   * Constructor
   */
  public function __construct($newProduct, $newAmount) {
    $this->product = $newProduct;
    $this->amount = $newAmount;
  }

  /*
   * Functions
   */
  public function getPID() {
    return $this->product->getID();
  }

  public function getProduct(){
    return $this->product;
  }
  public function getAmount() {
    return $this->amount;
  }

  public function setAmount($newAmount) {
    $this->amount = $newAmount;
  }

  public function incrementAmount() {
    $this->amount += 1;
  }
}

?>

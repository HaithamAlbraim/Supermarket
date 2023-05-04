
<?php
class product0 {

  public $name;
  private  $quantity;
public function __construct($name , $quantity)
{
  $this->name=$name;
  $this->quantity=$quantity;
}

public function get_name()
{
  return $this->name;
}

public function get_quantity()
{
  return $this->quantity;
}

  public function subtotal($quantity,$price)
  {
    return $quantity*$price;
  }

}?>
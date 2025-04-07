<?php

class Car
{
    // Properties / fields
    private $brand;
    private $color;
    public $vehicleType = "car";

    //Constructor
    public function __construct($brand, $color = "none")
    {
        $this->brand = $brand;
        $this->color = $color;
    }

    //Method
    public function getCarInfo()
    {
        echo "Brand : " . $this->brand . " Color : " . $this->color;
    }
    public function getBrand()
    {
        return $this->brand;
    }
    public function getColor()
    {
        return $this->color;
    }
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }
    public function setColor(string $color)
    {
        $this->color = $color;
    }
}
$car01 = new Car("Volvo", "green");
$car02 = new Car("BMW", "blue");
echo $car01->vehicleType;
echo "<br>";
echo $car01->getCarInfo();
echo "<br>";
$car01->setBrand("Ferrari");
$car01->setColor("Blue");
echo $car01->getBrand() . " ";
echo $car01->getColor();

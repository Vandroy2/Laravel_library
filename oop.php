<?php

//class Car{
//
//    const WHEELS = 4;
//
//    public $color = 'white';
//    public $speed;
//    public $fuel;
//    public $brand;
//
//    public  function test(){
//        echo  '<br> test function';
//    }
//
//    public function tripTime($distance)
//    {
//        $time = $distance / $this->speed;
//        return $time;
//    }
//
//    public function __construct($brand, $color, $fuel, $speed){
//
//        $this->brand = $brand;
//        $this->color = $color;
//        $this->fuel = $fuel;
//        $speed->speed = $speed;
//
//    }
//
//    public function test1(){
//        echo Car::WHEELS;
//        echo self::WHEELS;
//    }
//
//}
//
//$car1 = new Car('Audi', 'green', 12, 110);
//
//$car2 = new Car('BMW', 'orange', 14, 140 );

//$car1->brand = 'Audi';
//$car1->speed = 110;
//$car1->fuel = 12;
//
//$car1->test();




//$car2->brand = 'Mercedes';
//$car2->speed = 130;
//$car2->fuel = 14;
//$car2->color = 'Black';
//
//$car2->test();


use Carbon\Carbon;


class Vehicle {

    public $speed;
    public $fuel;
    public $brand;

    public function tripTime($distance)
    {
        return $distance / $this->speed;
    }

}

class Bicycle extends Vehicle{
    public $type;
    const CALORIES_PER_HOUR = 500;
    public $color = 'white';

    public function caloriesBirned($distance)
    {
        $time = $this->tripTime($distance);
        return $time * self::CALORIES_PER_HOUR;
    }
    public function tripTime($distance): float
    {// $time = ($distance / $this->speed) * 1.2;
        return parent::tripTime($distance)* 1.2;
    }

}

class Car1 extends Vehicle{
    public $fuel;

    public function  fuelConsumption($distance){
        return ($this->fuel * $distance) / 100;
    }
}

$car1 = new Car1();
$car1->speed = 130;
$car1->fuel = 14;

$car2 = new Car();
$car2->speed = 120;
$car2->fuel = 12;

$bicycle = new Bicycle();
$bicycle->speed = 20;

echo '<br>Car1 time:'. $car1->tripTime(100);

$carbon = Carbon:: tomorrow()->format('d/m/y');

$carbon = Carbon::createFromDate('20', '05', '09');

$carbon = Carbon:: createFromTimeString('02:10:30');

$carbon = Carbon::create('50', '09', '30');

$carbon = Carbon::createFromFormat('Y-m-d', '2018-05-23');

$carbon = Carbon::createFromTimestamp('');

$cp = $carbon->copy();

$carbon->format('d/m/y');

$carbon->toDateString();

$carbon->toTimeString();

$carbon->toFormattedDateString();

$carbon->toDayDateTimeString();

$carbon = Carbon::parse();

$carbon->year = 2021;

$carbon2 = new Carbon();

$carbon2->year = 2020;

$carbon->eq($carbon2); # равно или нет

$carbon->gt($carbon2); # больше чем

$carbon->gte($carbon2); # больше или равно

$carbon->lt($carbon2); # меньше чем

Carbon::now()->closest('$carbon', '$carbon2');

Carbon::now()->farthest('$carbon', '$carbon2');

$carbon->isMonday();

$carbon->isFuture();

$carbon->addYears('10');

$carbon->addYear()->addMonth()->addDay();

$carbon->diffInYears($carbon2); # получаем разницу в годах

$carbon->diffForHumans($carbon2); # разница с описанием







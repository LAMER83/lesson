<?php

class animal
{
    public $name;
    public $health;
    private $power;
    private $alive;


    public function __construct(string $name, int $health, int $power)
    {
        $this->name = $name;
        $this->health = $health;
        $this->power = $power;
        $this->alive = true;
    }
    public function calcDamage()
    {
        return $this->power * (mt_rand(100, 300) / 200);
    }
    public function applyDamage(int $damage)
    {
        $this->health -= $damage;

        if ($this->health<0)
        {
            $this->health = 0;
            $this->alive = false;
        }
    }
}

class Dog extends Animal
{

}
class Cat extends Animal
{
    private $lifes;
    public function __construct(string $name, int $health, int $power)
    {
        parent::__construct($name,$health, $power);
        $this->lifes = 9;
    }
}
class Mouse extends Animal
{
    private $hidenlevel;
    public function __construct(string $name, int $health, int $power)
    {
        parent::__construct($name,$health, $power);
        $this->hidenlevel = 0.4;
    }
}

class GameCore
{
    private $units;

    public function __constract()
    {
        $this->units = [];
    }
    public function  addUnit(Animal $unit)
    {
        echo "<pre>";
        $this->units[] = $unit;
       // var_dump($this->units[0]);
    }
    public function nexTick()
    {
        echo "<pre>";
        foreach ($this->units as $unit)
        {
            $damage = $unit->calcDamage();
           // var_dump($unit);
        }
    }
}




$core = new GameCore();

$murzik = new Cat('Murzik',100,10);
$bobik = new Dog('bobik',100,10);
$jerry = new Mouse('jerry',100,10);

$core->addUnit($murzik);
$core->addUnit($bobik);
$core->addUnit($jerry);

$core->nexTick();

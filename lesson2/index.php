<?php
Interface IStorage{
    public function add(string $key, mixed $data) : void;
    public function remove(string $key) : void;
    public function contains(string $key) : bool;
    public function get(string $key) : mixed;
}

class Storoge implements IStorage, JsonSerializable{
    public $istoroge = [];
    public function add(string $key, mixed $data): void
    {
        $this->istoroge[$key] = $data;
    }
    public function remove(string $key): void
    {
        if (isset($this->istoroge) && (array_key_exists($key, $this->istoroge))){
            unset($this->istoroge[$key]);
        }
        // TODO: Implement remove() method.
    }
    public function contains(string $key): bool
    {
        return array_key_exists($key, $this->istoroge);
        // TODO: Implement contains() method.
    }
    public function get(string $key): mixed
    {
        if (isset($this->istoroge) && (array_key_exists($key, $this->istoroge))) {
            return $this->istoroge[$key];
        }
        else{
            return 'Not found';
        }
        // TODO: Implement get() method.
    }
    public function jsonSerialize(): mixed{
        return $this;
    }
    public function __toString(){
        return json_encode($this->jsonSerialize(), JSON_UNESCAPED_UNICODE);
    }
}
class Animal implements JsonSerializable {
    public $name;
    public $health;
    public $alive;
    protected $power;

    public function __construct(string $name, int $health, int $power){
        $this->name = $name;
        $this->health = $health;
        $this->power = $power;
        $this->alive = true;
    }

    public function calcDamage(){
        return $this->power * (mt_rand(100, 300) / 200);
    }

    public function applyDamage(int $damage){
        $this->health -= $damage;

        if($this->health <= 0){
            $this->health = 0;
            $this->alive = false;
        }
    }
    public function jsonSerialize(): mixed{
        return $this;
    }

    public function __toString(){
        return json_encode($this->jsonSerialize(), JSON_UNESCAPED_UNICODE);
    }
}
class JSONLogger{

    protected array $objects = [];

    public function addObject(JsonSerializable $obj) : void{
        $this->objects[] = $obj;
    }

    public function log(string $betweenLogs = ',') : string{
        $logs = array_map(function(JsonSerializable $obj){
            return $obj->jsonSerialize();
        }, $this->objects);

        return implode($betweenLogs, $logs);
    }
}

$res = new Storoge();
$res->add('key1', 'value1');
$res->add('key2', 'value2');
$a1 = new Animal('Murzik', 20, 5);
$a2 = new Animal('Bobik', 30, 3);
$gameStorage = new Storoge();
$gameStorage->add('test', mt_rand(1, 10));
$loger = new JSONLogger();
$loger->addObject($a1);
$loger->addObject($a2);
$loger->addObject($gameStorage);
$loger->addObject($res);


echo $loger->log('<br>') . '<hr>';
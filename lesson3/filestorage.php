<?php

class FileStorage implements IStorage{
	protected array $records = [];
	protected int $ai = 0;
	protected string $dbPath;
    protected static $instance = [];
	protected function __construct(string $dbPath){
		$this->dbPath = $dbPath;

		if(file_exists($this->dbPath)){
			$data = json_decode(file_get_contents($this->dbPath), true);
            if (empty($data)){
                $this->ai = 0;
                return 'файл пуст';
            }
            else{
                $this->records = $data['records'];
                $this->ai = $data['ai'];
            }
		}
	}

    public static function getInstance(string $db) : self{
//self заменить на static - при наследование возможность переопределить
        if(!array_key_exists($db, self::$instance)){
                self::$instance[$db] = new self($db);
        }
        return self::$instance[$db];
    }

	public function create(array $fields) : int{
		$id = ++$this->ai;
		$this->records[$id] = [];
        $this->records [$id] ['title'] = $fields[0];
        $this->records [$id] ['content'] = $fields[1];
		$this->save();
		return $id;
	}

	public function get(int $id) : ?array{
		return $this->records [$id] ?? null;
	}

	public function remove(int $id) : bool{
		if(array_key_exists($id, $this->records)){
			unset($this->records[$id]);
			$this->save();
			return true;
		}
		return false;
	}

	public function update(int $id, array $fields) : bool{
		if(array_key_exists($id, $this->records)){
			$this->records[$id] = $fields;
			$this->save();
			return true;
		}
		return false;
	}

	protected function save(){
		file_put_contents($this->dbPath, json_encode([
			'records' => $this->records,
			'ai' => $this->ai
		]));
	}
}

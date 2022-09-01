<?php

class Article{
	protected int $id; 
	public string $title; 
	public string $content; 
	protected IStorage $storage;
    protected array $isValid;

	public function __construct(IStorage $storage){
		$this->storage = $storage;
	}

	public function create(array $fields){
        $this->isValid = $fields;
        if (!$this->isValid()) {
           $this->id = $this->storage->create($fields);
        }
        else{
            return NULL;
        }
	}

	public function load(int $id){
		$data = $this->storage->get($id);

		if($data === null){
			throw new Exception("article with id=$id not found");
		}

		$this->id = $id;
		$this->title = $data['title'];
		$this->content = $data['content'];
        return $this->title . ' ' .  $this->content;
	}

	public function save(){
		$this->storage->update($this->id, [
			'title' => $this->title,
			'content' => $this->content
		]);
	}

    protected function isValid() : bool{
        foreach ($this->isValid as $key=>$value){
            if (empty($value)) {
                return true;
            }
        }
        return false;
    }
}

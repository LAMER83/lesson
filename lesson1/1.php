<?php
declare(strict_types=1);
class User
{
    public $id;
    public $login;
    public $name;
    public $created;
    public $status;

    public function __construct(int $id)
{
    $this->id = $id;
}



}

$user1 = new User(56);
echo $user1->id;
echo '<br>';
$user2 = new User(51 );
echo $user2->id;
//var_dump($user1);

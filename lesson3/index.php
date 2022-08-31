<?php

include_once('istorage.php');
include_once('article.php');
include_once('filestorage.php');

$art = new Article();
$art->create();
echo '<pre>';
var_dump($art);
//$artStorage = new FileStorage('articles.txt');
//echo '<pre>';
//$artStorage->create(['New art', 'Content new art']);
//$artStorage->create(['New art2', 'Content new art2']);
//$artStorage->title = 'New art';
//$artStorage->content = 'Content new art';
//var_dump($artStorage);
//$art1->save();
/*
$art2 = new Article($ms);
$art2->load(1);
echo '<pre>';
print_r($art2);
echo '</pre>';

$art2->title = 'NZ';
$art2->save(); 
*/
//$artStorage = new Article($artStorage);
//$artStorage->load(1);
//echo '<pre>';
//print_r($artStorage);
//echo '</pre>';
<?php
class Tag
{
    public $attr = [];
    public function attr($attr, $zn)
    {
        $this->attr[] = array($attr, $zn);
    }
}

class SingleTag extends Tag
{

    public $Stag = '';
    public function __construct(string $tag)
    {
        $this->Stag=$tag;
    }


}

class PairTag extends Tag
{
    public $tag = '';
    public $test;
    public function __construct(string $tag)
    {
        $this->tag=$tag;
    }
    public function appendChild(Tag $attr)
    {
        echo "<pre>";
       // echo "<pre>";
      //  print_r($attr);
        foreach ($attr as list ($a, $b, $c)) {
print_r($c);


        }
    }
}

$img = new SingleTag('img');
$img->attr('src', './nz');
$img->attr('alt', 'nz');
$img->attr('width', '100');

$a = new PairTag('a');
$a->appendChild($img);
//echo "<pre>";
//print_r($img);
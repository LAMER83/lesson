<?php
class Tag
{

}

class SingleTag extends Tag
{
    public $attr = [];
    public $tag;
    public function __constract($tag)
    {
        $this->tag=$tag;
    }
    public function attr(array $attr)
    {
        $this->attr = $attr;
        return null;
    }

}

class PairTag extends Tag
{

}

$img = new SingleTag('img');
$img->attr('src', './nz');
$img->attr('alt', 'nz');
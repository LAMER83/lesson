<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
class Tag
{
    public $md = [];
    public $attr = [];

    public function attr($attr, $zn)
    {
        $this->attr[$attr] = $zn;
    }

    public function render()
    {
        $res = '<' . $this->tag . ' ';

            foreach ($this->attr as $key => $value) {
                $res .= $key . '="' . $value . '" ';
            }
        $res .= '>';
        foreach ($this->PairAttr as $value)
        {
            $res .= $value . ' ';
        }
        $res .= '</'.$this->tag.'>';

        return $res;
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
    public $test = '';
    public $tag = '';
    public $PairAttr = [];

    public function __construct(string $tag)
    {
        $this->tag=$tag;

    }
    public function appendChild(Tag $attr)
    {
        if ($attr instanceof SingleTag)
        {
            $this->test  = "<".$attr->Stag . " ";
            $this->test .= '';
            foreach ($attr as $value) {
                foreach ($value as $item=>$key){
                    $this->test .= $item . '="' . $key . '" ';
                }
            }
            $this->test .= ">";
            $this->PairAttr[] = $this->test;
            //return $this->test;
            $this->test = '';

            return $this->PairAttr;
        }
        elseif($attr instanceof PairTag){

            $this->md [] = $this->tag;
            return $this->md;
        }
        }



}

$img = new SingleTag('img');
$img->attr('src', './nz');
$img->attr('alt', 'nz');
$img->attr('width', '100');


$hr = new SingleTag('hr');



$a = new PairTag('a');
$a->attr('href', './nz');
$a->appendChild($img);
$a->appendChild($hr);


$a->render();

//echo "<pre>";
//print_r($b);
$ec = htmlspecialchars ($a->render());
echo $ec;
//echo '<br>';
//$b->appendChild($a);

//echo htmlspecialchars($a->appendChild($img));
//echo '<br>';
//echo "<pre>";
//htmlspecialchars(print_r($b));

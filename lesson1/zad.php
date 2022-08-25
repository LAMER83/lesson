<?php
class Tag
{
    public $tag = '';
    public function __construct(string $tag)
    {
        $this->tag=$tag;

    }
    public function renderArgs()
    {

    }

}

class SingleTag extends Tag
{
}

class PairTag extends Tag
{

    public function render()
    {
        $childs = '';

        return sprintf(
            '<%1$s%2$s>%3$s</%1$s>',
            $this->tag,
            $this->renderArgs(),
            $childs
        );
    }
}

$form = new PairTag('form');
$ec = htmlspecialchars ($form->render());
echo $ec;


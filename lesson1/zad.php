<?php
class Tag
{
    public $tag = '';
    public $attr = [];
    public function __construct(string $tag)
    {
        $this->tag=$tag;

    }
    public function renderArgs()
    {
        var_dump($this->attr);
        foreach ($this->attr as $value=>$key)
        {

        }
    }
    public function attr($value, $key)
    {
        $this->attr [$value] = $key;
        return $this;
    }
/*    protected function renderArgs(): string
    {
        if (!$this->attributes)
        {
            return '';
        }
        $attr = [];
        foreach ($this->attributes as $arg => $value)
        {
            if (is_null($value))
            {
                $attr[] = $arg;
            }
            else
            {
                $attr[] = "$arg=\"$value\"";
            }
        }
        return ' ' . implode(' ', $attr);s
    }*/


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



$form = new PairTag('label');
$form->attr('src', 'f1.jpj');
$form->attr('imj', 'ieche');

$ec = htmlspecialchars ($form->render());
echo $ec;


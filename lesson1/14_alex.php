<?php
class Tag
{
    protected string $tag;
    protected array $attributes = [];
    public function  __construct($tag)
    {
        $this->tag = $tag;
    }
    public function attr(string $arg, $value = null): Tag
    {
        $this->attributes[$arg] = $value;
        return $this;
    }

    protected function renderArgs(): string
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
        return ' ' . implode(' ', $attr);
    }
    public function render(): string
    {

        return sprintf(
        //Разбор макета
        //< - символ как есть
        //%1 - нумерация аргумента
        //$s - аргумент типа строка
        //%2 - нумерация аргумента (аргумент номер2)
        //> - символ как есть
            '<%1$s%2$s>',
        // передаем тег
            $this->tag,
            $this->renderArgs()
        );
    }
}

class SingleTag extends Tag
{

}

class PairTag extends Tag
{
    protected array$childs = [];

    public function  appendChild(Tag $child_tag): Tag
    {
        $this->childs[] = $child_tag;
        return $this;
    }

    public function render(): string
    {
        //echo '<pre>';
        //var_dump($this->childs);
        $childs = '';

        if ($this->childs)
        {

            foreach ($this->childs as $child)
            {
                //echo $childs; echo '<br>';
                echo '<pre>';
              //  print_r($child);
                $childs.= $child->render();

            }
        }
        return sprintf(
            '<%1$s%2$s>%3$s</%1$s>',
            $this->tag,
            $this->renderArgs(),
            $childs
        );
    }

}

$s = new PairTag('form');
/*$l = new PairTag('label');
$l2 = new PairTag('label');
$img = new SingleTag('img');
$img->attr('img', 'f1.jpg');
$img->attr('her', 'dddd1.jpg');
$l->appendChild($img);
//$s->appendChild($l);
$l2->appendChild($img);

$s->appendChild($l);
$s->appendChild($l2);*/
$ec = htmlspecialchars ($s->render());
echo "<br>";
echo $ec;
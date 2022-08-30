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
      //  var_dump($this->attr);
        if (!$this->attr)
        {
            return '';
        }
        $att = [];
        foreach ($this->attr as $value=>$key)
        {
            if (is_null($key))
            {
                $att [] = $attr;
            }
            else
            {
                $att [] = "$value=\"$key\"";
            }

        }
        return ' ' . implode(' ', $att);
    }
    public function attr($value, $key)
    {
        $this->attr [$value] = $key;
        return $this;
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

    public function render() : string
    {
        $childs = '';
        if ($this->childs)
        {

            foreach ($this->childs as $child)
            {
                echo '<pre>';
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


$img = new SingleTag('img');
$img->attr('src', 'f1.jpj');
$img->attr('alt', 'f1 not fount');
$form = new PairTag('form');
$label = new PairTag('label');
$label->appendChild($img);
$form->appendChild($label);



$ec = htmlspecialchars ($form->render());
echo $ec;


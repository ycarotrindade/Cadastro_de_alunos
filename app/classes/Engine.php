<?php 

declare(strict_types=1);
namespace app\classes;

class Engine
{
    private ?string $layout; #template
    private string $content; #conteúdo adicional
    private array $data; #dados que precisamos na view

    private function load()
    {
        #retorna o conteúdo que quer ser mostrado dinamicamente na view
        return !empty($this->content)? $this->content:'';
    }

    private function extends(?string $layout, array $data=[])
    {
        #usado na view para carregar o template
        $this->layout=$layout;
        $this->data=$data;
    }

    public function render(string $view, array $data)
    {
        $view=dirname(__FILE__,2)."\\views\\$view.php";
        if(!file_exists($view))
        {
            throw new \Exception("View $view does not found");
        }
        ob_start();
        extract($data);
        require $view;
        $content=ob_get_contents();
        ob_end_clean();
        if(!empty($this->layout))
        {
            $this->content=$content;
            $data=array_merge($this->data,$data);
            $layout=$this->layout;
            $this->layout=null;
            return $this->render($layout,$this->data);
        }
        return $content;
    }
}

?>
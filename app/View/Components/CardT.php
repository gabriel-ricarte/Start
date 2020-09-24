<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardT extends Component
{
    public $tipo;

    public $mensagem;

    public function __construct($tipo, $mensagem)
    {
        $this->tipo = $tipo;
        $this->mensagem = $mensagem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card-t');
    }
}

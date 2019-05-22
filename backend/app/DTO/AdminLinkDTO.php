<?php

namespace App\DTO\Homework;

use App\DTO\BaseDTO;

class AdminLinkDTO extends BaseDTO
{
    protected $label;
    protected $active;
    protected $view;
    protected $viewParameters;

    public function __construct(string $label, string $view)
    {
        $this->label = $label;
        $this->view = $view;
        $this->active = false;
        $this->viewParameters = [];
    }

    public function toArray()
    {
        return [
            'label' => $this->label,
            'active' => $this->active,
            'view' => $this->view,
            'viewParameters' => $this->viewParameters
        ];
    }

    public function activate(array $viewParameters)
    {
        $this->viewParameters = $viewParameters;
        $this->active = true;
    }
}

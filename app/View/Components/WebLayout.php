<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class WebLayout extends Component
{
    public function __construct(
        public ?string $seoTitle = null,
        public ?string $seoDescription = null,
        public ?string $seoImage = null,
        public ?string $seoType = null,
    ) {}

    public function render(): View
    {
        return view('layouts.web.index', [
            'seoTitle' => $this->seoTitle,
            'seoDescription' => $this->seoDescription,
            'seoImage' => $this->seoImage,
            'seoType' => $this->seoType,
        ]);
    }
}

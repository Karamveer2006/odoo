<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Structure extends Component
{
    /**
     * Create a new component instance.
     */
    public $title ;
    public $description ;
    public $meta_title ;
    public $meta_description ;
    public $meta_keywords ;
    public function __construct($title = "CivicTrack", $description = "Your platform for civic engagement and issue tracking.", $metatitle = "CivicTrack", $metadescription = "Your platform for civic engagement and issue tracking.", $metakeywords = "civic, engagement, issues, tracking")
    {
        $this->title = $title;
        $this->description = $description;
        $this->meta_title = $metatitle;
        $this->meta_description = $metadescription;
        $this->meta_keywords = $metakeywords;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.structure');
    }
}

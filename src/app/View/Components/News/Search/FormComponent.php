<?php declare(strict_types=1);

namespace App\View\Components\News\Search;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class FormComponent extends Component
{
    public $result;

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $result)
    {
        $this->result = $result;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news.search.form-component');
    }
}

<?php

namespace App\View\Components\News;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use App\Models\Customer;

class ListComponent extends Component
{
    public array $news = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $news)
    {
        foreach($news as $new){
            $this->news[] = [
                'id' => $new->id,
                'title' => $new->title,
                'description' => $new->description,
                'created_at' => $new->created_at->format('d/m/Y'),
                'author' => $new->author->profile->name(),
                'url_contact' => route('scheduler.contacts', [ 'contact_id' => $new->author->id ] ),
                'is_contact' => $this->isContact($new->author->id, auth()->id()),
                'brief' => Str::limit($new->description, 100),
                'url' => route('new', $new->id)
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components..news.list-component');
    }

    private function isContact(int $author_id, int $customer_id): bool
    {
        return Customer::find($customer_id)?->contacts()->where('contact_id', $author_id)->exists() ?? false;
    }
}

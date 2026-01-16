<?php declare(strict_types=1);

namespace App\View\Components\News;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;
use App\Models\Customer;
use Carbon\Carbon;

class NewComponent extends Component
{
    public array $new = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Post $post)
    {
        $this->new = [
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->content,
            'created_at' => Carbon::parse($post->created_at)->format('d/m/Y'),
            'author' => $post->author->profile->name(),
            'url_contact' => route('scheduler.contacts', [ 'contact_id' => $post->author->id ] ),
            'is_contact' => $this->isContact($post->author->id, auth()->id()),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news.new-component');
    }

    public function isContact(int $author_id, int $customer_id): bool
    {
        return Customer::find($customer_id)?->contacts()->where('contact_id', $author_id)->exists() ?? false;
    }
}

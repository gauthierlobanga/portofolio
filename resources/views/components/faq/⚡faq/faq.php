<?php

use App\Models\Faq;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Transition;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url(as: 'q')]
    public string $search = '';

    #[Transition(skip: true)]
    public function clearSearch(): void
    {
        $this->reset('search');
    }

    public function updatedSearch(string $value): void
    {
        $this->search = mb_substr(trim($value), 0, 120);
    }

    #[Computed]
    public function faqs(): Collection
    {
        $search = trim($this->search);
        $query = Faq::query()
            ->active()
            ->ordered();

        if ($search === '') {
            $query->limit(6);
        } else {
            $term = '%'.$search.'%';

            $query->where(function (Builder $query) use ($term): void {
                $query
                    ->where('question', 'like', $term)
                    ->orWhere('answer', 'like', $term);
            });
        }

        return $query->get();
    }
};

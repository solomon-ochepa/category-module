<?php

namespace Modules\Category\app\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Category\app\Models\Category;

class Index extends Component
{
    use WithPagination;

    public $selected = [];

    public $search = '';

    public $limit = 25;

    public $page = 1;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function render()
    {
        $data = [];
        $data['categories'] = Category::search($this->search)->orderBy('name')->paginate(request('limit', $this->limit));

        return view('category::livewire.index', $data);
    }
}

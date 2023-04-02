<?php

namespace Modules\Category\app\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Category\app\Models\Category;

class Index extends Component
{
    use WithPagination;

    public $selected = [];

    public $search = "";
    public $limit = 25;
    public $page = 1;

    protected $queryString = [
        'search'    => ['except' => ''],
        'page'      => ['except' => 1],
    ];

    public function render()
    {
        $data = [];
        if ($this->search) {
            $data['categories'] = Category::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('slug', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orderBy('name')
                ->paginate($this->limit);
        } else {
            $data['categories'] = Category::orderBy('name')->paginate($this->limit);
        }

        return view('category::livewire.admin.index', $data);
    }
}

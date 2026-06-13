<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Costume;
use App\Models\Category;
use App\Models\Region;

class CostumeCatalog extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $selectedRegion = '';
    public $sort = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
        'selectedRegion' => ['except' => ''],
        'sort' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatingSelectedRegion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::all();
        $regions = Region::all();

        $query = Costume::with(['region', 'images'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedCategory, function ($q) {
                $q->where('category_id', $this->selectedCategory);
            })
            ->when($this->selectedRegion, function ($q) {
                $q->where('region_id', $this->selectedRegion);
            });

        if ($this->sort === 'price_asc') {
            $query->orderBy('price_per_day', 'asc');
        } elseif ($this->sort === 'price_desc') {
            $query->orderBy('price_per_day', 'desc');
        } else {
            $query->latest();
        }

        $costumes = $query->paginate(12);

        return view('livewire.costume-catalog', [
            'costumes' => $costumes,
            'categories' => $categories,
            'regions' => $regions,
        ])->layout('layouts.app');
    }
}

<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{

    use WithPagination;

    #[Url(history: true)]
    public string $search = '';
    
    #[Url(history: true)]
    public string $role = '';

    #[Url()]
    public int $registersPerPage = 5;

    #[Url(history: true)]
    public string $sortBy = 'created_at';

    #[Url(history: true)]
    public string $sortDirection = 'asc';

    public function delete(User $user): void
    {
        $user->delete();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function setSortBy(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            return;
        }
        $this->sortBy = $column;
        $this->sortDirection = 'asc';
    }

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::search($this->search)
                ->role($this->role)->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->registersPerPage)
        ]);
    }
}

<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{

    use WithPagination;

    public string $search = '';
    public string $role = '';
    
    public int $registersPerPage = 5;

    public string $sortBy = 'created_at';
    public string $sortDirection = 'asc';

    public function delete(User $user): void
    {
        $user->delete();
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

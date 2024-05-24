<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{

    use WithPagination;

    public int $registersPerPage = 5;
    public string $search = '';
    public string $role = '';

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::search($this->search)
                ->role($this->role)->paginate($this->registersPerPage)
        ]);
    }
}

<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{

    use WithPagination;

    public int $registersPerPage = 5;

    public function render()
    {
        return view('livewire.users-table', ['users' => User::paginate($this->registersPerPage)]);
    }
}

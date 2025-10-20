<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.user.users', ['users' => $users]);
    }
}

<?php

namespace App\Livewire\Profile\Modals;

use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;

class ViewProfile extends ModalComponent
{
    public Role $profile;

    public function render()
    {
        return view('livewire.profile.modals.view-profile');
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '2xl';
    }
}

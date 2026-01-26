<?php

namespace Modules\User\app\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Auth\App\Concerns\PasswordValidationRules;
use Modules\Auth\app\Livewire\Actions\Logout;

class DeleteUserForm extends Component
{
    use PasswordValidationRules;

    public string $password = '';

    public function render()
    {
        return view('user::livewire.settings.delete-user-form');
    }

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => $this->currentPasswordRules(),
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}

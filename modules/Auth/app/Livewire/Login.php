<?php

namespace Modules\Auth\App\Livewire;

use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Modules\Tenancy\App\Models\Domain;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    #[Validate(['required', 'string'])]
    public $domain;

    public function render()
    {
        return view('auth::livewire.login');
    }

    public function company()
    {
        $this->domain($this->domain);

        $this->validate();

        $domain = Domain::where('domain', $this->domain)->first();
        if (! $domain) {
            $this->addError('domain', 'Company not found.');

            return;
        }

        return redirect()->away('//'.$domain->url.'/login');
    }

    public function updatedDomain($value)
    {
        return $this->domain($value);
    }

    public function domain(string $domain)
    {
        return $this->domain = Str::of($domain)->endsWith(domain()) ? Str::of($domain)->before('.'.domain(), '')->toString() : $domain;
    }
}

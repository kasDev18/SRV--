<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BasePage;

class Login extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        if(ENV('DESKTOP',false))
        {
            $this->form->fill([
                'email' => 'admin1@admin.com',
                'password' => 'password',
                'remember' => true,
            ]);
        }

    }
}

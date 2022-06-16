<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Settings extends Component
{
    public array $settings;

    public function mount()
    {
        $this->settings = auth()->user()->settings->toArray();
    }

    public function rules()
    {
        return [
            'settings.timezone' => 'required|timezone',
            'settings.locale'   => 'required',
        ];
    }

    public function updateSettings()
    {
        $validatedFields = $this->validate()['settings'];

        auth()->user()->settings->fill($validatedFields)->update();

        $this->emitSelf('saved');
    }

    public function render()
    {
        return view('livewire.user.settings');
    }
}

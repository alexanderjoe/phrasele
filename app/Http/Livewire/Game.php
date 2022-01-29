<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Game extends Component
{
    public $store = [];
    public $solution = ['T', 'h', 'i', 's', ' ', 'i', 's', ' ', 'a', ' ', 't', 'e', 's', 't'];
    public $solutionLength = 11;
    public $attempts = 0;
    private $MAX_ATTEMPTS = 6;

    public function render()
    {
        return view('livewire.game');
    }

    public function handleKey($key)
    {
        if ($key == "Backspace") {
            array_pop($this->store);
        } else if (!preg_match('/^[A-Za-z0-9]+$/', $key)){
            $this->store[] = $key;
        }
    }
}

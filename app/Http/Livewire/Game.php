<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Game extends Component
{
    public $solution = ['t', 'h', 'i', 's', ' ', 'i', 's', ' ', 'a', ' ', 't', 'e', 's', 't'];
    public $curPos = 0;
    public $attempts = 0;
    public $MAX_ATTEMPTS = 6;
    public $storeInput;
    public $attemptsStore = [];
    public $solved = false;

    public function render()
    {
        return view('livewire.game');
    }

    public function getStoreProperty()
    {
        return str_split($this->storeInput);
    }

    public function getSolutionLengthProperty()
    {
        return count($this->solution);
    }

    public function getKey($index, $attempt)
    {
        if ($attempt == $this->attempts) {
            if (array_key_exists($index, $this->getStoreProperty())) {
                return $this->getStoreProperty()[$index];
            }
        } else {
            if (isset($this->attemptsStore[$attempt])) {
                if (array_key_exists($index, $this->attemptsStore[$attempt]))
                    return $this->attemptsStore[$attempt][$index];
            }
        }

        return '';
    }

    public function getColor($index, $attempt)
    {
        if (isset($this->attemptsStore[$attempt])) {
            if (array_key_exists($index, $this->attemptsStore[$attempt]))
                if ($this->solution[$index] == $this->attemptsStore[$attempt][$index]) {
                    return 'bg-green-500';
                } else if (in_array($this->attemptsStore[$attempt][$index], $this->solution)) {
                    return 'bg-yellow-400';
                }
        }

        return '';
    }

    public function handleAttempt()
    {
        if ($this->getSolutionLengthProperty() == count($this->getStoreProperty())) {
            $this->attemptsStore[] = $this->getStoreProperty();
            $this->attempts++;
            if($this->getStoreProperty() == $this->solution) {
                $this->solved = true;
            }
            $this->storeInput = "";
        } else {
            session()->flash('error', 'Your solution is not the correct length!');
        }
    }
}

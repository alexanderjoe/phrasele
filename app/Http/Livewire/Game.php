<?php

namespace App\Http\Livewire;

use App\Models\Solution;
use Livewire\Component;

class Game extends Component
{
    // Different depending on the current solution
    public $solution = [];
    public $MAX_ATTEMPTS = 0;
    public $length;

    // Same for the start of every game
    public $curPos = 0;
    public $attempts = 0;
    public $solved = false;
    public $attemptsStore = [];
    public $store = [];

    public function render()
    {
        return view('livewire.game');
    }

    public function mount()
    {
        $solution = Solution::orderByDesc('starts_at')->where('starts_at', '<', now())->first();

        $this->solution = json_decode($solution->solution);
        $this->MAX_ATTEMPTS = $solution->max_attempts;
        $this->length = count($this->solution);
    }

    /**
     * Get what letter should be shown in a given attempt (or current attempt)
     * @param $index
     * @param $attempt
     * @return mixed|string
     */
    public function getKey($index, $attempt)
    {
        if ($attempt == $this->attempts) {
            if (array_key_exists($index, $this->store)) {
                return $this->store[$index];
            }
        } else {
            if (isset($this->attemptsStore[$attempt])) {
                if (array_key_exists($index, $this->attemptsStore[$attempt]))
                    return $this->attemptsStore[$attempt][$index];
            }
        }

        return '';
    }

    /**
     * Get what color the tile for a previous attempt should be
     * @param $index
     * @param $attempt
     * @return string
     */
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

    /**
     * Handles when a user backspaces to delete an entered character
     * @return void
     */
    public function handleDelete()
    {
        if($this->curPos <= 0) return;
        if ($this->solution[--$this->curPos] == '') {
            array_pop($this->store);
            $this->curPos--;
        }
        array_pop($this->store);
    }

    /**
     * Handles when a user presses enter to submit an attempt
     * @return void
     */
    public function handleAttempt()
    {
        if ($this->length == count($this->store)) {
            $this->attemptsStore[] = $this->store;
            $this->attempts++;
            if ($this->store == $this->solution) {
                $this->solved = true;
            }
            $this->store = [];
            $this->curPos = 0;
        } else {
            session()->flash('error', 'Your solution is not the correct length!');
        }
    }

    /**
     * Handles when a user presses a key between a-z
     * @param $key
     * @return void
     */
    public function handleKey($key)
    {
        if($this->solved) return;
        if($this->length <= $this->curPos) return;
        if ($this->solution[$this->curPos] == '') {
            $this->store[] = '';
            $this->curPos++;
        }
        $this->store[] = $key;
        $this->curPos++;
    }
}

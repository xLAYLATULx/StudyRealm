<?php

namespace App\Livewire\TaskManager;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public function render()
    {
        return view('livewire.task-manager.index')->extends('layouts.navbar')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Forms;

use App\Models\User;
use App\Resources\UserResource;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DemoTable extends LivewireDatatable
{
    public function builder()
    {
        return User::query();
    }

    public function columns()
    {
        return UserResource::asTable();
    }
}

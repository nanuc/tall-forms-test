<?php

namespace App\Http\Livewire\Forms;

use App\Models\User;
use App\Resources\UserResource;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DemoTableLittle extends LivewireDatatable
{
    public function builder()
    {
        return User::query()->orderBy('name');
    }

    public function columns()
    {
        return UserResource::asTable(['is_active', 'name']);
    }
}

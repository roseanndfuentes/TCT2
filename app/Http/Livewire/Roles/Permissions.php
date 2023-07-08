<?php

namespace App\Http\Livewire\Roles;

use App\Services\PermissionsService;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissions extends Component
{
    public $role;

    public $search = '';

    public $description = PermissionsService::DESCRIPTIONS;

    public $queryStrings = ['search' => ['except' => '']];

    public function mount(Role $role)
    {
        $this->role = $role;
    }

    public function render()
    {
        return view('livewire.roles.permissions', [
            'permissions' => Permission::query()
                ->when($this->search, fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
                ->get(),
        ]);
    }

    public function revoke($permissionId)
    {
        $permission = Permission::find($permissionId);
        $this->role->revokePermissionTo($permission);
        $this->role->refresh();
    }

    public function grant($permissionId)
    {
        $permission = Permission::find($permissionId);
        $this->role->givePermissionTo($permission);
        $this->role->refresh();
    }
}

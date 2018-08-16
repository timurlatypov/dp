<?php

namespace App\Permissions;

use App\{Role, Permission};

trait HasPermissionsTrait
{
	public function givePermissionTo(...$permisisons)
	{
		$permissions = $this->getAllPermissions(array_flatten($permisisons));

		if ($permissions === null) {
			return $this;
		}

		$this->permissions()->sync($permissions);

		return $this;
	}
	public function withdrawPermissionTo(...$permisisons)
	{
		$permissions = $this->getAllPermissions(array_flatten($permisisons));

		$this->permissions()->detach($permissions);

		return $this;
	}


	public function hasRole($roles)
	{

		foreach ($roles as $role) {
			if ($this->roles->contains('name', $role)) {
				return true;
			}
		}
		return false;
	}

	public function hasPermissionTo($permission)
	{
		return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
	}

	protected function hasPermissionThroughRole($permission)
	{
		foreach ($permission->roles as $role) {
			if ($this->roles->contains($role)) {
				return true;
			}
		}
		return false;
	}

	protected function hasPermission($permission)
	{
		return (bool) $this->permissions->where('name', $permission->name)->count();
	}

	protected function getAllPermissions(array $permissions)
	{
		return Permission::whereIn('name', $permissions)->get();
	}




	public function roles()
	{
		return $this->belongsToMany(Role::class, 'users_roles');
	}
	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'users_permissions');
	}
}
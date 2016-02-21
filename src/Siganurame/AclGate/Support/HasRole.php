<?php 

namespace Siganurame\AclGate\Support;

trait HasRole
{
	use MakeRoleModel, MakePermissionModel;

	/**
	 * Get roles for current user
	 *
	 * @return collection
	 */
	public function roles()
	{
		return $this->belongsToMany(config('acl.models.role'));
	}

	/**
	 * Assign the given role to the user.
	 *
	 * @param  string $role
	 * 
	 * @return mixed
	 */
	public function assignRole($role)
	{
		return $this->roles()->save(
			$this->roleModel()->where('name', $role)->firstOrFail()
		);
	}

	/**
	 * Determine if the user has the given role.
	 *
	 * @param  mixed $role
	 * 
	 * @return boolean
	 */
	public function hasRole($role)
	{
		if (is_string($role)) {
			return $this->roles->contains('name', $role);
		}

		return !! $role->intersect($this->roles)->count();
	}

	/**
	 * Determine if the user may perform the given permission.
	 *
	 * @param  mixed $permission
	 * 
	 * @return boolean
	 */
	public function hasPermission($permission)
	{
		$permission = $this->permissionModel()->where('name', $permission)->firstOrfail();

		return $this->hasRole($permission->roles);
	}
}
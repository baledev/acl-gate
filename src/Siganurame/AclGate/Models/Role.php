<?php

namespace Siganurame\AclGate\Models;

use Illuminate\Database\Eloquent\Model;
use Siganurame\AclGate\Support\MakePermissionModel;

class Role extends Model
{
	use MakePermissionModel;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'desc'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * Get the user for the roles
	 */
	public function users()
	{
		return $this->belongsToMany(config('auth.providers.users.model'));
	}

	/**
	 * Get the permissions for the roles
	 */
	public function permissions()
	{
		return $this->belongsToMany(config('acl.models.permission'));
	}

	/**
	 * Grant the given permission to a role.
	 *
	 * @param  Permission $permission
	 * @return mixed
	 */
	public function givePermissionTo($permission)
	{
		return $this->permissions()->save(
			$this->permissionModel()->where('name', $permission)->firstOrFail()
		);
	}
}

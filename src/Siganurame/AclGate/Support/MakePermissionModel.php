<?php 

namespace Siganurame\AclGate\Support;

use Exception;

trait MakePermissionModel
{
	/**
	 * Make Permission Model
	 *
	 * @return  Model
	 */
	public function permissionModel()
	{
		$permission = app()->make(config('acl.models.permission'));

		if(! $permission instanceof \Illuminate\Database\Eloquent\Model) {
			throw new Exception('Class '. config('acl.models.permission') .' must be instance of Illuminate\\Database\\Eloquent\\Model');
		}

		return $permission;
	}
}
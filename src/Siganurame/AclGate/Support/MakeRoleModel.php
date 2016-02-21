<?php 

namespace Siganurame\AclGate\Support;

use Exception;

trait MakeRoleModel
{
	/**
	 * Make Role model
	 *
	 * @return  Model
	 */
	public function roleModel()
	{
		$role = app()->make(config('acl.models.role'));

		if(! $role instanceof \Illuminate\Database\Eloquent\Model) {
			throw new Exception('Class '. config('acl.models.role') .' must be instance of Illuminate\\Database\\Eloquent\\Model');
		}

		return $role;
	}
}
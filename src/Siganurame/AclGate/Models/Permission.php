<?php

namespace Siganurame\AclGate\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'desc'];

    /**
     * Get the roles for the permissions
     */
    public function roles()
    {
        return $this->belongsToMany(config('acl.models.role'));
    }
}

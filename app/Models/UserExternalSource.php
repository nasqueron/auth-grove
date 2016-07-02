<?php

namespace AuthGrove\Models;

use Illuminate\Database\Eloquent\Model;

class UserExternalSource extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_external_sources';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['source_name', 'source_user_id', 'user_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * Gets fillable but not hidden attributes, plus create/update time.
     *
     * @return Array
     */
    public function getAttributes () {
        $attributes = array_diff($this->fillable , $this->hidden);
        $attributes[] = 'created_at';
        $attributes[] = 'updated_at';
        array_unshift($attributes, 'id');
        return $attributes;
    }

    /**
     * Gets user attached to this source.
     *
     * @return User
     */
    public function getUser () {
        return User::find($this->user_id);
    }

}

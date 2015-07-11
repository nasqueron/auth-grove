<?php namespace AuthGrove;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use AuthGrove\Services\FindableByAttribute;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, FindableByAttribute;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'fullname', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Gets fillable but not hidden attributes, plus create/update time
	 *
	 * @return Array
	 */
	public function getAttributes () {
		$attributes = array_diff($this->fillable , $this->hidden);
		$attributes[] = 'created_at';
		$attributes[] = 'updated_at';
		return $attributes;
	}

	/**
	 * Gets non sensible properties
	 *
	 * @return Array
	 */
	public function getInformation () {
		$info = [];
		$attributes = $this->getAttributes();
		foreach ($attributes as $attribute) {
			$info[$attribute] = $this->attributes[$attribute];
		}
		return $info;
	}

	/**
	 * Gets the full name of an user, or if not defined, the username.
	 */
	public function getName () {
		if ($this->attributes['fullname'] !== "") {
			return $this->attributes['fullname'];
		}
		return $this->attributes['username'];
	}
}

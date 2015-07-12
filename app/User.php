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
	 * The currenty user identity
	 */
	private $identity;

	/**
	 * Gets fillable but not hidden attributes, plus create/update time
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
	 * Localizes attribute
	 *
	 * @param string $attribute The attribute to localize
	 * @return string The localized name of the attribute
	 */
	public static function localizeAttribute ($attribute) {
		return trans("panel.user-attributes.$attribute");
	}

	/**
	 * Gets default attributes
	 *
	 * @return Array an array of string, each a default attribute of the model
	 */
	public static function getDefaultAttributes () {
		$user = new self();
		return $user->getAttributes();
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

	///
	/// Identities
	///

	/**
	 * Gets identity name
	 */
	public function getIdentityOrAccountName () {
		$identity = $this->getCurrentIdentity();
		if ($identity === null) {
			return $this->attributes['username'];
		}
		return $identity->getName();
	}

	/**
	 * Autoselects an identity
	 */
	public function autoselectsIdentity () {
	}

	/**
	 * Gets the full name of an identity, or if not defined, the username.
	 *
	 * If the user hasn't selected an identity yet, we use the user's username.
	 */
	public function getCurrentIdentity () {
		if ($this->identity = null) {
			//Tries to autoselect identity if there is only one
			//or if one is configured to be used by default.
			$this->autoselectsIdentity();
		}
		return $this->identity;
	}
}

<?php namespace AuthGrove;

use Illuminate\Database\Eloquent\Model;

class Identity extends Model {

    use FindableByAttribute;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'identities';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['uuid', 'user_id', 'username', 'fullname'];

	/**
	 * The user linked to this identity
	 *
	 * @var User
	 */
	private $user;

	/**
	 * Gets user linked to this identity
	 */
	public function getUser () {
		if ($this->user === null) {
			$this->user = User::find($this->attributes['user_id']);
		}
		return $this->user;
	}

	/**
	 * Gets identity name
	 */
	public function getName () {
		if ($this->attributes['fullname'] !== "") {
			return $this->attributes['fullname'];
		}
		return $this->attributes['username'];
	}
}

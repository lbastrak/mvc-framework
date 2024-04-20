<?php

namespace models;
use app\Model;
use library\isValid;

class User extends Model
{
	public function get_id() {
		return $this->DB->column("SELECT id FROM clients WHERE auth_token = :token",['token' => $this->token]);
	}
}
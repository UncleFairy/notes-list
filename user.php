<?php

/**
 * Class User
 * Main storage for users
 */
class User implements Serializable {
	private $firstName;
	private $lastName;
	private $patronymic;
	private $email;
	private $message;
	/** @var DateTime */
	private $date;

	public function getFirstName() {
		return $this->firstName;
	}

	public function setFirstName($firstName) {
		$this->firstName = $firstName;

		return $this;
	}

	public function getLastName() {
		return $this->lastName;
	}

	public function setLastName($lastName) {
		$this->lastName = $lastName;

		return $this;
	}

	public function getPatronymic() {
		return $this->patronymic;
	}

	public function setPatronymic($patronymic) {
		$this->patronymic = $patronymic;

		return $this;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;

		return $this;
	}

	public function getMessage() {
		return $this->message;
	}

	public function setMessage($message) {
		$this->message = $message;

		return $this;
	}
	/**
	 * @param string $date
	 *
	 * @return User
	 * @throws Exception
	 */
	public function setDate($date) {
		$this->date = new DateTime();
		$this->date->setTimestamp($date);

		return $this;
	}

	/**
	 * Serialize object
	 *
	 * @inheritDoc
	 */
	public function serialize() {
		return serialize([
			'first_name' => $this->getFirstName(),
			'last_name' => $this->getLastName(),
			'patronymic' => $this->getPatronymic(),
			'email' => $this->getEmail(),
			'message' => $this->getMessage(),
			'date' => $this->getDate("s")
		]);
	}

	/**
	 * Restore serialized object
	 *
	 * @inheritDoc
	 */
	public function unserialize($serialized) {
		$unserialized = unserialize($serialized);
		$this->setFirstName($unserialized['first_name']);
		$this->setLastName($unserialized['last_name']);
		$this->setPatronymic($unserialized['patronymic']);
		$this->setEmail($unserialized['email']);
		$this->setMessage($unserialized['message']);
		$this->setDate($unserialized['date']);

		return $this;
	}
}

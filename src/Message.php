<?php


namespace Holabs\Flashes;

use ErrorException;
use Nette\Http\Url;
use stdClass;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/flashes
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
class Message {

	const DEFAULT_INFO = 'info';
	const DEFAULT_SUCCESS = 'success';
	const DEFAULT_WARNING = 'warning';
	const DEFAULT_ERROR = 'danger';

	/** @var string */
	public static $INFO = self::DEFAULT_INFO;

	/** @var string */
	public static $SUCCESS = self::DEFAULT_SUCCESS;

	/** @var string */
	public static $WARNING = self::DEFAULT_WARNING;

	/** @var string */
	public static $ERROR = self::DEFAULT_ERROR;

	/** @var string */
	protected $message;

	/** @var string */
	protected $type;

	/** @var stdClass|null */
	protected $link = NULL;

	/**
	 * @param string      $message
	 * @param string|null $type
	 */
	public function __construct($message, $type = NULL) {
		$this->message = $message;
		$this->type = $type ? : self::$INFO;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param string $message
	 * @return Message
	 */
	public function setMessage($message) {
		$this->message = $message;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 * @return Message
	 */
	public function setType($type) {
		$this->type = $type;

		return $this;
	}

	/**
	 * @return stdClass|null
	 */
	public function getLink(){
		return $this->link;
	}

	/**
	 * @param string $url
	 * @param string $text
	 * @return stdClass
	 */
	public function setLink($url, $text){
		$this->link = (object) [
			'url' => new Url($url),
			'text' => $text,
		];

		return $this->link;
	}


	/******* MAGICS **********/


	/**
	 * For prevent BC Break with default Nette Framework flashMessages
	 * 
	 * @param $name
	 * @return mixed
	 * @throws ErrorException
	 */
	public function __get($name) {
		switch ($name) {
			case 'message':
				return $this->getMessage();
			case 'type':
				return $this->getType();
			default:
				throw new ErrorException(sprintf("No such property named %s in class %s", $name, self::class));
		}
	}

	/**
	 * For prevent BC Break with default Nette Framework flashMessages
	 *
	 * @param string $name
	 * @param string $value
	 * @return mixed
	 * @throws ErrorException
	 */
	public function __set($name, $value) {
		switch ($name) {
			case 'message':
				return $this->setMessage($value);
			case 'type':
				return $this->setType($value);
			default:
				throw new ErrorException(sprintf("No such property named %s in class %s", $name, self::class));
		}
	}


}
<?php


namespace Holabs\Flashes;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/flashes
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
trait TFlasher {

	/** @var Factory */
	protected $flashFactory;

	/**
	 * @param string   $message
	 * @param string   $type
	 * @param int|null $count
	 * @param array    $parameters
	 * @return Message
	 */
	public function flashMessage($message, $type = Message::DEFAULT_INFO, $count = NULL, $parameters = []) {
		return $this->flashFactory->create($this, $message, $type, $count, $parameters);
	}

	/**
	 * @param Factory $factory
	 */
	public function injectFlashFactory(Factory $factory) {
		$this->flashFactory = $factory;
	}

}
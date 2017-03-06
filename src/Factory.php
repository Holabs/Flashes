<?php


namespace Holabs\Flashes;

use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;
use Nette\Utils\Html;
use Nette\Utils\Strings;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/flashes
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
class Factory {

	/** @var ITranslator */
	private $translator;

	/**
	 * @param ITranslator $translator
	 */
	public function __construct(ITranslator $translator) {
		$this->translator = $translator;
	}

	/**
	 * @param Control  $control
	 * @param string   $message
	 * @param string   $type
	 * @param int|null $count
	 * @param array    $params
	 * @return Message
	 */
	public function create(Control $control, $message, $type = Message::DEFAULT_INFO, $count = NULL, $params = []) {
		$id = $control->getParameterId('flash');
		$messages = $control->getPresenter()->getFlashSession()->{$id};

		$messages[] = $flash = new Message($this->useParams($message, $params, $count), $type);

		$control->getTemplate()->flashes = $messages;
		$control->getPresenter()->getFlashSession()->{$id} = $messages;

		return $flash;
	}

	/**
	 * @param Control $control
	 * @return Message[]|string[]|array
	 */
	public function getFlashes(Control $control) {
		$id = $control->getParameterId('flash');

		return $control->getPresenter()->getFlashSession()->{$id};
	}

	/**
	 * @param string   $message
	 * @param array    $params
	 * @param int|null $count
	 * @return Html
	 */
	protected function useParams($message, $params = [], $count = NULL) {
		if ($count !== NULL && !isset($params['count'])) {
			$params['count'] = $count;
		}

		$pattern = [];
		foreach ($params as $key => $param) {
			$pattern["/%{$key}%/"] = $param;
		}

		$message = Strings::replace($message, $pattern);

		$result = new Html();

		$result->setHtml($message);

		return $result;
	}


}
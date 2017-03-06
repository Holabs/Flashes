<?php


namespace Holabs\Flashes\UI;

use Holabs\Flashes\Factory;
use Holabs\UI\BaseControl;
use Nette\Application\UI\Control as NetteControl;
use Nette\Localization\ITranslator;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/flashes
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseControl {

	const DEFAULT_TEMPLATE_FILE = __DIR__ . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'default.latte';

	/** @var string */
	public static $PROJECT_TEMPLATE_FILE = self::DEFAULT_TEMPLATE_FILE;

	/** @var Factory */
	private $factory;

	/** @var NetteControl */
	private $control;

	/**
	 * @param ITranslator  $translator
	 * @param Factory      $factory
	 * @param NetteControl $control
	 */
	public function __construct(ITranslator $translator, Factory $factory, NetteControl $control) {
		parent::__construct($translator);
		$this->setTemplateFile(self::$PROJECT_TEMPLATE_FILE);
		$this->factory = $factory;
		$this->control = $control;
	}

	public function render(){
		$this->getTemplate()->messages = $this->factory->getFlashes($this->control);
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}


}
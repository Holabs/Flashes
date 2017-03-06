<?php


namespace Holabs\Flashes\Bridges\Nette;

use Holabs\Flashes\Factory;
use Holabs\Flashes\UI\IFactory;
use Nette\DI\CompilerExtension;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/flashes
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
class FlashesExtension extends CompilerExtension {

	public function loadConfiguration(){

		$builder = $this->getContainerBuilder();

		// Flashes factory
		$builder->addDefinition($this->prefix('factory'))
			->setClass(Factory::class);

		// Flashes control factory
		$builder->addDefinition($this->prefix('ui.factory'))
			->setImplement(IFactory::class);

	}


}
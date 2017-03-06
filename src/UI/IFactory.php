<?php


namespace Holabs\Flashes\UI;

use Nette\Application\UI\Control as NetteControl;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/flashes
 * @copyright    Copyright © 2016, Tomáš Holan [www.tomasholan.eu]
 */
interface IFactory {

	/**
	 * @param NetteControl $control
	 * @return Control
	 */
	public function create(NetteControl $control);

}
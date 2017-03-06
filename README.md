Holabs/Flashes
==============

Installation
------------

**Require:**
- [Holabs/UI](https://github.com/Holabs/UI)
- [Nette/Application](https://github.com/nette/application)
- [Nette/HTTP](https://github.com/nette/http)
- [Nette/Utils](https://github.com/nette/utils)

```sh
composer require holabs/flashes
```

Configuration
-------------
```neon
extensions:
	flashes: Holabs\Flashes\Bridges\Nette\FlashesExtension
```

Using
-----

`BasePresenter` class:
```php

use Nette\Application\UI\Presenter;
use Holabs\Flashes\Message;
use Holabs\Flashes\UI\IFactory;
use Holabs\Flashes\UI\Control;

class BasePresenter extends Presenter {

	use TFlasher; // Inject flash factory
	
	/** @var IFactory @inject */
	public $flashesControlFactory; // Optional
	
	public function actionDefault(){
	    $this->flashMessage('Hello world!', Message::$INFO);
	    $this->flashMessage('Hello world with link!', Message::$INFO)
	    	->setLink($this->link('link'), 'Nice link');
	}
	
	// Optional component
	
	/**
	 * @return Control
	 */
	protected function createComponentFlashes(){
		$control = $this->flashesControlFactory->create($this);
		// $control->setTemplateFile('path/to/your/latte')
		return $control;
	}
	
	// ...

}
```

`@layout.latte` file:
```latte
	{* ... *}
	
	{* Standard render *}
	<div n:foreach="$messages as $message" class="flash flash-{$message->getType()}">
    	{$message->getMessage()}.
    	<a href="{$message->getLink()->url}" n:if="$message->getLink()">{$message->getLink()->text}</a>
    </div>
    
    {* OR control *}
	{control flashes}
	
	{* ... *}
```


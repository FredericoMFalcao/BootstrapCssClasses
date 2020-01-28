<?php

class DOM_Html extends HTMLElement { 
	public function __construct(DOM_Head $head, DOM_Body $body ) { parent::__construct("html"); $this->addChild($head)->addChild($body);} 
	public function &getDomHead() { return $this->getChild(0); }
	public function &getDomBody() { return $this->getChild(1); }

}
class DOM_Body extends HTMLElement { 

	private $allElements = [];
	public function __construct() { parent::__construct("body"); } 
	public function getChildrenCount() { return count($this->allElements); }
	public function addChild(HTMLElement $el) { 
		/* Run the overloaded function */
		parent::addChild($el);
		/* Add pointer to last child, and its children */
		$this->rAddPointers($this->getChild($this->getNoOfChildren()-1));
	}
	private function rAddPointers(HTMLElement &$el) {
		$this->allElements[] = &$el;
		$lastId = count($this->allElements)-1;
		// Tell each element its own id in the virtual dom tree
		$el->setVDomId($lastId);
		// Make the function recursive, i.e. traverse down the whole tree
		for($i=0;$i<$el->getNoOfChildren();$i++) 
			$this->rAddPointers($el->getChild($i));
	}
	public function render() {
		// Check if (1) there is an event to be processed 
 		if (isset($_GET['eventId']) )
			$this->allElements[$_GET['eventId']]->callOnClickPreRenderFn();

		parent::render();
 		
		if (isset($_GET['eventId']) )
			$this->allElements[$_GET['eventId']]->callOnClickPostRenderFn();

	}
}
class DOM_Script extends HTMLElement {
	public function __construct(string $url = "") { 
		parent::__construct("script"); 
		if (!empty($url)) $this->setAttribute("src", $url); 
		$this->setInnerValue(" ");
	}
}
class DOM_CSS_File extends HTMLElement {
	private $external = true; 
	public function __construct(string $url = "") { 
		if (!empty($url)) {
			$this->setAttribute("rel", "stylesheet")->setAttribute("href", $url);  
			parent::__construct("link");
			$this->external = true;
		} else {
			parent::__construct("style");
			$this->external = false;
		}
	}
}
class DOM_Head extends HTMLElement { 
	public function __construct(array $scriptsAndStylesheets = []) { 
		parent::__construct("head"); 
		if (isset($scriptsAndStylesheets['css'])) 
			foreach($scriptsAndStylesheets['css'] as $cssURL)
				$this->addChild(new DOM_CSS_File($cssURL));
		if (isset($scriptsAndStylesheets['js'])) 
			foreach($scriptsAndStylesheets['js'] as $scriptURL)
				$this->addChild(new DOM_Script($scriptURL));
		
	} 
	public function setRequirements(array $scriptsAndStylesheets) {
		if (isset($scriptsAndStylesheets['css'])) 
			foreach($scriptsAndStylesheets['css'] as $cssURL)
				$this->addChild(new DOM_CSS_File($cssURL));
		if (isset($scriptsAndStylesheets['js'])) 
			foreach($scriptsAndStylesheets['js'] as $scriptURL)
				$this->addChild(new DOM_Script($scriptURL));
		return $this;

	}
	public function setTitle(string $title) { $this->setAttribute("title",$title); return $this; }

	
}


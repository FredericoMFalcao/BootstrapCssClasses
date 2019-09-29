<?php

class DOM_Html extends HTMLElement { public function __construct(DOM_Head $head, DOM_Body $body ) { parent::__construct("html"); $this->addChild($head)->addChild($body);} }
class DOM_Body extends HTMLElement { public function __construct() { parent::__construct("body"); } }
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


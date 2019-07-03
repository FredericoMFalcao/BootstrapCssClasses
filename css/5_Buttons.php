<?php

define("BUTTON_OPT_DEFAULT",   1); 
define("BUTTON_OPT_LINK"   ,   2); 
define("BUTTON_OPT_INPUT"  ,   4); 
define("BUTTON_OPT_SUBMIT" ,   8); 

define("BUTTON_SIZE_LARGE",         16);
define("BUTTON_SIZE_DEFAULT",       32);
define("BUTTON_SIZE_SMALL",         64);
define("BUTTON_SIZE_EXTRA_SMALL",  128);

define("BUTTON_OPT_BLOCK_LEVEL",   256);
define("BUTTON_OPT_DISABLED",      512);
class _GUI_BUTTON extends HTMLElement {

	private $type = "default";

	public function __construct(string $label, string $link = "", int $options = BUTTON_OPT_DEFAULT) {
		$this->addClass("btn");
		if ($options & BUTTON_OPT_DEFAULT) {
			parent::__construct("button");
			$this->setInnerValue($label);
			$this->setAttribute("type","button");
			if ($options & BUTTON_OPT_DISABLED   )  {$this->setAttribute("disabled","disabled");}
		}
		elseif ($options & BUTTON_OPT_LINK ) {
			parent::__construct("a");
			$this->setInnerValue($label);
			$this->setAttribute("role","button");
			$this->setAttribute("href", empty($link)?"#":$link);
			if ($options & BUTTON_OPT_DISABLED   )  {$this->addClass("disabled");}
		}
		elseif ($options & BUTTON_OPT_INPUT) {
			parent::__construct("input");
			$this->setAttribute("value", $label);
			$this->setAttribute("type", "button");
			if ($options & BUTTON_OPT_DISABLED   )  {$this->setAttribute("disabled","disabled");}
		}
		elseif ($options & BUTTON_OPT_SUBMIT) {
			parent::__construct("input");
			$this->setAttribute("value", $label);
			$this->setAttribute("type", "submit");
			if ($options & BUTTON_OPT_DISABLED   )  {$this->setAttribute("disabled","disabled");}
		}

		if     ($options & BUTTON_SIZE_LARGE)       {$this->addClass("btn-lg");}
		if     ($options & BUTTON_SIZE_SMALL)       {$this->addClass("btn-sm");}
		if     ($options & BUTTON_SIZE_EXTRA_SMALL) {$this->addClass("btn-xs");}
		
		if     ($options & BUTTON_OPT_BLOCK_LEVEL)  {$this->addClass("btn-block");}
	}

	public function setType(int $context) { global $GRAPHICAL_PROP; $this->type = $GRAPHICAL_PROP[$context]; return $this; }
	

	public function prerender() { $this->addClass("btn-".$this->type); }
}

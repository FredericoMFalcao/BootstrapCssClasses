<?php

define("GRAPHICAL_PROP_IMAGE_ROUNDED",     1); $GRAPHICAL_PROP[  1] = "img-rounded";
define("GRAPHICAL_PROP_IMAGE_CIRCLE",      2); $GRAPHICAL_PROP[  2] = "img-circle";
define("GRAPHICAL_PROP_IMAGE_THUMBNAIL",   3); $GRAPHICAL_PROP[  3] = "img-thumbnail";

class _GUI_IMAGE extends HTMLElement {

	public function __construct() {parent::__construct("img"); }

	public function setFilename(string $filename) { 
		if (!is_file($filename)) throw new Exception ("Non existing file ($filename)");
		$this->setAttribute("src",$filename);
		return $this;
	}

	public function addGraphicalProp(int $prop) { global $GRAPHICAL_PROP; $this->addClass($GRAPHICAL_PROP[$prop]); return $this; }

	
}



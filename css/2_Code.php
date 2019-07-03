<?php

class _GUI_CODE_INLINE extends HTMLElement {

	public function __construct(string $text) { parent::__construct("code"); $this->setInnerValue($text); }

}

class _GUI_CODE_USER_INPUT extends HTMLElement {

	public function __construct(string $text) { parent::__construct("kbd"); $this->setInnerValue($text); }

}

class _GUI_CODE_BASIC_BLOCK extends HTMLElement {

	public function __construct(string $text) { parent::__construct("pre"); $this->setInnerValue($text); }

}
define("GRAPHICAL_PROP_BASIC_BLOCK_SCROLLABLE", 128); $GRAPHICAL_PROP[128] = "pre-scrollable";

class _GUI_CODE_SAMPLE_OUTPUT extends HTMLElement {
	public function __construct(string $text) { parent::__construct("samp"); $this->setInnerValue($text); }
}

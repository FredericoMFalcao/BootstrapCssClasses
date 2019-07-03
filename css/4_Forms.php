<?php
/* 0. Text based fields */
define("FORM_FIELD_TYPE_TEXT",     0); $FORM_TYPES[ 0] = "text";
define("FORM_FIELD_TYPE_PASSWORD", 1); $FORM_TYPES[ 1] = "password";
define("FORM_FIELD_TYPE_DATETIME", 2); $FORM_TYPES[ 2] = "datetime";
define("FORM_FIELD_TYPE_DATETIMEL",3); $FORM_TYPES[ 3] = "datetime-local";
define("FORM_FIELD_TYPE_DATE",     4); $FORM_TYPES[ 4] = "date";
define("FORM_FIELD_TYPE_MONTH",    5); $FORM_TYPES[ 5] = "month";
define("FORM_FIELD_TYPE_TIME",     6); $FORM_TYPES[ 6] = "time";
define("FORM_FIELD_TYPE_WEEK",     7); $FORM_TYPES[ 7] = "week";
define("FORM_FIELD_TYPE_NUMBER",   8); $FORM_TYPES[ 8] = "number";
define("FORM_FIELD_TYPE_EMAIL",    9); $FORM_TYPES[ 9] = "email";
define("FORM_FIELD_TYPE_URL",     10); $FORM_TYPES[10] = "url";
define("FORM_FIELD_TYPE_SEARCH",  11); $FORM_TYPES[11] = "search";
define("FORM_FIELD_TYPE_TEL",     12); $FORM_TYPES[12] = "tel";
define("FORM_FIELD_TYPE_COLOR",   13); $FORM_TYPES[13] = "color";
/* 1. Non-text based fields */
define("FORM_FIELD_TYPE_FILE",    14); $FORM_TYPES[14] = "file";
define("FORM_FIELD_TYPE_CHECKBOX",15); $FORM_TYPES[15] = "checkbox";

/* 2. Control Sizing */
define("FORM_FIELD_SIZE_SMALL",    1); $FORM_SIZES[ 1] = "input-sm";
define("FORM_FIELD_SIZE_LARGE",    2); $FORM_SIZES[ 2] = "input-lg";

define("FORM_OPT_NORMAL",     0);
define("FORM_OPT_INLINE",     1);
define("FORM_OPT_HORIZONTAL", 2);
define("FORM_OPT_DISABLED",   4);
define("FORM_OPT_MULTIPLE",   8);
define("FORM_OPT_READONLY",  16);
define("FORM_OPT_ERROR",     32);
define("FORM_OPT_WARNING",   64);
define("FORM_OPT_SUCCESS",  128);
define("FORM_OPT_INC_ICON", 256);
class _GUI_FORM extends HTMLElement{
	private $horizontalForm = false;
	private $horizontalFormLblSize = [];

	public function __construct(int $options = FORM_OPT_NORMAL, $optValue1 = NULL ) { 
		parent::__construct("form"); 
		if (!$options == FORM_OPT_NORMAL) $this->setOptions($options, $optValue1);

	}
	public function setOptions(int $options, $optValue1 = NULL ) {
		if($options & FORM_OPT_INLINE)
			$this->addClass("form-inline"); 
		if($options & FORM_OPT_HORIZONTAL) {
			$this->addClass("form-horizontal"); 
			if (is_Null($optValue1)) throw new Exception("Trying to create a HORIZONTAL FORM without specifying fields dimensions.");
			$this->horizontalForm = true;
			$this->horizontalFormLblSize = $optValue1;
		}
		return $this;
	}
	public function addChild($el) {
		if (method_exists($el,"setParentForm")) {
			$el->setParentForm($this);
		} 
		parent::addChild($el);
		return $this;
	}
	public function setHorizontalForm(bool $state = true, array $horizontalFormLblSize = [] ) { $this->horizontalForm = $state; $this->horizontalFormLblSize = $horizontalFormLblSize; return $this;}
	public function isHorizontalForm() : bool { return $this->horizontalForm; }
	public function getHorizontalFormLblSize() : array { return $this->horizontalFormLblSize; }
	public function addCheckboxField(string $labelText, string $id = "", string $value = "", string $help_text = "", int $options = FORM_OPT_NORMAL) {
		$divFormGroup = (new HTMLElement("div"))->addClass("checkbox");
		$labelEl      = (new HTMLElement("label"))->setInnerValue("%s ".$labelText);
		$input        = (new HTMLElement("input"))
					->setAttribute("type","checkbox")
					->setId("id",$id)
					->setAttribute("value",$value)
		;
		if ($options & FORM_OPT_DISABLED) {$input->setProperty("disabled"); $divFormGroup->addClass("disabled");}
		if ($options & FORM_OPT_INLINE)   $labelEl->addClass("radio-inline");
		$divFormGroup
			->addChild($labelEl
				->addChild($input)
			)
			;
		
		if ($options & FORM_OPT_SUCCESS) $divFormGroup->addClass("has-success");
		if ($options & FORM_OPT_WARNING) $divFormGroup->addClass("has-warning");
		if ($options & FORM_OPT_ERROR)   $divFormGroup->addClass("has-error");
		/* Adds help block text */
		if (!empty($help_text)) 
			$divFormGroup
			->addChild(
				(new HTMLElement("p"))
				->addClass("help-block")
				->setInnerValue($help_text)
			);
		return $this->addChild($divFormGroup);
		
	}
	public function addSelectMenu (array $items, string $name = "", string $id = "",int $options = 0) { $this->addChild((new _GUI_FORM_SELECT($items, $name , $id ,$options ))); return $this;}
	public function addTextArea(int $noOfRows = 3) {
		$textAreaDOM = (new HTMLElement("textarea"))->addClass("form-control");
		$textAreaDOM->setInnerValue(" ");
		return $this->addChild($textAreaDOM);
	}
	public function addSubmitButton(string $label, string $id = "") {
		$this->addChild( (new HTMLElement("button"))
			->setAttribute("type","submit")
			->addClass("btn")
			->addClass("btn-default")
			->setId($id)
			->setInnerValue($label)
			);
		return $this;
	}

}
class _GUI_FORM_GENERIC_TEXTFIELD extends HTMLElement {
		private        $typeNo; 
		private        $label; 
		private        $id; 
		private        $placeholder = "";
		private        $help_text = "";
		private        $prependGroupAddon = ""; 
		private        $appendGroupAddon = ""; 
		private        $options = 0;
		private        $size = "";

		private        $parentForm;
	public function __construct(
		int $typeNo, 
		string $label, 
		string $id, 
		string $placeholder = "",
		string $help_text = "",
		string $prependGroupAddon = "", 
		string $appendGroupAddon = "", 
		int    $options = 0
	) {
		$this->typeNo            = $typeNo;
		$this->label             = $label;
		$this->id                = $id;
		$this->placeholder       = $placeholder;
		$this->help_text         = $help_text;
		$this->prependGroupAddon = $prependGroupAddon;
		$this->appendGroupAddon  = $appendGroupAddon;
		$this->options           = $options;
	}

	public function setParentForm(_GUI_FORM &$parent) { $this->parentForm = $parent; return $this; }
	public function getParentForm() : _GUI_FORM      { return $this->parentForm; }
	public function hasParentForm() : bool { return !is_null($this->parentForm); }

	public function setSize(int $sizeOption) { global $FORM_SIZES; $this->size = $FORM_SIZES[$sizeOption]; return $this; }
	public function setRightHtmlAddon(HTMLElement $el) { $this->appendGroupAddon  = $el->render(); return $this; }
	public function setLefttHtmlAddon(HTMLElement $el) { $this->prependGroupAddon = $el->render(); return $this; }
	public function prerender() {
		global $FORM_TYPES;
		parent::__construct("div");
		$this->addClass(str_replace("input","form-group",$this->size));
		$this->addClass("form-group");
		$labelField        = (new HTMLElement("label"))->setAttribute("for",$this->id)->setInnerValue($this->label);
		/* Horizontal Forms */
		if ($this->hasParentForm() && $this->getParentForm()->isHorizontalForm()) 
			$labelField->addClasses(gridSystem($this->getParentForm()->getHorizontalFormLblSize()))->addClass("control-label");
		$inputField        = (new HTMLElement("input"))
					->setAttribute("type",$FORM_TYPES[$this->typeNo])
					->setId("id",$this->id)
					->setAttribute("placeholder",$this->placeholder)
					->addClass("form-control")
					->addClass($this->size);
		if ($this->options & FORM_OPT_READONLY) $inputField->setProperty("readonly");
		if (!empty($this->prependGroupAddon) || !empty($this->appendGroupAddon)) {
			$inputGroup = (new HTMLElement("div"))->addClass("input-group");
			if (!empty($this->prependGroupAddon)) $inputGroup->addChild((new HTMLElement("div"))->addClass("input-group-addon")->setInnerValue($this->prependGroupAddon));
			$inputGroup->addChild($inputField);
			if (!empty($this->appendGroupAddon))  $inputGroup->addChild((new HTMLElement("div"))->addClass("input-group-addon")->setInnerValue($this->appendGroupAddon));
		} else {
			$inputGroup = $inputField;
		}
		if (!empty($this->label)) $this->addChild($labelField);
		/* Horizontal Forms */
		if ($this->hasParentForm() && $this->getParentForm()->isHorizontalForm()) {
			$this->addChild(
				(new HTMLElement("div"))
				->addClasses(gridSystem(array_map(function($o){return 12-$o;},$this->getParentForm()->getHorizontalFormLblSize())))
				->addChild($inputGroup)
			);
		} else {
			$this->addChild($inputGroup); 
		}
		
		if ($this->options & FORM_OPT_SUCCESS) {
			$this->addClass("has-success");
			if ($this->options & FORM_OPT_INC_ICON) 
				$this
				->addChild((new HTMLElement("span"))->addClasses(["glyphicon","glyphicon-ok form-control-feedback"])->setForceDoubleTag(true))
				->addClass("has-feedback")
				;
		}
		if ($this->options & FORM_OPT_WARNING) {
			$this->addClass("has-warning");
			if ($this->options & FORM_OPT_INC_ICON) 
				$this
				->addChild((new HTMLElement("span"))->addClasses(["glyphicon","glyphicon-warning-sign form-control-feedback"])->setForceDoubleTag(true))
				->addClass("has-feedback")
				;
		}
		if ($this->options & FORM_OPT_ERROR) {
			$this->addClass("has-error");
			if ($this->options & FORM_OPT_INC_ICON) 
				$this
				->addChild((new HTMLElement("span"))->addClasses(["glyphicon","glyphicon-remove form-control-feedback"])->setForceDoubleTag(true))
				->addClass("has-feedback")
				;
		}
		/* Adds help block text */
		if (!empty($help_text)) 
			$this
			->addChild(
				(new HTMLElement("p"))
				->addClass("help-block")
				->setInnerValue($help_text)
			);
	}

}
class _GUI_FORM_TEXT_FIELD extends _GUI_FORM_GENERIC_TEXTFIELD {
	public function __construct(string $label, string $id, string $placeholder = "",string $help_text = "",string $prependGroupAddon = "", string $appendGroupAddon = "",int $options = 0) {
		parent::__construct(FORM_FIELD_TYPE_TEXT, $label,$id,$placeholder, $help_text,$prependGroupAddon,$appendGroupAddon,$options);
	}
}
class _GUI_FORM_EMAIL_FIELD extends _GUI_FORM_GENERIC_TEXTFIELD {
	public function __construct(string $label, string $id, string $placeholder = "",string $help_text = "",string $prependGroupAddon = "", string $appendGroupAddon = "", int $options = 0) {
		parent::__construct(FORM_FIELD_TYPE_EMAIL, $label,$id,$placeholder,$help_text,$prependGroupAddon,$appendGroupAddon,$options);
	}
}
class _GUI_FORM_PASSWORD_FIELD extends _GUI_FORM_GENERIC_TEXTFIELD {
	public function __construct(string $label, string $id, string $placeholder = "",string $help_text = "",string $prependGroupAddon = "", string $appendGroupAddon = "", int $options = 0) {
		parent::__construct(FORM_FIELD_TYPE_PASSWORD, $label,$id,$placeholder,$help_text,$prependGroupAddon,$appendGroupAddon,$options);
	}
}
class _GUI_FORM_FILE_FIELD extends _GUI_FORM_GENERIC_TEXTFIELD {
	public function __construct(string $label, string $id,string $help_text = "",string $prependGroupAddon = "", string $appendGroupAddon = "", int $options = 0) {
		parent::__construct(FORM_FIELD_TYPE_FILE, $label,$id,$help_text,$prependGroupAddon,$appendGroupAddon,$options);
	}
}

class _GUI_FORM_SELECT extends HTMLElement {
	public function __construct(array $items, string $name = "", string $id = "",int $options = 0) {
		parent::__construct("select");
		$this->addClass("form-control");
		$this->setAttribute("name", $name);
		foreach($items as $k => $v)
			if (is_int($k))
				$this->addChild((new HTMLElement("option"))->setInnerValue($v));
			else
				$this->addChild((new HTMLElement("option"))->setInnerValue($v)->setAttribute("value",$k));

		if ($options & FORM_OPT_MULTIPLE) $this->setProperty("multiple");
	}
	public function setSize(int $sizeOption) { global $FORM_SIZES; $this->addClass($FORM_SIZES[$sizeOption]); return $this; }
}
class _GUI_FORM_RADIO_BUTTONS extends HTMLElement {

	private $name="";
	private $options;
	public function __construct(string $name, int $options = 0) {$this->name = $name; $this->setNoTag(true); $this->options = $options; }
	public function addItem(string $label, string $id = "", string $value = "", int $options = FORM_OPT_NORMAL) {
		if ($this->options & FORM_OPT_INLINE)
			$divEl = (new HTMLElement("div"))->setNoTag(true);
		else
			$divEl   = (new HTMLElement("div"))->addClass("radio");
		$labelEl = (new HTMLElement("label"))->setInnerValue("%s ".$label);
		$inputEl = (new HTMLElement("input"))
			->setAttribute("type", "radio")
			->setAttribute("name", $this->name)
			->setId(empty($id)?$this->name.$this->getNoOfChildren():$id)
			->setAttribute("value", $value);
		if ($options & FORM_OPT_DISABLED) {$inputEl->setProperty("disabled"); $labelEl->addClass("disabled"); }
		if ($this->options & FORM_OPT_INLINE) $labelEl->addClass("radio-inline");
		$divEl->addChild(
			$labelEl->addChild($inputEl)
		);
		$this->addChild($divEl);
		return $this;
	}
}






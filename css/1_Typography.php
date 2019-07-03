<?php
if (!isset($GRAPHICAL_PROP)) $GRAPHICAL_PROP = [];
define("GRAPHICAL_PROP_H1", 1); $GRAPHICAL_PROP[1] = "h1";
define("GRAPHICAL_PROP_H2", 2); $GRAPHICAL_PROP[2] = "h2";
define("GRAPHICAL_PROP_H3", 3); $GRAPHICAL_PROP[3] = "h3";
define("GRAPHICAL_PROP_H4", 4); $GRAPHICAL_PROP[4] = "h4";
define("GRAPHICAL_PROP_H5", 5); $GRAPHICAL_PROP[5] = "h5";
define("GRAPHICAL_PROP_H6", 6); $GRAPHICAL_PROP[6] = "h6";


class _GUI_TYPOGRAPHY_H1 extends HTMLElement{public function __construct(string $mainText, string $secondaryText = "") { parent::__construct("h1"); $this->setInnerValue($mainText); 
	if(!empty($secondaryText)) $this->addChild((new HTMLElement("small"))->setInnerValue($secondaryText)); } }
class _GUI_TYPOGRAPHY_H2 extends HTMLElement{public function __construct(string $mainText, string $secondaryText = "") { parent::__construct("h2"); $this->setInnerValue($mainText);  
	if(!empty($secondaryText)) $this->addChild((new HTMLElement("small"))->setInnerValue($secondaryText)); } }
class _GUI_TYPOGRAPHY_H3 extends HTMLElement{public function __construct(string $mainText, string $secondaryText = "") { parent::__construct("h3"); $this->setInnerValue($mainText); 
	if(!empty($secondaryText)) $this->addChild((new HTMLElement("small"))->setInnerValue($secondaryText)); } }
class _GUI_TYPOGRAPHY_H4 extends HTMLElement{public function __construct(string $mainText, string $secondaryText = "") { parent::__construct("h4"); $this->setInnerValue($mainText); 
	if(!empty($secondaryText)) $this->addChild((new HTMLElement("small"))->setInnerValue($secondaryText)); } }
class _GUI_TYPOGRAPHY_H5 extends HTMLElement{public function __construct(string $mainText, string $secondaryText = "") { parent::__construct("h5"); $this->setInnerValue($mainText); 
	if(!empty($secondaryText)) $this->addChild((new HTMLElement("small"))->setInnerValue($secondaryText)); } }
class _GUI_TYPOGRAPHY_H6 extends HTMLElement{public function __construct(string $mainText, string $secondaryText = "") { parent::__construct("h6"); $this->setInnerValue($mainText); 
	if(!empty($secondaryText)) $this->addChild((new HTMLElement("small"))->setInnerValue($secondaryText)); } }

class _GUI_TYPOGRAPHY_BR extends HTMLElement{public function __construct() { parent::__construct("br");  } }

class _GUI_TYPOGRAPHY_Paragraph extends HTMLElement{
public function __construct(string $mainText = "", bool $standOut = false) { 
	parent::__construct("p"); 
	if (!empty($mainText)) $this->setInnerValue($mainText); 
	if ($standOut) $this->addClass("lead");

}
}
class _GUI_TYPOGRAPHY_Small extends HTMLElement{public function __construct(string $mainText = "") { parent::__construct("small"); if (!empty($mainText)) $this->setInnerValue($mainText); } }
class _GUI_TYPOGRAPHY_Mark extends HTMLElement{public function __construct(string $mainText = "") { parent::__construct("mark"); if (!empty($mainText)) $this->setInnerValue($mainText); } }
class _GUI_TYPOGRAPHY_StrikeThrough extends HTMLElement{public function __construct(string $mainText = "") { parent::__construct("s"); if (!empty($mainText)) $this->setInnerValue($mainText); } }
class _GUI_TYPOGRAPHY_Underline extends HTMLElement{public function __construct(string $mainText = "") { parent::__construct("u"); if (!empty($mainText)) $this->setInnerValue($mainText); } }
class _GUI_TYPOGRAPHY_Bold extends HTMLElement{public function __construct(string $mainText = "") { parent::__construct("strong"); if (!empty($mainText)) $this->setInnerValue($mainText); } }
class _GUI_TYPOGRAPHY_Italic extends HTMLElement{public function __construct(string $mainText = "") { parent::__construct("em"); if (!empty($mainText)) $this->setInnerValue($mainText); } }



define("GRAPHICAL_PROP_TEXT_ALIGN_LEFT",     7); $GRAPHICAL_PROP[ 7] = "text-left";
define("GRAPHICAL_PROP_TEXT_ALIGN_CENTER",   8); $GRAPHICAL_PROP[ 8] = "text-center";
define("GRAPHICAL_PROP_TEXT_ALIGN_RIGHT",    9); $GRAPHICAL_PROP[ 9] = "text-right";
define("GRAPHICAL_PROP_TEXT_ALIGN_JUSTIFY",  10); $GRAPHICAL_PROP[10] = "text-justify";
define("GRAPHICAL_PROP_TEXT_ALIGN_NOWRAP",   11); $GRAPHICAL_PROP[11] = "text-nowrap";

define("GRAPHICAL_PROP_TEXT_LOWERCASE", 12); $GRAPHICAL_PROP[12] = "text-lowercase";
define("GRAPHICAL_PROP_TEXT_UPPERCASE", 13); $GRAPHICAL_PROP[13] = "text-uppercase";
define("GRAPHICAL_PROP_TEXT_CAPITALIZE",14); $GRAPHICAL_PROP[14] = "text-capitalize";

class _GUI_TYPOGRAPHY_Abbreviation extends HTMLElement{public function __construct(string $abbreviation, string $meaning) { parent::__construct("abbr"); $this->setInnerValue($abbreviation)->setAttribute("title",$meaning); } }
class _GUI_TYPOGRAPHY_Initialism extends HTMLElement{
	public function __construct(string $abbreviation, string $meaning) { 
		parent::__construct("abbr"); 
		$this->setInnerValue($abbreviation)->setAttribute("title",$meaning); 
		$this->addClass("initialism");

	} 
}

class _GUI_TYPOGRAPHY_Address extends HTMLElement {public function __construct() { parent::__construct("address");}}


define("GRAPHICAL_PROP_END_WITH_NEWLINE",64); $GRAPHICAL_PROP[ 64] = "";


class _GUI_TYPOGRAPHY_BlockQuote extends HTMLElement{
	public function __construct(string $quote,string $source = "") { 
		parent::__construct("blockquote"); 
		$this->addChild(new _GUI_TYPOGRAPHY_Paragraph($quote)); 
		if (!empty($source)) 
			$this->addChild((new HTMLElement("footer"))->setInnerValue($source));  
	} 
}
define("GRAPHICAL_PROP_BLOCKQUOTE_REVERSE",15); $GRAPHICAL_PROP[15] = "blockquote-reverse";

define("LISTS_OPT_UNORDERED",1);
define("LISTS_OPT_ORDERED",2);
class _GUI_TYPOGRAPHY_List extends HTMLElement{
	private $parent = NULL;
	public function getListParent() : _GUI_TYPOGRAPHY_ListItem { return $this->parent; }
	public function setListParent(_GUI_TYPOGRAPHY_ListItem &$p) { $this->parent = $p; }
	public function endSubList() { return $this->getListParent(); }
	
	public function __construct(int $option = LISTS_OPT_UNORDERED) { 
		if (0) {}	
		elseif ($option == LISTS_OPT_UNORDERED) parent::__construct("ul"); 
		elseif ($option == LISTS_OPT_ORDERED)   parent::__construct("ol");
		else throw new Exception("Error. Invalid option");
	} 
	public function addItem(_GUI_TYPOGRAPHY_ListItem $item) { $this->addChild($item); return $this;}
	public function addItems(array $arr) { foreach($arr as $el) $this->addItem($el); return $this;}
}
class _GUI_TYPOGRAPHY_ListItem extends HTMLElement {
	public function __construct(string $text = "") {
		parent::__construct("li");
		if (!empty($text)) $this->setInnerValue($text);
	}
	public function startSubList(int $option = LISTS_OPT_UNORDERED) {
		$this->appendToInnerValue("%s");
		$o = new _GUI_TYPOGRAPHY_List($option);
		$o->setListParent($this);
		$this->addChild($o);
		return $o;
	}
}
define("GRAPHICAL_PROP_LIST_UNSTYLED", 16); $GRAPHICAL_PROP[16] = "list-unstyled";
define("GRAPHICAL_PROP_LIST_INLINE",   17); $GRAPHICAL_PROP[17] = "list-inline";


class _GUI_TYPOGRAPHY_Description extends HTMLElement {
	public function __construct() { parent::__construct("dl");}
	public function addItem(_GUI_TYPOGRAPHY_DescriptionItem $item) { $this->addChild($item); return $this;}
}
class _GUI_TYPOGRAPHY_DescriptionItem extends HTMLElement {
public function __construct(string $term, string $description) {
	parent::__construct("dt"); $this->setInnerValue($term);
	$this->addOlderSibling((new HTMLElement("dd"))->setInnerValue($description));
}
}

define("GRAPHICAL_PROP_DESCRIPTION_HORIZONTAL",   18); $GRAPHICAL_PROP[18] = "dl-horizontal";


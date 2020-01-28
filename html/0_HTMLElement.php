<?php

class HTMLElement {
	private $tag;
	private $innerValue = "";
	private $attributes = [];
	private $properties = [];
	private $css_classes = [];
	private $children   = [];
	private $youngerSiblings = [];
	private $olderSiblings = [];
	private $noTag = false;
	private $forceDoubleTag = false;
	private $parent = null;
	private $onClickPreRenderFn = null;
	private $onClickPostRenderFn = null;
	private $vDomId = null;
	public	function __construct(string $tag = "div") {if (!empty($tag)) $this->tag = $tag;}
	public  function setVDomId(int $i) {$this->vDomId = $i; return $this;}
	public  function setId(string $id) {if (!empty($id)) $this->attributes["id"] = $id; return $this;}
	public  function setInnerValue (string $value) {$this->innerValue = $value; return $this; }
	public  function appendToInnerValue (string $value) {$this->innerValue .= $value; return $this; }
	public  function addClass(string $className) {$this->css_classes[] = $className; return $this;}
	public  function addClasses(array $classes) {foreach($classes as $className) $this->addClass($className); return $this;}
	public  function addChild(HTMLElement $el) {$el->setParent($this); $this->children[] = $el; return $this;}
	public  function addChildren(array $els) {foreach($els as $el) $this->addChild($el); return $this;}
	public  function setProperty(string $name) { $this->properties[$name] = 1; return $this; }
	public  function addYoungerSibling(HTMLElement $el) {$this->youngerSiblings[] = $el; return $this;}
	public  function addOlderSibling(HTMLElement $el) {$this->olderSiblings[] = $el; return $this;}
	public  function setAttribute(string $key, string $value) {$this->attributes[$key] = $value; return $this;}
	public  function setNoTag(bool $state) { $this->noTag = $state; return $this; }
	public  function setParent(HTMLElement $el) { $this->parent = $el; return $this; }
	public  function setForceDoubleTag(bool $state) { $this->forceDoubleTag = $state; return $this; }
	public  function setChild(int $indexNo, HTMLElement $el) { $this->children[$indexNo] = $el; return $this; }
	public  function setOnClickPreRenderFn(callable $fn) {$this->onClickPreRenderFn = $fn; return $this; }
	public  function setOnClickPostRenderFn(callable $fn) {$this->onClickPostRenderFn = $fn; return $this; }
	public  function addGraphicalProp(int $value) { 
		global $GRAPHICAL_PROP; 
		if (!isset($GRAPHICAL_PROP[$value])) 
			throw new Exception("Error. GRAPHICAL_PROP of $value does not exist."); 
		else {
			if ($value < 64)
				$this->addClass($GRAPHICAL_PROP[$value]);
			else {
				if (0) {}
				else if ($value == GRAPHICAL_PROP_END_WITH_NEWLINE) $this->addOlderSibling(new _GUI_TYPOGRAPHY_BR());
			}
		}
		return $this;
	}
	public function addGraphicalProps(array $array) { 
		foreach($array as $v) { 
			if (is_int($v)) 
				throw new Exception ("Error. Only int values accepted"); 
			else 
				$this->addGraphicalProp($v);
		} 
		return $this;
	}
	public function hasChildren() { return (empty($this->children)); }
	public function hasDomHtmlParent() { $el = $this; while($el->hasParent() && !is_a($el,"DOM_Html")) $el = $el->getParent(); return is_a($el, "DOM_Html");}
	public function hasDomHeadParent() { $el = $this; while($el->hasParent() && !is_a($el,"DOM_Head")) $el = $el->getParent(); return is_a($el, "DOM_Head");}
	public function hasDomBodyParent() { $el = $this; while($el->hasParent() && !is_a($el,"DOM_Body")) $el = $el->getParent(); return is_a($el, "DOM_Body");}
	public function &getChild(int $no) { return $this->children[$no]; }
	public function getNoOfChildren() { return count($this->children);}
	public function getParent() { return $this->parent; }
	public function getDomHtmlParent() : DOM_Html { $el = $this; while(!is_a($el,"DOM_Html")) $el = $el->getParent(); return $el; }
	public function getDomHeadParent() : DOM_Head { $el = $this; while(!is_a($el,"DOM_Head")) $el = $el->getParent(); return $el; }
	public function getDomBodyParent() : DOM_Body { $el = $this; while(!is_a($el,"DOM_Body")) $el = $el->getParent(); return $el; }
	public function getAttribute(string $key) { return  $this->attributes[$key]??null;}
	public  function getVDomId() {return $this->vDomId ; }
	public  function callOnClickPreRenderFn() {
		if (is_callable($this->onClickPreRenderFn))
			return call_user_func($this->onClickPreRenderFn, ["target"=>&$this]);
		else
			return null;
	}
	public  function callOnClickPostRenderFn() {
		if (is_callable($this->onClickPostRenderFn))
			return call_user_func($this->onClickPostRenderFn, ["target"=>&$this]);
		else
			return null;
	}


	public function getTag() { return $this->tag; }	
	public function getInnerValue() { return $this->innerValue; }

	public  function preRender() {return $this;}
	private function addServerLink() {

	}
	public  function render() {
		$output  = "";
		$selfClosed = (empty($this->children) && empty($this->innerValue) && !$this->forceDoubleTag);
		// Call prerender ( give a chance to fix some tree properties )
		foreach($this->children as $child) $child->preRender();
		// Check if element is "actionable" - i.e. can receive actions
		if (is_callable($this->onClickPreRenderFn)) {
			// If it is an "anchor" and an href link
			if ($this->tag == "a")
				$this->attributes["href"] = "?eventId=".$this->getVDomId();
		}
		// Add younger sibblings
		foreach($this->youngerSiblings as $o) $output .= $o->render();
		if (!$this->noTag) $output .= "<{$this->tag}";

		// Add CSS classes 
		if (!empty($this->css_classes)) $output .= " class = \"".implode(" ",$this->css_classes)."\"";
		// Add extra/custom attributes 
		foreach($this->attributes as $k=>$v) $output .= " $k=\"$v\"";
		// Add extra/custom properties 
		foreach($this->properties as $k=>$v) $output .= " $k";
		// Close early
		if (!$this->noTag) {
			if ($selfClosed) $output .= "/>"; else $output  .= ">";
		}

		if(!empty($this->innerValue)) {
			for($i=0;($pos = strpos($this->innerValue, "%s")) !== false; $i++) 
				if (!isset($this->children[$i]))
					throw new Exception ("Error. Format string contains more placeholders than children");
				else
					$this->innerValue = substr_replace($this->innerValue, $this->children[$i]->render(), $pos, strlen("%s"));
			
			$output .= $this->innerValue;
		}
		else
			$output .= implode("", array_map(function($o){return $o->render();},$this->children));

		if (!$selfClosed && !$this->noTag) $output .= "</{$this->tag}>";
		// Add older sibblings
		foreach($this->olderSiblings as $o) $output .= $o->render();
		return $output;
	}
}


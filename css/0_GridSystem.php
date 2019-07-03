<?php

function gridSystem(array $sizes) {
	$cssClasses = [];
	$cssSizes = ["xs","sm","md","lg"];
	foreach($sizes as $no=>$size)
		$cssClasses[] = "col-{$cssSizes[$no]}-$size";
	
	return $cssClasses;
}

class _GUI_GRID_ROW extends HTMLElement {
	public function __construct(array $szOptions = []) { 
		parent::__construct("div"); 
		$this->addClass("row"); 
		foreach($szOptions as $szOption)
			$this->addChild(new _GUI_GRID_COL($szOption));

		
	}
	public function &startFirstCol()    { return $this->getChild(0 )->setGridParent($this); }
	public function &startSecondCol()   { return $this->getChild(1 )->setGridParent($this); }
	public function &startThirdCol()    { return $this->getChild(2 )->setGridParent($this); }
	public function &startFourthCol()   { return $this->getChild(3 )->setGridParent($this); }
	public function &startFifthCol()    { return $this->getChild(4 )->setGridParent($this); }
	public function &startSixthCol()    { return $this->getChild(5 )->setGridParent($this); }
	public function &startSeventhCol()  { return $this->getChild(6 )->setGridParent($this); }
	public function &startEigththCol()  { return $this->getChild(7 )->setGridParent($this); }
	public function &startNinethCol()   { return $this->getChild(8 )->setGridParent($this); }
	public function &startTenthCol()    { return $this->getChild(9 )->setGridParent($this); }
	public function &startEleventhCol() { return $this->getChild(10)->setGridParent($this); }
	public function &startTwelvethCol() { return $this->getChild(11)->setGridParent($this); }
	
}

class _GUI_GRID_COL extends HTMLElement {
	private $parent;
	public function __construct(array $szOptions ) { parent::__construct("div"); 
		foreach(["xs","sm","md","lg"] as $size => $sizeName) {
			if (isset($szOptions[$size]))
				$this->addClass("col-$sizeName-{$szOptions[$size]}");
		}
	}
	public function &setGridParent(_GUI_GRID_ROW &$parent) { $this->parent = $parent; return $this; }
	public function endCol() : _GUI_GRID_ROW { return $this->parent; }
}



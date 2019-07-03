<?php

class _GUI_TABLE_BASIC extends HTMLElement {
	public function __construct(array $columnNames = []) { parent::__construct("table"); parent::addClass("table");
		if (!empty($columnNames)) {
			$headerRow = new _GUI_TABLE_ROW();
			foreach($columnNames as $colName) $headerRow->addChild(new _GUI_TABLE_CELL($colName, TABLE_CELL_OPT_HEADER));
			$this->addChild((new HTMLElement("thead"))->addChild($headerRow));
		}
	}
	public function startRow() : _GUI_TABLE_ROW { $o = new _GUI_TABLE_ROW(); $o->setTableParent($this); $this->addChild($o); return $o; }
}

class _GUI_TABLE_ROW extends HTMLElement {
	private $parent;
	public function __construct() { parent::__construct("tr"); }
	public function setTableParent(_GUI_TABLE_BASIC &$parent) { $this->parent = $parent; return $this;}
	public function getTableParent() :_GUI_TABLE_BASIC { return $this->parent; }
	public function endRow() { return $this->getTableParent(); }
}
define("TABLE_CELL_OPT_NORMAL", 1);
define("TABLE_CELL_OPT_HEADER", 2);
class _GUI_TABLE_CELL extends HTMLElement {
	public function __construct(string $text, int $opts = TABLE_CELL_OPT_NORMAL) { parent::__construct($opts==TABLE_CELL_OPT_NORMAL?"td":"th"); $this->setInnerValue($text); }
}

define("GRAPHICAL_PROP_TABLE_STRIPPED_ROWS",  19); $GRAPHICAL_PROP[ 19] = "table-striped";
define("GRAPHICAL_PROP_TABLE_BORDERED",       20); $GRAPHICAL_PROP[ 20] = "table-bordered";
define("GRAPHICAL_PROP_TABLE_HOVER",          21); $GRAPHICAL_PROP[ 21] = "table-hover";
define("GRAPHICAL_PROP_TABLE_CONDENSED",      22); $GRAPHICAL_PROP[ 22] = "table-condensed";

define("GRAPHICAL_PROP_CONTEXT_ACTIVE",   23); $GRAPHICAL_PROP[ 23] = "active";
define("GRAPHICAL_PROP_CONTEXT_PRIMARY",  24); $GRAPHICAL_PROP[ 24] = "primary";
define("GRAPHICAL_PROP_CONTEXT_SUCCESS",  25); $GRAPHICAL_PROP[ 25] = "success";
define("GRAPHICAL_PROP_CONTEXT_INFO",     26); $GRAPHICAL_PROP[ 26] = "info";
define("GRAPHICAL_PROP_CONTEXT_WARNING",  27); $GRAPHICAL_PROP[ 27] = "warning";
define("GRAPHICAL_PROP_CONTEXT_DANGER",   28); $GRAPHICAL_PROP[ 28] = "danger";
define("GRAPHICAL_PROP_CONTEXT_LINK",     29); $GRAPHICAL_PROP[ 29] = "link";

define("GRAPHICAL_PROP_TABLE_RESPONSIVE",    30); $GRAPHICAL_PROP[ 30] = "table-responsive";

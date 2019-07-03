<?php 


register_shutdown_function(function () {if (error_get_last() !== NULL)header("Content-type: text/plain");});

require_once "include_all.php";
require_once "advanced_gui_version.php";

$head = new DOM_Head();
$body = new DOM_Body("body");

$head->setTitle("TO DO LIST");

/* Add Page Header */
$header = (new HTMLElement())->addChild(
	(new HTMLElement())
	->addClass("page-header")
	->addChild( new GUI_TYPOGRAPHY_H1("Adam's To Do List"))
);
/* Add Panel */
$panel = (new HTMLElement())
	->addClass("panel")
	->addChild(
		(new GUI_FORM())
		->setOptions(FORM_OPT_INLINE)
		->addChild((new GUI_FORM_TEXT_FIELD("", "")))
		->addChild((new GUI_BUTTON("Add")))
	
	)
->addChild(
	(new GUI_TABLE_BASIC())
	->startRow()
		->addChild( (new GUI_TABLE_CELL("Description", TABLE_CELL_OPT_HEADER)))
		->addChild( (new GUI_TABLE_CELL("Done", TABLE_CELL_OPT_HEADER)))
	->endRow()
	->startRow()
		->addChild( (new GUI_TABLE_CELL("Buy Flowers")))
		->addChild( (new GUI_TABLE_CELL("No")))
	->endRow()
	->startRow()
		->addChild( (new GUI_TABLE_CELL("Get Shoes")))
		->addChild( (new GUI_TABLE_CELL("No")))
	->endRow()
	->startRow()
		->addChild( (new GUI_TABLE_CELL("Collect Tickets")))
		->addChild( (new GUI_TABLE_CELL("No")))
	->endRow()
	->startRow()
		->addChild( (new GUI_TABLE_CELL("Call Joe")))
		->addChild( (new GUI_TABLE_CELL("No")))
	->endRow()
);


$body->addChildren([$header, $panel]);
$head->setRequirements(
["css"=>
	[
		"/bootstrap.min.css"
	],
  "js" =>
	[
		"/jquery-3.4.1.min.js",
		"/bootstrap.min.js",
	]
]);
$html = new DOM_Html($head,$body);

$error_free_html = $html->render();
echo $error_free_html;

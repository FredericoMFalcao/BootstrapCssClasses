<html>
<head>
	<link rel="stylesheet" href="/bootstrap.min.css">
	<script src="/jquery-3.4.1.min.js"></script>
	<script src="/bootstrap.min.js"></script>
</head>
	<?php 


	register_shutdown_function(function () {if (error_get_last() !== NULL)header("Content-type: text/plain");});

	require_once "../include_all.php";
	require_once "../basic_gui_version.php";

	$body = new HTMLElement("body");

	$body->addClass("container");
	
	/* *******************
	 *
	 *  0 - GRID SYSTEM 
	 * 
	 *********************/	

	$body->addChild(
		(new GUI_GRID_ROW([[2,4],[10,2]]))
		->startFirstCol()
			->setInnerValue("This is the first col")
		->endCol()
		->startSecondCol()
			->setInnerValue("This is the second col")
		->endCol()
	);




	/* *******************
	 *
	 *  1 - TYPOGRAPHY 
	 * 
	 *********************/	


	$body->addChild(new GUI_TYPOGRAPHY_H1("h1. Bootstrap heading"));
	$body->addChild(new GUI_TYPOGRAPHY_H2("h2. Bootstrap heading"));
	$body->addChild(new GUI_TYPOGRAPHY_H3("h3. Bootstrap heading"));
	$body->addChild(new GUI_TYPOGRAPHY_H4("h4. Bootstrap heading"));
	$body->addChild(new GUI_TYPOGRAPHY_H5("h5. Bootstrap heading"));
	$body->addChild(new GUI_TYPOGRAPHY_H6("h6. Bootstrap heading"));

	$body->addChild(new GUI_TYPOGRAPHY_H1("h1. Bootstrap heading", "Secondary Text"));
	$body->addChild(new GUI_TYPOGRAPHY_H2("h2. Bootstrap heading", "Secondary Text"));
	$body->addChild(new GUI_TYPOGRAPHY_H3("h3. Bootstrap heading", "Secondary Text"));
	$body->addChild(new GUI_TYPOGRAPHY_H4("h4. Bootstrap heading", "Secondary Text"));
	$body->addChild(new GUI_TYPOGRAPHY_H5("h5. Bootstrap heading", "Secondary Text"));
	$body->addChild(new GUI_TYPOGRAPHY_H6("h6. Bootstrap heading", "Secondary Text"));

	$body->addChild(new GUI_TYPOGRAPHY_Paragraph("Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.

Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.

Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit."));

	/* 1.3 Inline Text Elements */
	$body->addChild(new GUI_TYPOGRAPHY_Paragraph("Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.",true));

	$body->addChild((new GUI_TYPOGRAPHY_Paragraph("You can use the mark tag to %s text"))->addChild((new GUI_TYPOGRAPHY_Mark("highlight"))));
	
	$body->addChild(new GUI_TYPOGRAPHY_StrikeThrough("This line of text is meant to be treated as no longer acurate."));
	
	$body->addChild(new GUI_TYPOGRAPHY_Underline("This line of text will render as underlined."));
	
	$body->addChild(new GUI_TYPOGRAPHY_Small("This line of text is meant to be treated as fine print."));
	
	$body->addChild(new GUI_TYPOGRAPHY_Bold("rendered as bold text"));
	
	$body->addChild(new GUI_TYPOGRAPHY_Italic("rendered as italicized"));

	/* 1.4 Alignment classes */
	$body->addChild((new GUI_TYPOGRAPHY_Paragraph("Left aligned text."))->addGraphicalProp(GRAPHICAL_PROP_TEXT_ALIGN_LEFT));
	$body->addChild((new GUI_TYPOGRAPHY_Paragraph("Center aligned text."))->addGraphicalProp(GRAPHICAL_PROP_TEXT_ALIGN_CENTER));
	$body->addChild((new GUI_TYPOGRAPHY_Paragraph("Right aligned text."))->addGraphicalProp(GRAPHICAL_PROP_TEXT_ALIGN_RIGHT));
	$body->addChild((new GUI_TYPOGRAPHY_Paragraph("Justfied text."))->addGraphicalProp(GRAPHICAL_PROP_TEXT_ALIGN_JUSTIFY));
	$body->addChild((new GUI_TYPOGRAPHY_Paragraph("No wrap text."))->addGraphicalProp(GRAPHICAL_PROP_TEXT_ALIGN_NOWRAP));


	/* 1.5 Transformation classes */
	$body->addChild((new GUI_TYPOGRAPHY_Paragraph("Lowercased text."))->addGraphicalProp(GRAPHICAL_PROP_TEXT_LOWERCASE));
	$body->addChild((new GUI_TYPOGRAPHY_Paragraph("Uppercased text."))->addGraphicalProp(GRAPHICAL_PROP_TEXT_UPPERCASE));
	$body->addChild((new GUI_TYPOGRAPHY_Paragraph("Capitalized text."))->addGraphicalProp(GRAPHICAL_PROP_TEXT_CAPITALIZE));

	/* 1.6 Abbreviation classes */
	$body->addChild((new GUI_TYPOGRAPHY_Abbreviation("attr","attribute")));
	$body->addChild((new GUI_TYPOGRAPHY_Initialism("HTML","HyperText Markup Language")));
	
	/* 1.7 Addresses */
	$body->addChild((new GUI_TYPOGRAPHY_Address())
		->setInnerValue("%s 1355 Market Street, Suite 900 %sSan Francisco, CA 94103%s %s (123) 456-7890")
		->addChild((new GUI_TYPOGRAPHY_Bold("Twitter, Inc."))->addGraphicalProp(GRAPHICAL_PROP_END_WITH_NEWLINE))
		->addChild(new GUI_TYPOGRAPHY_BR())
		->addChild(new GUI_TYPOGRAPHY_BR())
		->addChild(new GUI_TYPOGRAPHY_Abbreviation("P:","Phone"))
	);
	
	/* 1.8 Block Quotes */
	$body->addChild(new GUI_TYPOGRAPHY_BlockQuote("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante."));
	$body->addChild(new GUI_TYPOGRAPHY_BlockQuote("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.", "Someone famouse in the source title"));
	
	$body->addChild((new GUI_TYPOGRAPHY_BlockQuote("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.", "Someone famouse in the source title"))
	->addGraphicalProp(GRAPHICAL_PROP_BLOCKQUOTE_REVERSE));

	/* 1.10 LISTS */

	/* 1.11 Unordered */
	$body->addChild((new GUI_TYPOGRAPHY_List())
		->addItem(new GUI_TYPOGRAPHY_ListItem("Lorem ipsum dolor sit amet"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Consectetur adipiscing elit"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Integer molestie lorem at massa"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Facilisis in pretium nisl aliquet"))
		->addItem((new GUI_TYPOGRAPHY_ListItem("Nulla volutpat aliquam velit"))
			->startSubList()
			->addItem(new GUI_TYPOGRAPHY_ListItem("Phasellus iaculis neque"))
			->addItem(new GUI_TYPOGRAPHY_ListItem("Purus sodales ultricies"))
			->addItem(new GUI_TYPOGRAPHY_ListItem("Vestibulum laoreet porttitor sem"))
			->addItem(new GUI_TYPOGRAPHY_ListItem("Ac tristique libero volutpat at"))
			->endSubList()
		
		)
	);
	/* 1.12 Ordered */
	$body->addChild((new GUI_TYPOGRAPHY_List(LISTS_OPT_ORDERED))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Lorem ipsum dolor sit amet"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Consectetur adipiscing elit"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Integer molestie lorem at massa"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Facilisis in pretium nisl aliquet"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Nulla volutpat aliquam velit"))
	);

	/* 1.12 Unstyled */
	$body->addChild((new GUI_TYPOGRAPHY_List())->addGraphicalProp(GRAPHICAL_PROP_LIST_UNSTYLED)
		->addItem(new GUI_TYPOGRAPHY_ListItem("Lorem ipsum dolor sit amet"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Consectetur adipiscing elit"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Integer molestie lorem at massa"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Facilisis in pretium nisl aliquet"))
		->addItem((new GUI_TYPOGRAPHY_ListItem("Nulla volutpat aliquam velit"))
			->startSubList()
			->addItem(new GUI_TYPOGRAPHY_ListItem("Phasellus iaculis neque"))
			->addItem(new GUI_TYPOGRAPHY_ListItem("Purus sodales ultricies"))
			->addItem(new GUI_TYPOGRAPHY_ListItem("Vestibulum laoreet porttitor sem"))
			->addItem(new GUI_TYPOGRAPHY_ListItem("Ac tristique libero volutpat at"))
			->endSubList()
		)
			
	);
	/* 1.12 Inline */
	$body->addChild((new GUI_TYPOGRAPHY_List())->addGraphicalProp(GRAPHICAL_PROP_LIST_INLINE)
		->addItem(new GUI_TYPOGRAPHY_ListItem("Lorem ipsum"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Phasellus iaculis neque"))
		->addItem(new GUI_TYPOGRAPHY_ListItem("Nulla volutpat aliquam velit"))
			
	);

	/* 1.20 DESCRIPTIONS */

	/* 1.21 Vertical */
	$body->addChild((new GUI_TYPOGRAPHY_Description())
		->addItem(new GUI_TYPOGRAPHY_DescriptionItem("Description lists", "A description list is perfect for defining terms."))
		->addItem(new GUI_TYPOGRAPHY_DescriptionItem("Euismod", "Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.\nDonec id elit non mi porta gravida at eget metus."))
		->addItem(new GUI_TYPOGRAPHY_DescriptionItem("Malesuada Porta", "Etiam porta sem magna mollis euismod."))
	);
	/* 1.22 Horizontal */
	$body->addChild((new GUI_TYPOGRAPHY_Description())
		->addGraphicalProp(GRAPHICAL_PROP_DESCRIPTION_HORIZONTAL)
		->addItem(new GUI_TYPOGRAPHY_DescriptionItem("Description lists", "A description list is perfect for defining terms."))
		->addItem(new GUI_TYPOGRAPHY_DescriptionItem("Euismod", "Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.\nDonec id elit non mi porta gravida at eget metus."))
		->addItem(new GUI_TYPOGRAPHY_DescriptionItem("Malesuada Porta", "Etiam porta sem magna mollis euismod."))
	);


	/* *******************
	 *
	 *  2 - CODE 
	 * 
	 *********************/	

	$body->addChild(
		(new GUI_TYPOGRAPHY_Paragraph("For example, %s should be wrapped as inline."))
		->addChild(new GUI_CODE_INLINE("&lt;section&gt;"))
	);
	
	$body->addChild(
		(new GUI_TYPOGRAPHY_Paragraph("To switch directories, type %s followed by the name of the directory."))
		->addChild(new GUI_CODE_USER_INPUT("cd"))
	);
	$body->addChild(
		(new GUI_TYPOGRAPHY_Paragraph("To edit settings, press %s"))
		->addChild((new GUI_CODE_USER_INPUT("%s + %s"))
			->addChild((new GUI_CODE_USER_INPUT("ctrl")))
			->addChild((new GUI_CODE_USER_INPUT(",")))
		)
	);
	$body->addChild(
		(new GUI_CODE_BASIC_BLOCK("&lt;p&gt;Sample text here...&lt;/p&gt;"))
	);
	$body->addChild(
		(new GUI_CODE_SAMPLE_OUTPUT("This text is meant to be treated as sample output from a computer program."))
	);

	/* *******************
	 *
	 *  3 - TABLES 
	 * 
	 *********************/	
	
	$body->addChild(
		(new GUI_TABLE_BASIC(["#","First Name", "Last Name", "Username"]))
		->startRow()
			->addChild( new GUI_TABLE_CELL("1")) 
			->addChild( new GUI_TABLE_CELL("Mark")) 
			->addChild( new GUI_TABLE_CELL("Otto")) 
			->addChild( new GUI_TABLE_CELL("@mdo")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("2")) 
			->addChild( new GUI_TABLE_CELL("Jacob")) 
			->addChild( new GUI_TABLE_CELL("Thornton")) 
			->addChild( new GUI_TABLE_CELL("@fat")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("3")) 
			->addChild( new GUI_TABLE_CELL("Larry")) 
			->addChild( new GUI_TABLE_CELL("the Bird")) 
			->addChild( new GUI_TABLE_CELL("@twitter")) 
		->endRow()
	);
	$body->addChild(
		(new GUI_TABLE_BASIC(["#","First Name", "Last Name", "Username"]))
		->addGraphicalProp(GRAPHICAL_PROP_TABLE_STRIPPED_ROWS)
		->startRow()
			->addChild( new GUI_TABLE_CELL("1")) 
			->addChild( new GUI_TABLE_CELL("Mark")) 
			->addChild( new GUI_TABLE_CELL("Otto")) 
			->addChild( new GUI_TABLE_CELL("@mdo")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("2")) 
			->addChild( new GUI_TABLE_CELL("Jacob")) 
			->addChild( new GUI_TABLE_CELL("Thornton")) 
			->addChild( new GUI_TABLE_CELL("@fat")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("3")) 
			->addChild( new GUI_TABLE_CELL("Larry")) 
			->addChild( new GUI_TABLE_CELL("the Bird")) 
			->addChild( new GUI_TABLE_CELL("@twitter")) 
		->endRow()
	);
	$body->addChild(
		(new GUI_TABLE_BASIC(["#","First Name", "Last Name", "Username"]))
		->addGraphicalProp(GRAPHICAL_PROP_TABLE_BORDERED)
		->startRow()
			->addChild( new GUI_TABLE_CELL("1")) 
			->addChild( new GUI_TABLE_CELL("Mark")) 
			->addChild( new GUI_TABLE_CELL("Otto")) 
			->addChild( new GUI_TABLE_CELL("@mdo")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("2")) 
			->addChild( new GUI_TABLE_CELL("Jacob")) 
			->addChild( new GUI_TABLE_CELL("Thornton")) 
			->addChild( new GUI_TABLE_CELL("@fat")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("3")) 
			->addChild( new GUI_TABLE_CELL("Larry")) 
			->addChild( new GUI_TABLE_CELL("the Bird")) 
			->addChild( new GUI_TABLE_CELL("@twitter")) 
		->endRow()
	);
	$body->addChild(
		(new GUI_TABLE_BASIC(["#","First Name", "Last Name", "Username"]))
		->addGraphicalProp(GRAPHICAL_PROP_TABLE_HOVER)
		->startRow()
			->addChild( new GUI_TABLE_CELL("1")) 
			->addChild( new GUI_TABLE_CELL("Mark")) 
			->addChild( new GUI_TABLE_CELL("Otto")) 
			->addChild( new GUI_TABLE_CELL("@mdo")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("2")) 
			->addChild( new GUI_TABLE_CELL("Jacob")) 
			->addChild( new GUI_TABLE_CELL("Thornton")) 
			->addChild( new GUI_TABLE_CELL("@fat")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("3")) 
			->addChild( new GUI_TABLE_CELL("Larry")) 
			->addChild( new GUI_TABLE_CELL("the Bird")) 
			->addChild( new GUI_TABLE_CELL("@twitter")) 
		->endRow()
	);
	$body->addChild(
		(new GUI_TABLE_BASIC(["#","Column Heading", "Column Heading", "Column Heading"]))
		->startRow()
			->addGraphicalProp(GRAPHICAL_PROP_CONTEXT_ACTIVE)
			->addChild( new GUI_TABLE_CELL("1")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
		->endRow()
		->startRow()
			->addGraphicalProp(GRAPHICAL_PROP_CONTEXT_SUCCESS)
			->addChild( new GUI_TABLE_CELL("2")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
		->endRow()
		->startRow()
			->addGraphicalProp(GRAPHICAL_PROP_CONTEXT_DANGER)
			->addChild( new GUI_TABLE_CELL("3")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
		->endRow()
		->startRow()
			->addGraphicalProp(GRAPHICAL_PROP_CONTEXT_WARNING)
			->addChild( new GUI_TABLE_CELL("4")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
		->endRow()
		->startRow()
			->addGraphicalProp(GRAPHICAL_PROP_CONTEXT_INFO)
			->addChild( new GUI_TABLE_CELL("5")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("6")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("7")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("8")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
		->endRow()
		->startRow()
			->addChild( new GUI_TABLE_CELL("9")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
			->addChild( new GUI_TABLE_CELL("Column Content")) 
		->endRow()
	);

	/* *******************
	 *
	 *  4 - FORMS 
	 * 
	 *********************/	

	$body->addChild((new GUI_TYPOGRAPHY_H2("Normal Form")));
	$body->addChild((new GUI_Form())
		->addChild(new GUI_FORM_EMAIL_FIELD("EmailAddress","exampleInputEmail1","Email"))
		->addChild(new GUI_FORM_PASSWORD_FIELD("Password","exampleInputPassword1","Password"))
		->addChild(new GUI_FORM_FILE_FIELD("File Input","exampleInputFile","Example block-level text here."))
		->addCheckboxField("Check me out","exampleInputFile","Example block-level text here.")
		
	); 


	$body->addChild((new GUI_TYPOGRAPHY_H2("Inline Form")));
	$body->addChild((new GUI_Form(FORM_OPT_INLINE))
		->addChild(new GUI_FORM_EMAIL_FIELD("EmailAddress","exampleInputEmail1","Email"))
		->addChild(new GUI_FORM_PASSWORD_FIELD("Password","exampleInputPassword1","Password"))
		->addSubmitButton("Send Invitation")
	); 

	$body->addChild((new GUI_Form(FORM_OPT_INLINE))
		->addChild(new GUI_FORM_TEXT_FIELD( "","exampleInputAmount","Amount (in Dollars)","","$",".00"))
		->addSubmitButton("Transfer Cash")
	); 

	
	$body->addChild((new GUI_TYPOGRAPHY_H2("Horizontal Form")));
	$body->addChild((new GUI_Form(FORM_OPT_HORIZONTAL,[2,2]))
		->addChild(new GUI_FORM_TEXT_FIELD("Name","exampleInputName2","Jane Doe"))
		->addChild( new GUI_FORM_EMAIL_FIELD("Email","exampleInputEmail3","jane.doe@example.com"))
		->addSubmitButton("Send Invitation")
	); 

	$body->addChild(
		(new GUI_Form())
		->addTextArea()
		->addCheckboxField("Option one is this and that&mdash;be sure to include why it's great")
		->addCheckboxField("Option two is disabled","","","",FORM_OPT_DISABLED)

	);

	$body->addChild(
		(new GUI_Form())
		->addChild(
			(new GUI_FORM_RADIO_BUTTONS("optionRadios"))
			->addItem("Option one is this and that&mdash;be sure to include why it's great","","option1")
			->addItem("Option two can be something else and selecting it will deselect option one","","option2")
			->addItem("Option three is disabled","","option3",FORM_OPT_DISABLED)
		)
	);
	$body->addChild(
		(new GUI_Form())
		->addChild(
			(new GUI_FORM_RADIO_BUTTONS("optionRadios",FORM_OPT_INLINE))
			->addItem("1","","option1")
			->addItem("2","","option2")
			->addItem("3","","option3",FORM_OPT_DISABLED)
		)
	);
	$body->addChild(
		(new GUI_Form())
		->addSelectMenu(
			["1","2","3","4","5"]
		)
		->addSelectMenu(
			["1","2","3","4","5"],
			"","",FORM_OPT_MULTIPLE
		)
	);
	$body->addChild((new GUI_TYPOGRAPHY_H2("Validation States")));
	$body->addChild((new GUI_Form())
		->addChild(new GUI_FORM_TEXT_FIELD("Input with Success","exampleInputName1","","A block of help text breaks onto a new line and may extend beyond one line.","","",FORM_OPT_SUCCESS))
		->addChild(new GUI_FORM_TEXT_FIELD("Input with Warning","exampleInputName1","","","","",FORM_OPT_WARNING))
		->addChild(new GUI_FORM_TEXT_FIELD("Input with Warning","exampleInputName1","","","","",FORM_OPT_ERROR))
		->addCheckboxField("Checkbox with success", "checkbox_success", "option1","",FORM_OPT_SUCCESS)
		->addCheckboxField("Checkbox with warning", "checkbox_warning", "option2","",FORM_OPT_WARNING)
		->addCheckboxField("Checkbox with error"  , "checkbox_error",   "option3","",FORM_OPT_ERROR)
	); 
	$body->addChild((new GUI_TYPOGRAPHY_H2("Optional icons")));
	$body->addChild((new GUI_Form())
		->addChild(new GUI_FORM_TEXT_FIELD("Input with Success","exampleInputName1","","A block of help text breaks onto a new line and may extend beyond one line.","","",FORM_OPT_SUCCESS|FORM_OPT_INC_ICON))
		->addChild(new GUI_FORM_TEXT_FIELD("Input with Warning","exampleInputName1","","","","",FORM_OPT_WARNING|FORM_OPT_INC_ICON))
		->addChild(new GUI_FORM_TEXT_FIELD("Input with Warning","exampleInputName1","","","","",FORM_OPT_ERROR|FORM_OPT_INC_ICON))
		->addCheckboxField("Checkbox with success", "checkbox_success", "option1","",FORM_OPT_SUCCESS)
		->addCheckboxField("Checkbox with warning", "checkbox_warning", "option2","",FORM_OPT_WARNING)
	/* public function addCheckboxField(string $labelText, string $id = "", string $value = "", string $help_text = "", int $options = FORM_OPT_NORMAL) { */
		->addCheckboxField("Checkbox with error"  , "checkbox_error",   "option3","",FORM_OPT_ERROR)
	); 

	/* Control Sizing */
	$body->addChild((new GUI_TYPOGRAPHY_H2("Control Sizing")));

	$body->addChild((new GUI_FORM_TEXT_FIELD("","",".input-lg"))->setSize(FORM_FIELD_SIZE_LARGE));
	$body->addChild((new GUI_FORM_TEXT_FIELD("","",".default input")));
	$body->addChild((new GUI_FORM_TEXT_FIELD("","",".input-sm"))->setSize(FORM_FIELD_SIZE_SMALL));

	$body->addChild((new GUI_FORM_SELECT([".input-lg"],"",""))->setSize(FORM_FIELD_SIZE_LARGE));
	$body->addChild((new GUI_FORM_SELECT(["default input"],"","")));
	$body->addChild((new GUI_FORM_SELECT(["input-sm"],"",""))->setSize(FORM_FIELD_SIZE_SMALL));

	/* *******************
	 *
	 *  5 - BUTTONS 
	 * 
	 *********************/	

	$body->addChild((new GUI_TYPOGRAPHY_H2("Buttons")));
	$body->addChild((new GUI_BUTTON("Link","",BUTTON_OPT_LINK)));
	$body->addChild((new GUI_BUTTON("Button","")));
	$body->addChild((new GUI_BUTTON("Input","",BUTTON_OPT_INPUT)));
	$body->addChild((new GUI_BUTTON("Submit","",BUTTON_OPT_SUBMIT)));

	$body->addChild((new GUI_TYPOGRAPHY_H2("Options")));
	$body->addChild((new GUI_BUTTON("Default","",BUTTON_OPT_DEFAULT)));
	$body->addChild((new GUI_BUTTON("Active","",BUTTON_OPT_DEFAULT)) ->setType(GRAPHICAL_PROP_CONTEXT_ACTIVE));
	$body->addChild((new GUI_BUTTON("Primary","",BUTTON_OPT_DEFAULT))->setType(GRAPHICAL_PROP_CONTEXT_PRIMARY));
	$body->addChild((new GUI_BUTTON("Success","",BUTTON_OPT_DEFAULT))->setType(GRAPHICAL_PROP_CONTEXT_SUCCESS));
	$body->addChild((new GUI_BUTTON("Info","",BUTTON_OPT_DEFAULT))   ->setType(GRAPHICAL_PROP_CONTEXT_INFO));
	$body->addChild((new GUI_BUTTON("Warning","",BUTTON_OPT_DEFAULT))->setType(GRAPHICAL_PROP_CONTEXT_WARNING));
	$body->addChild((new GUI_BUTTON("Danger","",BUTTON_OPT_DEFAULT)) ->setType(GRAPHICAL_PROP_CONTEXT_DANGER));
	$body->addChild((new GUI_BUTTON("Link","",BUTTON_OPT_DEFAULT))   ->setType(GRAPHICAL_PROP_CONTEXT_LINK));

	$body->addChild((new GUI_TYPOGRAPHY_H2("Sizes")));
	$body->addChild((new GUI_BUTTON("Large Button","",BUTTON_OPT_DEFAULT|BUTTON_SIZE_LARGE)) ->setType(GRAPHICAL_PROP_CONTEXT_PRIMARY));
	$body->addChild((new GUI_BUTTON("Large Button","",BUTTON_OPT_DEFAULT|BUTTON_SIZE_LARGE)) );
	
	$body->addChild((new GUI_BUTTON("Default Button","",BUTTON_OPT_DEFAULT|BUTTON_SIZE_DEFAULT)) ->setType(GRAPHICAL_PROP_CONTEXT_PRIMARY));
	$body->addChild((new GUI_BUTTON("Default Button","",BUTTON_OPT_DEFAULT|BUTTON_SIZE_DEFAULT)) );

	$body->addChild((new GUI_BUTTON("Extra Small Button","",BUTTON_OPT_DEFAULT|BUTTON_SIZE_EXTRA_SMALL)) ->setType(GRAPHICAL_PROP_CONTEXT_PRIMARY));
	$body->addChild((new GUI_BUTTON("Extra Small Button","",BUTTON_OPT_DEFAULT|BUTTON_SIZE_EXTRA_SMALL)) );
	
	$body->addChild((new GUI_BUTTON("Block Level Button","",BUTTON_OPT_DEFAULT|BUTTON_SIZE_LARGE|BUTTON_OPT_BLOCK_LEVEL)) ->setType(GRAPHICAL_PROP_CONTEXT_PRIMARY));
	$body->addChild((new GUI_BUTTON("Block Level Button","",BUTTON_OPT_DEFAULT|BUTTON_SIZE_LARGE|BUTTON_OPT_BLOCK_LEVEL)) );

	$body->addChild((new GUI_TYPOGRAPHY_H2("Disabled State")));
	$body->addChild((new GUI_BUTTON("Primary Button","",BUTTON_OPT_DISABLED|BUTTON_OPT_DEFAULT|BUTTON_SIZE_LARGE|BUTTON_OPT_BLOCK_LEVEL))->setType(GRAPHICAL_PROP_CONTEXT_PRIMARY) );
	$body->addChild((new GUI_BUTTON("Button","",BUTTON_OPT_DISABLED|BUTTON_OPT_DEFAULT|BUTTON_SIZE_LARGE|BUTTON_OPT_BLOCK_LEVEL)) );
	
	/* *******************
	 *
	 *  6 - IMAGES 
	 * 
	 *********************/	
	$body->addChild((new GUI_IMAGE())->setFilename("../placeholder_140x140.png")->addGraphicalProp(GRAPHICAL_PROP_IMAGE_ROUNDED));
	$body->addChild((new GUI_IMAGE())->setFilename("../placeholder_140x140.png")->addGraphicalProp(GRAPHICAL_PROP_IMAGE_CIRCLE));
	$body->addChild((new GUI_IMAGE())->setFilename("../placeholder_140x140.png")->addGraphicalProp(GRAPHICAL_PROP_IMAGE_THUMBNAIL));
	
	/* *******************
	 *
	 *  7 - HELPER CLASSES 
	 * 
	 *********************/	
	
	/* *******************
	 *
	 *  8 -  RESPONSIVE UTILITIES
	 * 
	 *********************/	
	



	$error_free_html = $body->render();
	echo $error_free_html;
?>
</html>



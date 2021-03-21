<?php

return [
	'UserModeLang'     => false, // true,false | if you want save lang in User Tbl Set true auto detected user lang
	'LangRoute'        => 'lang', // Route Name You Can Change Route Name
	'column_lang'      => 'lang', // You May put The Defualt column if you are enable UserModeLang for true
	'languages'        => ['ar', 'en', 'fr'], // Put Your Language website Usage
	'defaultLanguage'  => 'ar', // Set Your Default Language (ar,en,es Any Short Lang From languages array)
	'redirectAfterSet' => 'back', //Set Direction home,back | Back reflect to function back | home to index or other route
];
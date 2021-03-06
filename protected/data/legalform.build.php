<?php

return array(
	'layout' => 'layouts.backend',
	'isDeleteDisabled' => true,
	'foreignRefer' => array('key' => 'id', 'title' => 'title'),
	'menuTemplate' => array(
		'index' => 'admin, create',
		'admin' => 'create',
		'create' => 'admin',
		'update' => 'admin, create, view',
		'view' => 'admin, create, update',
	),
	'admin' => array(
		'list' => array('id', 'title', 'country_code', 'is_active', 'date_added'),
	),
	'structure' => array(
		// in order for it to work as expected, this column must have a double database field
		'ordering' => array(
		)
	),
	// this foreignKey is mainly for crud view generation. model relationship will not use this at the moment
	'foreignKey' => array(
		'country_code' => array('relationName' => 'country', 'model' => 'Country', 'foreignReferAttribute' => 'printable_name'),
	),
);

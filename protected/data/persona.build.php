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
		'list' => array('id', 'title', 'is_active', 'date_added'),
	),
	'structure' => array(
		'code' => array(
			'isUnique' => true,
			'isUUID' => true,
		),
	),
	// this foreignKey is mainly for crud view generation. model relationship will not use this at the moment
	'foreignKey' => array(
		//'state_code'=>array( 'relationName'=>'state', 'model'=>'State', 'foreignReferAttribute'=>'title'),
	),
);

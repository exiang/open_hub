<?php
return array(
	'layout' => 'layouts.backend',
	'foreignRefer' => array('key'=>'id', 'title'=>'title'),
	'menuTemplate' => array(
		'index'=>'admin, create',
		'admin'=>'create',
		'create'=>'admin',
		'update'=>'admin, create, view',
		'view'=>'admin, create, update',
	),
	'admin' => array(
		'list' => array('id', 'state_code', 'title'),
	),
	'structure' => array(
	),
	// this foreignKey is mainly for crud view generation. model relationship will not use this at the moment
	'foreignKey' => array(
		'state_code'=>array( 'relationName'=>'state', 'model'=>'State', 'foreignReferAttribute'=>'title'),
	),
); 

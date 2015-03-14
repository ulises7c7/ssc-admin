<?php

	class Empresa extends AppModel {

		var $name = 'Empresa';
		var $useTable = 'Empresa';

		var $hasMany = array(
		'Unidade' => array(
			'className' => 'Unidade',
			),
		
		);
		
		
		

	}

?>
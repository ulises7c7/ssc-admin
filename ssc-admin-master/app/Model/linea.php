<?php

	class Linea extends AppModel {

		var $name = 'Linea';
		var $useTable = 'Linea';

		var $hasMany = array(
		'Unidade' => array(
			'className' => 'Unidade',
			),
		'Parada' => array(
			'className' => 'Parada',
			),
		
		);
	
		var $validate = array(

			'nrolinea' => array(
							'rule' =>  'notEmpty',	
							),
			
			'nombre'=> array(
							'rule' =>  'notEmpty',	
							)
		);
		

	}

?>
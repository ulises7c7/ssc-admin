<?php

	class Parada extends AppModel {

		var $name = 'Parada';
		var $useTable = 'Parada';
		
		public $belongsTo = array(
        'Linea' => array(
            'className' => 'Linea',
            'foreignKey' => 'linea_id'
        	),
    	);
		

	}

?>
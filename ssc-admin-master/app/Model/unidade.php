<?php

	class Unidade extends AppModel {

		var $name = 'Unidade';
		var $useTable = 'Unidad';
		
		public $belongsTo = array(
        'Empresa' => array(
            'className' => 'Empresa',
            'foreignKey' => 'empresa_id'
        	),
    	'Linea' => array(
            'className' => 'Linea',
            'foreignKey' => 'linea_id'
        	),
    	);
		

	}

?>
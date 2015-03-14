<?php
    
	class ParadasController extends AppController {
			


			var $name = 'Paradas';
			var $helpers = array ('Html', 'Form', 'Time');
			var $uses = array('Parada', 'Linea');
		

			function index() {
				
			   
				$this->set('paradas', $this->Parada->find('all'));
		
			}

			
			function add($idLinea) {
		
				if ($this->request->is('post')) {
		             $this->Parada->create();
		           
		             if ($this->Parada->save($this->request->data)) {
		               
		                 $this->Session->setFlash(__('Paradas almacenadas'));
		                 return $this->redirect(array('controller'=>'lineas', 'action' => 'index'));
		             } else {
		             $this->Session->setFlash(__('Las paradas no pudieron guardarse. Por favor, intente de nuevo'));
		        
		            }
	       	    }
				$lineas = $this->Parada->Linea->find('list', array('fields' => 'Linea.nombre', 'conditions' => array('Linea.id'=>$idLinea)));
				$this->set('lineas', $lineas);
			}

	        function delete ($id=null){
					if (!$id) {

						$this->Session->setFlash('ID invalido');
						$this->redirect(array('action'=>'index'), null, true);
					}


					if ($this->Parada->delete($id)) {

						$this->Session->setFlash('Paradas borrada' );

						$this->redirect(array('action'=>'index'), null, true);

					}

			}

			public function decimesilatiene($ide){
				$result = 0;
				$tieneParada = $this->Parada->query(
					'SELECT id  
					FROM Parada 
					WHERE (linea_id = '.$ide.')');	


						if (isset($tieneParada[0]['Parada']['id'])){
						
						
							# Si es una beca, plan o descuento no mostrar

							# solo mostrar lo que entra por Sysadmin
							$result=1;
						}
						
					
				return $result;
			}

			function edit ($id=null) {
    	
				if (!$id) {

					$this->Session->setFlash('Parada Invalida'.$id);
					$this->redirect(array('action'=>'index'), null, true);
				} 

				if ($this->request->is('post')) {
		             $this->Parada->create();
		           
		             if ($this->Parada->save($this->request->data)) {
		               
		                 $this->Session->setFlash(__('Paradas editadas'));
		                 return $this->redirect(array('controller'=>'lineas', 'action' => 'index'));
		             } else {
		             $this->Session->setFlash(__('Las paradas no pudieron editarse. Por favor, intente de nuevo'));
		        
		            }
	       	    }
	       	    $this->data = $this->Parada->find('all', array('fields' => 'Parada.id', 'conditions' => array('Linea_id'=>$id)));

				$lineas = $this->Parada->Linea->find('list', array('fields' => 'Linea.nombre', 'conditions' => array('Linea.id'=>$id)));
				$this->set('lineas', $lineas);
			}

	}



	
?>
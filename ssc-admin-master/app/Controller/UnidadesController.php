<?php
    
	class UnidadesController extends AppController {
			


			var $name = 'Unidades';
			var $helpers = array ('Html', 'Form', 'Time');
			var $uses = array('Empresa', 'Unidade', 'Linea');
		

			function index() {
				
			   
				$this->set('unidades', $this->Unidade->find('all'));
		
			}

			
			function add() {
		
				if ($this->request->is('post')) {

		            $this->Unidade->create();
		           
		            if ($this->Unidade->save($this->request->data)) {
		               
		                $this->Session->setFlash(__('Unidad almacenada'));
		                return $this->redirect(array('action' => 'index'));
		            } else {
		            $this->Session->setFlash(__('La unidad no pudo guardarse. Por favor, intente de nuevo'));
		        
		            }
	       	    }
				$empresas = $this->Unidade->Empresa->find('list', array('fields' => 'Empresa.razonsocial'));
				$this->set('empresas', $empresas);
				$lineas = $this->Unidade->Linea->find('list', array('fields' => 'Linea.nombre'));
				$this->set('lineas', $lineas);
			}

	        function delete ($id=null){
					if (!$id) {

						$this->Session->setFlash('id invalida para ese Unidad');
						$this->redirect(array('action'=>'index'), null, true);
					}

					/*$dxc = $this->Arancelesxcarrera->find('first', array(
						'conditions'=>array('Arancelesxcarrera.arancele_id'=>$id)));

					if (isset($dxc['Arancelesxcarrera'])) {
					
						$this->Session->setFlash('No puede eliminar un arancel
							con arancel por carrera asociado' );

						$this->redirect(array('action'=>'index'), null, true);
					}*/

					if ($this->Unidade->delete($id)) {

						$this->Session->setFlash('Unidad borrada' );

						$this->redirect(array('action'=>'index'), null, true);

					}

			}

			function edit ($id=null) {
    	
				if (!$id) {

					$this->Session->setFlash('Unidad Invalida'.$id);
					$this->redirect(array('action'=>'index'), null, true);
				} 

				if (empty( $this->data)){ 
	      			$this->data = $this->Unidade->find('all',
		   	 		array('conditions' => array('Unidade.id'=>$id)));

		   	 		$this->set('empresas', $this->Unidade->Empresa->find('list', array('fields' => 'Empresa.razonsocial')));
		   	 		$this->set('lineas', $this->Unidade->Linea->find('list', array('fields' => 'Linea.nombre')));

	     		} else {
			       							   	
					 // pr($this->data);			       							   						  	  
					if ($this->Unidade->save($this->data)) {
						$this->Session->setFlash('La Unidad ha sido guardada');
						$this->redirect(array('action'=>'index'), null, true);

					} else {

						$this->Session->setFlash('Unidad no salvada, prueba de nuevo');	
					}
				
				}

		}



	}
?>
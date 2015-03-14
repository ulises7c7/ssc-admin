<?php
    
	class EmpresasController extends AppController {
			


			var $name = 'Empresas';
			var $helpers = array ('Html', 'Form', 'Time');
			//var $uses = array('Empresa');
		

			function index() {
				
			   
				$this->set('empresas', $this->Empresa->find('all'));
		
			}

			
			function add() {
				
				
						if (!empty($this->data)){ 
							$this->Empresa->create(); 
							if ($this->Empresa->save($this->data)){ //Salva los datos en la BD

								$this->Session->setFlash('Empresa ha sido guardada');
								$this->redirect(array('action'=>'index'), null, true);

							} else {
								$this->Session->setFlash('Empresa no pudo ser guardada, prueba de nuevo');	
							}

						}
			}

	        function delete ($id=null){
					if (!$id) {

						$this->Session->setFlash('id invalida para ese empresa');
						$this->redirect(array('action'=>'index'), null, true);
					}

					/*$dxc = $this->Arancelesxcarrera->find('first', array(
						'conditions'=>array('Arancelesxcarrera.arancele_id'=>$id)));

					if (isset($dxc['Arancelesxcarrera'])) {
					
						$this->Session->setFlash('No puede eliminar un arancel
							con arancel por carrera asociado' );

						$this->redirect(array('action'=>'index'), null, true);
					}*/

					if ($this->Empresa->delete($id)) {

						$this->Session->setFlash('Empresa borrada' );

						$this->redirect(array('action'=>'index'), null, true);

					}

			}

			function edit ($id=null) {
    	
				if (!$id) {

					$this->Session->setFlash('Empresa Invalida'.$id);
					$this->redirect(array('action'=>'index'), null, true);
				} 

				if (empty( $this->data)){ 
	      			$this->data = $this->Empresa->find('all',
		   	 		array('conditions' => array('id'=>$id)));
	     		} else {
			       							   	
				//	 pr($this->data);			       							   						  	  
					if ($this->Empresa->save($this->data)) {
						$this->Session->setFlash('La Empresa ha sido guardada');
						$this->redirect(array('action'=>'index'), null, true);

					} else {

						$this->Session->setFlash('Empresa no salvada, prueba de nuevo');	
					}
				
				}

		}



	}
?>
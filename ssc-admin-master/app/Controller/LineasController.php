<?php
    
	class LineasController extends AppController {
			


			var $name = 'Lineas';
			var $helpers = array ('Html', 'Form', 'Time');
			var $uses = array('Linea', 'Parada');
			var $defaultLocalize = true;
			

			function index() {
				
			   
				$this->set('lineas', $this->Linea->find('all'));
		
			}

			function edit ($id=null) {
    	
				if (!$id) {

					$this->Session->setFlash('Linea Invalida'.$id);
					$this->redirect(array('action'=>'index'), null, true);
				} 

				if (empty( $this->data)){ 
	      			$consulta = $this->Linea->query('select * from Linea where id='.$id.'');
	     			$this->request->data = $consulta;
	     		} else {

	     			$datos = $this->data ;
	     			$auxiliar['Linea']['id'] = $datos['id'];
	     			$auxiliar['Linea']['nrolinea'] = $datos['nrolinea'];
	     			$auxiliar['Linea']['nombre'] = $datos['nombre'];
	     			$auxiliar['Linea']['recorrido'] = $datos['Linea']['recorrido'];
			   						  	  
					if ($this->Linea->save($auxiliar)) {
						$this->Session->setFlash('La Linea ha sido guardada');
						$this->redirect(array('action'=>'index'), null, true);

					} else {

						$this->Session->setFlash('Linea no guardada, prueba de nuevo');	
					}
				
				}

			}

			
			function add() {
				
				
						if (!empty($this->data)){ 
							$this->Linea->create(); 
							
							if ($this->Linea->save($this->data)){ //Salva los datos en la BD

								$this->Session->setFlash('Linea ha sido guardada');
								
								$this->redirect(array('action'=>'index'), null, true);

							} else {
								$this->Session->setFlash('Linea no pudo ser guardada, prueba de nuevo');	
							}

						}
			}

	        function delete ($id=null){
					if (!$id) {

						$this->Session->setFlash('id invalida para ese Linea');
						$this->redirect(array('action'=>'index'), null, true);
					}

					if ($this->Linea->delete($id)) {

						$this->Session->setFlash('Linea borrada' );

						$this->redirect(array('action'=>'index'), null, true);

					}

			}

			public function cargarrecorrido(){

				if(!$this->request->is('ajax')) {
			         throw new BadRequestException();
			    }
			    $data = $this->request->data;
			    $consulta = $this->Linea->query('select * from linea where id= '.$data['idLinea'].' ');
			    $recorrido = $consulta[0]['linea']['recorrido'];

			    $consulta2 = $this->Parada->query('select paradas from parada where linea_id= '.$data['idLinea'].' ');
			    if ($consulta2 != null) {
			    	$paradas = $consulta2[0]['parada']['paradas'];	
			    }else{
			    	$paradas=0;
			    }
			    
			    
			    $this->autoRender = false;
			    
			    $resultado[0] = $recorrido;
			    $resultado[1] = $paradas;

				return (json_encode($resultado));//json_encode();
			}
	
	}
?>
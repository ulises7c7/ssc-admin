 <?php

class UsersController extends AppController {

  
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('login','logout', 'home');
    }

    public function login() {
        if ($this->request->is('post')) {
            /* login and redirect to url set in app controller */
            if ($this->Auth->login()) {
                
                 return $this->redirect($this->Auth->redirect(array('controller' => 'pages', 'action' => 'display')));
                /*array('controller' => 'lineas','action' => 'index')*/
            }
            $this->Session->setFlash(__('Usuario o contraseña inválido, intente de nuevo'));
        }
    }

    public function logout() {
         /* logout and redirect to url set in app controller */
        return $this->redirect($this->Auth->logout());
        $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }

   public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('El usuario ha sido guardado'));
                return $this->redirect(array('controller' => 'pages','action' => 'home'));
            }
            $this->Session->setFlash(__('El usuario no pudo ser guardado. Intente de nuevo.'));
        }
    }


}

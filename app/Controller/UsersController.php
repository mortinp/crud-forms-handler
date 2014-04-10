<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {
    
    public $uses = array('User', 'PendingUser');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register');
        $this->Auth->allow('register_welcome');
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('register_welcome', 'password_changed', 'profile'))) { // Allow these actions for the logged-in user
            return true;
        }
        return parent::isAuthorized($user);
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if(AuthComponent::user('role') === 'admin') return $this->redirect(array('action'=>'index'));
                return $this->redirect($this->Auth->redirect());
            }
            $this->setErrorMessage(__('El usuario o la contraseña son inválidos. Intenta de nuevo.'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function register() {
        if ($this->request->is('post')) {
            if($this->User->loginExists($this->request->data['User']['username'])) {
                $this->setErrorMessage(__('Este correo electrónico ya está en uso. Escribe una dirección diferente.'));
                return;
            }
            if($this->PendingUser->loginExists($this->request->data['User']['username'])) {
                $this->setErrorMessage(__('Este correo electrónico ya está registrado, pero no ha sido autorizado. Por favor, autoriza tu cuenta usando el link que enviamos a su correo electrónico.'));
                return;
            }
            
            $this->PendingUser->create();
            
            $activation_id = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1);
            $this->request->data['User']['activation_id'] =  $activation_id;
            $this->request->data['User']['role'] = 'regular';
            if ($this->PendingUser->save($this->request->data['User'])) {
                // Send email and redirect to a welcome page
                $Email = new CakeEmail('yotellevo');
                $Email->template('welcome')
                ->viewVars(array('user_id' => $activation_id))
                ->emailFormat('html')
                ->to($this->request->data['User']['username'])
                ->subject('Tu enlace de confirmación')
                ->send();

                return $this->render('register_welcome');
                //return $this->authorize($activation_id);
            }
            $this->setErrorMessage(__('Ocurrió un error registrando su usuario. Intente de nuevo'));
        }
    }

    public function authorize($activation_id) {
        $pending_user = $this->PendingUser->find('first', array('conditions'=>array('activation_id'=>$activation_id)));
        if($pending_user != null) {
            $id = $pending_user['PendingUser']['id'];
            $pending_user['PendingUser']['id'] = null; // Let user create its own id
            $pending_user['PendingUser']['active'] = true;
            if(!$this->User->save(array('User' => $pending_user['PendingUser']))){
                $this->setErrorMessage("Ocurrió un error inesperado activando su cuenta");
                return;
            }
            
            $this->PendingUser->delete($id);
            $this->setSuccessMessage(__('Tu cuenta ha sido confirmada exitosamente. Ahora puedes entrar para crear anuncios de viajes.'));

            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        
        $this->setErrorMessage("Ocurrió un error activando su cuenta, o el link usado ha expirado (tal vez ya usaste este link)");
    }
    
    public function recover_password() {
        if ($this->request->is('post')) {
            
            $user = $this->User->find('first', array('conditions'=>array('username'=>$this->request->data['User']['username'])));
            
            // TODO: Verificar existencia de usuario
            if($user == null || empty ($user)) {
                $this->setErrorMessage('Este correo no pertenece a ningún usuario.');
                return;
            }
            
            
            $newPass = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1);
            
            $this->request->data['User']['id'] = $user['User']['id']; // Poner id para que el save() lo que haga sea modificar
            $this->request->data['User']['password'] = $newPass;
            if ($this->User->save($this->request->data['User'])) {               
                // Send email and redirect to a welcome page
                $Email = new CakeEmail('yotellevo');
                $Email->template('recover_password')
                ->viewVars(array('newPass' => $newPass))
                ->emailFormat('html')
                ->to($this->request->data['User']['username'])
                ->subject('Tu Nueva Contraseña')
                ->send();

                return $this->render('password_changed');
                //return $this->authorize($activation_id);
            }
        }
    }
    
    public function profile() {
        if ($this->request->is('post')|| $this->request->is('put')) {
            $user = $this->request->data;
            
            if(strlen($user['User']['password']) == 0) unset ($user['User']['password']);
            if($this->User->save($user)) {
                $this->Session->write('Auth.User', $user['User']);
                
                // TODO: redirect???
                $this->setSuccessMessage('Tu nueva información ha sido guardada');
            } else {
                $this->setErrorMessage('Ocurrió un problema guardando la información. Intenta de nuevo.');
            }
        } else {
            $this->request->data['User'] = $this->Auth->user();
        }
    }
    
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('controller'=>'travels','action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function remove($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
}

?>
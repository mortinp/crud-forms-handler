<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {
    
    public $uses = array('User', /*'PendingUser',*/ 'UserInteraction');

    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow('confirm_email');
        
        if($this->Auth->loggedIn()) {
            $this->Auth->allow('logout', 'send_confirm_email');
        }
        else $this->Auth->allow('login', 'register', 'register_welcome', /*'authorize',*/ 'recover_password');
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
                $this->_setCookie($this->Auth->user('id'));
                
                if(AuthComponent::user('role') === 'admin') return $this->redirect(array('action'=>'index'));
                return $this->redirect($this->Auth->redirect());
            } else {
                $this->setErrorMessage(__('El usuario o la contraseña son inválidos. Intenta de nuevo.'));
            }
        }
        if ($this->Auth->loggedIn() || $this->Auth->login()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function register() {
        if ($this->request->is('post')) {
            if($this->User->loginExists($this->request->data['User']['username'])) {
                $this->setErrorMessage(__('Este correo electrónico ya está registrado en <em>YoTeLlevo</em>. Escribe una dirección diferente o 
                    <a href="'.Router::url(array('action'=>'login')).'">entra con tu cuenta</a>.'));// TODO: esta direccion estatica es un hack
                return $this->redirect($this->referer());
            }
            /*if($this->PendingUser->loginExists($this->request->data['User']['username'])) {
                $this->setErrorMessage(__('Este correo electrónico ya está registrado, pero no ha sido autorizado. Por favor, autoriza tu cuenta usando el link que enviamos a su correo electrónico.'));
                return $this->redirect($this->referer());
            }*/
            
            //$this->PendingUser->create();
            
            //$activation_id = $this->getWeirdString();//substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1);
            //$this->request->data['User']['activation_id'] =  $activation_id;
            $this->request->data['User']['role'] = 'regular';
            $this->request->data['User']['active'] = true;
            
            $datasource = $this->User->getDataSource();
            $datasource->begin();
            
            if ($this->User->save($this->request->data['User'])) {
                /*// Send email and redirect to a welcome page
                $Email = new CakeEmail('yotellevo');
                $Email->template('welcome')
                ->viewVars(array('user_id' => $activation_id))
                ->emailFormat('html')
                ->to($this->request->data['User']['username'])
                ->subject('Tu enlace de confirmación');
                try {
                    $Email->send();
                } catch ( Exception $e ) {
                    $datasource->rollback();
                    $this->setErrorMessage('Ocurrió un error registrando su usuario. Intente de nuevo.');
                    return;
                }*/

                $datasource->commit();
                //return $this->render('register_welcome');
                //return $this->authorize($activation_id);
                $this->setSuccessMessage(__('Tu cuenta ha sido registrada exitosamente. Ahora puedes comenzar a crear anuncios de viajes.'));
                $this->login();
            }
            $datasource->rollback();
            $this->setErrorMessage(__('Ocurrió un error registrando su usuario. Intente de nuevo'));
        }
    }

    /*public function authorize($activation_id) {
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
            
            $this->setSuccessMessage(__('Tu cuenta ha sido registrada exitosamente. Ahora puedes comenzar a crear anuncios de viajes.'));
            //return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            $this->login();
            
        }
        
        $this->setErrorMessage("Ocurrió un error activando su cuenta, o el link usado ha expirado (tal vez ya usaste este link)");
    }*/
    
    public function recover_password() {
        if ($this->request->is('post')) {
            
            $user = $this->User->find('first', array('conditions'=>array('username'=>$this->request->data['User']['username'])));
            
            // TODO: Verificar existencia de usuario
            if($user == null || empty ($user)) {
                $this->setErrorMessage('Este correo no pertenece a ningún usuario.');
                return;
            }
            
            
            $newPass = $this->getWeirdString();//substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1);
            $this->request->data['User']['id'] = $user['User']['id']; // Poner id para que el save() lo que haga sea modificar
            $this->request->data['User']['password'] = $newPass;
            
            $datasource = $this->User->getDataSource();
            $datasource->begin();
            
            if ($this->User->save($this->request->data['User'])) {               
                // Send email and redirect to a welcome page
                $Email = new CakeEmail('yotellevo');
                $Email->template('recover_password')
                ->viewVars(array('newPass' => $newPass))
                ->emailFormat('html')
                ->to($this->request->data['User']['username'])
                ->subject('Tu Nueva Contraseña');
                try {
                    $Email->send();
                } catch ( Exception $e ) {
                    $datasource->rollback();
                    $this->setErrorMessage('Ocurrió un error recuperando su contraseña. Intente de nuevo.');
                    return;
                }
                $datasource->commit();
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
    
    public function send_confirm_email() {
        $interaction = $this->UserInteraction->find('first', array('conditions'=>array(
            'user_id'=>AuthComponent::user('id'),
            'interaction_due'=>'confirm email',
            'expired'=>false)));
        
        $datasource = $this->User->getDataSource();
        $datasource->begin();
        
        $OK = true;
        if($interaction != null) {
            $code = $interaction['UserInteraction']['interaction_code'];
        } else {
            $code = $this->getWeirdString();
            
            $interaction = array('UserInteraction');
            $interaction['UserInteraction']['user_id'] = AuthComponent::user('id');
            $interaction['UserInteraction']['interaction_due'] = 'confirm email';
            $interaction['UserInteraction']['expired'] = false;
            $interaction['UserInteraction']['interaction_code'] = $code;
            
            if(!$this->UserInteraction->save($interaction)) $OK = false;
        }
        
        if($OK) {
            // Send email and redirect to a welcome page
            $Email = new CakeEmail('yotellevo');
            $Email->template('email_confirmation')
            ->viewVars(array('confirmation_code' => $code))
            ->emailFormat('html')
            ->to(AuthComponent::user('username'))
            ->subject('Verificación de cuenta');
            try {
                $Email->send();
            } catch ( Exception $e ) {
                $OK = false;
            }
        }        
        
        if($OK) {
            $datasource->commit();
            //$this->setInfoMessage('Se envió un correo a tu cuenta con un enlace para verificarla. Revisa tu correo y sigue las instrucciones.');
        }else {
            $datasource->rollback();
            $this->setErrorMessage('Ocurrió un error enviando las instrucciones a tu correo. Intenta de nuevo.');
            $this->redirect($this->referer());
        }
    }
    
    public function confirm_email($confirmation_code) {
        $interaction = $this->UserInteraction->find('first', array('conditions'=>array(
            'interaction_due'=>'confirm email',
            'expired'=>false,
            'interaction_code'=>$confirmation_code)));
        
        $datasource = $this->User->getDataSource();
        $datasource->begin();
        
        $OK = true;
        if($interaction != null) {
            $interaction['UserInteraction']['expired'] = true;
            if(!$this->UserInteraction->save($interaction)) $OK = false;
            
            if($OK) {
                $user = $this->User->findById($interaction['UserInteraction']['user_id']);
                if($user != null) {
                    $user['User']['email_confirmed'] = true;
                    $this->User->id = $interaction['UserInteraction']['user_id'];
                    if($this->User->saveField('email_confirmed', '1')) {
                        if($this->Auth->loggedIn()) {
                            $this->Auth->logout();
                            if ($this->Auth->login($user['User'])) {
                                $this->_setCookie($this->Auth->user('id'));
                            } else {
                                $OK = false;
                            }
                        } else {
                            //
                        }   
                        
                    } else {
                        $OK = false;
                    }
                }
            }
        } else {            
            $OK = false;
        }
        
        if($OK) {
            $datasource->commit();
            
            /*if($this->Auth->loggedIn()) {
                $this->setInfoMessage('Tu cuenta fue verificada exitosamente.');
                if(AuthComponent::user('role') === 'admin') return $this->redirect(array('action'=>'index'));
                return $this->redirect(array('controller'=>'travels', 'action'=>'index'));
            } else {
                $this->setInfoMessage('Tu cuenta fue verificada. Entra a <em>YoTeLlevo</em> para crear anuncios de viajes.');
                return $this->redirect(array('controller'=>'users', 'action'=>'login'));
            } */
            $this->set('user', $user);
            $this->set('isLoggedIn', $this->Auth->loggedIn());
        } else {
            $datasource->rollback();
            $this->setErrorMessage('Ocurrió un error verificando tu cuenta de correo electrónico. Puede ser que el enlace esté caducado o usado, o que la dirección que estás usando es incorrecta.');
            
            if($this->Auth->loggedIn()) {
                return $this->redirect(array('controller'=>'travels', 'action'=>'index'));
            } else {
                return $this->redirect(array('controller'=>'pages', 'action'=>'home'));
            }
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
            $this->request->data['User']['active'] = true;
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
    
    
    
    /**
     * AUX
     */
    
    private function getWeirdString() {
        return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1).substr(md5(time()),1);
    }
    
    protected function _setCookie($id) {
        if (!$this->request->data('User.remember_me')) {
            return false;
        }
        $data = array(
            'username' => $this->request->data('User.username'),
            'password' => $this->request->data('User.password')
        );
        $this->Cookie->write('User', $data, true, '+2 week');
        return true;
    }
}

?>
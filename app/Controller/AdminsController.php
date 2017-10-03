<?php

App::uses('AppController', 'Controller');

class AdminsController extends AppController
{
    public $components = array('Paginator');
    // public $uses = array('Admin');

    public function beforeFilter()
    {
        AppController::beforeFilter();
        //Basic Setup
        $this->Auth->authenticate = array('Form');
        $this->Auth->authenticate = array(
          'Form' => array('userModel' => 'Admin')
        );
        date_default_timezone_set("Asia/Kolkata");
        $this->Auth->allow('login'); //Without Logged IN which page can be access.. assign here
    }

    public function login()
    {
        $this->layout = 'login_layout';
        if($this->request->is('post'))
        {
            if($this->Auth->login())
            {
              $user_access_detail = $this->Session->read('Auth');
              return $this->redirect($this->Auth->redirectUrl(array('controller'=>'admins','action'=>'index')));
              // return $this->redirect(array('action' => 'index'));
            }
            else
            {
              # code...
              $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          Invalid credentials.
                                        </div>');
            }
        }
    }
    public function index()
    {
        $this->layout = 'base_layout';

        $this -> set('page_title', 'Dashboard');
        //
        //Admins Count
        $admins_count = $this->Admin->find('count');
        $this->set('admins_count' , $admins_count);
        //
        // //Events Count
        // $events_count = $this->Event->find('count');
        // $this->set('events_count' , $events_count);
    }
    public function add()
    {
      // if($this->Session->read('Auth.User.access') != 1)
      // {
      //   return $this -> redirect(array('controller' => 'users', 'action' => 'index'));
      // }
      $this->layout = 'base_layout';
      $this -> set('page_title', 'Add Admin');

        if($this->request->is('post'))
        {
            $temp = $this->request->data;
            if($temp['Admin']['password'] != $temp['Admin']['rtpassword']) {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Password does not match with Retype password.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'admins', 'action' => 'add'));
            }

            $check = $this->Admin->find('all',array('conditions'=>array('Admin.username'=>$temp['Admin']['username'])));

            if(sizeof($check) > 0)
            {
              # code...
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          <b>Oops! Username is already exists.</b>
                                        </div>');
                return $this -> redirect(array('controller' => 'admins', 'action' => 'add'));
            }
            else {
              # code...
                if($this->Admin->save($temp))
                {
                    $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                  Admin <b>`".$temp['Admin']['username']."`</b> has been added.</div>";

                      $this->Session->setFlash($tempMsg);
                      $this -> redirect(array('controller' => 'admins', 'action' => 'view'));
                    }
                    else {
                    # code...
                    $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <b>Oops! Something went wrong. Please try again later.</b>
                                              </div>');
                    $this -> redirect(array('controller' => 'admins', 'action' => 'view'));
                }
            }
        }
    }
    public function edit($id = null) {

        if($id !== null) {
            $this->layout = 'base_layout';
            $this -> set('page_title', 'Edit Admin');
            $temp2 = $this->Admin->findById($id);

            if($temp2) {
                $this->set('admin', $temp2);
            }

            if ($this->request->is('post'))
            {
                $temp = $this->request->data;
                if(trim($temp['Admin']['password']) != trim($temp['Admin']['rtpassword'])) {
                    $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <b>Oops! Both password must be same or just leave it blank.</b>
                                              </div>');
                    return $this -> redirect(array('controller' => 'admins', 'action' => 'edit'));
                }
                else {
                    if(trim($temp['Admin']['password']) > 2) {
                        $this->Admin->id = $id;
                        if ($this->Admin->save($temp))
                        {
                            $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                          Admin <b>`".$temp2['Admin']['username']."`</b> has been edited.</div>";

                            $this->Session->setFlash($tempMsg);
                            $this -> redirect(array('controller' => 'admins', 'action' => 'view'));
                        }
                        else
                        {
                            $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <b>Oops! Something went wrong! Please try again later.</b>
                                                      </div>');
                        }
                    }
                    else {
                        //if password is Blank Then don't update it...
                        $this->Admin->id = $id;
                        // $tp['Admin']['username'] = $temp['Admin']['username'];
                        $tp['Admin']['fname'] = $temp['Admin']['fname'];
                        $tp['Admin']['lname'] = $temp['Admin']['lname'];
                        // pr($tp); die();
                        if ($this->Admin->save($tp))
                        {
                            $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                          Admin <b>`".$temp2['Admin']['username']."`</b> has been edited.</div>";

                            $this->Session->setFlash($tempMsg);
                            return $this -> redirect(array('controller' => 'admins', 'action' => 'view'));
                        }
                        else
                        {
                            $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <b>Oops! Something went wrong! Please try again later.</b>
                                                      </div>');
                        }
                    }
                }
            }

        }
        else {
            return $this -> redirect ( array('controller' => 'admins', 'action' => 'view'));
        }
    }
    public function view()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Admins');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Admin.created DESC'
        );
        $data = $this->Paginator->paginate('Admin');
        $this->set('admins', $data);
    }

    public function delete($id = null) {
        if($id != null) {
            if ($this->Admin->delete($id)) {

              $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          The Admin has been deleted.
                                        </div>');
                    return $this-> redirect( array('controller' => 'admins', 'action'=>'view'));
            }
            else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Oops! Something went wrong! Please try again later.
                                          </div>');
                    return $this-> redirect( array('controller' => 'admins', 'action'=>'view'));
            }
        }
        else {
            return $this -> redirect ( array('controller' => 'admins', 'action' => 'view'));
        }
    }

    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect(array('action' => 'login'));
    }

    public function change_password()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Change Password');

        if ($this->request->is('post'))
        {
            $user = $this->getAdmin();
            $temp = $this->request->data;
            $hashPassword = AuthComponent::password($temp['Admin']['oldpassword']);
            $pass_check = $this->Admin->find('all',array(
                    'conditions' => array(
                        'Admin.password'=>$hashPassword,
                        'Admin.id'=>$user['User']['id']
                    )
                )
            );
            if (empty($pass_check)) {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Invalid current Password.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'admins', 'action' => 'change_password'));
            }

            if(trim($temp['Admin']['password']) != trim($temp['Admin']['rtpassword'])) {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Both password must be same or just leave it blank.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'admins', 'action' => 'change_password'));
            }
            else {
                if(trim($temp['Admin']['password']) > 2) {
                    $this->Admin->id = $user['User']['id'];
                    if ($this->Admin->save($temp))
                    {
                        $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                      Password changed successfully.</div>";

                        $this->Session->setFlash($tempMsg);
                        $this -> redirect(array('controller' => 'admins', 'action' => 'index'));
                    }
                    else
                    {
                        $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <b>Oops! Something went wrong! Please try again later.</b>
                                                  </div>');
                    }
                } else {
                    $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <b>New Password length must be greater than 2.</b>
                                              </div>');
                }
            }
        }
    }
}

?>

<?php
class UserReviewsController extends AppController {

    public $uses = array('Admin','UserReview');
    public $components = array('Paginator');

    public function beforeFilter() {
        AppController::beforeFilter();
        $this->Auth->allow('login');
        $this->Auth->authenticate = array('Form');
        $this->Auth->authenticate = array(
          'Form' => array('userModel' => 'Admin')
        );

        // date_default_timezone_set("Asia/Kolkata");
    }


    public function add()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add Review');

        if ($this->request->is('post'))
        {
            $temp = $this->request->data;
            if ($this->UserReview->save($temp)) {
                $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                              Review has been added.</div>";

                $this->Session->setFlash($tempMsg);
                return $this -> redirect(array('controller' => 'user_reviews', 'action' => 'view'));
            } else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Something went wrong! Please try again later.</b>
                                          </div>');
                return $this -> redirect(array('controller' => 'user_reviews', 'action' => 'view'));
            }
        }
    }

    public function edit($id = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Edit Review');

        if ($id != null) {
            $tmp = $this->UserReview->findById($id);
            $this->set('data',$tmp);

            if ($this->request->is('post'))
            {
                $temp = $this->request->data;
                $this->UserReview->id = $tmp['UserReview']['id'];

                if ($this->UserReview->save($temp)) {
                    $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    Review has been modified.</div>";

                    $this->Session->setFlash($tempMsg);
                    return $this -> redirect(array('controller' => 'user_reviews', 'action' => 'view'));
                } else {
                    $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Oops! Something went wrong! Please try again later.</b>
                    </div>');
                    return $this -> redirect(array('controller' => 'user_reviews', 'action' => 'view'));
                }
            }
        } else {
            //redirect to view
        }
    }

    public function view()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Reviews');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'UserReview.priority ASC',
        );

        $data = $this->Paginator->paginate('UserReview');
        $this->set('user_reviews', $data);
    }


    public function delete($id = null)
    {

        if($id !== null) {
            if ($this->UserReview->delete($id)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          The UserReview has been deleted.
                                        </div>');
                    return $this-> redirect( array('controller' => 'user_reviews', 'action'=>'view'));
            }
            else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Oops! Something went wrong! Please try again later.
                                          </div>');
                    return $this-> redirect( array('controller' => 'user_reviews', 'action'=>'view'));
            }
        }
        else {
            return $this -> redirect ( array('controller' => 'user_reviews', 'action' => 'view'));
        }
    }
}

?>
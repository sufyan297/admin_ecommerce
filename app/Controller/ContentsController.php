<?php
class ContentsController extends AppController {

    public $uses = array('Admin','Content');

    public function beforeFilter() {
        AppController::beforeFilter();
        $this->Auth->allow('login');//Without Logged IN which page can be access.. assign here
        $this->Auth->authenticate = array('Form');
        $this->Auth->authenticate = array(
          'Form' => array('userModel' => 'Admin')
        );

        date_default_timezone_set("Asia/Kolkata");
    }


    public function change_content($alias = null)
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Customize');

        if ($alias != null) {
            $tmp = $this->Content->findByAlias($alias);
            $this->set('content',$tmp);
            // pr($tmp);
            if ($this->request->is('post'))
            {
                $temp = $this->request->data;
                $this->Content->id = $tmp['Content']['id'];
                if ($this->Content->save($temp)) {
                    $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                  Content has been customized.</div>";

                    $this->Session->setFlash($tempMsg);
                    return $this -> redirect(array('controller' => 'contents', 'action' => 'change_content', $alias));
                } else {
                    $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <b>Oops! Something went wrong! Please try again later.</b>
                                              </div>');
                    return $this -> redirect(array('controller' => 'contents', 'action' => 'change_content', $alias));
                }
            }
        }
    }
}

?>
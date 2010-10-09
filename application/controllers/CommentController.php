<?php
class CommentController extends Zend_Controller_Action
{
    protected $_session;
    
    public function init()
    {
        $this->_session = new Zend_Session_Namespace('comment');
    }

    public function indexAction()
    {
        $form = new Application_Form_Comment(array (
            'action' => $this->_helper->url('send-comment'),
            'method' => 'POST',
        ));
        if (isset ($this->_session->commentForm)) {
            $form = unserialize($this->_session->commentForm);
            unset ($this->_session->commentForm);
        }
        $this->view->form = $form;
    }

    public function sendCommentAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('index');
        }
        $form = new Application_Form_Comment();
        if (!$form->isValid($request->getPost())) {
            $this->_session->commentForm = serialize($form);
            return $this->_helper->redirector('index');
        }
        $values = $form->getValues();
        $this->view->values = $values;
    }
}




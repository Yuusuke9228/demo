<?php

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Sign Up/Sign In');
//        parent::initialize();
    }

    public function indexAction()
    {
/*        if (!$this->request->isPost()) {
            $this->tag->setDefault('cd', 'demo');
            $this->tag->setDefault('password', 'phalcon');
        }
*/
        //クッキーが以前にセットされているかどうかチェック
        if ($this->cookies->has('erph_user')) {
            //クッキーの取得
            $erphUser = $this->cookies->get('erph_user');
            //クッキーの値を取得
            $erph_user = $erphUser->getValue();
            $this->tag->setDefault('cd', $erph_user);
            $this->tag->setDefault('hozon', 'on');
        }
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession(Users $user)
    {
        $this->session->set('auth', array(
            'id' => $user->id,
            'name' => $user->name
        ));
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function startAction()
    {
        if ($this->request->isPost()) {

            $cd = $this->request->getPost('cd');
            $password = $this->request->getPost('password');

            $user = Users::findFirst(array(
                "(cd = :cd:) AND password = :password:",
                'bind' => array('cd' => $cd, 'password' => sha1($password))
            ));
            if ($user != false) {
                $this->_registerSession($user);
                $this->flash->success('Welcome ' . $user->name . ' さん');
                if ($this->request->getPost('hozon') == 'on') {
                    $this->cookies->set('erph_user', $user->cd, time() + 15 * 86400);
                } else{
                    $this->cookies->set('erph_user', '', time() - 3600);
                }
                return $this->forward('navigators/index');
            }

            $this->flash->error('Wrong name/password');
        }

        return $this->forward('session/index');
        // ログインフォームへ再度転送

    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('session/index');
    }
}

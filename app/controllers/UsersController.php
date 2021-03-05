<?php
 


class UsersController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("Users", "ユーザーマスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for users
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="Users")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $user = $nameDts::findFirstByid($id);
            if (!$user) {
                $this->flash->error("ユーザーマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "users",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($user, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "users", "Users", "ユーザーマスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "users", "Users", "ユーザーマスタ");
    }

    /**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $user = Users::findFirstByid($id);
            if (!$user) {
                $this->flash->error("ユーザーマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "users",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $user->id;

            $this->_setDefault($user, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($user, $action="edit", $meisai="Users")
    {
        $setdts = ["id",
            "cd",
            "password",
            "name",
            "user_group_mr_cd",
            "kaisi_bi",
            "id_moto",
            "kinsi_flg",
            "shuuryou_nitiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
            ];
            
        foreach ($setdts as $setdt) {
            if (property_exists($user, $setdt)) {
                $this->tag->setDefault($setdt, $user->$setdt);
            }
        }
    }

    /**
     * Edits a user PassWord
     *
     * @param string $id
     */
    public function editpwAction($id)
    {
        if (!$this->request->isPost()) {

            $user = Users::findFirstByid($id);
            if (!$user) {
                $this->flash->error("ユーザーが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "users",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->id);
            $this->tag->setDefault("cd", $user->cd);
            $this->tag->setDefault("password", $user->password);
            $this->tag->setDefault("name", $user->name);
            $this->tag->setDefault("user_group_mr_name", $user->userGroupMrs->name);
            $this->tag->setDefault("created", $user->created);
            $this->tag->setDefault("updated", $user->updated);
            
        }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        $repeatPassword = $this->request->getPost("repeatPassword");
        if ($this->request->getPost("password") != $this->request->getPost("repeatPassword")) {
            $this->flash->error('パスワードが再入力と違います。');
            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'new'
            ));
            return;
        }

        $user = new Users();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "user_group_mr_cd",
            "kaisi_bi",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $user->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }
        $user->password = sha1($this->request->getPost("password"));

        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("ユーザーマスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "users",
            'action' => 'edit',
            'params' => array($user->id)
        ));
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $user = Users::findFirstByid($id);

        if (!$user) {
            $this->flash->error("ユーザーマスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        if ($user->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからユーザーマスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $user->kousin_user_id . " tb=" . $user->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "user_group_mr_cd",
            "kaisi_bi",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $user->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "edit",
                "params" => array($user->id)
            ));

            return;
        }

        $this->_bakOut($user);

        foreach ($post_flds as $post_fld) {
            $user->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("ユーザーマスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "users",
            'action' => 'edit',
            'params' => array($user->id)
        ));
    }

    /**
     * Saves a user password edited
     *
     */
    public function savepwAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'edit',
                'params' => array($user->id)
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $user = Users::findFirstByid($id);

        if (!$user) {
            $this->flash->error("user does not exist " . $id);

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $password = $this->request->getPost("password");
        $repeatPassword = $this->request->getPost("repeatPassword");
        if ($password != $repeatPassword) {
            $this->flash->error('パスワードが再入力と違います。');
            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'editpw',
                'params' => array($id)
            ));
            return;
        }

        $this->_bakOut($user);

        $user->password = sha1($password);

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'editpw',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("パスワードを変更しました。");

        $this->dispatcher->forward(array(
            'controller' => "users",
            'action' => 'edit',
            'params' => array($id)
        ));

    }

    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $user = Users::findFirstByid($id);
        if (!$user) {
            $this->flash->error("ユーザーマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($user, 1);

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "users",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("ユーザーマスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "users",
            'action' => "index"
        ));
    }

    /**
     * Back Out a user
     *
     * @param string $user, $dlt_flg
     */
    public function _bakOut($user, $dlt_flg = 0)
    {

        $bak_user = new BakUsers();
        foreach ($user as $fld => $value) {
            $bak_user->$fld = $user->$fld;
        }
        $bak_user->id = NULL;
        $bak_user->id_moto = $user->id;
        $bak_user->hikae_dltflg = $dlt_flg;
        $bak_user->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_user->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_user->save()) {
            foreach ($bak_user->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }


	public function name_ajaxGetAction()
	{
	    $this->view->disable();

	    //Create a response instance
	    $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        //    return;
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        //    return;
        }

	    $users = Users::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'cd',
	        'conditions' => ' name LIKE ?1 ',
	        'bind' => array(1 => '%'.$this->request->getPost('name').'%'),
	        'limit' => 20
	    ));
        $res_flds = ["id","cd","name",];
	    $resData = array();
	    foreach ($users as $user) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $user->$res_fld;
	        }
	        $resData[] = $resAdata;//array('cd' => $user->cd, 'name' => $user->name);
	    }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}

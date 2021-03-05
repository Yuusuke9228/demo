<?php
 


class UserGroupMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("UserGroupMrs", "ユーザーグループマスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for user_group_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="UserGroupMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $user_group_mr = $nameDts::findFirstByid($id);
            if (!$user_group_mr) {
                $this->flash->error("ユーザーグループマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "user_group_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($user_group_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "user_group_mrs", "UserGroupMrs", "ユーザーグループマスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "user_group_mrs", "UserGroupMrs", "ユーザーグループマスタ");
    }

    /**
     * Edits a user_group_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $user_group_mr = UserGroupMrs::findFirstByid($id);
            if (!$user_group_mr) {
                $this->flash->error("ユーザーグループマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "user_group_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $user_group_mr->id;

            $this->_setDefault($user_group_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($user_group_mr, $action="edit", $meisai="UserGroupMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
            ];
            
        foreach ($setdts as $setdt) {
            if (property_exists($user_group_mr, $setdt)) {
                $this->tag->setDefault($setdt, $user_group_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new user_group_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "user_group_mrs",
                'action' => 'index'
            ));

            return;
        }

        $user_group_mr = new UserGroupMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $user_group_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$user_group_mr->save()) {
            foreach ($user_group_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "user_group_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("ユーザーグループマスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "user_group_mrs",
            'action' => 'edit',
            'params' => array($user_group_mr->id)
        ));
    }

    /**
     * Saves a user_group_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "user_group_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $user_group_mr = UserGroupMrs::findFirstByid($id);

        if (!$user_group_mr) {
            $this->flash->error("ユーザーグループマスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "user_group_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($user_group_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからユーザーグループマスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $user_group_mr->kousin_user_id . " tb=" . $user_group_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "user_group_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $user_group_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "user_group_mrs",
                "action" => "edit",
                "params" => array($user_group_mr->id)
            ));

            return;
        }

        $this->_bakOut($user_group_mr);

        foreach ($post_flds as $post_fld) {
            $user_group_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$user_group_mr->save()) {

            foreach ($user_group_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "user_group_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("ユーザーグループマスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "user_group_mrs",
            'action' => 'edit',
            'params' => array($user_group_mr->id)
        ));
    }

    /**
     * Deletes a user_group_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $user_group_mr = UserGroupMrs::findFirstByid($id);
        if (!$user_group_mr) {
            $this->flash->error("ユーザーグループマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "user_group_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($user_group_mr, 1);

        if (!$user_group_mr->delete()) {

            foreach ($user_group_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "user_group_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("ユーザーグループマスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "user_group_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a user_group_mr
     *
     * @param string $user_group_mr, $dlt_flg
     */
    public function _bakOut($user_group_mr, $dlt_flg = 0)
    {

        $bak_user_group_mr = new BakUserGroupMrs();
        foreach ($user_group_mr as $fld => $value) {
            $bak_user_group_mr->$fld = $user_group_mr->$fld;
        }
        $bak_user_group_mr->id = NULL;
        $bak_user_group_mr->id_moto = $user_group_mr->id;
        $bak_user_group_mr->hikae_dltflg = $dlt_flg;
        $bak_user_group_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_user_group_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_user_group_mr->save()) {
            foreach ($bak_user_group_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

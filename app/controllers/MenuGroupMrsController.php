<?php
 


class MenuGroupMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("MenuGroupMrs", "メニューグループマスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for menu_group_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="MenuGroupMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $menu_group_mr = $nameDts::findFirstByid($id);
            if (!$menu_group_mr) {
                $this->flash->error("メニューグループマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "menu_group_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($menu_group_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "menu_group_mrs", "MenuGroupMrs", "メニューグループマスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "menu_group_mrs", "MenuGroupMrs", "メニューグループマスタ");
    }

    /**
     * Edits a menu_group_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $menu_group_mr = MenuGroupMrs::findFirstByid($id);
            if (!$menu_group_mr) {
                $this->flash->error("メニューグループマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "menu_group_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $menu_group_mr->id;
            $this->view->menu_group_mr = $menu_group_mr;

            $this->_setDefault($menu_group_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($menu_group_mr, $action="edit", $meisai="MenuGroupMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "jun",
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
            if (property_exists($menu_group_mr, $setdt)) {
                $this->tag->setDefault($setdt, $menu_group_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new menu_group_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "menu_group_mrs",
                'action' => 'index'
            ));

            return;
        }

        $menu_group_mr = new MenuGroupMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "jun",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $menu_group_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$menu_group_mr->save()) {
            foreach ($menu_group_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "menu_group_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("メニューグループマスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "menu_group_mrs",
            'action' => 'edit',
            'params' => array($menu_group_mr->id)
        ));
    }

    /**
     * Saves a menu_group_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "menu_group_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $menu_group_mr = MenuGroupMrs::findFirstByid($id);

        if (!$menu_group_mr) {
            $this->flash->error("メニューグループマスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "menu_group_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($menu_group_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからメニューグループマスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $menu_group_mr->kousin_user_id . " tb=" . $menu_group_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "menu_group_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "jun",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $menu_group_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "menu_group_mrs",
                "action" => "edit",
                "params" => array($menu_group_mr->id)
            ));

            return;
        }

        $this->_bakOut($menu_group_mr);

        foreach ($post_flds as $post_fld) {
            $menu_group_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$menu_group_mr->save()) {

            foreach ($menu_group_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "menu_group_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("メニューグループマスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "menu_group_mrs",
            'action' => 'edit',
            'params' => array($menu_group_mr->id)
        ));
    }

    /**
     * Deletes a menu_group_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $menu_group_mr = MenuGroupMrs::findFirstByid($id);
        if (!$menu_group_mr) {
            $this->flash->error("メニューグループマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "menu_group_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($menu_group_mr, 1);

        if (!$menu_group_mr->delete()) {

            foreach ($menu_group_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "menu_group_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("メニューグループマスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "menu_group_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a menu_group_mr
     *
     * @param string $menu_group_mr, $dlt_flg
     */
    public function _bakOut($menu_group_mr, $dlt_flg = 0)
    {

        $bak_menu_group_mr = new BakMenuGroupMrs();
        foreach ($menu_group_mr as $fld => $value) {
            $bak_menu_group_mr->$fld = $menu_group_mr->$fld;
        }
        $bak_menu_group_mr->id = NULL;
        $bak_menu_group_mr->id_moto = $menu_group_mr->id;
        $bak_menu_group_mr->hikae_dltflg = $dlt_flg;
        $bak_menu_group_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_menu_group_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_menu_group_mr->save()) {
            foreach ($bak_menu_group_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * Edits a menu_group_mr
     *
     * @param string $id
     */
    public function menuAction($id)
    {
//        if (!$this->request->isPost()) {

            $menu_group_mr = MenuGroupMrs::findFirstByid($id);
            if (!$menu_group_mr) {
                $this->flash->error("メニューグループマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "menu_group_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->menu_group_mr = $menu_group_mr;
//        }
    }

}

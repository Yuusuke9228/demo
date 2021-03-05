<?php
 


class MenusController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("Menus", "メニュー", "jun"); //簡易検索付き一覧表示
    }

    /**
     * Searches for menus
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="Menus")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $menu = $nameDts::findFirstByid($id);
            if (!$menu) {
                $this->flash->error("メニューが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "menus",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($menu, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "menus", "Menus", "メニュー");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "menus", "Menus", "メニュー");
    }

    /**
     * Edits a menu
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $menu = Menus::findFirstByid($id);
            if (!$menu) {
                $this->flash->error("メニューが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "menus",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $menu->id;

            $this->_setDefault($menu, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($menu, $action="edit", $meisai="Menus")
    {
        $setdts = ["id",
            "name",
            "address",
            "jun",
            "menu_group_mr_cd",
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
            if (property_exists($menu, $setdt)) {
                $this->tag->setDefault($setdt, $menu->$setdt);
            }
        }
    }

    /**
     * Creates a new menu
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "menus",
                'action' => 'index'
            ));

            return;
        }

        $menu = new Menus();

        $post_flds = [];
        $post_flds = ["name",
            "address",
            "jun",
            "menu_group_mr_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $menu->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$menu->save()) {
            foreach ($menu->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "menus",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("メニューの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "menus",
            'action' => 'edit',
            'params' => array($menu->id)
        ));
    }

    /**
     * Saves a menu edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "menus",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $menu = Menus::findFirstByid($id);

        if (!$menu) {
            $this->flash->error("メニューが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "menus",
                'action' => 'index'
            ));

            return;
        }

        if ($menu->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからメニューが変更されたため更新を中止しました。"
                . $id . ",uid=" . $menu->kousin_user_id . " tb=" . $menu->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "menus",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["name",
            "address",
            "jun",
            "menu_group_mr_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $menu->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "menus",
                "action" => "edit",
                "params" => array($menu->id)
            ));

            return;
        }

        $this->_bakOut($menu);

        foreach ($post_flds as $post_fld) {
            $menu->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$menu->save()) {

            foreach ($menu->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "menus",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("メニューの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "menus",
            'action' => 'edit',
            'params' => array($menu->id)
        ));
    }

    /**
     * Deletes a menu
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $menu = Menus::findFirstByid($id);
        if (!$menu) {
            $this->flash->error("メニューが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "menus",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($menu, 1);

        if (!$menu->delete()) {

            foreach ($menu->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "menus",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("メニューの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "menus",
            'action' => "index"
        ));
    }

    /**
     * Back Out a menu
     *
     * @param string $menu, $dlt_flg
     */
    public function _bakOut($menu, $dlt_flg = 0)
    {

        $bak_menu = new BakMenus();
        foreach ($menu as $fld => $value) {
            $bak_menu->$fld = $menu->$fld;
        }
        $bak_menu->id = NULL;
        $bak_menu->id_moto = $menu->id;
        $bak_menu->hikae_dltflg = $dlt_flg;
        $bak_menu->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_menu->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_menu->save()) {
            foreach ($bak_menu->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

<?php
 


class ChokkinsimeBisController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ChokkinsimeBis", "直近締日"); //簡易検索付き一覧表示
    }

    /**
     * Searches for chokkinsime_bis
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ChokkinsimeBis")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $chokkinsime_bi = $nameDts::findFirstByid($id);
            if (!$chokkinsime_bi) {
                $this->flash->error("直近締日が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chokkinsime_bis",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($chokkinsime_bi, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "chokkinsime_bis", "ChokkinsimeBis", "直近締日");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "chokkinsime_bis", "ChokkinsimeBis", "直近締日");
    }

    /**
     * Edits a chokkinsime_bi
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $chokkinsime_bi = ChokkinsimeBis::findFirstByid($id);
            if (!$chokkinsime_bi) {
                $this->flash->error("直近締日が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chokkinsime_bis",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $chokkinsime_bi->id;

            $this->_setDefault($chokkinsime_bi, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($chokkinsime_bi, $action="edit", $meisai="ChokkinsimeBis")
    {
        $setdts = ["id",
            "cd",
            "name",
            "simebi",
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
            if (property_exists($chokkinsime_bi, $setdt)) {
                $this->tag->setDefault($setdt, $chokkinsime_bi->$setdt);
            }
        }
    }

    /**
     * Creates a new chokkinsime_bi
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chokkinsime_bis",
                'action' => 'index'
            ));

            return;
        }

        $chokkinsime_bi = new ChokkinsimeBis();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "simebi",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $chokkinsime_bi->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$chokkinsime_bi->save()) {
            foreach ($chokkinsime_bi->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chokkinsime_bis",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("直近締日の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "chokkinsime_bis",
            'action' => 'edit',
            'params' => array($chokkinsime_bi->id)
        ));
    }

    /**
     * Saves a chokkinsime_bi edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chokkinsime_bis",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $chokkinsime_bi = ChokkinsimeBis::findFirstByid($id);

        if (!$chokkinsime_bi) {
            $this->flash->error("直近締日が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "chokkinsime_bis",
                'action' => 'index'
            ));

            return;
        }

        if ($chokkinsime_bi->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから直近締日が変更されたため更新を中止しました。"
                . $id . ",uid=" . $chokkinsime_bi->kousin_user_id . " tb=" . $chokkinsime_bi->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "chokkinsime_bis",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "simebi",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $chokkinsime_bi->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "chokkinsime_bis",
                "action" => "edit",
                "params" => array($chokkinsime_bi->id)
            ));

            return;
        }

        $this->_bakOut($chokkinsime_bi);

        foreach ($post_flds as $post_fld) {
            $chokkinsime_bi->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$chokkinsime_bi->save()) {

            foreach ($chokkinsime_bi->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chokkinsime_bis",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("直近締日の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "chokkinsime_bis",
            'action' => 'edit',
            'params' => array($chokkinsime_bi->id)
        ));
    }

    /**
     * Deletes a chokkinsime_bi
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $chokkinsime_bi = ChokkinsimeBis::findFirstByid($id);
        if (!$chokkinsime_bi) {
            $this->flash->error("直近締日が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "chokkinsime_bis",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($chokkinsime_bi, 1);

        if (!$chokkinsime_bi->delete()) {

            foreach ($chokkinsime_bi->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chokkinsime_bis",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("直近締日の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "chokkinsime_bis",
            'action' => "index"
        ));
    }

    /**
     * Back Out a chokkinsime_bi
     *
     * @param string $chokkinsime_bi, $dlt_flg
     */
    public function _bakOut($chokkinsime_bi, $dlt_flg = 0)
    {

        $bak_chokkinsime_bi = new BakChokkinsimeBis();
        foreach ($chokkinsime_bi as $fld => $value) {
            $bak_chokkinsime_bi->$fld = $chokkinsime_bi->$fld;
        }
        $bak_chokkinsime_bi->id = NULL;
        $bak_chokkinsime_bi->id_moto = $chokkinsime_bi->id;
        $bak_chokkinsime_bi->hikae_dltflg = $dlt_flg;
        $bak_chokkinsime_bi->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_chokkinsime_bi->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_chokkinsime_bi->save()) {
            foreach ($bak_chokkinsime_bi->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

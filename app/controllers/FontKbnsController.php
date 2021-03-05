<?php
 


class FontKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("FontKbns", "フォント区分"); //簡易検索付き一覧表示
    }

    /**
     * Searches for font_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="FontKbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $font_kbn = $nameDts::findFirstByid($id);
            if (!$font_kbn) {
                $this->flash->error("フォント区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "font_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($font_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "font_kbns", "FontKbns", "フォント区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "font_kbns", "FontKbns", "フォント区分");
    }

    /**
     * Edits a font_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $font_kbn = FontKbns::findFirstByid($id);
            if (!$font_kbn) {
                $this->flash->error("フォント区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "font_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $font_kbn->id;

            $this->_setDefault($font_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($font_kbn, $action="edit", $meisai="FontKbns")
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
            if (property_exists($font_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $font_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new font_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "font_kbns",
                'action' => 'index'
            ));

            return;
        }

        $font_kbn = new FontKbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $font_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$font_kbn->save()) {
            foreach ($font_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "font_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("フォント区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "font_kbns",
            'action' => 'edit',
            'params' => array($font_kbn->id)
        ));
    }

    /**
     * Saves a font_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "font_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $font_kbn = FontKbns::findFirstByid($id);

        if (!$font_kbn) {
            $this->flash->error("フォント区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "font_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($font_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからフォント区分が変更されたため更新を中止しました。"
                . $id . ",uid=" . $font_kbn->kousin_user_id . " tb=" . $font_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "font_kbns",
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
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $font_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "font_kbns",
                "action" => "edit",
                "params" => array($font_kbn->id)
            ));

            return;
        }

        $this->_bakOut($font_kbn);

        foreach ($post_flds as $post_fld) {
            $font_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$font_kbn->save()) {

            foreach ($font_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "font_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("フォント区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "font_kbns",
            'action' => 'edit',
            'params' => array($font_kbn->id)
        ));
    }

    /**
     * Deletes a font_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $font_kbn = FontKbns::findFirstByid($id);
        if (!$font_kbn) {
            $this->flash->error("フォント区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "font_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($font_kbn, 1);

        if (!$font_kbn->delete()) {

            foreach ($font_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "font_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("フォント区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "font_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a font_kbn
     *
     * @param string $font_kbn, $dlt_flg
     */
    public function _bakOut($font_kbn, $dlt_flg = 0)
    {

        $bak_font_kbn = new BakFontKbns();
        foreach ($font_kbn as $fld => $value) {
            $bak_font_kbn->$fld = $font_kbn->$fld;
        }
        $bak_font_kbn->id = NULL;
        $bak_font_kbn->id_moto = $font_kbn->id;
        $bak_font_kbn->hikae_dltflg = $dlt_flg;
        $bak_font_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_font_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_font_kbn->save()) {
            foreach ($bak_font_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

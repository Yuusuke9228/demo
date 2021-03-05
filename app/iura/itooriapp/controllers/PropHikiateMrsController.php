<?php
 


class PropHikiateMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("PropHikiateMrs", "prop_hikiate_mrs"); //簡易検索付き一覧表示
    }

    /**
     * Searches for prop_hikiate_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="PropHikiateMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $prop_hikiate_mr = $nameDts::findFirstByid($id);
            if (!$prop_hikiate_mr) {
                $this->flash->error("prop_hikiate_mrsが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "prop_hikiate_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($prop_hikiate_mr, "new", $dataname);
            $this->tag->setDefault("指図番号", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "prop_hikiate_mrs", "PropHikiateMrs", "prop_hikiate_mrs");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "prop_hikiate_mrs", "PropHikiateMrs", "prop_hikiate_mrs");
    }

    /**
     * Edits a prop_hikiate_mr
     *
     * @param string $指図番号
     */
    public function editAction($指図番号)
    {
//        if (!$this->request->isPost()) {

            $prop_hikiate_mr = PropHikiateMrs::findFirstBy指図番号($指図番号);
            if (!$prop_hikiate_mr) {
                $this->flash->error("prop_hikiate_mrsが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "prop_hikiate_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->指図番号 = $prop_hikiate_mr->指図番号;

            $this->_setDefault($prop_hikiate_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($prop_hikiate_mr, $action="edit", $meisai="PropHikiateMrs")
    {
        $setdts = ["指図番号",
            "指図枝番",
            "加工№",
            "加工NO",
            "単価",
            "単価単位",
            "糸名",
            "糸名２",
            "ロット",
            "備考",
            "出荷先",
            "住所",
            "電話",
            "ラベル形式",
            ];
            
        foreach ($setdts as $setdt) {
            if (property_exists($prop_hikiate_mr, $setdt)) {
                $this->tag->setDefault($setdt, $prop_hikiate_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new prop_hikiate_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "prop_hikiate_mrs",
                'action' => 'index'
            ));

            return;
        }

        $prop_hikiate_mr = new PropHikiateMrs();

        $post_flds = [];
        $post_flds = ["指図番号",
            "指図枝番",
            "加工№",
            "加工NO",
            "単価",
            "単価単位",
            "糸名",
            "糸名２",
            "ロット",
            "備考",
            "出荷先",
            "住所",
            "電話",
            "ラベル形式",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $prop_hikiate_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$prop_hikiate_mr->save()) {
            foreach ($prop_hikiate_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "prop_hikiate_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("prop_hikiate_mrsの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "prop_hikiate_mrs",
            'action' => 'edit',
            'params' => array($prop_hikiate_mr->指図番号)
        ));
    }

    /**
     * Saves a prop_hikiate_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "prop_hikiate_mrs",
                'action' => 'index'
            ));

            return;
        }

        $指図番号 = $this->request->getPost("指図番号");
        $prop_hikiate_mr = PropHikiateMrs::findFirstBy指図番号($指図番号);

        if (!$prop_hikiate_mr) {
            $this->flash->error("prop_hikiate_mrsが見つからなくなりました。" . $指図番号);

            $this->dispatcher->forward(array(
                'controller' => "prop_hikiate_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($prop_hikiate_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからprop_hikiate_mrsが変更されたため更新を中止しました。"
                . $指図番号 . ",uid=" . $prop_hikiate_mr->kousin_user_id . " tb=" . $prop_hikiate_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "prop_hikiate_mrs",
                'action' => 'edit',
                'params' => array($指図番号)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["指図番号",
            "指図枝番",
            "加工№",
            "加工NO",
            "単価",
            "単価単位",
            "糸名",
            "糸名２",
            "ロット",
            "備考",
            "出荷先",
            "住所",
            "電話",
            "ラベル形式",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $prop_hikiate_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $指図番号);

            $this->dispatcher->forward(array(
                "controller" => "prop_hikiate_mrs",
                "action" => "edit",
                "params" => array($prop_hikiate_mr->指図番号)
            ));

            return;
        }

        $this->_bakOut($prop_hikiate_mr);

        foreach ($post_flds as $post_fld) {
            $prop_hikiate_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$prop_hikiate_mr->save()) {

            foreach ($prop_hikiate_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "prop_hikiate_mrs",
                'action' => 'edit',
                'params' => array($指図番号)
            ));

            return;
        }

        $this->flash->success("prop_hikiate_mrsの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "prop_hikiate_mrs",
            'action' => 'edit',
            'params' => array($prop_hikiate_mr->指図番号)
        ));
    }

    /**
     * Deletes a prop_hikiate_mr
     *
     * @param string $指図番号
     */
    public function deleteAction($指図番号)
    {
        $prop_hikiate_mr = PropHikiateMrs::findFirstBy指図番号($指図番号);
        if (!$prop_hikiate_mr) {
            $this->flash->error("prop_hikiate_mrsが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "prop_hikiate_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($prop_hikiate_mr, 1);

        if (!$prop_hikiate_mr->delete()) {

            foreach ($prop_hikiate_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "prop_hikiate_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("prop_hikiate_mrsの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "prop_hikiate_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a prop_hikiate_mr
     *
     * @param string $prop_hikiate_mr, $dlt_flg
     */
    public function _bakOut($prop_hikiate_mr, $dlt_flg = 0)
    {

        $bak_prop_hikiate_mr = new BakPropHikiateMrs();
        foreach ($prop_hikiate_mr as $fld => $value) {
            $bak_prop_hikiate_mr->$fld = $prop_hikiate_mr->$fld;
        }
        $bak_prop_hikiate_mr->指図番号 = NULL;
        $bak_prop_hikiate_mr->moto_指図番号 = $prop_hikiate_mr->指図番号;
        $bak_prop_hikiate_mr->hikae_dltflg = $dlt_flg;
        $bak_prop_hikiate_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_prop_hikiate_mr->hikae_nitiji = date("Y-m-d H:i:s");
        if (!$bak_prop_hikiate_mr->save()) {
            foreach ($bak_prop_hikiate_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

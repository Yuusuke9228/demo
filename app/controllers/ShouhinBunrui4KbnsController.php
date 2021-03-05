<?php
 


class ShouhinBunrui4KbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShouhinBunrui4Kbns", "商品分類４"); //簡易検索付き一覧表示
    }

    /**
     * Searches for shouhin_bunrui4_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * モーダル 2019/11/5 Nishiyama
     */
    public function modalAction()
    {
        ControllerBase::indexCd("ShouhinBunrui4Kbns", "分類4台帳");
    }

    /*
     * Ajax 2019/11/5 Nishiyama
     */
    public function ajaxGetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        }
        $shouhin_bunrui3 = ShouhinBunrui4Kbns::find(array(
            'order' => 'cd',
            'conditions' => ' cd LIKE ?1 ',
            'bind' => array(1 => $this->request->getPost('cd').'%')
        ));
        $res_flds = ["id","cd","name",];
        $resData = array();
        foreach ($shouhin_bunrui4 as $bunrui4) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $bunrui4->$res_fld;
            }
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ShouhinBunrui4Kbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shouhin_bunrui4_kbn = $nameDts::findFirstByid($id);
            if (!$shouhin_bunrui4_kbn) {
                $this->flash->error("商品分類４が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shouhin_bunrui4_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shouhin_bunrui4_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shouhin_bunrui4_kbns", "ShouhinBunrui4Kbns", "商品分類４");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shouhin_bunrui4_kbns", "ShouhinBunrui4Kbns", "商品分類４");
    }

    /**
     * Edits a shouhin_bunrui4_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $shouhin_bunrui4_kbn = ShouhinBunrui4Kbns::findFirstByid($id);
            if (!$shouhin_bunrui4_kbn) {
                $this->flash->error("商品分類４が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shouhin_bunrui4_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shouhin_bunrui4_kbn->id;

            $this->_setDefault($shouhin_bunrui4_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shouhin_bunrui4_kbn, $action="edit", $meisai="ShouhinBunrui4Kbns")
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
            if (property_exists($shouhin_bunrui4_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $shouhin_bunrui4_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new shouhin_bunrui4_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shouhin_bunrui4_kbns",
                'action' => 'index'
            ));

            return;
        }

        $shouhin_bunrui4_kbn = new ShouhinBunrui4Kbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shouhin_bunrui4_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shouhin_bunrui4_kbn->save()) {
            foreach ($shouhin_bunrui4_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shouhin_bunrui4_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("商品分類４の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shouhin_bunrui4_kbns",
            'action' => 'edit',
            'params' => array($shouhin_bunrui4_kbn->id)
        ));
    }

    /**
     * Saves a shouhin_bunrui4_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shouhin_bunrui4_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shouhin_bunrui4_kbn = ShouhinBunrui4Kbns::findFirstByid($id);

        if (!$shouhin_bunrui4_kbn) {
            $this->flash->error("商品分類４が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shouhin_bunrui4_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($shouhin_bunrui4_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから商品分類４が変更されたため更新を中止しました。"
                . $id . ",uid=" . $shouhin_bunrui4_kbn->kousin_user_id . " tb=" . $shouhin_bunrui4_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shouhin_bunrui4_kbns",
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
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $shouhin_bunrui4_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shouhin_bunrui4_kbns",
                "action" => "edit",
                "params" => array($shouhin_bunrui4_kbn->id)
            ));

            return;
        }

        $this->_bakOut($shouhin_bunrui4_kbn);

        foreach ($post_flds as $post_fld) {
            $shouhin_bunrui4_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shouhin_bunrui4_kbn->save()) {

            foreach ($shouhin_bunrui4_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shouhin_bunrui4_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("商品分類４の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shouhin_bunrui4_kbns",
            'action' => 'edit',
            'params' => array($shouhin_bunrui4_kbn->id)
        ));
    }

    /**
     * Deletes a shouhin_bunrui4_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shouhin_bunrui4_kbn = ShouhinBunrui4Kbns::findFirstByid($id);
        if (!$shouhin_bunrui4_kbn) {
            $this->flash->error("商品分類４が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shouhin_bunrui4_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shouhin_bunrui4_kbn, 1);

        if (!$shouhin_bunrui4_kbn->delete()) {

            foreach ($shouhin_bunrui4_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shouhin_bunrui4_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("商品分類４の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shouhin_bunrui4_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shouhin_bunrui4_kbn
     *
     * @param string $shouhin_bunrui4_kbn, $dlt_flg
     */
    public function _bakOut($shouhin_bunrui4_kbn, $dlt_flg = 0)
    {

        $bak_shouhin_bunrui4_kbn = new BakShouhinBunrui4Kbns();
        foreach ($shouhin_bunrui4_kbn as $fld => $value) {
            $bak_shouhin_bunrui4_kbn->$fld = $shouhin_bunrui4_kbn->$fld;
        }
        $bak_shouhin_bunrui4_kbn->id = NULL;
        $bak_shouhin_bunrui4_kbn->id_moto = $shouhin_bunrui4_kbn->id;
        $bak_shouhin_bunrui4_kbn->hikae_dltflg = $dlt_flg;
        $bak_shouhin_bunrui4_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shouhin_bunrui4_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shouhin_bunrui4_kbn->save()) {
            foreach ($bak_shouhin_bunrui4_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

<?php
 


class ShiiresakiBunrui2KbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ShiiresakiBunrui2Kbns", "仕入先分類２"); //簡易検索付き一覧表示
    }

    /**
     * Searches for shiiresaki_bunrui2_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ShiiresakiBunrui2Kbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $shiiresaki_bunrui2_kbn = $nameDts::findFirstByid($id);
            if (!$shiiresaki_bunrui2_kbn) {
                $this->flash->error("仕入先分類２が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiiresaki_bunrui2_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($shiiresaki_bunrui2_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * モーダル 2019/11/12 Nishiyama
     */
    public function modalAction()
    {
        ControllerBase::indexCd("ShiiresakiBunrui2Kbns", "仕入先分類2台帳");
    }

    /*
     * Ajax 2019/11/12 Nishiyama
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
        $shiiresaki_bunrui2 = ShiiresakiBunrui2Kbns::find(array(
            'order' => 'cd',
            'conditions' => ' cd LIKE ?1 ',
            'bind' => array(1 => $this->request->getPost('cd').'%')
        ));
        $res_flds = ["id","cd","name",];
        $resData = array();
        foreach ($shiiresaki_bunrui2 as $bunrui2) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $bunrui2->$res_fld;
            }
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "shiiresaki_bunrui2_kbns", "ShiiresakiBunrui2Kbns", "仕入先分類２");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "shiiresaki_bunrui2_kbns", "ShiiresakiBunrui2Kbns", "仕入先分類２");
    }

    /**
     * Edits a shiiresaki_bunrui2_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $shiiresaki_bunrui2_kbn = ShiiresakiBunrui2Kbns::findFirstByid($id);
            if (!$shiiresaki_bunrui2_kbn) {
                $this->flash->error("仕入先分類２が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shiiresaki_bunrui2_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $shiiresaki_bunrui2_kbn->id;

            $this->_setDefault($shiiresaki_bunrui2_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($shiiresaki_bunrui2_kbn, $action="edit", $meisai="ShiiresakiBunrui2Kbns")
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
            if (property_exists($shiiresaki_bunrui2_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $shiiresaki_bunrui2_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new shiiresaki_bunrui2_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui2_kbns",
                'action' => 'index'
            ));

            return;
        }

        $shiiresaki_bunrui2_kbn = new ShiiresakiBunrui2Kbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $shiiresaki_bunrui2_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shiiresaki_bunrui2_kbn->save()) {
            foreach ($shiiresaki_bunrui2_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui2_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("仕入先分類２の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_bunrui2_kbns",
            'action' => 'edit',
            'params' => array($shiiresaki_bunrui2_kbn->id)
        ));
    }

    /**
     * Saves a shiiresaki_bunrui2_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui2_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $shiiresaki_bunrui2_kbn = ShiiresakiBunrui2Kbns::findFirstByid($id);

        if (!$shiiresaki_bunrui2_kbn) {
            $this->flash->error("仕入先分類２が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui2_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($shiiresaki_bunrui2_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから仕入先分類２が変更されたため更新を中止しました。"
                . $id . ",uid=" . $shiiresaki_bunrui2_kbn->kousin_user_id . " tb=" . $shiiresaki_bunrui2_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui2_kbns",
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
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $shiiresaki_bunrui2_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "shiiresaki_bunrui2_kbns",
                "action" => "edit",
                "params" => array($shiiresaki_bunrui2_kbn->id)
            ));

            return;
        }

        $this->_bakOut($shiiresaki_bunrui2_kbn);

        foreach ($post_flds as $post_fld) {
            $shiiresaki_bunrui2_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$shiiresaki_bunrui2_kbn->save()) {

            foreach ($shiiresaki_bunrui2_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui2_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("仕入先分類２の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_bunrui2_kbns",
            'action' => 'edit',
            'params' => array($shiiresaki_bunrui2_kbn->id)
        ));
    }

    /**
     * Deletes a shiiresaki_bunrui2_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $shiiresaki_bunrui2_kbn = ShiiresakiBunrui2Kbns::findFirstByid($id);
        if (!$shiiresaki_bunrui2_kbn) {
            $this->flash->error("仕入先分類２が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui2_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($shiiresaki_bunrui2_kbn, 1);

        if (!$shiiresaki_bunrui2_kbn->delete()) {

            foreach ($shiiresaki_bunrui2_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "shiiresaki_bunrui2_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("仕入先分類２の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "shiiresaki_bunrui2_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a shiiresaki_bunrui2_kbn
     *
     * @param string $shiiresaki_bunrui2_kbn, $dlt_flg
     */
    public function _bakOut($shiiresaki_bunrui2_kbn, $dlt_flg = 0)
    {

        $bak_shiiresaki_bunrui2_kbn = new BakShiiresakiBunrui2Kbns();
        foreach ($shiiresaki_bunrui2_kbn as $fld => $value) {
            $bak_shiiresaki_bunrui2_kbn->$fld = $shiiresaki_bunrui2_kbn->$fld;
        }
        $bak_shiiresaki_bunrui2_kbn->id = NULL;
        $bak_shiiresaki_bunrui2_kbn->id_moto = $shiiresaki_bunrui2_kbn->id;
        $bak_shiiresaki_bunrui2_kbn->hikae_dltflg = $dlt_flg;
        $bak_shiiresaki_bunrui2_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_shiiresaki_bunrui2_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_shiiresaki_bunrui2_kbn->save()) {
            foreach ($bak_shiiresaki_bunrui2_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

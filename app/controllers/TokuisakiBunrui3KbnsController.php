<?php
 


class TokuisakiBunrui3KbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("TokuisakiBunrui3Kbns", "得意先分類３"); //簡易検索付き一覧表示
    }

    /**
     * Searches for tokuisaki_bunrui3_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * モーダル 2019/11/12 Nishiyama
     */
    public function modalAction()
    {
        ControllerBase::indexCd("TokuisakiBunrui3Kbns", "得意先分類3台帳");
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
        $tokuisaki_bunrui3 = TokuisakiBunrui3Kbns::find(array(
            'order' => 'cd',
            'conditions' => ' cd LIKE ?1 ',
            'bind' => array(1 => $this->request->getPost('cd').'%')
        ));
        $res_flds = ["id","cd","name",];
        $resData = array();
        foreach ($tokuisaki_bunrui3 as $bunrui3) {
            $resAdata = array();
            foreach ($res_flds as $res_fld) {
                $resAdata[$res_fld] = $bunrui3->$res_fld;
            }
            $resData[] = $resAdata;
        }
        $response->setContent(json_encode($resData));
        return $response;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="TokuisakiBunrui3Kbns")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $tokuisaki_bunrui3_kbn = $nameDts::findFirstByid($id);
            if (!$tokuisaki_bunrui3_kbn) {
                $this->flash->error("得意先分類３が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tokuisaki_bunrui3_kbns",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($tokuisaki_bunrui3_kbn, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "tokuisaki_bunrui3_kbns", "TokuisakiBunrui3Kbns", "得意先分類３");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "tokuisaki_bunrui3_kbns", "TokuisakiBunrui3Kbns", "得意先分類３");
    }

    /**
     * Edits a tokuisaki_bunrui3_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $tokuisaki_bunrui3_kbn = TokuisakiBunrui3Kbns::findFirstByid($id);
            if (!$tokuisaki_bunrui3_kbn) {
                $this->flash->error("得意先分類３が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tokuisaki_bunrui3_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $tokuisaki_bunrui3_kbn->id;

            $this->_setDefault($tokuisaki_bunrui3_kbn, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($tokuisaki_bunrui3_kbn, $action="edit", $meisai="TokuisakiBunrui3Kbns")
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
            if (property_exists($tokuisaki_bunrui3_kbn, $setdt)) {
                $this->tag->setDefault($setdt, $tokuisaki_bunrui3_kbn->$setdt);
            }
        }
    }

    /**
     * Creates a new tokuisaki_bunrui3_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_bunrui3_kbns",
                'action' => 'index'
            ));

            return;
        }

        $tokuisaki_bunrui3_kbn = new TokuisakiBunrui3Kbns();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $tokuisaki_bunrui3_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$tokuisaki_bunrui3_kbn->save()) {
            foreach ($tokuisaki_bunrui3_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_bunrui3_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("得意先分類３の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tokuisaki_bunrui3_kbns",
            'action' => 'edit',
            'params' => array($tokuisaki_bunrui3_kbn->id)
        ));
    }

    /**
     * Saves a tokuisaki_bunrui3_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_bunrui3_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $tokuisaki_bunrui3_kbn = TokuisakiBunrui3Kbns::findFirstByid($id);

        if (!$tokuisaki_bunrui3_kbn) {
            $this->flash->error("得意先分類３が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_bunrui3_kbns",
                'action' => 'index'
            ));

            return;
        }

        if ($tokuisaki_bunrui3_kbn->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから得意先分類３が変更されたため更新を中止しました。"
                . $id . ",uid=" . $tokuisaki_bunrui3_kbn->kousin_user_id . " tb=" . $tokuisaki_bunrui3_kbn->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_bunrui3_kbns",
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
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $tokuisaki_bunrui3_kbn->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "tokuisaki_bunrui3_kbns",
                "action" => "edit",
                "params" => array($tokuisaki_bunrui3_kbn->id)
            ));

            return;
        }

        $this->_bakOut($tokuisaki_bunrui3_kbn);

        foreach ($post_flds as $post_fld) {
            $tokuisaki_bunrui3_kbn->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$tokuisaki_bunrui3_kbn->save()) {

            foreach ($tokuisaki_bunrui3_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_bunrui3_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("得意先分類３の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "tokuisaki_bunrui3_kbns",
            'action' => 'edit',
            'params' => array($tokuisaki_bunrui3_kbn->id)
        ));
    }

    /**
     * Deletes a tokuisaki_bunrui3_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $tokuisaki_bunrui3_kbn = TokuisakiBunrui3Kbns::findFirstByid($id);
        if (!$tokuisaki_bunrui3_kbn) {
            $this->flash->error("得意先分類３が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_bunrui3_kbns",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($tokuisaki_bunrui3_kbn, 1);

        if (!$tokuisaki_bunrui3_kbn->delete()) {

            foreach ($tokuisaki_bunrui3_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tokuisaki_bunrui3_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("得意先分類３の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tokuisaki_bunrui3_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a tokuisaki_bunrui3_kbn
     *
     * @param string $tokuisaki_bunrui3_kbn, $dlt_flg
     */
    public function _bakOut($tokuisaki_bunrui3_kbn, $dlt_flg = 0)
    {

        $bak_tokuisaki_bunrui3_kbn = new BakTokuisakiBunrui3Kbns();
        foreach ($tokuisaki_bunrui3_kbn as $fld => $value) {
            $bak_tokuisaki_bunrui3_kbn->$fld = $tokuisaki_bunrui3_kbn->$fld;
        }
        $bak_tokuisaki_bunrui3_kbn->id = NULL;
        $bak_tokuisaki_bunrui3_kbn->id_moto = $tokuisaki_bunrui3_kbn->id;
        $bak_tokuisaki_bunrui3_kbn->hikae_dltflg = $dlt_flg;
        $bak_tokuisaki_bunrui3_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_tokuisaki_bunrui3_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_tokuisaki_bunrui3_kbn->save()) {
            foreach ($bak_tokuisaki_bunrui3_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

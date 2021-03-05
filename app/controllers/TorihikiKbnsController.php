<?php
 
class TorihikiKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
		ControllerBase::indexCd("TorihikiKbns", "取引区分");
    }

    /**
     * Searches for torihiki_kbns
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
		ControllerBase::nextCd($id, "torihiki_kbns", "TorihikiKbns", "取引区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
		ControllerBase::prevCd($id, "torihiki_kbns", "TorihikiKbns", "取引区分");
    }

    /**
     * Edits a torihiki_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $torihiki_kbn = TorihikiKbns::findFirstByid($id);
            if (!$torihiki_kbn) {
                $this->flash->error("取引区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "torihiki_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $torihiki_kbn->id;

            $this->tag->setDefault("id", $torihiki_kbn->id);
            $this->tag->setDefault("cd", $torihiki_kbn->cd);
            $this->tag->setDefault("name", $torihiki_kbn->name);
            $this->tag->setDefault("shiire_name", $torihiki_kbn->shiire_name);
            $this->tag->setDefault("id_moto", $torihiki_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $torihiki_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $torihiki_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $torihiki_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $torihiki_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $torihiki_kbn->created);
            $this->tag->setDefault("kousin_user_id", $torihiki_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $torihiki_kbn->updated);
            
//        }
    }

    /**
     * Creates a new torihiki_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbns",
                'action' => 'index'
            ));

            return;
        }

        $torihiki_kbn = new TorihikiKbns();
        $post_flds = ["cd","name","shiire_name","updated",];
        foreach ($post_flds as $post_fld) {
            $torihiki_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$torihiki_kbn->save()) {
            foreach ($torihiki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("取引区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "torihiki_kbns",
            'action' => 'edit',
            'params' => array($torihiki_kbn->id)
        ));
    }

    /**
     * Saves a torihiki_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $torihiki_kbn = TorihikiKbns::findFirstByid($id);

        if (!$torihiki_kbn) {
            $this->flash->error("取引区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","shiire_name","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($torihiki_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "torihiki_kbns",
                "action" => "edit",
                "params" => array($torihiki_kbn->id)
            ));

            return;
        }

        $this->_bakOut($torihiki_kbn);

        foreach ($post_flds as $post_fld) {
            $torihiki_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$torihiki_kbn->save()) {

            foreach ($torihiki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("取引区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "torihiki_kbns",
            'action' => 'edit',
            'params' => array($torihiki_kbn->id)
        ));
    }

    /**
     * Deletes a torihiki_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $torihiki_kbn = TorihikiKbns::findFirstByid($id);
        if (!$torihiki_kbn) {
            $this->flash->error("取引区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$torihiki_kbn->delete()) {

            foreach ($torihiki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "torihiki_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($torihiki_kbn, 1);

        $this->flash->success("取引区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "torihiki_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a torihiki_kbn
     *
     * @param string $torihiki_kbn, $dlt_flg
     */
    public function _bakOut($torihiki_kbn, $dlt_flg = 0)
    {

        $bak_torihiki_kbn = new BakTorihikiKbns();
        foreach ($torihiki_kbn as $fld => $value) {
            $bak_torihiki_kbn->$fld = $torihiki_kbn->$fld;
        }
        $bak_torihiki_kbn->id = NULL;
        $bak_torihiki_kbn->id_moto = $torihiki_kbn->id;
        $bak_torihiki_kbn->hikae_dltflg = $dlt_flg;
        $bak_torihiki_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_torihiki_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_torihiki_kbn->save()) {
            foreach ($bak_torihiki_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

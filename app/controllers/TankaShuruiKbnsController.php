<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TankaShuruiKbnsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
		ControllerBase::indexCd("TankaShuruiKbns", "単価種類区分");
    }

    /**
     * Searches for tanka_shurui_kbns
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
		ControllerBase::nextCd($id, "tanka_shurui_kbns", "TankaShuruiKbns", "単価種類区分");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
		ControllerBase::prevCd($id, "tanka_shurui_kbns", "TankaShuruiKbns", "単価種類区分");
    }

    /**
     * Edits a tanka_shurui_kbn
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $tanka_shurui_kbn = TankaShuruiKbns::findFirstByid($id);
            if (!$tanka_shurui_kbn) {
                $this->flash->error("単価種類区分が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "tanka_shurui_kbns",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $tanka_shurui_kbn->id;

            $this->tag->setDefault("id", $tanka_shurui_kbn->id);
            $this->tag->setDefault("cd", $tanka_shurui_kbn->cd);
            $this->tag->setDefault("name", $tanka_shurui_kbn->name);
            $this->tag->setDefault("koumokumei", $tanka_shurui_kbn->koumokumei);
            $this->tag->setDefault("uriage_flg", $tanka_shurui_kbn->uriage_flg);
            $this->tag->setDefault("shiire_flg", $tanka_shurui_kbn->shiire_flg);
            $this->tag->setDefault("id_moto", $tanka_shurui_kbn->id_moto);
            $this->tag->setDefault("hikae_dltflg", $tanka_shurui_kbn->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $tanka_shurui_kbn->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $tanka_shurui_kbn->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $tanka_shurui_kbn->sakusei_user_id);
            $this->tag->setDefault("created", $tanka_shurui_kbn->created);
            $this->tag->setDefault("kousin_user_id", $tanka_shurui_kbn->kousin_user_id);
            $this->tag->setDefault("updated", $tanka_shurui_kbn->updated);
            
 //       }
    }

    /**
     * Creates a new tanka_shurui_kbn
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tanka_shurui_kbns",
                'action' => 'index'
            ));

            return;
        }

        $tanka_shurui_kbn = new TankaShuruiKbns();
        $post_flds = ["cd","name","koumokumei","uriage_flg","shiire_flg","updated",];
        foreach ($post_flds as $post_fld) {
            $tanka_shurui_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$tanka_shurui_kbn->save()) {
            foreach ($tanka_shurui_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tanka_shurui_kbns",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("単価種類区分の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tanka_shurui_kbns",
            'action' => 'edit',
            'params' => array($tanka_shurui_kbn->id)
        ));
    }

    /**
     * Saves a tanka_shurui_kbn edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "tanka_shurui_kbns",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $tanka_shurui_kbn = TankaShuruiKbns::findFirstByid($id);

        if (!$tanka_shurui_kbn) {
            $this->flash->error("単価種類区分が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "tanka_shurui_kbns",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","koumokumei","uriage_flg","shiire_flg","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($tanka_shurui_kbn->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "tanka_shurui_kbns",
                "action" => "edit",
                "params" => array($tanka_shurui_kbn->id)
            ));

            return;
        }

        $this->_bakOut($tanka_shurui_kbn);

        foreach ($post_flds as $post_fld) {
            $tanka_shurui_kbn->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$tanka_shurui_kbn->save()) {

            foreach ($tanka_shurui_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tanka_shurui_kbns",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("単価種類区分の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "tanka_shurui_kbns",
            'action' => 'edit',
            'params' => array($tanka_shurui_kbn->id)
        ));
    }

    /**
     * Deletes a tanka_shurui_kbn
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $tanka_shurui_kbn = TankaShuruiKbns::findFirstByid($id);
        if (!$tanka_shurui_kbn) {
            $this->flash->error("単価種類区分が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "tanka_shurui_kbns",
                'action' => 'index'
            ));

            return;
        }

        if (!$tanka_shurui_kbn->delete()) {

            foreach ($tanka_shurui_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "tanka_shurui_kbns",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($tanka_shurui_kbn, 1);

        $this->flash->success("単価種類区分の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "tanka_shurui_kbns",
            'action' => "index"
        ));
    }

    /**
     * Back Out a tanka_shurui_kbn
     *
     * @param string $tanka_shurui_kbn, $dlt_flg
     */
    public function _bakOut($tanka_shurui_kbn, $dlt_flg = 0)
    {

        $bak_tanka_shurui_kbn = new BakTankaShuruiKbns();
        foreach ($tanka_shurui_kbn as $fld => $value) {
            $bak_tanka_shurui_kbn->$fld = $tanka_shurui_kbn->$fld;
        }
        $bak_tanka_shurui_kbn->id = NULL;
        $bak_tanka_shurui_kbn->id_moto = $tanka_shurui_kbn->id;
        $bak_tanka_shurui_kbn->hikae_dltflg = $dlt_flg;
        $bak_tanka_shurui_kbn->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_tanka_shurui_kbn->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_tanka_shurui_kbn->save()) {
            foreach ($bak_tanka_shurui_kbn->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

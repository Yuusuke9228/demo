<?php
 


class HCalendarPatanDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HCalendarPatanDts", "カレンダーパタン"); //簡易検索付き一覧表示
    }

    /**
     * Searches for h_calendar_patan_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HCalendarPatanDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $h_calendar_patan_dt = $nameDts::findFirstByid($id);
            if (!$h_calendar_patan_dt) {
                $this->flash->error("カレンダーパタンが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_calendar_patan_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($h_calendar_patan_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "h_calendar_patan_dts", "HCalendarPatanDts", "カレンダーパタン");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "h_calendar_patan_dts", "HCalendarPatanDts", "カレンダーパタン");
    }

    /**
     * Edits a h_calendar_patan_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $h_calendar_patan_dt = HCalendarPatanDts::findFirstByid($id);
            if (!$h_calendar_patan_dt) {
                $this->flash->error("カレンダーパタンが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_calendar_patan_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $h_calendar_patan_dt->id;

            $this->_setDefault($h_calendar_patan_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($h_calendar_patan_dt, $action="edit", $meisai="HCalendarPatanDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "bikou",
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
            if (property_exists($h_calendar_patan_dt, $setdt)) {
                $this->tag->setDefault($setdt, $h_calendar_patan_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new h_calendar_patan_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_calendar_patan_dts",
                'action' => 'index'
            ));

            return;
        }

        $h_calendar_patan_dt = new HCalendarPatanDts();

        $post_flds = ["cd",
            "name",
            "bikou",
            "updated",
            ];
        

        foreach ($post_flds as $post_fld) {
            $h_calendar_patan_dt->$post_fld = $this->request->getPost($post_fld);
        }

        if (!$h_calendar_patan_dt->save()) {
            foreach ($h_calendar_patan_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_patan_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("カレンダーパタンの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_calendar_patan_dts",
            'action' => 'edit',
            'params' => array($h_calendar_patan_dt->id)
        ));
    }

    /**
     * Saves a h_calendar_patan_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_calendar_patan_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $h_calendar_patan_dt = HCalendarPatanDts::findFirstByid($id);

        if (!$h_calendar_patan_dt) {
            $this->flash->error("カレンダーパタンが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_patan_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($h_calendar_patan_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからカレンダーパタンが変更されたため更新を中止しました。"
                . $id . ",uid=" . $h_calendar_patan_dt->kousin_user_id . " tb=" . $h_calendar_patan_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_patan_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "bikou",
            "updated",
            ];
        

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($this->request->getPost($post_fld) !== $h_calendar_patan_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "h_calendar_patan_dts",
                "action" => "edit",
                "params" => array($h_calendar_patan_dt->id)
            ));

            return;
        }

        $this->_bakOut($h_calendar_patan_dt, 0);

        foreach ($post_flds as $post_fld) {
            $h_calendar_patan_dt->$post_fld = $this->request->getPost($post_fld);
        }

        if (!$h_calendar_patan_dt->save()) {

            foreach ($h_calendar_patan_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_patan_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("カレンダーパタンの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_calendar_patan_dts",
            'action' => 'edit',
            'params' => array($h_calendar_patan_dt->id)
        ));
    }

    /**
     * Deletes a h_calendar_patan_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $h_calendar_patan_dt = HCalendarPatanDts::findFirstByid($id);
        if (!$h_calendar_patan_dt) {
            $this->flash->error("カレンダーパタンが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_patan_dts",
                'action' => 'index'
            ));

            return;
        }

        if (!$h_calendar_patan_dt->delete()) {

            foreach ($h_calendar_patan_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_patan_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($h_calendar_patan_dt, 1);

        $this->flash->success("カレンダーパタンの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_calendar_patan_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a h_calendar_patan_dt
     *
     * @param string $h_calendar_patan_dt, $dlt_flg
     */
    public function _bakOut($h_calendar_patan_dt, $dlt_flg = 0)
    {

        $bak_h_calendar_patan_dt = new BakHCalendarPatanDts();
        foreach ($h_calendar_patan_dt as $fld => $value) {
            $bak_h_calendar_patan_dt->$fld = $h_calendar_patan_dt->$fld;
        }
        $bak_h_calendar_patan_dt->id = NULL;
        $bak_h_calendar_patan_dt->id_moto = $h_calendar_patan_dt->id;
        $bak_h_calendar_patan_dt->hikae_dltflg = $dlt_flg;
        $bak_h_calendar_patan_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_h_calendar_patan_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_h_calendar_patan_dt->save()) {
            foreach ($bak_h_calendar_patan_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

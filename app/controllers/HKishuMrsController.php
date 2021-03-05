<?php
 


class HKishuMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HKishuMrs", "機種マスタ"); //簡易検索付き一覧表示
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
        ControllerBase::indexCd("HKishuMrs", "機種マスタ");
    }

    /**
     * Searches for h_kishu_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HKishuMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $h_kishu_mr = $nameDts::findFirstByid($id);
            if (!$h_kishu_mr) {
                $this->flash->error("機種マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_kishu_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($h_kishu_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "h_kishu_mrs", "HKishuMrs", "機種マスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "h_kishu_mrs", "HKishuMrs", "機種マスタ");
    }

    /**
     * Edits a h_kishu_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $h_kishu_mr = HKishuMrs::findFirstByid($id);
            if (!$h_kishu_mr) {
                $this->flash->error("機種マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_kishu_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $h_kishu_mr->id;

            $this->_setDefault($h_kishu_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($h_kishu_mr, $action="edit", $meisai="HKishuMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "h_kouteimei_mr_cd",
            "daisuu",
            "sou_suisuu",
            "kaitensuu",
            "kadouritu",
            "kadouhun_aday",
            "seisansei",
            "max_haba",
            "max_kei",
            "max_makiryou",
            "max_yorisuu",
            "ryakushou",
            "bikou",
            "h_calendar_patan_dt_cd",
            "irowake",
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
            if (property_exists($h_kishu_mr, $setdt)) {
                $this->tag->setDefault($setdt, $h_kishu_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new h_kishu_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_kishu_mrs",
                'action' => 'index'
            ));

            return;
        }

        $h_kishu_mr = new HKishuMrs();

        $post_flds = ["cd",
            "name",
            "h_kouteimei_mr_cd",
            "daisuu",
            "sou_suisuu",
            "kaitensuu",
            "kadouritu",
            "kadouhun_aday",
            "seisansei",
            "max_haba",
            "max_kei",
            "max_makiryou",
            "max_yorisuu",
            "ryakushou",
            "bikou",
            "h_calendar_patan_dt_cd",
            "irowake",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $h_kishu_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_kishu_mr->save()) {
            foreach ($h_kishu_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_kishu_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("機種マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_kishu_mrs",
            'action' => 'edit',
            'params' => array($h_kishu_mr->id)
        ));
    }

    /**
     * Saves a h_kishu_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_kishu_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $h_kishu_mr = HKishuMrs::findFirstByid($id);

        if (!$h_kishu_mr) {
            $this->flash->error("機種マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "h_kishu_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($h_kishu_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから機種マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $h_kishu_mr->kousin_user_id . " tb=" . $h_kishu_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "h_kishu_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = ["cd",
            "name",
            "h_kouteimei_mr_cd",
            "daisuu",
            "sou_suisuu",
            "kaitensuu",
            "kadouritu",
            "kadouhun_aday",
            "seisansei",
            "max_haba",
            "max_kei",
            "max_makiryou",
            "max_yorisuu",
            "ryakushou",
            "bikou",
            "h_calendar_patan_dt_cd",
            "irowake",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $h_kishu_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "h_kishu_mrs",
                "action" => "edit",
                "params" => array($h_kishu_mr->id)
            ));

            return;
        }

        $this->_bakOut($h_kishu_mr, 0);

        foreach ($post_flds as $post_fld) {
            $h_kishu_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_kishu_mr->save()) {

            foreach ($h_kishu_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_kishu_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("機種マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_kishu_mrs",
            'action' => 'edit',
            'params' => array($h_kishu_mr->id)
        ));
    }

    /**
     * Deletes a h_kishu_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $h_kishu_mr = HKishuMrs::findFirstByid($id);
        if (!$h_kishu_mr) {
            $this->flash->error("機種マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "h_kishu_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$h_kishu_mr->delete()) {

            foreach ($h_kishu_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_kishu_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($h_kishu_mr, 1);

        $this->flash->success("機種マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_kishu_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a h_kishu_mr
     *
     * @param string $h_kishu_mr, $dlt_flg
     */
    public function _bakOut($h_kishu_mr, $dlt_flg = 0)
    {

        $bak_h_kishu_mr = new BakHKishuMrs();
        foreach ($h_kishu_mr as $fld => $value) {
            $bak_h_kishu_mr->$fld = $h_kishu_mr->$fld;
        }
        $bak_h_kishu_mr->id = NULL;
        $bak_h_kishu_mr->id_moto = $h_kishu_mr->id;
        $bak_h_kishu_mr->hikae_dltflg = $dlt_flg;
        $bak_h_kishu_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_h_kishu_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_h_kishu_mr->save()) {
            foreach ($bak_h_kishu_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

	public function ajaxGetAction()
	{
	    $this->view->disable();

	    //Create a response instance
	    $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        //    return;
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        //    return;
        }

	    $h_kishu_mrs = HKishuMrs::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'cd',
	        'conditions' => ' cd LIKE ?1 ',
	        'bind' => array(1 => $this->request->getPost('cd').'%')
	    ));
        $res_flds = [
        	"id",
        	"cd",
        	"name",
        	"h_kouteimei_mr_cd",
        	"daisuu",
        	"sou_suisuu",
        	"kaitensuu",
        	"kadouritu",
        	"kadouhun_aday",
        	"max_haba",
        	"max_kei",
        	"max_makiryou",
        	"max_yorisuu",
        	"ryakushou",
        	"bikou",
            "h_calendar_patan_dt_cd",
            "irowake",
        ];
	    $resData = array();
	    foreach ($h_kishu_mrs as $h_kishu_mr) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $h_kishu_mr->$res_fld;
	        }
	        $resData[] = $resAdata;
	    }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}

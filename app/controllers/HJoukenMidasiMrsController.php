<?php
 


class HJoukenMidasiMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HJoukenMidasiMrs", "条件見出しマスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for h_jouken_midasi_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HJoukenMidasiMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $h_jouken_midasi_mr = $nameDts::findFirstByid($id);
            if (!$h_jouken_midasi_mr) {
                $this->flash->error("条件見出しマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_jouken_midasi_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($h_jouken_midasi_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "h_jouken_midasi_mrs", "HJoukenMidasiMrs", "条件見出しマスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "h_jouken_midasi_mrs", "HJoukenMidasiMrs", "条件見出しマスタ");
    }

    /**
     * Edits a h_jouken_midasi_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $h_jouken_midasi_mr = HJoukenMidasiMrs::findFirstByid($id);
            if (!$h_jouken_midasi_mr) {
                $this->flash->error("条件見出しマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_jouken_midasi_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $h_jouken_midasi_mr->id;

            $this->_setDefault($h_jouken_midasi_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($h_jouken_midasi_mr, $action="edit", $meisai="HJoukenMidasiMrs")
    {
        $setdts = ["id",
            "h_kouteimei_mr_cd",
            "cd",
            "name",
            "tanni_mr_cd",
            "retu",
            "gyou",
            "val_type",
            "seisuuketa",
            "shousuuketa",
            "h_jouken_kouho_mr_cd",
            "yuuikey",
            "jikan_keisan",
            "jikan_keisan_jun",
            "sagyou_keisan",
            "sagyou_keisan_jun",
            "koutin_keisan",
            "koutin_keisan_jun",
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
            if (property_exists($h_jouken_midasi_mr, $setdt)) {
                $this->tag->setDefault($setdt, $h_jouken_midasi_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new h_jouken_midasi_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_jouken_midasi_mrs",
                'action' => 'index'
            ));

            return;
        }

        $h_jouken_midasi_mr = new HJoukenMidasiMrs();

        $post_flds = ["h_kouteimei_mr_cd",
            "cd",
            "name",
            "tanni_mr_cd",
            "retu",
            "gyou",
            "val_type",
            "seisuuketa",
            "shousuuketa",
            "h_jouken_kouho_mr_cd",
            "yuuikey",
            "jikan_keisan",
            "jikan_keisan_jun",
            "sagyou_keisan",
            "sagyou_keisan_jun",
            "koutin_keisan",
            "koutin_keisan_jun",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $h_jouken_midasi_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_jouken_midasi_mr->save()) {
            foreach ($h_jouken_midasi_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_midasi_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("条件見出しマスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_jouken_midasi_mrs",
            'action' => 'edit',
            'params' => array($h_jouken_midasi_mr->id)
        ));
    }

    /**
     * Saves a h_jouken_midasi_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_jouken_midasi_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $h_jouken_midasi_mr = HJoukenMidasiMrs::findFirstByid($id);

        if (!$h_jouken_midasi_mr) {
            $this->flash->error("条件見出しマスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_midasi_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($h_jouken_midasi_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから条件見出しマスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $h_jouken_midasi_mr->kousin_user_id . " tb=" . $h_jouken_midasi_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_midasi_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = ["h_kouteimei_mr_cd",
            "cd",
            "name",
            "tanni_mr_cd",
            "retu",
            "gyou",
            "val_type",
            "seisuuketa",
            "shousuuketa",
            "h_jouken_kouho_mr_cd",
            "yuuikey",
            "jikan_keisan",
            "jikan_keisan_jun",
            "sagyou_keisan",
            "sagyou_keisan_jun",
            "koutin_keisan",
            "koutin_keisan_jun",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $h_jouken_midasi_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "h_jouken_midasi_mrs",
                "action" => "edit",
                "params" => array($h_jouken_midasi_mr->id)
            ));

            return;
        }

        $this->_bakOut($h_jouken_midasi_mr, 0);

        foreach ($post_flds as $post_fld) {
            $h_jouken_midasi_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_jouken_midasi_mr->save()) {

            foreach ($h_jouken_midasi_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_midasi_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("条件見出しマスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_jouken_midasi_mrs",
            'action' => 'edit',
            'params' => array($h_jouken_midasi_mr->id)
        ));
    }

    /**
     * Deletes a h_jouken_midasi_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $h_jouken_midasi_mr = HJoukenMidasiMrs::findFirstByid($id);
        if (!$h_jouken_midasi_mr) {
            $this->flash->error("条件見出しマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_midasi_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$h_jouken_midasi_mr->delete()) {

            foreach ($h_jouken_midasi_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_jouken_midasi_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($h_jouken_midasi_mr, 1);

        $this->flash->success("条件見出しマスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_jouken_midasi_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a h_jouken_midasi_mr
     *
     * @param string $h_jouken_midasi_mr, $dlt_flg
     */
    public function _bakOut($h_jouken_midasi_mr, $dlt_flg = 0)
    {

        $bak_h_jouken_midasi_mr = new BakHJoukenMidasiMrs();
        foreach ($h_jouken_midasi_mr as $fld => $value) {
            $bak_h_jouken_midasi_mr->$fld = $h_jouken_midasi_mr->$fld;
        }
        $bak_h_jouken_midasi_mr->id = NULL;
        $bak_h_jouken_midasi_mr->id_moto = $h_jouken_midasi_mr->id;
        $bak_h_jouken_midasi_mr->hikae_dltflg = $dlt_flg;
        $bak_h_jouken_midasi_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_h_jouken_midasi_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_h_jouken_midasi_mr->save()) {
            foreach ($bak_h_jouken_midasi_mr->getMessages() as $message) {
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
        $res_fld0s = [
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
        ];
	    $resData0 = array();
	    foreach ($h_kishu_mrs as $h_kishu_mr) {
	        $resAdata = array();
	        foreach ($res_fld0s as $res_fld0) {
	            $resAdata[$res_fld0] = $h_kishu_mr->$res_fld0;
	        }
	        $resAdata['h_kouteimei_mr_name'] = $h_kishu_mr->HKouteimeiMrs->name;
	        $resData0[] = $resAdata;
	    }

	    $h_jouken_midasi_mrs = HJoukenMidasiMrs::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'retu, gyou',
	        'conditions' => ' h_kouteimei_mr_cd IN ("", ?1, ?2)',
	        'bind' => [1 => $h_kishu_mrs[0]->h_kouteimei_mr_cd, 2 => $h_kishu_mrs[0]->cd],
	    ));
        $res_flds = [
            "id",
            "h_kouteimei_mr_cd",
            "cd",
            "name",
            "tanni_mr_cd",
            "retu",
            "gyou",
            "val_type",
            "seisuuketa",
            "shousuuketa",
            "h_jouken_kouho_mr_cd",
            "yuuikey",
        ];
	    $resData = array();
	    foreach ($h_jouken_midasi_mrs as $h_jouken_midasi_mr) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $h_jouken_midasi_mr->$res_fld;
	        }
	        $resBdata = array();
	        foreach ($h_jouken_midasi_mr->HJoukenKouhoMrs as $h_jouken_kouho_mr) {
	            $resBdata[$h_jouken_kouho_mr->jouken] = $h_jouken_kouho_mr->name;
	        }
	        $resAdata['kouho'] = $resBdata;
	        $resData[] = $resAdata;
	    }
	    $resData0[0][midasi] = $resData;

	    //Set the content of the response
	    $response->setContent(json_encode($resData0));

	    //Return the response
	    return $response;
	}

}

<?php
 


class HShouhinJoukenMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("HShouhinJoukenMrs", "商品条件マスタ", 'shouhin_mr_cd'); //簡易検索付き一覧表示
    }

    /**
     * Searches for h_shouhin_jouken_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form 初期生成
     */
    public function new0Action($id=null, $dataname="HShouhinJoukenMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $h_shouhin_jouken_mr = $nameDts::findFirstByid($id);
            if (!$h_shouhin_jouken_mr) {
                $this->flash->error("商品条件マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_shouhin_jouken_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($h_shouhin_jouken_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * Displays the creation form 運用新規画面
     */
    public function newAction()
    {
    	if($this->request->isGet()){ //リクエストがgetのときの処理
			$shouhin_mr_cd = $this->request->getQuery("shouhin");
			$h_kishu_mr_cd = $this->request->getQuery("kishu");
		}

        $this->view->imax = 0;
        $this->view->id = 0;

        if ($shouhin_mr_cd) {
            $this->tag->setDefault('shouhin_mr_cd', $shouhin_mr_cd);
        }
        if ($h_kishu_mr_cd) {
            $this->tag->setDefault('h_kishu_mr_cd', $h_kishu_mr_cd);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        if ($id) {
            ControllerBase::nextCd($id, "h_shouhin_jouken_mrs", "HShouhinJoukenMrs", "商品条件マスタ");
        } else {
            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'index'
            ));
        }
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        if ($id) {
            ControllerBase::prevCd($id, "h_shouhin_jouken_mrs", "HShouhinJoukenMrs", "商品条件マスタ");
        } else {
            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'index'
            ));
        }
    }

    /**
     * Edits a h_shouhin_jouken_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $h_shouhin_jouken_mr = HShouhinJoukenMrs::findFirstByid($id);
            if (!$h_shouhin_jouken_mr) {
                $this->flash->error("商品条件マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_shouhin_jouken_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $h_shouhin_jouken_mr->id;

            $this->_setDefault($h_shouhin_jouken_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($h_shouhin_jouken_mr, $action="edit", $meisai="HShouhinJoukenMrs")
    {
        $setdts = ["id",
            "shouhin_mr_cd",
            "h_kishu_mr_cd",
            "h_jouken_midasi_mr_id",
            "jouken",
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
            if (property_exists($h_shouhin_jouken_mr, $setdt)) {
                $this->tag->setDefault($setdt, $h_shouhin_jouken_mr->$setdt);
            }
        }
    }

    /**
     * Saves a h_shouhin_jouken_mr edited 運用更新処理
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'index'
            ));

            return;
        }

        $shouhin_mr_cd = $this->request->getPost('shouhin_mr_cd');
        $h_kishu_mr_cd = $this->request->getPost('h_kishu_mr_cd');
        $updated = $this->request->getPost('updated');
        $now_updated = HShouhinJoukenMrs::maximum([
            'column' => 'updated',
            'conditions' => 'shouhin_mr_cd = ?1 AND h_kishu_mr_cd = ?2',
            'bind' => [1 => $shouhin_mr_cd, 2 => $h_kishu_mr_cd],
        ]);
        if ($now_updated > $updated) {
            $this->flash->error("他のプロセスから商品生産条件が修正されたので中止しました。" . $now_updated . " > " . $updated);

            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'new',
                'params' => array($shouhin_mr_cd, $h_kishu_mr_cd)
            ));

            return;
        }
        $ary_getPosts = $this->request->getPost();
        $error_cnt = 0;
        $add_cnt = 0;
        $upd_cnt = 0;
        foreach ($ary_getPosts as $post_fld=>$post_data) {
            if (substr($post_fld,0,3)=='id_') {
                $h_jouken_midasi_mr_id = intval(substr($post_fld,3));
                $h_shouhin_jouken_mr = HShouhinJoukenMrs::findFirst([
                    'conditions' => 'shouhin_mr_cd = ?1 AND h_kishu_mr_cd = ?2 AND h_jouken_midasi_mr_id = ?3',
                    'bind'=>[1 => $shouhin_mr_cd, 2 => $h_kishu_mr_cd, 3 => $h_jouken_midasi_mr_id],
                ]);
                if (!$h_shouhin_jouken_mr) { // 新規
                    $h_shouhin_jouken_mr = new HShouhinJoukenMrs();
                    $h_shouhin_jouken_mr->shouhin_mr_cd = $shouhin_mr_cd;
                    $h_shouhin_jouken_mr->h_kishu_mr_cd = $h_kishu_mr_cd;
                    $h_shouhin_jouken_mr->h_jouken_midasi_mr_id = $h_jouken_midasi_mr_id;
                    $h_shouhin_jouken_mr->jouken = rtrim($post_data);
                    if (!$h_shouhin_jouken_mr->save()) {
                        foreach ($h_shouhin_jouken_mr->getMessages() as $message) {
                            $this->flash->error($message);
                            $error_cnt++;
                        }
                    } else {
                        $add_cnt++;
                    }
                } else { // 更新
                    if ($h_shouhin_jouken_mr->jouken !== rtrim($post_data)) {
                        $h_shouhin_jouken_mr->jouken = rtrim($post_data);
                        if (!$h_shouhin_jouken_mr->save()) {
                            foreach ($h_shouhin_jouken_mr->getMessages() as $message) {
                                $this->flash->error($message);
                                $error_cnt++;
                            }
                        } else {
                            $upd_cnt++;
                        }
                    }
                }
            }
        }

        if ($error_cnt == 0) {
            if ($add_cnt == 0 && $upd_cnt == 0) {
                $this->flash->warning("変更がありません。");
            } else {
                $this->flash->success("商品生産条件の格納が完了しました。追加=".$add_cnt.",更新=".$upd_cnt);
            }
        } else {
            $this->flash->error("商品生産条件の格納中にエラーしました。失敗数=".$error_cnt.",追加=".$add_cnt.",更新=".$upd_cnt);
        }

        $this->dispatcher->forward(array(
            'controller' => "h_shouhin_jouken_mrs",
            'action' => 'new',
            'params' => array($shouhin_mr_cd, $h_kishu_mr_cd)
        ));
    }

    /**
     * Creates a new h_shouhin_jouken_mr 初期生成
     */
    public function create0Action()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'index'
            ));

            return;
        }

        $h_shouhin_jouken_mr = new HShouhinJoukenMrs();

        $post_flds = ["shouhin_mr_cd",
            "h_kishu_mr_cd",
            "h_jouken_midasi_mr_id",
            "jouken",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $h_shouhin_jouken_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_shouhin_jouken_mr->save()) {
            foreach ($h_shouhin_jouken_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("商品条件マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_shouhin_jouken_mrs",
            'action' => 'edit',
            'params' => array($h_shouhin_jouken_mr->id)
        ));
    }

    /**
     * Saves a h_shouhin_jouken_mr edited 初期生成
     *
     */
    public function save0Action()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $h_shouhin_jouken_mr = HShouhinJoukenMrs::findFirstByid($id);

        if (!$h_shouhin_jouken_mr) {
            $this->flash->error("商品条件マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($h_shouhin_jouken_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから商品条件マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $h_shouhin_jouken_mr->kousin_user_id . " tb=" . $h_shouhin_jouken_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = ["shouhin_mr_cd",
            "h_kishu_mr_cd",
            "h_jouken_midasi_mr_id",
            "jouken",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $h_shouhin_jouken_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "h_shouhin_jouken_mrs",
                "action" => "edit",
                "params" => array($h_shouhin_jouken_mr->id)
            ));

            return;
        }

        $this->_bakOut($h_shouhin_jouken_mr, 0);

        foreach ($post_flds as $post_fld) {
            $h_shouhin_jouken_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$h_shouhin_jouken_mr->save()) {

            foreach ($h_shouhin_jouken_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("商品条件マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_shouhin_jouken_mrs",
            'action' => 'edit',
            'params' => array($h_shouhin_jouken_mr->id)
        ));
    }

    /**
     * Deletes a h_shouhin_jouken_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $h_shouhin_jouken_mr = HShouhinJoukenMrs::findFirstByid($id);
        if (!$h_shouhin_jouken_mr) {
            $this->flash->error("商品条件マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$h_shouhin_jouken_mr->delete()) {

            foreach ($h_shouhin_jouken_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_shouhin_jouken_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($h_shouhin_jouken_mr, 1);

        $this->flash->success("商品条件マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_shouhin_jouken_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a h_shouhin_jouken_mr
     *
     * @param string $h_shouhin_jouken_mr, $dlt_flg
     */
    public function _bakOut($h_shouhin_jouken_mr, $dlt_flg = 0)
    {

        $bak_h_shouhin_jouken_mr = new BakHShouhinJoukenMrs();
        foreach ($h_shouhin_jouken_mr as $fld => $value) {
            $bak_h_shouhin_jouken_mr->$fld = $h_shouhin_jouken_mr->$fld;
        }
        $bak_h_shouhin_jouken_mr->id = NULL;
        $bak_h_shouhin_jouken_mr->id_moto = $h_shouhin_jouken_mr->id;
        $bak_h_shouhin_jouken_mr->hikae_dltflg = $dlt_flg;
        $bak_h_shouhin_jouken_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_h_shouhin_jouken_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_h_shouhin_jouken_mr->save()) {
            foreach ($bak_h_shouhin_jouken_mr->getMessages() as $message) {
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

        $shouhin_mr_cd = $this->request->getPost('shouhin_mr_cd');
        $h_kishu_mr_cd = $this->request->getPost('h_kishu_mr_cd');
        $h_kouteimei_mr_cd = '';

        if ($shouhin_mr_cd != '' && $h_kishu_mr_cd == '') {
            $h_shouhin_jouken_mrs = HShouhinJoukenMrs::findFirst([
                'order' => 'jouken',
                'conditions' => 'shouhin_mr_cd = ?1 AND h_jouken_midasi_mr_id = 1',
                'bind' => [1 => $shouhin_mr_cd],
            ]);
            if ($h_shouhin_jouken_mrs) {
                $h_kishu_mr_cd = $h_shouhin_jouken_mrs->h_kishu_mr_cd;
            }
        }

	    $h_kishu_mrs = HKishuMrs::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'cd',
	        'conditions' => ' cd LIKE ?1 ',
	        'bind' => array(1 => $h_kishu_mr_cd.'%')
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
	    if ($h_kishu_mrs) {
	    	$h_kouteimei_mr_cd = $h_kishu_mrs[0]->h_kouteimei_mr_cd;
	   	}

//	    $h_jouken_midasi_mrs = HJoukenMidasiMrs::find(array(
//	        'columns' => array('cd, name'), 全項目とする
//	        'order' => 'retu, gyou',
//	        'conditions' => ' h_kouteimei_mr_cd IN ("", ?1, ?2)',
//	        'bind' => [1 => $h_kishu_mrs[0]->h_kouteimei_mr_cd, 2 => $h_kishu_mrs[0]->cd],
//	    ));
        $h_jouken_midasi_mrs = HJoukenMidasiMrs::query()
            ->leftJoin('HShouhinJoukenMrs', 'b.h_jouken_midasi_mr_id = HJoukenMidasiMrs.id AND b.h_kishu_mr_cd = ?2 AND b.shouhin_mr_cd = ?3', 'b')
            ->leftJoin('Users', 'c.id = b.sakusei_user_id', 'c')
            ->leftJoin('Users', 'd.id = b.kousin_user_id', 'd')
            ->where('h_kouteimei_mr_cd IN ("", ?1, ?2)',
             [1 => $h_kouteimei_mr_cd, 2 => $h_kishu_mr_cd, 3 => $shouhin_mr_cd])
            ->orderBy('retu, gyou')
            ->columns([
            "HJoukenMidasiMrs.id",
            "HJoukenMidasiMrs.h_kouteimei_mr_cd",
            "HJoukenMidasiMrs.cd",
            "HJoukenMidasiMrs.name",
            "HJoukenMidasiMrs.tanni_mr_cd",
            "HJoukenMidasiMrs.retu",
            "HJoukenMidasiMrs.gyou",
            "HJoukenMidasiMrs.val_type",
            "HJoukenMidasiMrs.seisuuketa",
            "HJoukenMidasiMrs.shousuuketa",
            "HJoukenMidasiMrs.h_jouken_kouho_mr_cd",
            "b.jouken",
            "c.name sakusei_user_name",
            "b.created",
            "d.name kousin_user_name",
            "b.updated",
            ])
            ->execute();
	   // return json_encode($h_jouken_midasi_mrs);


        $res_a = 'HJoukenMidasiMrs';
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
            "jouken",
            "created",
        ];
	    $resData = array();

        $sakusei_user_name = '';
        $created = '0000-00-00';
        $kousin_user_name = '';
        $updated = '0000-00-00';
	    foreach ($h_jouken_midasi_mrs as $h_jouken_midasi_mr) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $h_jouken_midasi_mr->$res_fld;
	        }
	        $resBdata = array();
	        if ($h_jouken_midasi_mr->h_jouken_kouho_mr_cd) {
			    $h_jouken_kouho_mrs = HJoukenKouhoMrs::find(array(
			        'order' => 'jouken',
			        'conditions' => 'cd = ?1',
			        'bind' => array(1 => $h_jouken_midasi_mr->h_jouken_kouho_mr_cd)
			    ));
		        foreach ($h_jouken_kouho_mrs as $h_jouken_kouho_mr) {
		            $resBdata[$h_jouken_kouho_mr->jouken] = $h_jouken_kouho_mr->name;
		        }
	        }
	        $resAdata['kouho'] = $resBdata;
            if (!is_null($h_jouken_midasi_mr->created)) {
                if ($created == '0000-00-00' || $h_jouken_midasi_mr->created < $created) {
                    $created = $h_jouken_midasi_mr->created;
                    $sakusei_user_name = $h_jouken_midasi_mr->sakusei_user_name;
                }
                if ($updated == '0000-00-00' || $h_jouken_midasi_mr->updated > $updated) {
                    $updated = $h_jouken_midasi_mr->updated;
                    $kousin_user_name = $h_jouken_midasi_mr->kousin_user_name;
                }
            }
	        $resData[] = $resAdata;
	    }

	    $resData0[0]['midasi'] = $resData;
	    $resData0[0]['sakusei_user_name'] = $sakusei_user_name;
	    $resData0[0]['created'] = $created;
	    $resData0[0]['kousin_user_name'] = $kousin_user_name;
	    $resData0[0]['updated'] = $updated;
	    $resData0[0]['h_kouteimei_mr_cd1'] = $h_kouteimei_mr_cd;
	    $resData0[0]['h_kishu_mr_cd'] = $h_kishu_mr_cd;
	    $resData0[0]['shouhin_mr_cd'] = $shouhin_mr_cd;

	    //Set the content of the response
	    $response->setContent(json_encode($resData0));

	    //Return the response
	    return $response;
	}

	public function ajaxKishuAction()
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

        $ary_shouhin_mr_cd = $this->request->getPost('ary_shouhin_mr_cd');

	    $resData = array();

	    foreach ($ary_shouhin_mr_cd as $shouhin_mr_cd) {
	        $resAData = array();
		    $resAData['shouhin_kakou_cd'] = '';
	    	$shouhin_mrs = ShouhinMrs::findFirst([
		        'conditions' => 'cd = ?1',
		        'bind' => [1 => $shouhin_mr_cd],
		    ]);
		    foreach ($shouhin_mrs->KouseiBuhinMrs as $kousei_buhin_mr) {
		    	if ($kousei_buhin_mr->GenShouhinMrs->zaikokanri != '1' &&
		    		$kousei_buhin_mr->GenShouhinMrs->shouhin_bunrui1_cd != 'E') {
		    		$resAData['shouhin_kakou_cd'] = $kousei_buhin_mr->gen_shouhin_mr_cd;
		    	}
		    }
		    $h_shouhin_jouken_mrs = HShouhinJoukenMrs::find([
		        'conditions' => 'shouhin_mr_cd = ?1 AND h_jouken_midasi_mr_id = 1', // 1=優先順位
		        'bind' => [1 => $resAData['shouhin_kakou_cd']],
		        'order' => 'jouken', // 優先順
		    ]);
	        $resBData = [];
	        foreach ($h_shouhin_jouken_mrs as $h_shouhin_jouken_mr) {
	        	$resCData = [];
	            $resCData['junni'] = $h_shouhin_jouken_mr->jouken;
	            $resCData['h_kishu_mr_cd'] = $h_shouhin_jouken_mr->h_kishu_mr_cd;
	            $resCData['h_kishu_mr_name'] = $h_shouhin_jouken_mr->HKishuMrs->name;
	            $resCData['h_kishu_mr_irowake'] = $h_shouhin_jouken_mr->HKishuMrs->irowake;
	            $resCData['h_kishu_mr_suisuu'] = round($h_shouhin_jouken_mr->HKishuMrs->sou_suisuu / $h_shouhin_jouken_mr->HKishuMrs->daisuu);
	            $resBData[] = $resCData;
	        }
	        if (count($resBData) > 0) {
                $resBData[0]['kouritu'] = '';
                $resBData[0]['kouritu_tanni'] = '';
                $h_jouken_midasi_mrs = HShouhinJoukenMrs::query()
                    ->leftJoin('HJoukenMidasiMrs', 'HShouhinJoukenMrs.h_jouken_midasi_mr_id = b.id', 'b')
                    ->where('HShouhinJoukenMrs.shouhin_mr_cd = ?1 AND HShouhinJoukenMrs.h_kishu_mr_cd = ?2 AND b.yuuikey = "kouritu"',
                        [1 => $resAData['shouhin_kakou_cd'], 2 => $resBData[0]['h_kishu_mr_cd']])
                    ->columns([
                        "HShouhinJoukenMrs.jouken",
                        "b.tanni_mr_cd",
                    ])
                    ->execute();
                $resBData[0]['kouritu'] = count($h_jouken_midasi_mrs);
                foreach ($h_jouken_midasi_mrs as $h_jouken_midasi_mr) {
                    $resBData[0]['kouritu'] = $h_jouken_midasi_mr->jouken;
                    $resBData[0]['kouritu_tanni'] = $h_jouken_midasi_mr->tanni_mr_cd;
                }
            }
            $resAData['junni'] = $resBData;
	        $resData[] = $resAData;
	    }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}

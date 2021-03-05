<?php
 


class KakouIraiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("KakouIraiDts", "加工依頼書用データ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for kakou_irai_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="KakouIraiDts")
    {
                $this->dispatcher->forward(array(
                    'controller' => "kakou_irai_dts",
                    'action' => 'sheet',
                    'params' => [$id]
                ));
    }

    /**
     * Displays the creation form
     */
    public function new0Action($id=null, $dataname="KakouIraiDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $kakou_irai_dt = $nameDts::findFirstByid($id);
            if (!$kakou_irai_dt) {
                $this->flash->error("加工依頼書用データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_irai_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($kakou_irai_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "kakou_irai_dts", "KakouIraiDts", "加工依頼書用データ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "kakou_irai_dts", "KakouIraiDts", "加工依頼書用データ");
    }

    /**
     * Edits a kakou_irai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_dts",
                'action' => 'sheet',
                'params' => [$id]
            ));
    }

    /**
     * Edits a kakou_irai_dt
     *
     * @param string $id
     */
    public function edit0Action($id)
    {
//        if (!$this->request->isPost()) {

            $kakou_irai_dt = KakouIraiDts::findFirstByid($id);
            if (!$kakou_irai_dt) {
                $this->flash->error("加工依頼書用データが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "kakou_irai_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $kakou_irai_dt->id;

            $this->_setDefault($kakou_irai_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($kakou_irai_dt, $action="edit", $meisai="KakouIraiDts")
    {
        $setdts = ["id",
            "cd",
            "name",
            "hacchuu_dt_id",
            "gotantou",
            "keishou",
            "seisan_kanri_user_cd",
            "assistant_user_cd",
            "loss_ritu",
            "kibou_nouki",
            "kouki",
            "kakou_shu",
            "kishu",
            "yori_houkou",
            "yorisuu",
            "yori_tanni",
            "makiryou",
            "makiryou_tanni",
            "seimaki_mae",
            "seimaki_suu",
            "seimaki_tanni",
            "sikan_sitei",
            "set_umu",
            "set_ondo",
            "set_hun",
            "tail_kbn",
            "komaki_kbn",
            "tunagi_kbn",
            "youto",
            "case_kbn",
            "irihonsuu",
            "zansi_kbn",
            "shukka_kbn",
            "sonota1",
            "sonota2",
            "sonota3",
            "bikou_ka",
            "bikou_yor",
            "bikou_ma",
            "bikou_si",
            "bikou_se",
            "bikou_ta",
            "bikou_ko",
            "bikou_tu",
            "bikou_you",
            "bikou_ca",
            "bikou_za",
            "bikou_sh",
            "bikou_so1",
            "bikou_so2",
            "bikou_so3",
            "tokki",
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
            if (property_exists($kakou_irai_dt, $setdt)) {
                $this->tag->setDefault($setdt, $kakou_irai_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new kakou_irai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_dts",
                'action' => 'index'
            ));

            return;
        }

        $kakou_irai_dt = new KakouIraiDts();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "hacchuu_dt_id",
            "gotantou",
            "keishou",
            "seisan_kanri_user_cd",
            "assistant_user_cd",
            "loss_ritu",
            "kibou_nouki",
            "kouki",
            "kakou_shu",
            "kishu",
            "yori_houkou",
            "yorisuu",
            "yori_tanni",
            "makiryou",
            "makiryou_tanni",
            "seimaki_mae",
            "seimaki_suu",
            "seimaki_tanni",
            "sikan_sitei",
            "set_umu",
            "set_ondo",
            "set_hun",
            "tail_kbn",
            "komaki_kbn",
            "tunagi_kbn",
            "youto",
            "case_kbn",
            "irihonsuu",
            "zansi_kbn",
            "shukka_kbn",
            "sonota1",
            "sonota2",
            "sonota3",
            "bikou_ka",
            "bikou_yor",
            "bikou_ma",
            "bikou_si",
            "bikou_se",
            "bikou_ta",
            "bikou_ko",
            "bikou_tu",
            "bikou_you",
            "bikou_ca",
            "bikou_za",
            "bikou_sh",
            "bikou_so1",
            "bikou_so2",
            "bikou_so3",
            "tokki",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $kakou_irai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kakou_irai_dt->save()) {
            foreach ($kakou_irai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_dts",
                'action' => 'new0'
            ));

            return;
        }

        $this->flash->success("加工依頼書用データの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_irai_dts",
            'action' => 'edit0',
            'params' => array($kakou_irai_dt->id)
        ));
    }

    /**
     * Saves a kakou_irai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $kakou_irai_dt = KakouIraiDts::findFirstByid($id);

        if (!$kakou_irai_dt) {
            $this->flash->error("加工依頼書用データが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($kakou_irai_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから加工依頼書用データが変更されたため更新を中止しました。"
                . $id . ",uid=" . $kakou_irai_dt->kousin_user_id . " tb=" . $kakou_irai_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_dts",
                'action' => 'edit0',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "hacchuu_dt_id",
            "gotantou",
            "keishou",
            "seisan_kanri_user_cd",
            "assistant_user_cd",
            "loss_ritu",
            "kibou_nouki",
            "kouki",
            "kakou_shu",
            "kishu",
            "yori_houkou",
            "yorisuu",
            "yori_tanni",
            "makiryou",
            "makiryou_tanni",
            "seimaki_mae",
            "seimaki_suu",
            "seimaki_tanni",
            "sikan_sitei",
            "set_umu",
            "set_ondo",
            "set_hun",
            "tail_kbn",
            "komaki_kbn",
            "tunagi_kbn",
            "youto",
            "case_kbn",
            "irihonsuu",
            "zansi_kbn",
            "shukka_kbn",
            "sonota1",
            "sonota2",
            "sonota3",
            "bikou_ka",
            "bikou_yor",
            "bikou_ma",
            "bikou_si",
            "bikou_se",
            "bikou_ta",
            "bikou_ko",
            "bikou_tu",
            "bikou_you",
            "bikou_ca",
            "bikou_za",
            "bikou_sh",
            "bikou_so1",
            "bikou_so2",
            "bikou_so3",
            "tokki",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $kakou_irai_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "kakou_irai_dts",
                "action" => "edit0",
                "params" => array($kakou_irai_dt->id)
            ));

            return;
        }

        $this->_bakOut($kakou_irai_dt);

        foreach ($post_flds as $post_fld) {
            $kakou_irai_dt->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$kakou_irai_dt->save()) {

            foreach ($kakou_irai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("加工依頼書用データの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_irai_dts",
            'action' => 'edit',
            'params' => array($kakou_irai_dt->id)
        ));
    }

    /**
     * Deletes a kakou_irai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $kakou_irai_dt = KakouIraiDts::findFirstByid($id);
        if (!$kakou_irai_dt) {
            $this->flash->error("加工依頼書用データが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_dts",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($kakou_irai_dt, 1);

        if (!$kakou_irai_dt->delete()) {

            foreach ($kakou_irai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "kakou_irai_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("加工依頼書用データの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "kakou_irai_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a kakou_irai_dt
     *
     * @param string $kakou_irai_dt, $dlt_flg
     */
    public function _bakOut($kakou_irai_dt, $dlt_flg = 0)
    {

        $bak_kakou_irai_dt = new BakKakouIraiDts();
        foreach ($kakou_irai_dt as $fld => $value) {
            $bak_kakou_irai_dt->$fld = $kakou_irai_dt->$fld;
        }
        $bak_kakou_irai_dt->id = NULL;
        $bak_kakou_irai_dt->id_moto = $kakou_irai_dt->id;
        $bak_kakou_irai_dt->hikae_dltflg = $dlt_flg;
        $bak_kakou_irai_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_kakou_irai_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_kakou_irai_dt->save()) {
            foreach ($bak_kakou_irai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 登録画面を開く
     * データ読込表示は開いた後にajaxGetで実現する
     * 2018/4/5 井浦
     */
	public function sheetAction($id=null)
	{
		if ($id){
			$hacchuu_dt = HacchuuDts::findFirstByid($id);
			if ($hacchuu_dt){$this->tag->setDefault('cd', $hacchuu_dt->cd);}
		}
		$kakou_nagare_kbns = KakouNagareKbns::find(['order'=>'cd', 'conditions' => 'cd > 0']);
		$this->view->kakou_nagare_kbns = $kakou_nagare_kbns;
		$user_me = Users::findFirstByid((int)$this->getDI()->getSession()->get('auth')['id']);
		$this->view->user_me = $user_me;
	}

    /**
     * 登録画面から呼び出される
     * データー表示用
     * 2018/4/5 井浦
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

	    $hacchuu_dts = HacchuuDts::find(array(
	        'order' => 'cd, id DESC',
	        'conditions' => ' cd LIKE ?1 ',
	        'bind' => array(1 => $this->request->getPost('cd').'%'),
	        'limit' => 20
		));

	    $response->setContent(json_encode($this->_ajaxGetSub($hacchuu_dts)));

	    return $response;
	}

	public function _ajaxGetSub($hacchuu_dts)
	{
		$res_flds = [
			"id",
			"cd",
//			"nendo",
			"tekiyou",
			"hacchuubi",
			"nounyuu_kijitu",
//			"juchuu_dt_cd",
//			"zeiritu_tekiyoubi",
			"shiiresaki_mr_cd",
//			"torihiki_kbn_cd",
//			"zei_tenka_kbn_cd",
			"tantou_mr_cd",
			"sakusei_user_id",
			"created",
			"kousin_user_id",
			"updated",
		];
		$meisai_flds = [
			"utiwake_kbn_cd",
//			"kousei",
			"shouhin_mr_cd",
			"tekiyou",
			"lot",
//			"kobetucd",
//			"hinsitu_kbn_cd",
//			"souko_mr_cd",
//			"iro",
//			"iromei",
//			"size",
//			"suuryou",
			"keisu",
			"irisuu",
			"suuryou1",
			"tanni_mr1_cd",
			"suuryou2",
			"tanni_mr2_cd",
			"tanka_kbn",
//			"gentanka",
			"tanka",
//			"kingaku",
//			"genkagaku",
//			"zeinukigaku",
//			"zeigaku",
//			"zeiritu_mr_cd",
//			"bikou",
			"nouki",
		];

		$kak_flds = [
			'gotantou',
			'keishou',
			'seisan_kanri_user_cd',
			'assistant_user_cd',
			'loss_ritu',
			'kibou_nouki',
			'kouki',
			'kakou_shu',
			'kishu',
			'yori_houkou',
			'yorisuu',
			'yori_tanni',
			'makiryou',
			'makiryou_tanni',
			'seimaki_mae',
			'seimaki_suu',
			'seimaki_tanni',
			'sikan_sitei',
			'set_umu',
			'set_ondo',
			'set_hun',
			'tail_kbn',
			'komaki_kbn',
			'tunagi_kbn',
			'youto',
			'case_kbn',
			'irihonsuu',
			'zansi_kbn',
			'shukka_kbn',
			'sonota1',
			'sonota2',
			'sonota3',
			'bikou_ka',
			'bikou_yor',
			'bikou_ma',
			'bikou_si',
			'bikou_se',
			'bikou_ta',
			'bikou_ko',
			'bikou_tu',
			'bikou_you',
			'bikou_ca',
			'bikou_za',
			'bikou_sh',
			'bikou_so1',
			'bikou_so2',
			'bikou_so3',
			'tokki',
		];

		$cnt = 0;
		$mcnt = 0;
		$resData = array();
		foreach ($hacchuu_dts as $hacchuu_dt) {
			$cnt++;
			$resAdata = array();
			foreach ($res_flds as $res_fld) {
				$resAdata[$res_fld] = $hacchuu_dt->$res_fld;
			}
			$resAdata['tantou_name'] = $hacchuu_dt->TantouMrs->name;
			
			foreach ($hacchuu_dt->HacchuuMeisaiDts as $hacchuu_meisai_dt) {
				if ($hacchuu_meisai_dt->utiwake_kbn_cd == '10' || $hacchuu_meisai_dt->utiwake_kbn_cd == '21') { // 工賃行と支給消費行
					$resAdata['mei'][$mcnt]['tekiyou'] = $hacchuu_meisai_dt->tekiyou;
					$resAdata['mei'][$mcnt]['lot'] = $hacchuu_meisai_dt->lot;
					$resAdata['mei'][$mcnt]['keisu'] = $hacchuu_meisai_dt->keisu;
					$resAdata['mei'][$mcnt]['irisuu'] = $hacchuu_meisai_dt->irisuu;
					$resAdata['mei'][$mcnt]['suuryou2'] = $hacchuu_meisai_dt->suuryou2;
					$resAdata['mei'][$mcnt]['tanni_mr2_cd'] = $hacchuu_meisai_dt->tanni_mr2_cd;
					$resAdata['mei'][$mcnt]['tanka'] = $hacchuu_meisai_dt->tanka;
					$resAdata['mei'][$mcnt]['nouki'] = $hacchuu_meisai_dt->nouki;
					$resAdata['mei'][$mcnt]['tanni_name'] = $hacchuu_meisai_dt->TanniMr2s->name;
					$mcnt++;
				}
			}
			if ($cnt > 1) {
				
			} else {
				foreach ($kak_flds as $kak_fld) { // 加工内容
					$resAdata[$kak_fld] = $hacchuu_dt->KakouIraiDt->$kak_fld;
				}
				$resAdata['seisan_kanri_user_name'] = $hacchuu_dt->KakouIraiDt->SeisanKanriUser->name;
				$resAdata['assistant_user_name'] = $hacchuu_dt->KakouIraiDt->AssistantUser->name;
				$mcnt = 0;
				foreach ($hacchuu_dt->KakouSaiFaxDts as $fax_dt) { // 再ファックス追加連絡事項
					$resAdata['fax'][$mcnt]['hiduke'] = $fax_dt->hiduke;
					$resAdata['fax'][$mcnt]['user_cd'] = $fax_dt->user_cd;
					$resAdata['fax'][$mcnt]['user_name'] = $fax_dt->Users->name;
					$resAdata['fax'][$mcnt]['name'] = $fax_dt->name;
					$mcnt++;
				}
				$mcnt = 0;
				foreach ($hacchuu_dt->KakoujouChouseiDts as $cho_dt) { // 加工場調整事項
					$resAdata['cho'][$mcnt]['hiduke'] = $cho_dt->hiduke;
					$resAdata['cho'][$mcnt]['user_cd'] = $cho_dt->user_cd;
					$resAdata['cho'][$mcnt]['user_name'] = $cho_dt->Users->name;
					$resAdata['cho'][$mcnt]['name'] = $cho_dt->name;
					$resAdata['cho'][$mcnt]['kakunin_kbn'] = $cho_dt->kakunin_kbn;
					$mcnt++;
				}
				foreach ($hacchuu_dt->KakouNagareDts as $nag_dt) { // 加工流れ詳細
					$ngyo = $nag_dt->KakouNagareKbn->cd - 1; // 行位置
					$resAdata['nag'][$ngyo]['name'] = $nag_dt->name;
					$resAdata['nag'][$ngyo]['bikou'] = $nag_dt->bikou;
					$resAdata['nag'][$ngyo]['kakunin_kbn'] = $nag_dt->kakunin_kbn;
				}
				$mcnt = 0;
				foreach ($hacchuu_dt->KakouZenkaiMokuriDts as $mok_dt) { // 前回加工時より申し送り事項
					$resAdata['mok'][$mcnt]['hiduke'] = $mok_dt->hiduke;
					$resAdata['mok'][$mcnt]['user_cd'] = $mok_dt->user_cd;
					$resAdata['mok'][$mcnt]['user_name'] = $mok_dt->Users->name;
					$resAdata['mok'][$mcnt]['name'] = $mok_dt->name;
					$mcnt++;
				}
			}

	        $resData[] = $resAdata;//array('cd' => $hacchuu_dt->cd, 'name' => $hacchuu_dt->name);
	    }
	    
	    return $resData;
	}

    /**
     * 登録画面から呼び出される
     * データー更新追加
     * 2018/4/5 井浦
     */
	public function ajaxSaveAction()
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

        $data = $this->request->getPost('data');

        //return json_encode($data);

		$hacchuu_flds = [
			['cd'				,'cd'				,0],
			['hacchuubi'		,'hacchuubi'		,0],
			['tekiyou'			,'tekiyou'			,0],
			['shiiresaki_mr_cd'	,'shiiresaki_mr_cd'	,0],
			['nounyuu_kijitu'	,'nounyuu_kijitu'	,0],
			['tantou_mr_cd'		,'tantou_mr_cd'		,0],
		];
/*			'cd'	,'cd'	,0,
			'juchuu_dt_cd'	,'juchuu_dt_cd'	,0,
			'zeiritu_tekiyoubi'	,'zeiritu_tekiyoubi'	,0,
			'torihiki_kbn_cd'	,'torihiki_kbn_cd'	,0,
			'zei_tenka_kbn_cd'	,'zei_tenka_kbn_cd'	,0,
			'kakeritu'	,'kakeritu'	,0,
			'hassousaki_kbn_cd'	,'hassousaki_kbn_cd'	,0,
			'hassousaki_mr_cd'	,'hassousaki_mr_cd'	,0,
			'shounin_joutai_flg'	,'shounin_joutai_flg'	,0,
			'shounin_sha_mr_cd'	,'shounin_sha_mr_cd'	,0,
			'updated'	,'updated'	,0,
*/
		$meisai_flds = [
			['cd'				,'cd'				,0],
			['utiwake_kbn_cd'	,'utiwake_kbn_cd'	,0],
			['shouhin_mr_cd'	,'shouhin_mr_cd'	,0],
			['suuryou2'			,'suuryou'			,1],
			['tanni_mr2_cd'		,'tanni'			,0],
			['irisuu'			,'irisuu'			,1],
			['keisu'			,'keisu'			,1],
			['tanka_kbn'		,'tanka_kbn'		,0],
			['tanka'			,'tanka'			,1],
			['tekiyou'			,'tekiyou'			,0],
			['lot'				,'lot'				,0],
			['nouki'			,'nouki'			,1],
		];
/*			"id",
			"cd",
			"kousei",
			"suuryou",
			"kobetucd",
			"hinsitu_kbn_cd",
			"souko_mr_cd",
			['suuryou1'			,'suuryou1'			,1],
			['tanni_mr1_cd'		,'tanni_mr1_cd'		,0],
			"iro",
			"iromei",
			"size",
			"gentanka",
			"genkagaku",
			"kingaku",
			"zeinukigaku",
			"zeigaku",
			"project_mr_cd",
			"zeiritu_mr_cd",
			"bikou",
*/
		$irai_flds = [
			['gotantou'			,'gotantou'				,0],
			['keishou'			,'keishou'				,0],
			['seisan_kanri_user_cd','seisan_kanri_user_cd',0],
			['assistant_user_cd','assistant_user_cd'	,0],
			['loss_ritu'		,'loss_ritu'			,0],
			['kibou_nouki'		,'kibou_nouki'			,0],
			['kouki'			,'kouki'				,0],
			['kakou_shu'		,'kakou_shu'			,0],
			['kishu'			,'kishu'				,0],
			['yori_houkou'		,'yori_houkou'			,0],
			['yorisuu'			,'yorisuu'				,1],
			['yori_tanni'		,'yori_tanni'			,0],
			['makiryou'			,'makiryou'				,0],
			['makiryou_tanni'	,'makiryou_tanni'		,0],
			['seimaki_mae'		,'seimaki_mae'			,0],
			['seimaki_suu'		,'seimaki_suu'			,0],
			['seimaki_tanni'	,'seimaki_tanni'		,0],
			['sikan_sitei'		,'sikan_sitei'			,0],
			['set_umu'			,'set_umu'				,0],
			['set_ondo'			,'set_ondo'				,0],
			['set_hun'			,'set_hun'				,0],
			['tail_kbn'			,'tail_kbn'				,0],
			['komaki_kbn'		,'komaki_kbn'			,0],
			['tunagi_kbn'		,'tunagi_kbn'			,0],
			['youto'			,'youto'				,0],
			['case_kbn'			,'case_kbn'				,0],
			['irihonsuu'		,'irihonsuu'			,1],
			['zansi_kbn'		,'zansi_kbn'			,0],
			['shukka_kbn'		,'shukka_kbn'			,0],
			['sonota1'			,'sonota1'				,0],
			['sonota2'			,'sonota2'				,0],
			['sonota3'			,'sonota3'				,0],
			['bikou_ka'			,'bikou_ka'				,0],
			['bikou_yor'		,'bikou_yor'			,0],
			['bikou_ma'			,'bikou_ma'				,0],
			['bikou_si'			,'bikou_si'				,0],
			['bikou_se'			,'bikou_se'				,0],
			['bikou_ta'			,'bikou_ta'				,0],
			['bikou_ko'			,'bikou_ko'				,0],
			['bikou_tu'			,'bikou_tu'				,0],
			['bikou_you'		,'bikou_you'			,0],
			['bikou_ca'			,'bikou_ca'				,0],
			['bikou_za'			,'bikou_za'				,0],
			['bikou_sh'			,'bikou_sh'				,0],
			['bikou_so1'		,'bikou_so1'			,0],
			['bikou_so2'		,'bikou_so2'			,0],
			['bikou_so3'		,'bikou_so3'			,0],
			['tokki'			,'tokki'				,0],
		];

		$errmsgs = [];
		$chgcnt = 0;
		if ($data['id']) {	// idがあればidで更新
			$hacchuu_dt = HacchuuDts::findFirstByid($data['id']);
			if (!$hacchuu_dt) {
				$errmsgs[] = "発注データが見つからなくなりました。" . $data['id'];
				//アベンド処理がない
			}
		} else {			// idが無かったら新規追加
			$hacchuu_dt = new HacchuuDts();
		}

		$KakouIraiLogDts = []; // ログの用意

		foreach ($hacchuu_flds as $fld) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
			if ($fld[2] == 1) {	// 数値の時は
				$data[$fld[1]] = (double)str_replace(',','',$data[$fld[1]]); // カンマ除去
			}
			$fld0 = $fld[0];
			if ($hacchuu_dt->$fld0 != $data[$fld[1]]) {
				if ($data['id']) { // 新規は出力しない
					$KakouIraiLogDts[$chgcnt] = new KakouIraiLogDts();
					$KakouIraiLogDts[$chgcnt]->table_ryaku = '発注';
					$KakouIraiLogDts[$chgcnt]->cd = $data['cd'];
					$KakouIraiLogDts[$chgcnt]->koumoku_cd = $fld0;
					$KakouIraiLogDts[$chgcnt]->gyou_ix = 0;
					$KakouIraiLogDts[$chgcnt]->henkou_mae = $hacchuu_dt->$fld0;
					$KakouIraiLogDts[$chgcnt]->name = $data[$fld[1]]; // 変更後
				}
				$chgcnt++;
				$hacchuu_dt->$fld0 = $data[$fld[1]];
			}
		}

		$i = 0; // db側位置		0 1 2 3 4
		foreach ($data["mei"] as $mei_dt) {
			if ($data['mei'][$i]['tekiyou'] || $i < count($hacchuu_dt->HacchuuMeisaiDts)) {
				if ($i < count($hacchuu_dt->HacchuuMeisaiDts)) {
					$HacchuuMeisaiDts[$i] = $hacchuu_dt->HacchuuMeisaiDts[$i];
				} else {
					$HacchuuMeisaiDts[$i] = new HacchuuMeisaiDts();
				}
				$data['mei'][$i]['souko_mr_cd'] = '0000'; // 共通倉庫
				$data['mei'][$i]['hinsitu_kbn_cd'] = '11'; // 品質：正常
				$data['mei'][$i]['tanka_kbn'] = '2'; // 単価区分：/KG
				$data['mei'][$i]['kingaku'] = (int)($HacchuuMeisaiDts[$i]->tanka * $HacchuuMeisaiDts[$i]->suuryou2); // 金額
				$data['mei'][$i]['cd']= $i + 1; // 行番号
				$data['mei'][$i]['tanni_mr2_cd'] = $data['mei'][$i]['tanni_mr2_cd']??'5'; // 単位：KG
				if ($i == 0) {
					$data['mei'][$i]['utiwake_kbn_cd'] = '20';	// 加工製品
					$data['mei'][$i]['tanka'] = 0;				// 単価0円
					if (!$data['mei'][$i]['shouhin_mr_cd']) { // 商品コードが無ければ
						$data['mei'][$i]['shouhin_mr_cd'] = '3/00000'; // 商品コード：ダミー
					}
					$data['mei'][$i]['keisu'] = 0;	// 係数
				} else if ($i == 1) {
					$data['mei'][$i]['utiwake_kbn_cd'] = '10';	// 加工工賃
					$data['mei'][$i]['shouhin_mr_cd'] = 'N/00000'; // 商品コード：ダミー
					$data['mei'][$i]['keisu'] = 0;	// 係数
				} else {
					$data['mei'][$i]['utiwake_kbn_cd'] = '21';	// 加工原料
					$data['mei'][$i]['shouhin_mr_cd'] = '1/00000'; // 商品コード：ダミー
					$data['mei'][$i]['tanka'] = 0;				// 単価0円
				}
				foreach ($meisai_flds as $fld) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
					if ($fld[2] == 1) {	// 数値の時は
						$data[$fld[1]] = (double)str_replace(',','',$data[$fld[1]]); // カンマ除去
					}
					$fld0 = $fld[0];
					if ($HacchuuMeisaiDts[$i]->$fld0 != $data['mei'][$i][$fld[1]]) {
						if ($data['id']) { // 新規は出力しない
							$KakouIraiLogDts[$chgcnt] = new KakouIraiLogDts();
							$KakouIraiLogDts[$chgcnt]->table_ryaku = '明細';
							$KakouIraiLogDts[$chgcnt]->cd = $data['cd'];
							$KakouIraiLogDts[$chgcnt]->koumoku_cd = $fld0;
							$KakouIraiLogDts[$chgcnt]->gyou_ix = $i;
							$KakouIraiLogDts[$chgcnt]->henkou_mae = $HacchuuMeisaiDts[$i]->$fld0;
							$KakouIraiLogDts[$chgcnt]->name = $data['mei'][$i][$fld[1]]; // 変更後
						}
						$chgcnt++;
						$HacchuuMeisaiDts[$i]->$fld0 = $data['mei'][$i][$fld[1]];
					}
				}
			}
			$i++;
		}
		$hacchuu_dt->HacchuuMeisaiDts = $HacchuuMeisaiDts; // 明細データ（製品・工賃・原料）をドッキング

		if ($hacchuu_dt->KakouIraiDt) { // 加工依頼データ
			$KakouIraiDt = $hacchuu_dt->KakouIraiDt;
		} else {
			$KakouIraiDt = new KakouIraiDts();
		}
		foreach ($irai_flds as $fld) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
			if ($fld[2] == 1) {	// 数値の時は
				$data[$fld[1]] = (double)str_replace(',','',$data[$fld[1]]); // カンマ除去
			}
			$fld0 = $fld[0];
			if ($KakouIraiDt->$fld0 != $data[$fld[1]]) {
				if ($data['id']) { // 新規は出力しない
					$KakouIraiLogDts[$chgcnt] = new KakouIraiLogDts();
					$KakouIraiLogDts[$chgcnt]->table_ryaku = '依頼';
					$KakouIraiLogDts[$chgcnt]->cd = $data['cd'];
					$KakouIraiLogDts[$chgcnt]->koumoku_cd = $fld0;
					$KakouIraiLogDts[$chgcnt]->gyou_ix = 0;
					$KakouIraiLogDts[$chgcnt]->henkou_mae = $KakouIraiDt->$fld0;
					$KakouIraiLogDts[$chgcnt]->name = $data[$fld[1]]; // 変更後
				}
				$chgcnt++;
				$KakouIraiDt->$fld0 = $data[$fld[1]];
			}
		}
		$hacchuu_dt->KakouIraiDt = $KakouIraiDt; // 加工依頼データをドッキング

		$fax_flds = ['hiduke','user_cd','name'];
		$i = 0;
		foreach ($data["fax"] as $fax_dt) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
			if ($fax_dt['name'] || $i < count($hacchuu_dt->KakouSaiFaxDts)) {
				if ($i < count($hacchuu_dt->KakouSaiFaxDts)) {
					$KakouSaiFaxDts[$i] = $hacchuu_dt->KakouSaiFaxDts[$i];
				} else {
					$KakouSaiFaxDts[$i] = new KakouSaiFaxDts();
				}
				foreach ($fax_flds as $fld) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
					if ($KakouSaiFaxDts[$i]->$fld !== $fax_dt[$fld]) {
						if ($data['id']) { // 新規は出力しない
							$KakouIraiLogDts[$chgcnt] = new KakouIraiLogDts();
							$KakouIraiLogDts[$chgcnt]->table_ryaku = '再FAX';
							$KakouIraiLogDts[$chgcnt]->cd = $data['cd'];
							$KakouIraiLogDts[$chgcnt]->koumoku_cd = $fld;
							$KakouIraiLogDts[$chgcnt]->gyou_ix = $i;
							$KakouIraiLogDts[$chgcnt]->henkou_mae = $KakouSaiFaxDts[$i]->$fld;
							$KakouIraiLogDts[$chgcnt]->name = $fax_dt[$fld]; // 変更後
						}
						$chgcnt++;
						$KakouSaiFaxDts[$i]->$fld = $fax_dt[$fld];
					}
				}
				$KakouSaiFaxDts[$i]->cd = $i + 1;
			}
			$i++;
		}
		$hacchuu_dt->KakouSaiFaxDts = $KakouSaiFaxDts; // 加工再ファックスデータをドッキング

		$cho_flds = ['hiduke','user_cd','name','kakunin_kbn'];
		$i = 0;
		foreach ($data["cho"] as $cho_dt) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
			if ($cho_dt['name'] || $i < count($hacchuu_dt->KakoujouChouseiDts)) {
				if ($i < count($hacchuu_dt->KakoujouChouseiDts)) {
					$KakoujouChouseiDts[$i] = $hacchuu_dt->KakoujouChouseiDts[$i];
				} else {
					$KakoujouChouseiDts[$i] = new KakoujouChouseiDts();
				}
				foreach ($cho_flds as $fld) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
					if ($KakoujouChouseiDts[$i]->$fld !== $cho_dt[$fld]) {
						if ($data['id']) { // 新規は出力しない
							$KakouIraiLogDts[$chgcnt] = new KakouIraiLogDts();
							$KakouIraiLogDts[$chgcnt]->table_ryaku = '調整';
							$KakouIraiLogDts[$chgcnt]->cd = $data['cd'];
							$KakouIraiLogDts[$chgcnt]->koumoku_cd = $fld;
							$KakouIraiLogDts[$chgcnt]->gyou_ix = $i;
							$KakouIraiLogDts[$chgcnt]->henkou_mae = $KakoujouChouseiDts[$i]->$fld;
							$KakouIraiLogDts[$chgcnt]->name = $cho_dt[$fld]; // 変更後
						}
						$chgcnt++;
						$KakoujouChouseiDts[$i]->$fld = $cho_dt[$fld];
					}
				}
				$KakoujouChouseiDts[$i]->cd = $i + 1;
			}
			$i++;
		}
		$hacchuu_dt->KakoujouChouseiDts = $KakoujouChouseiDts; // 加工場調整事項データをドッキング

		$kakou_nagare_kbns = KakouNagareKbns::find(['order'=>'cd', 'conditions' => 'cd > 0']);

		$nag_flds = ['name','bikou','kakunin_kbn'];
		$i = 0;
		foreach ($data["nag"] as $nag_dt) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
			if ($data['nag'][$i]['name'] || $i < count($hacchuu_dt->KakouNagareDts)) {
				if ($i < count($hacchuu_dt->KakouNagareDts)) {
					$KakouNagareDts[$i] = $hacchuu_dt->KakouNagareDts[$i];
				} else {
					$KakouNagareDts[$i] = new KakouNagareDts();
				}
				$KakouNagareDts[$i]->kakou_nagare_kbn_id = $kakou_nagare_kbns[$i]->id;
				foreach ($nag_flds as $fld) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
					if ($KakouNagareDts[$i]->$fld !== $data['nag'][$i][$fld]) {
						if ($data['id']) { // 新規は出力しない
							$KakouIraiLogDts[$chgcnt] = new KakouIraiLogDts();
							$KakouIraiLogDts[$chgcnt]->table_ryaku = '流れ';
							$KakouIraiLogDts[$chgcnt]->cd = $data['cd'];
							$KakouIraiLogDts[$chgcnt]->koumoku_cd = $fld;
							$KakouIraiLogDts[$chgcnt]->gyou_ix = $i;
							$KakouIraiLogDts[$chgcnt]->henkou_mae = $KakouNagareDts[$i]->$fld;
							$KakouIraiLogDts[$chgcnt]->name = $data['nag'][$i][$fld]; // 変更後
						}
						$chgcnt++;
						$KakouNagareDts[$i]->$fld = $data['nag'][$i][$fld];
					}
				}
				$KakouNagareDts[$i]->cd = $i + 1;
			}
			$i++;
		}
		$hacchuu_dt->KakouNagareDts = $KakouNagareDts; // 加工流れ詳細データをドッキング

		$mok_flds = ['hiduke','user_cd','name'];
		$i = 0;
		foreach ($data["mok"] as $mok_dt) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
			if ($data['mok'][$i]['name'] || $i < count($hacchuu_dt->KakouZenkaiMokuriDts)) {
				if ($i < count($hacchuu_dt->KakouZenkaiMokuriDts)) {
					$KakouZenkaiMokuriDts[$i] = $hacchuu_dt->KakouZenkaiMokuriDts[$i];
				} else {
					$KakouZenkaiMokuriDts[$i] = new KakouZenkaiMokuriDts();
				}
				foreach ($mok_flds as $fld) {	// $fld[0]:テーブルカラムid,[1]:postデータid,[2]:タイプ0=文字列,1=数値
					if ($KakouZenkaiMokuriDts[$i]->$fld !== $data['mok'][$i][$fld]) {
						if ($data['id']) { // 新規は出力しない
							$KakouIraiLogDts[$chgcnt] = new KakouIraiLogDts();
							$KakouIraiLogDts[$chgcnt]->table_ryaku = '申送';
							$KakouIraiLogDts[$chgcnt]->cd = $data['cd'];
							$KakouIraiLogDts[$chgcnt]->koumoku_cd = $fld;
							$KakouIraiLogDts[$chgcnt]->gyou_ix = $i;
							$KakouIraiLogDts[$chgcnt]->henkou_mae = $KakouZenkaiMokuriDts[$i]->$fld;
							$KakouIraiLogDts[$chgcnt]->name = $data['mok'][$i][$fld]; // 変更後
						}
						$chgcnt++;
						$KakouZenkaiMokuriDts[$i]->$fld = $data['mok'][$i][$fld];
					}
				}
				$KakouZenkaiMokuriDts[$i]->cd = $i + 1;
			}
			$i++;
		}
		$hacchuu_dt->KakouZenkaiMokuriDts = $KakouZenkaiMokuriDts; // 前回加工時より申し送り事項データをドッキング

		// 伝票番号付番または再設定
		$den_ban_ctrl = new DenpyouBangouMrsController(); //伝票番号マスタコントローラ
		$nendo_ban = $den_ban_ctrl->countup('hacchuu', $hacchuu_dt->cd, $hacchuu_dt->hacchuubi, $hacchuu_dt->nendo);
		if (!$nendo_ban['nendo']) {
			$errmsgs[] = "エラー:年度が未登録（日付が今年か昨年以外は不可）。" . $hacchuu_dt->hacchuubi;
		}
		$hacchuu_dt->cd = $nendo_ban['bangou'];
		$hacchuu_dt->nendo = $nendo_ban['nendo'];

		$hacchuu_dt->KakouIraiLogDts = $KakouIraiLogDts; // ログデータをドッキング

		if ($chgcnt > 0) {
			if (!$hacchuu_dt->save()) {
				foreach ($hacchuu_dt->getMessages() as $message) {
					$errmsgs[] = $message;
				}
			}
		}

		$resData1 = array();

        $resData1['chgcnt'] = $chgcnt;
        $resData1['cd'] = $hacchuu_dt->cd;
        $resData1['id'] = $hacchuu_dt->id;
        $resData1['data_id'] = $data['id'];
        $resData1['dt_tekiyou'] = $data['tekiyou'];
        $resData1['tb_tekiyou'] = $hacchuu_dt->tekiyou;
        $resData1['nag_kakunin_kbn_1'] = $hacchuu_dt->KakouNagareDts[1]->kakunin_kbn_id;
        $resData1['nag_kakunin_kbn_2'] = $hacchuu_dt->KakouNagareDts[2]->kakunin_kbn_id;
        $resData1['nag_kakunin_kbn_3'] = $hacchuu_dt->KakouNagareDts[3]->kakunin_kbn_id;
        $resData1['meisai_flds']=$meisai_flds;
        $resData1['msgs'] = $errmsgs;

		if ($chgcnt > 0) {
			$hacchuu_dt = HacchuuDts::findFirstByid($hacchuu_dt->id);
		}
		$resData0 = $this->_ajaxGetSub([$hacchuu_dt]);

		$resData = array();
		$resData[] = $resData0[0];
		$resData[] = $resData1;

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}



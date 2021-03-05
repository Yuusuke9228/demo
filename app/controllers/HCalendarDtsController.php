<?php
 


class HCalendarDtsController extends ControllerBase
{
	// *****************************************************************
    public function indexAction() // 一覧表
	// *----------------------------------------------------------------
    {
        ControllerBase::indexCd("HCalendarDts", "カレンダーデータ"); //簡易検索付き一覧表示
    }

	// *****************************************************************
    public function kantanAction() //簡単登録 action
	// *----------------------------------------------------------------
    {

		// 現在の年月を取得
		$nen = date('Y');
		$this->view->nen = $nen;
    }

	private $g1=[]; // jsとデータ交換
	// *****************************************************************
	public function ajaxAnyDoAction() // 簡単画面から呼び出される データー表示用更新用 2020/3/5 井浦
	// *----------------------------------------------------------------
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

		$todo = $this->request->getPost('todo');
		$this->g1 = $this->request->getPost('g1');

										$this->g1['point_1']=[];
		switch ($todo) {
			case 'read':
				$this->DoReadAjax();
				break;
			case 'save':
				$this->DoSaveAjax();
				$this->DoReadAjax();
				break;
		}
		$response->setContent(json_encode($this->g1)); // json変換 g1
		return $response;  // javascriptへ戻り値 g1
	}

	// *****************************************************************
	private function DoReadAjax() { // 読込
										$this->g1['point_1'][] = "DoReadAjax";
	// *----------------------------------------------------------------
        $nen = $this->g1['nen']??date('Y');
        $this->g1['nen'] = $nen;
        $cd = $this->g1['cd']??'SFN';
        $this->g1['cd'] = $cd;
        $ptn = HCalendarPatanDts::findFirst([
        	'conditions'=>'cd = ?1',
        	'bind'=>[
        		1=>$cd,
        	],
        ]);
$this->g1['point_1'][] = "DoReadAjax:".$ptn->bikou;
        if ($ptn) $this->g1['patan_bikou'] = $ptn->bikou;

        $this->g1['calendar'] = [];
        for ($m = 1; $m <= 12; $m++) { // dtsにないと仮定してすべて初期値を入れる
            $last_day = date('j', mktime(0, 0, 0, $m + 1, 0, $nen)); // 月末日を取得
            for ($d = 1; $d <= $last_day; $d++) {
                $hiduke = $nen.'-'.substr('0'.$m, -2).'-'.substr('0'.$d, -2);
                $week = date('w', mktime(0, 0, 0, $m, $d, $nen)); // 曜日を取得
                $kadou_flg = ($cd == 'SHUK' || $week > 0 && $week < 6)?1:0;
                $this->g1['calendar'][$hiduke] = ['kadou_flg' => $kadou_flg, 'bikou' => ''];
            }
        }
        $dts = HCalendarDts::find([
        	'conditions'=>'cd = ?1 AND hiduke BETWEEN ?2 AND ?3',
        	'order'=>'hiduke',
        	'bind'=>[
        		1=>$cd,
        		2=>$nen.'-01-01',
        		3=>$nen.'-12-31',
        	],
        ]);
        if ($dts) {
        	foreach ($dts as $dt) {
        		$this->g1['calendar'][$dt->hiduke] = ['kadou_flg' => $dt->kadou_flg==1?1:0, 'bikou' => $dt->bikou]; // 有ったら上書き
        	}
        }
        // 祝祭日付加
        $dts = HCalendarDts::find([
        	'conditions'=>'cd = ?1 AND hiduke BETWEEN ?2 AND ?3',
        	'order'=>'hiduke',
        	'bind'=>[
        		1=>'SHUK',
        		2=>$nen.'-01-01',
        		3=>$nen.'-12-31',
        	],
        ]);
        if ($dts) {
        	foreach ($dts as $dt) {
        		$this->g1['calendar'][$dt->hiduke]['shuk_flg'] = $dt->kadou_flg==1?1:0; // 平日フラグ
        		$this->g1['calendar'][$dt->hiduke]['shuk_bikou'] = $dt->bikou; // 祝日備考
        	}
        }
    }

	// *****************************************************************
	private function DoSaveAjax() { // 保存
										$this->g1['point_1'][] = "DoSaveAjax";
	// *----------------------------------------------------------------
        $this->g1['errflg'] = 0;
        if (!isset($this->g1['nen'])) {
        	$this->g1['emsg'] = "年を指定してください。";
        	$this->g1['errflg'] = 1;
        	return; // 中止
        }
        if (!isset($this->g1['cd'])) {
        	$this->g1['emsg'] = "パターンコードを指定してください。";
        	$this->g1['errflg'] = 1;
        	return; // 中止
        }
        $this->g1['emsg'] = '';
        foreach ($this->g1['calendar'] as $hiduke0 => $data) {
        	$hiduke = $this->g1['nen'].substr($hiduke0,4);
			list($Y, $m, $d) = explode('-', $hiduke);
			if (checkdate($m, $d, $Y) === true) {
	            $dt = HCalendarDts::findFirst([
	            	'conditions'=>'cd = ?1 AND hiduke = ?2',
	        		'bind'=>[
	        			1=>$this->g1['cd'],
	        			2=>$hiduke,
	        		],
	        	]);
	        	if (!$dt) {
	        		$dt = new HCalendarDts();
	        		$dt->cd = $this->g1['cd'];
	        		$dt->hiduke = $hiduke;
	        	}
	        	$dt->kadou_flg = $data['kadou_flg'];
	        	$dt->bikou = $data['bikou'];
	            if (!$dt->save()) {
	            	$this->g1['emsg'] .= "保存に失敗しました。".$hiduke.'<br>';
	            	$this->g1['errflg'] = 1;
	            }
	        } else {
            	$this->g1['emsg'] .= "無効な日付は無視しました。".$hiduke.'<br>';
	           	$this->g1['errflg'] = 2;
	        }
        }
        if ($this->g1['errflg'] == 0) $this->g1['emsg'] = "登録しました。";
    }

    /**
     * Searches for h_calendar_dts
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="HCalendarDts")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $h_calendar_dt = $nameDts::findFirstByid($id);
            if (!$h_calendar_dt) {
                $this->flash->error("カレンダーデータが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_calendar_dts",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($h_calendar_dt, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "h_calendar_dts", "HCalendarDts", "カレンダーデータ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "h_calendar_dts", "HCalendarDts", "カレンダーデータ");
    }

    /**
     * Edits a h_calendar_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $h_calendar_dt = HCalendarDts::findFirstByid($id);
            if (!$h_calendar_dt) {
                $this->flash->error("カレンダーデータが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "h_calendar_dts",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $h_calendar_dt->id;

            $this->_setDefault($h_calendar_dt, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($h_calendar_dt, $action="edit", $meisai="HCalendarDts")
    {
        $setdts = ["id",
            "cd",
            "hiduke",
            "kadou_flg",
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
            if (property_exists($h_calendar_dt, $setdt)) {
                $this->tag->setDefault($setdt, $h_calendar_dt->$setdt);
            }
        }
    }

    /**
     * Creates a new h_calendar_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_calendar_dts",
                'action' => 'index'
            ));

            return;
        }

        $h_calendar_dt = new HCalendarDts();

        $post_flds = ["cd",
            "hiduke",
            "kadou_flg",
            "bikou",
            "updated",
            ];
        

        foreach ($post_flds as $post_fld) {
            $h_calendar_dt->$post_fld = $this->request->getPost($post_fld);
        }

        if (!$h_calendar_dt->save()) {
            foreach ($h_calendar_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_dts",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("カレンダーデータの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_calendar_dts",
            'action' => 'edit',
            'params' => array($h_calendar_dt->id)
        ));
    }

    /**
     * Saves a h_calendar_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "h_calendar_dts",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $h_calendar_dt = HCalendarDts::findFirstByid($id);

        if (!$h_calendar_dt) {
            $this->flash->error("カレンダーデータが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_dts",
                'action' => 'index'
            ));

            return;
        }

        if ($h_calendar_dt->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからカレンダーデータが変更されたため更新を中止しました。"
                . $id . ",uid=" . $h_calendar_dt->kousin_user_id . " tb=" . $h_calendar_dt->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = ["cd",
            "hiduke",
            "kadou_flg",
            "bikou",
            "updated",
            ];
        

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($this->request->getPost($post_fld) !== $h_calendar_dt->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "h_calendar_dts",
                "action" => "edit",
                "params" => array($h_calendar_dt->id)
            ));

            return;
        }

        $this->_bakOut($h_calendar_dt, 0);

        foreach ($post_flds as $post_fld) {
            $h_calendar_dt->$post_fld = $this->request->getPost($post_fld);
        }

        if (!$h_calendar_dt->save()) {

            foreach ($h_calendar_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_dts",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("カレンダーデータの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_calendar_dts",
            'action' => 'edit',
            'params' => array($h_calendar_dt->id)
        ));
    }

    /**
     * Deletes a h_calendar_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $h_calendar_dt = HCalendarDts::findFirstByid($id);
        if (!$h_calendar_dt) {
            $this->flash->error("カレンダーデータが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_dts",
                'action' => 'index'
            ));

            return;
        }

        if (!$h_calendar_dt->delete()) {

            foreach ($h_calendar_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "h_calendar_dts",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($h_calendar_dt, 1);

        $this->flash->success("カレンダーデータの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "h_calendar_dts",
            'action' => "index"
        ));
    }

    /**
     * Back Out a h_calendar_dt
     *
     * @param string $h_calendar_dt, $dlt_flg
     */
    public function _bakOut($h_calendar_dt, $dlt_flg = 0)
    {

        $bak_h_calendar_dt = new BakHCalendarDts();
        foreach ($h_calendar_dt as $fld => $value) {
            $bak_h_calendar_dt->$fld = $h_calendar_dt->$fld;
        }
        $bak_h_calendar_dt->id = NULL;
        $bak_h_calendar_dt->id_moto = $h_calendar_dt->id;
        $bak_h_calendar_dt->hikae_dltflg = $dlt_flg;
        $bak_h_calendar_dt->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_h_calendar_dt->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_h_calendar_dt->save()) {
            foreach ($bak_h_calendar_dt->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

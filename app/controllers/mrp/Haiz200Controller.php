<?php

class Haiz200Controller extends ControllerBase
{
	private $g1=[]; // jsとデータ交換

    /**
     * Index action
     */
    public function indexAction()
    {
    }


    /**
     * 登録画面から呼び出される
     * データー表示用
     * 2018/8/7 井浦
     */
	public function ajaxGrpDoAction()
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
			case 'HEAD_CHECK':
				$this->HeadCheck();
				break;
			case 'HEAD_NEXT':
				$this->HeadNext();
				break;
			case 'HEAD_BACK':
				$this->HeadBack();
				break;
			case 'BODY_CHECK':
				$this->BodyCheck();
				break;
			case 'TAIL_CHECK':
				$this->TailCheck();
				break;
		}
		$this->HeadCrtJoins();
		$response->setContent(json_encode($this->g1)); // json変換 g1
		return $response;  // javascriptへ戻り値 g1
	}

	// *****************************************************************
	private function HeadCheck() { // ヘッドチェック …HeadCheck
										$this->g1['point_1'][] = "H-CHECK";
	// *----------------------------------------------------------------
	    $h_siori_mr = HSioriMrs::findfirst([
	        'conditions' => ' cd = ?1 ',
	        'bind' => [1 => $this->g1['cd']],
		]);
		if ( $h_siori_mr ) {
			$this->HeadGetSub($h_siori_mr);
		}

		if ( $this->g1['skbn'] == 1) {
			if ( $h_siori_mr ) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "設計書に登録済です！";
			}
		} else {
			if ( !$h_siori_mr ) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "設計書に未登録です！";
			}
			if ( $this->g1['errflg'] == 0 && $this->g1['skbn'] == 4 && $this->g1['snag'] < 20) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "試織を現反登録不可！";
			}
		}
	}

	const H_SIORI_FLDS = [
			'cd',
			'moku',
			'symd',
			'kymd',
			'type',
			'irai',
			'etnt',
			'ktnt',
			'kibo',
			'inou',
			'snou',
			'tnou',
			'ynou',
			'anou',
			'tken',
			'yken',
			'socd',
			'soth',
			'soyh',
			'htkb',
			'htho',
			'htsi',
			'hykb',
			'hyho',
			'ayma',
			'aycd',
			'ayho',
			'ayme',
			'shab',
			'snag',
			'osa',
			'uti',
			'miha',
			'mihk',
			'miho',
			'jiha',
			'jihk',
			'dohk',
			'jiho',
			'khab',
			'knag',
			'tiji',
			'ahab',
			'anag',
			'auti',
			'jury',
			'kkoh',
			'nkoh',
			'tkoh',
			'ykoh',
			'dkoh',
			'skoh',
			'nnfk',
			'gjur',
			'ecod1',
			'ecod2',
			'ecod3',
			'ecod4',
			'ecod5',
			'updated',
		];

	// *****************************************************************
	private function HeadGetSub($h_siori_mr) { // 読んだデータを配列g1へ複写
										$this->g1['point_1'][] = "HeadGetSub";
	// *----------------------------------------------------------------
		foreach (self::H_SIORI_FLDS as $fld) {
			$this->g1[$fld] = $h_siori_mr->$fld;
		}
		if ($this->g1['kymd'] == '0000-00-00') {$this->g1['kymd'] = '';}

		$this->HeadGetJoins($h_siori_mr);
		
		$this->iryo_disp();
		$this->genryou_bunkai();
	}

	const H_SIORI_JOINS = [
			'HSioriKakouMrs'=>[
				'cd',
				'kote',
				'updated',
			],
			'HSioriKonrituMrs'=>[
				'cd',
				'kon',
				'rit',
				'updated',
			],
			'HSigenMrs'=>[
				'cd',
				'name',
				'gito',
				'kota',
				'kik1',
				'kik2',
				'ktni',
				'biko',
				'gtni',
				'updated',
				'HSigenKonMrs'=>[
					'cd',
					'kon',
					'rit',
					'updated',
				],
			],
			'HSinenMrs'=>[
				'cd',
				'name',
				'tjun',
				'yjun',
				'ito1',
				'hon1',
				'gen1',
				'ito2',
				'hon2',
				'gen2',
				'kote',
				'hoko',
				'yori',
				'kbn1',
				'kbn2',
				'kako',
				'kohi',
				'denl',
				'gtni',
				'updated',
			],
			'HSiitoMrs'=>[
				'cd',
				'imei',
				'tjun',
				'yjun',
				'h_itomei_mr_cd',
				'ttni',
				'ytni',
				'thon',
				'douk',
				'kais',
				'yhon',
				'denl',
				'ondo',
				'time',
				'tnor',
				'ynor',
				'iryo',
				'updated',
			],
			'HSihaireMrs'=>[
				'cd',
				'name',
				'tykb',
				'kigo',
				'updated',
			],
			'HSosikiMr'=>[
				'type',
				'socd',
				'soth',
				'soyh',
				'updated',
				'HSisosikiMrs'=>[
					'cd',
					'name',
					'line',
					'updated',
				],
			],
			'HSisosikiMrs'=>[
				'cd',
				'name',
				'line',
				'updated',
			],
			'HSiayaMrs'=>[
				'cd',
				'kigo',
				'updated',
			],
			'HSioriJihonMrs'=>[
				'cd',
				'name',
				'hiki',
				'hasu',
				'updated',
			],
			'HSichuiMrs'=>[
				'cd',
				'name',
				'kbn',
				'tais',
				'eda',
				'chui',
				'updated',
			],
		];
	// *****************************************************************
	private function HeadGetJoins($h_siori_mr) { // リンク先のデータを配列g1へ複写
										$this->g1['point_1'][] = "HeadGetJoins";
	// *----------------------------------------------------------------
		foreach (self::H_SIORI_JOINS as $tbl1=>$fld1s) {
			$this->g1[$tbl1] = [];
			if (substr($tbl1,-1) == 's') { // hasManyは末尾にsとする
				foreach ($h_siori_mr->$tbl1 as $row1) { // 例：$tbl1='HSigenMrs'
					$joinAdata=[];
					foreach ($fld1s as $fld1=>$fld1a) { // 例：$fld1='HSigenKonMrs',$fld1a=['cd','kon','rit']
						if (is_array($fld1a)) {
							foreach ($row1->$fld1 as $row2) { // 例：$fld1='HSigenKonMrs',$row2=[[id=4,cd=1,kon,rit],[id=5,cd=2,kon,rit]…]
								$joinBdata=[];
								foreach ($fld1a as $fld2) { // 例：$fld2='cd'
									$joinBdata[$fld2] = $row2->$fld2;
								}
								$joinAdata[$fld1][]=$joinBdata;
							}
						} else {
							$joinAdata[$fld1a] = $row1->$fld1a;
						}
					}
					$this->g1[$tbl1][]=$joinAdata;
				}
			} else { // belongsToは末尾をs以外とする(hasOneも)
				$joinAdata=[];
				$row1 = $h_siori_mr->$tbl1;
				foreach ($fld1s as $fld1=>$fld1a) {
					if (is_array($fld1a)) {
						foreach ($row1->$fld1 as $row2) {
							$joinBdata=[];
							foreach ($fld1a as $fld2) {
								$joinBdata[$fld2] = $row2->$fld2;
							}
							$joinAdata[$fld1][]=$joinBdata;
						}
					} else {
						$joinAdata[$fld1a] = $row1->$fld1a;
					}
				}
				$this->g1[$tbl1][]=$joinAdata; // [0]だけだが配列にする。
			}
		}
		$this->g1['HSiayaMr2s'] = []; // 参照用エリアへ格納する。更新時には無視される。
		if ($h_siori_mr->aycd != '') {
			$this->HeadGetAya($h_siori_mr);
		}
		$this->g1['htme'] = $this->g1['htkb']==1?'無地':'柄';
		$this->g1['hyme'] = $this->g1['hykb']==2?'共通':($this->g1['hykb']==1?'無地':'柄');
		$this->g1['htkg'] = ['',];
		$this->g1['hykg'] = ['',];
		$i1=0; // 始めは0
		$i2=0; // 始めは0
		foreach ($this->g1['HSihaireMrs'] as $mr) {
			if ($mr['tykb'] == 1) {
				$this->g1['htkg'][$i1++] = $mr['kigo'];
			} else if ($mr['tykb'] == 2) {
				$this->g1['hykg'][$i2++] = $mr['kigo'];
			}
		}
		$this->g1['EHq'] = [];
		foreach ($this->g1['HSiitoMrs'] as $HSiitoMr) {
			$s = self::J2N[$HSiitoMr['tjun']] - 1;
			$ss = self::J2N[$HSiitoMr['yjun']] - 1;
			if ($s >= 0 || $ss >= 0) {
				$this->g1['EHq'][$s] = [];
				if ($s >= 0) {
					$this->g1['EHq'][$s]['ttni'] = $HSiitoMr['ttni'];
					$this->g1['EHq'][$s]['thon'] = $HSiitoMr['thon'];
					$this->g1['EHq'][$s]['douk'] = $HSiitoMr['douk'];
					$this->g1['EHq'][$s]['kais'] = $HSiitoMr['kais'];
				}
				if ($ss >= 0) {
					$this->g1['EHq'][$ss]['ytni'] = $HSiitoMr['ytni'];
					$this->g1['EHq'][$ss]['yhon'] = $HSiitoMr['yhon'];
				}
			}
		}
	}
	// *****************************************************************
	private function HeadGetAya($h_siori_mr) { // リンク先のコードによる綾通しを配列g1へ追加
										$this->g1['point_1'][] = "HeadGetAya";
	// *----------------------------------------------------------------
	//	試織コードがAYADではじまり＋枚数＋綾通し区分をキーとする試織マスタに綾通し名を入れ、そのhasmanyの綾通しマスタに綾通し記号をいれる。
		if ($h_siori_mr->aycd == 9) { // 組織図による綾通し順を参照する
			$cd = $this->g1['socd'];
		} else {
			$cd = 'AYAD'.sprintf('%02d',$h_siori_mr->ayma).$h_siori_mr->aycd;
		}
		$h_siori_aya_mr = HSioriMrs::findfirst([
			'conditions' => ' cd = ?1 ',
			'bind' => [1 => $cd],
		]);
		if ($h_siori_aya_mr) {
			$this->g1['ayho'] = $h_siori_aya_mr->ayho;
			$this->g1['ayme'] = $h_siori_aya_mr->ayme;
			foreach ($h_siori_aya_mr->HSiayaMrs as $h_siaya_mr) {
				$this->g1['HSiayaMr2s'][] = ['cd'=>$h_siaya_mr->cd,'kigo'=>$h_siaya_mr->kigo];
			}
		}
	}
	// *****************************************************************
	private function HeadCrtJoins() { // リンク先のデータエリアを配列g1へ追加
	// *----------------------------------------------------------------
		foreach (self::H_SIORI_JOINS as $tbl1=>$fld1s) {
			if (!array_key_exists($tbl1, $this->g1)) {
				$this->g1[$tbl1] = [];
			}
		}
		if (!array_key_exists('EHq', $this->g1)) {
			$this->g1['EHq'] = [];
		}
	}
	// *****************************************************************
	private function HeadNext() { // 次へ押下表示用
	// *----------------------------------------------------------------
	    $h_siori_mr = HSioriMrs::findfirst([
	        'order' => 'cd',
	        'conditions' => ' cd > ?1 ',
	        'bind' => [1 => $this->g1['cd']],
		]);

		if ( $h_siori_mr ) {
			$this->HeadGetSub($h_siori_mr);
		} else {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "次の試織番号は登録されていません。".$this->g1['cd'];
		}
	}

	// *****************************************************************
	private function HeadBack() { // 次へ押下表示用
	// *----------------------------------------------------------------
	    $h_siori_mr = HSioriMrs::findfirst([
	        'order' => 'cd DESC',
	        'conditions' => ' cd < ?1 ',
	        'bind' => [1 => $this->g1['cd']],
		]);

		if ( $h_siori_mr ) {
			$this->HeadGetSub($h_siori_mr);
		} else {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "前の試織番号は登録されていません。";
		}
	}

	// *****************************************************************
	private function BodyCheck() { // ボディチェック …BodyCheck
										$this->g1['point_1'][] = "B-CHECK";
	// *----------------------------------------------------------------
		$this->sekkeibi_check(); // ｾｯｹｲﾋﾞ-ﾁｪｯｸ
		if ($this->g1['errflg'] == 0) {
			$this->kaiteibiNyuuryoku_check(); // ｶｲﾃｲﾋﾞﾆｭｳﾘｮｸ-ﾁｪｯｸ
		}
		if ($this->g1['errflg'] == 0) {
			$this->kaiteibiHikaku_check(); // ｶｲﾃｲﾋﾞﾋｶｸ-ﾁｪｯｸ
		}
		if ($this->g1['errflg'] == 0) {
			$this->seikeiHaba_check(); // ｾｲｹｲﾊﾊﾞ-ﾁｪｯｸ
		}
		if ($this->g1['errflg'] == 0) {
			$this->siyoIto_check(); // ｼﾖｳｲﾄ-ﾁｪｯｸ
		}
		if ($this->g1['errflg'] == 0) {
			$this->chuiJikoJufuku_check(); // ﾁｭｳｲｼﾞｺｳｼﾞｭｳﾌｸ-ﾁｪｯｸ
		}
		if ($this->g1['errflg'] == 0) {
			$this->chuiTaishoKensu_check(); // ﾁｭｳｲﾀｲｼｮｳｹﾝｽｳ-ﾁｪｯｸ
		}
		for ($i = 0; $i < count($this->g1['HSichuiMrs']); $i++) {
			if ($this->g1['errflg'] == 1) { break; }
			$this->chuiTaisho_check($i); // ﾁｭｳｲﾀｲｼｮｳ-ﾁｪｯｸ
			if ($this->g1['errflg'] == 0) {
				$this->chuiNaiyou_check($i); // ﾁｭｳｲﾅｲﾖｳ-ﾁｪｯｸ
			}
		}
		if ($this->g1['errflg'] == 0) {
			$this->gentanni_keisan(); // ｹﾞﾝﾀﾝｲ-ｹｲｻﾝ
		}
		if ($this->g1['errflg'] == 0) {
			$this->konritu_keisan(); // ｺﾝﾘﾂ-ｹｲｻﾝ
		}
		if ($this->g1['errflg'] == 0) {
			$this->iryo_disp();
		}
	}
	const J2N = [''=>0,'A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6,'G'=>7,'H'=>8, 'X'=>0];
	const N2ALPHA = ['','A','B','C','D','E','F','G','H'];
	// *****************************************************************
	private function iryo_disp() {
	// *----------------------------------------------------------------
		for ($i = 0; $i < count($this->g1['HSiitoMrs']); $i++) {
			$s = self::J2N[$this->g1['HSiitoMrs'][$i]['tjun']] - 1;
			$ss = self::J2N[$this->g1['HSiitoMrs'][$i]['yjun']] - 1;
			if ( $this->g1['snag'] < 20) { // 試織なら糸量を表示する
				switch ($this->g1['HSiitoMrs'][$i]['yjun']) {
					case "X":
					case "":
						switch ($this->g1['HSiitoMrs'][$i]['tjun']) {
							case "X":
							case "":
								$this->g1['HSiitoMrs'][$i]['iryo'] = 0; // ｽｳﾘｮｳ
								break;
							default:
								$this->g1['HSiitoMrs'][$i]['iryo'] = round($this->g1['EHq'][$s]['ttni'] * $this->g1['snag'] * 5, 0); // ｽｳﾘｮｳ
								break;
						}
						break;
					default:
						switch ($this->g1['HSiitoMrs'][$i]['tjun']) {
							case "X":
							case "":
								$this->g1['HSiitoMrs'][$i]['iryo'] = round($this->g1['EHq'][$ss]['ytni'] * $this->g1['snag'] * 5, 0); // ｽｳﾘｮｳ
								break;
							default:
								$this->g1['HSiitoMrs'][$i]['iryo'] = round(($this->g1['EHq'][$s]['ttni'] + $this->g1['EHq'][$ss]['ytni']) * $this->g1['snag'] * 5, 0); // ｽｳﾘｮｳ
								break;
						}
						break;
				}
			} else { // ↓現反の場合経本数を表示する
				switch ($this->g1['HSiitoMrs'][$i]['tjun']) {
					case "X":
					case "":
						$this->g1['HSiitoMrs'][$i]['iryo'] = 0; // ｽｳﾘｮｳ
						break;
					default:
						if ( $this->g1['anou'] == "Y" && $this->g1['HSiitoMrs'][$i]['iryo'] > 0) {
							// $this->g1['HSiitoMrs'][$i]['iryo'] = $this->g1['HSiitoMrs'][$i]['ondo'] * 1000 + $this->g1['HSiitoMrs'][$i]['time']; // ｽｳﾘｮｳ
						} else {
							$this->g1['HSiitoMrs'][$i]['iryo'] = round(($this->g1['jiho'] + $this->g1['miho'] * 2) * $this->g1['EHq'][$s]['thon'] / $this->g1['htho'], 0); // 経配列本数…htho
						}
						break;
				}
			}
		}

	}
	// *****************************************************************
	private function sekkeibi_check() { // ｾｯｹｲﾋﾞ-ﾁｪｯｸ
	// *----------------------------------------------------------------
		list($Y, $m, $d) = explode('-', $this->g1['symd']);
		if (!checkdate($m, $d, $Y)) {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "設計日がおかしい！";
			$this->g1['errfld'] = "Symd";
			return;
		}
		$sdate = new DateTime($this->g1['symd']);
		$today = new DateTime();
		$saday = $sdate->diff($today);  
		if ($saday->invert == 1) { // 負の場合1) {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "設計日が未来でおかしい！";
			$this->g1['errfld'] = "Symd";
		}
	}
	// *****************************************************************
	private function kaiteibiNyuuryoku_check() { // ｶｲﾃｲﾋﾞﾆｭｳﾘｮｸ-ﾁｪｯｸ
	// *----------------------------------------------------------------
		if ( $this->g1['skbn'] == '1' && $this->g1['kymd'] != '') {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "登録の場合は改訂日を入力できません！";
			$this->g1['errfld'] = "Kymd";
		}
	}
	// *****************************************************************
	private function kaiteibiHikaku_check() { // ｶｲﾃｲﾋﾞﾋｶｸ-ﾁｪｯｸ
	// *----------------------------------------------------------------
		if ( $this->g1['skbn'] == '2') {
			if ( $this->g1['kymd'] == '') {
	// *            ↓設計日が一週間以内なら改訂日無しでもOK
				$sdate = new DateTime($this->g1['symd']);
				$today = new DateTime();
				$saday = $today->diff($sdate);
				if ($saday->days > 7) {
					$this->g1['errflg'] = 1;
					$this->g1['emsg'] = "改訂日を入力して下さい";
					$this->g1['errfld'] = "Kymd";
					return;
				}
			} else {
				list($Y, $m, $d) = explode('-', $this->g1['kymd']);
				if (!checkdate($m, $d, $Y)) {
					$this->g1['errflg'] = 1;
					$this->g1['emsg'] = "改訂日がおかしい！";
					$this->g1['errfld'] = "Kymd";
					return;
				}
				$hdate = new DateTime($this->g1['kymd']);
				$today = new DateTime();
				$saday = $hdate->diff($today);  
				if ($saday->invert == 1) { // 負の場合1) {
					$this->g1['errflg'] = 1;
					$this->g1['emsg'] = "改訂日が未来でおかしい！";
					$this->g1['errfld'] = "Symd";
				}
				$sdate = new DateTime($this->g1['symd']);
				$saday = $sdate->diff($hdate);
				if ($saday->invert == 1) { // 負の場合1
					$this->g1['errflg'] = 1;
					$this->g1['emsg'] = "改訂日が設計日前！";
					$this->g1['errfld'] = "Kymd";
					return;
				}
			}
		}
	}
	// *****************************************************************
	private function seikeiHaba_check() { // ｾｲｹｲﾊﾊﾞ-ﾁｪｯｸ
	// *----------------------------------------------------------------
		if ( !$this->g1['shab']) {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "整経巾を入力してください！";
			$this->g1['errfld'] = "Shab";
		}
	}
	// *****************************************************************
	private function siyoIto_check() { // ｼﾖｳｲﾄ-ﾁｪｯｸ
	// *----------------------------------------------------------------
		for ($i = 0; $i < count($this->g1['HSiitoMrs']); $i++) { // いらないかも？
			$this->g1['HSiitoMrs'][$i]['cd'] = $this->g1['HSiitoMrs'][$i]['cd']??'';
			$this->g1['HSiitoMrs'][$i]['imei'] = $this->g1['HSiitoMrs'][$i]['imei']??'';
			$this->g1['HSiitoMrs'][$i]['tjun'] = $this->g1['HSiitoMrs'][$i]['tjun']??'';
			$this->g1['HSiitoMrs'][$i]['yjun'] = $this->g1['HSiitoMrs'][$i]['yjun']??'';
			$this->g1['HSiitoMrs'][$i]['denl'] = $this->g1['HSiitoMrs'][$i]['denl']??0;
			$this->g1['HSiitoMrs'][$i]['ondo'] = $this->g1['HSiitoMrs'][$i]['ondo']??0;
			$this->g1['HSiitoMrs'][$i]['time'] = $this->g1['HSiitoMrs'][$i]['time']??0;
			$this->g1['HSiitoMrs'][$i]['tnor'] = $this->g1['HSiitoMrs'][$i]['tnor']??0;
			$this->g1['HSiitoMrs'][$i]['ynor'] = $this->g1['HSiitoMrs'][$i]['ynor']??0;
			$this->g1['HSiitoMrs'][$i]['iryo'] = $this->g1['HSiitoMrs'][$i]['iryo']??0;
		}
		for ($s = 0; $s < 8; $s++) {
			if ($this->g1['errflg'] == 1) { break; }
			if (!$this->g1['EHq'][$s]) {
				$this->g1['EHq'][$s] = ['ttni'=>0,'ytni'=>0,'thon'=>0,'douk'=>'','kais'=>0,'yhon'=>0];
			}
			$i = 0;
			for ($i = 0; $i < count($this->g1['HSiitoMrs']); $i++) {
				if ($this->g1['EHq'][$s]['thon'] == 0 && $this->g1['EHq'][$s]['yhon'] == 0
					|| self::J2N[$this->g1['HSiitoMrs'][$i]['tjun']] - 1 == $s && $this->g1['EHq'][$s]['thon'] > 0
					|| self::J2N[$this->g1['HSiitoMrs'][$i]['yjun']] - 1 == $s && $this->g1['EHq'][$s]['yhon'] > 0) {
					break;
				}
			}
			if ( $i >= count($this->g1['HSiitoMrs'])) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "糸".self::N2ALPHA[$s+1]."は配列にあるが糸名がない！";
			} else {
				if ( $this->g1['snag'] >= 20 && $this->g1['HSiitoMrs'][$i]['cd'] == '') {
					$this->g1['errflg'] = 1;
					$this->g1['emsg'] = "糸".self::N2ALPHA[$s+1]."は糸コードが無い！";
				}
			}
		}
	}
	// *****************************************************************
	private function chuiJikoJufuku_check() { // ﾁｭｳｲｼﾞｺｳｼﾞｭｳﾌｸ-ﾁｪｯｸ
	// *----------------------------------------------------------------
		for ($i= 0; $i < count($this->g1['HSichuiMrs']); $i++) {
			$this->g1['HSichuiMrs'][$i]['kbn'] = $this->g1['HSichuiMrs'][$i]['kbn']??'';
			$this->g1['HSichuiMrs'][$i]['tais'] = $this->g1['HSichuiMrs'][$i]['tais']??'';
			$this->g1['HSichuiMrs'][$i]['eda'] = $this->g1['HSichuiMrs'][$i]['eda']??0;
			$this->g1['HSichuiMrs'][$i]['chui'] = $this->g1['HSichuiMrs'][$i]['chui']??'';
			if ($this->g1['errflg'] == 1) { break; }
			if ($this->g1['HSichuiMrs'][$i]['tais'] != '') { // ﾁｭｳｲﾀｲｼｮｳ …chuiTaisho
				for ($j = $i + 1; $j < count($this->g1['HSichuiMrs']); $j++) {
					if ($this->g1['errflg'] == 1) { break; }
					if ( $this->g1['HSichuiMrs'][$i]['tais'] == $this->g1['HSichuiMrs'][$j]['tais']
						&& $this->g1['HSichuiMrs'][$i]['chui'] == $this->g1['HSichuiMrs'][$j]['chui']
						&& $this->g1['HSichuiMrs'][$j]['chui'] != '') {
						// ﾁｭｳｲﾀｲｼｮｳ …chuiTaisho // ﾁｭｳｲﾀｲｼｮｳ …chuiTaisho // ﾁｭｳｲﾅｲﾖｳ …chuiNaiyou // ﾁｭｳｲﾅｲﾖｳ …chuiNaiyou // ﾁｭｳｲﾅｲﾖｳ …chuiNaiyou
						$this->g1['errflg'] = 1;
						$this->g1['emsg'] = "注意事項重複！".$i.":".$j;
					}
				}
			}
		}
	}
	private $tbl_chuiTaisho = [
		'製織注意'=>['A',0],
		'製織状況'=>['B',0],
		'加工注意'=>['C',0],
		'ビーカー'=>['D',0],
		'綾通し順'=>['E',0],
		'組織図'=>  ['F',0],
		'経糸配列'=>['G',0],
		'緯糸配列'=>['H',0],
		'糸使い'=>['I',0],
		'耳糸配列'=>['J',0]]; // ﾁｭｳｲｸﾌﾞﾝ,件数チェック用

	// *****************************************************************
	private function chuiTaishoKensu_check() { // ﾁｭｳｲﾀｲｼｮｳｹﾝｽｳ-ﾁｪｯｸ
	// *----------------------------------------------------------------
		foreach ($this->tbl_chuiTaisho as $key) {
			$this->tbl_chuiTaisho[$key][1] = 0; // 計数クリア
		}
		for ($j = 0; $j < count($this->g1['HSichuiMrs']); $j++) {
			if ( array_key_exists($this->g1['HSichuiMrs'][$j]['tais'], $this->tbl_chuiTaisho)) { // ﾁｭｳｲﾀｲｼｮｳ …chuiTaisho // TBL-ﾁｭｳｲﾀｲｼｮｳ …tbl_chuiTaisho
				$this->g1['HSichuiMrs'][$j]['kbn'] = $this->tbl_chuiTaisho[$this->g1['HSichuiMrs'][$j]['tais']][0]; // 注意区分A～I
				$this->tbl_chuiTaisho[$this->g1['HSichuiMrs'][$j]['tais']][1]++; // 計数
				if ( $this->tbl_chuiTaisho[$this->g1['HSichuiMrs'][$j]['tais']][1] > 9) {
					$this->g1['errflg'] = 1;
					$this->g1['emsg'] = "注意対象件数オーバー！".(1+$j).":".$this->g1['HSichuiMrs'][$j]['tais'];
					return;
				}
			} else {
				if ($this->g1['HSichuiMrs'][$j]['tais']) {
					$this->g1['errflg'] = 1;
					$this->g1['emsg'] = "注意対象の間違い！".(1+$j).":".$this->g1['HSichuiMrs'][$j]['tais'];
					return;
				}
			}
		}
	}
	// *****************************************************************
	private function chuiTaisho_check($i) { // ﾁｭｳｲﾀｲｼｮｳ-ﾁｪｯｸ
	// *----------------------------------------------------------------
		if ( $this->g1['HSichuiMrs'][$i]['chui'] != '' && $this->g1['HSichuiMrs'][$i]['tais'] == '') { // ﾁｭｳｲﾅｲﾖｳ …chuiNaiyou // ﾁｭｳｲﾀｲｼｮｳ …chuiTaisho
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "注意対象を入力してください！";
		}
	}
	// *****************************************************************
	private function chuiNaiyou_check($i) { // ﾁｭｳｲﾅｲﾖｳ-ﾁｪｯｸ
	// *----------------------------------------------------------------
		if ( $this->g1['HSichuiMrs'][$i]['tais'] != '' && $this->g1['HSichuiMrs'][$i]['chui'] == '') { // ﾁｭｳｲﾀｲｼｮｳ …chuiTaisho // ﾁｭｳｲﾅｲﾖｳ …chuiNaiyou
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "注意内容を入力してください！";
		}
	}
	// *****************************************************************
	private function gentanni_keisan() { // ｹﾞﾝﾀﾝｲ-ｹｲｻﾝ
	// *----------------------------------------------------------------
		for ($i = 0; $i < count($this->g1['HSiitoMrs']); $i++) {
			if ( $this->g1['HSiitoMrs'][$i]['tjun'] >= 'A' && $this->g1['HSiitoMrs'][$i]['tjun'] <='H') {
				$s = self::J2N[$this->g1['HSiitoMrs'][$i]['tjun']] - 1;
				if ( $this->g1['snag'] < 20) {
					if ( $this->g1['EHq'][$s]['thon'] > 0
						&& $this->g1['htho'] > 0
						&& $this->g1['jiho'] > 0
						&& $this->g1['HSiitoMrs'][$i]['denl'] > 0) {
						$this->g1['EHq'][$s]['ttni'] = round($this->g1['EHq'][$s]['thon'] * ($this->g1['jiho'] + $this->g1['miho'] * 2)
							* $this->g1['HSiitoMrs'][$i]['denl'] / $this->g1['htho'] / 9000, 1);
					} else {
						$this->g1['EHq'][$s]['ttni'] = 0;
					}
				} else {
					$this->g1['EHq'][$s]['ttni'] = round(($this->g1['HSiitoMrs'][$i]['ondo'] * 1000 + $this->g1['HSiitoMrs'][$i]['time'])
						 * $this->g1['HSiitoMrs'][$i]['denl'] / 9000, 1);
				}
			}
			if ( $this->g1['HSiitoMrs'][$i]['yjun'] >= 'A' && $this->g1['HSiitoMrs'][$i]['yjun'] <= 'H') {
				$s = self::J2N[$this->g1['HSiitoMrs'][$i]['yjun']];
				if ( $this->g1['EHq'][$s]['yhon'] > 0
					&& $this->g1['hyho'] > 0
					&& $this->g1['uti'] > 0
					&& $this->g1['shab'] > 0
					&& $this->g1['HSiitoMrs'][$i]['denl'] > 0) {
					$this->g1['EHq'][$s]['ytni'] = round($this->g1['EHq'][$s]['yhon'] * $this->g1['uti'] * 2 * $this->g1['shab']
						/ $this->g1['hyho'] * $this->g1['HSiitoMrs'][$i]['denl'] / 9000, 1);
				} else {
					$this->g1['EHq'][$s]['ytni'] = 0;
				}
			}
		}
	// *
		$this->genryou_bunkai(); // ｹﾞﾝﾘｮｳ-ﾌﾞﾝｶｲ
	}

	private $ueDamaCho = 0; // ｳｴﾀﾞﾏﾁｮｳ
	private $oriRos = 0; // ｵﾘﾛｽ
	private $hoseiTanni = 0; // ﾎｾｲﾀﾝｲ
	private $gentanniKei = 0; // ｹﾞﾝﾀﾝｲｹｲ
	// ｹﾞﾝﾀﾝｲ-TBL
	private $keisanIti = []; // COBOLGではｹﾞﾝﾀﾝｲ-TBL内
	private $itoNo = []; // COBOLGではｹﾞﾝﾀﾝｲ-TBL内
	private $gentanni = []; // COBOLGではｹﾞﾝﾀﾝｲ-TBL内
	// *****************************************************************
	private function genryou_bunkai() { // ｹﾞﾝﾘｮｳ-ﾌﾞﾝｶｲ
	// *----------------------------------------------------------------
		if ($this->g1['snag'] >= 20) {
			$this->ueDamaCho = 1 * $this->g1['inou']; // 依頼納期欄を上玉長とする。
			$this->oriRos = 1 * $this->g1['tnou']; // 整経納期欄を織ロスとする。
		}
		for ($i = 0; $i < count($this->g1['HSigenMrs']); $i++) {
			$this->g1['HSigenMrs'][$i]['gito'] = $this->g1['HSigenMrs'][$i]['gito']??'';
			$this->g1['HSigenMrs'][$i]['kota'] = $this->g1['HSigenMrs'][$i]['kota']??'';
			$this->g1['HSigenMrs'][$i]['kik1'] = $this->g1['HSigenMrs'][$i]['kik1']??0;
			$this->g1['HSigenMrs'][$i]['kik2'] = $this->g1['HSigenMrs'][$i]['kik2']??0;
			$this->g1['HSigenMrs'][$i]['ktni'] = $this->g1['HSigenMrs'][$i]['ktni']??'';
			$this->g1['HSigenMrs'][$i]['biko'] = $this->g1['HSigenMrs'][$i]['biko']??'';
			$this->g1['HSigenMrs'][$i]['gtni'] = 0;
		}
		for ($i = 0; $i < count($this->g1['HSinenMrs']); $i++) {
			$this->g1['HSinenMrs'][$i]['tjun'] = $this->g1['HSinenMrs'][$i]['tjun']??'';
			$this->g1['HSinenMrs'][$i]['yjun'] = $this->g1['HSinenMrs'][$i]['yjun']??'';
			$this->g1['HSinenMrs'][$i]['ito1'] = $this->g1['HSinenMrs'][$i]['ito1']??0;
			$this->g1['HSinenMrs'][$i]['hon1'] = $this->g1['HSinenMrs'][$i]['hon1']??0;
			$this->g1['HSinenMrs'][$i]['gen1'] = $this->g1['HSinenMrs'][$i]['gen1']??0;
			$this->g1['HSinenMrs'][$i]['ito2'] = $this->g1['HSinenMrs'][$i]['ito2']??0;
			$this->g1['HSinenMrs'][$i]['hon2'] = $this->g1['HSinenMrs'][$i]['hon2']??0;
			$this->g1['HSinenMrs'][$i]['gen2'] = $this->g1['HSinenMrs'][$i]['gen2']??0;
			$this->g1['HSinenMrs'][$i]['kote'] = $this->g1['HSinenMrs'][$i]['kote']??0;
			$this->g1['HSinenMrs'][$i]['hoko'] = $this->g1['HSinenMrs'][$i]['hoko']??'';
			$this->g1['HSinenMrs'][$i]['yori'] = $this->g1['HSinenMrs'][$i]['yori']??0;
			$this->g1['HSinenMrs'][$i]['kbn1'] = $this->g1['HSinenMrs'][$i]['kbn1']??'';
			$this->g1['HSinenMrs'][$i]['kbn2'] = $this->g1['HSinenMrs'][$i]['kbn2']??'';
			$this->g1['HSinenMrs'][$i]['kako'] = $this->g1['HSinenMrs'][$i]['kako']??'';
			$this->g1['HSinenMrs'][$i]['kohi'] = $this->g1['HSinenMrs'][$i]['kohi']??0;
			$this->g1['HSinenMrs'][$i]['denl'] = $this->g1['HSinenMrs'][$i]['denl']??0;
			$this->g1['HSinenMrs'][$i]['gtni'] = 0;
		}
		$this->gentanniKei = 0; // ｹﾞﾝﾀﾝｲｹｲ
		for ($i = 0; $i < count($this->g1['HSinenMrs']); $i++) {

			if ( $this->g1['HSinenMrs'][$i]['tjun'] || $this->g1['HSinenMrs'][$i]['yjun']) {
				// ｹﾞﾝﾀﾝｲ-TBL
				$this->keisanIti = [0,0,0,0,0,0,0,0,0,0]; // COBOLGでは10個
				$this->itoNo = [0,0,0,0,0,0,0,0,0,0]; // 〃
				$this->gentanni = [0,0,0,0,0,0,0,0,0,0]; // 〃
				$j = 0;
				$this->keisanIti[$j]++; // ｹｲｻﾝｲﾁ
				$this->itoNo[$j] = $i + 31; // ｲﾄNO
				if ( $this->g1['HSinenMrs'][$i]['tjun'] >= "A" && $this->g1['HSinenMrs'][$i]['tjun'] <= "H") {
					$s = self::J2N[$this->g1['HSinenMrs'][$i]['tjun']] - 1;
					$this->hoseiTanni = 1*$this->g1['EHq'][$s]['ttni']; // ﾎｾｲﾀﾝｲ
					$k = 0;
					for ($k = 0; $k < 5; $k++) {
						if ($this->ueDamaCho == 0 ||
							substr($this->g1['snou'], $k, 1) == $this->g1['HSinenMrs'][$i]['tjun']) {
							break ;
						}
					}
					if ( $this->ueDamaCho > 0 && $k < 5) { // ｳｴﾀﾞﾏﾁｮｳ …ueDamaCho
						$this->hoseiTanni = 0.005 + $this->hoseiTanni * 1.03 * $this->ueDamaCho / $this->g1['snag'];
						// ﾎｾｲﾀﾝｲ …$this->hoseiTanni // ﾎｾｲﾀﾝｲ …$this->hoseiTanni // ｳｴﾀﾞﾏﾁｮｳ …ueDamaCho
					} else {
						$this->hoseiTanni = 0.005 + $this->hoseiTanni * 1.03;
						// ﾎｾｲﾀﾝｲ …$this->hoseiTanni // ﾎｾｲﾀﾝｲ …$this->hoseiTanni
					}
					$this->g1['HSinenMrs'][$i]['gtni'] = 1*$this->g1['HSinenMrs'][$i]['gtni'] + $this->hoseiTanni;
					$this->gentanniKei += $this->hoseiTanni;
					$this->gentanni[$j] += $this->hoseiTanni; // ﾎｾｲﾀﾝｲ …$this->hoseiTanni // ｹﾞﾝﾀﾝｲｹｲ …gentanni // ｹﾞﾝﾀﾝｲ …gentanni
				}
				if ( $this->g1['HSinenMrs'][$i]['yjun'] >= "A" && $this->g1['HSinenMrs'][$i]['yjun'] <= "H") {
					$s = self::J2N[$this->g1['HSinenMrs'][$i]['yjun']] - 1;
					$this->hoseiTanni = 1*$this->g1['EHq'][$s]['ytni']; // ﾎｾｲﾀﾝｲ …$this->hoseiTanni
					if ( $this->g1['snag'] >= 20) {
						$this->hoseiTanni = $this->hoseiTanni * ( 1 + $this->oriRos / 100 ) * $this->g1['knag'] / $this->g1['snag'] + 0.005;
						// ﾎｾｲﾀﾝｲ …$this->hoseiTanni // ﾎｾｲﾀﾝｲ …$this->hoseiTanni // ｵﾘﾛｽ …$this->oriRos
					}
					$this->g1['HSinenMrs'][$i]['gtni'] += $this->hoseiTanni;
					$this->gentanniKei += $this->hoseiTanni;
					$this->gentanni[$j] += $this->hoseiTanni; // ﾎｾｲﾀﾝｲ …$this->hoseiTanni // ｹﾞﾝﾀﾝｲｹｲ …gentanni // ｹﾞﾝﾀﾝｲ …gentanni
				}
				$l = $i;
				while ( $this->keisanIti[2] <= 2) { // ｹｲｻﾝｲﾁ …$this->keisanIti
					$j++;
					$this->keisanIti[$j]++; // ｹｲｻﾝｲﾁ …$this->keisanIti
					switch ( true) {
						case  $this->keisanIti[$j] == 1 && $this->g1['HSinenMrs'][$l]['ito1'] < 31: // ｹｲｻﾝｲﾁ …$this->keisanIti
							$this->itoNo[$j] = $this->g1['HSinenMrs'][$l]['ito1']; // ｲﾄNO …itoNo
							$this->gentanni[$j] = $this->g1['HSinenMrs'][$l]['gen1'] * $this->gentanni[$j - 1]; // ｹﾞﾝﾀﾝｲ …gentanni // ｹﾞﾝﾀﾝｲ …gentanni
							$this->gentanniSet($j); // ｹﾞﾝﾀﾝｲSET …gentanniSet
							$j = $j - 1;
							break;
						case  $this->keisanIti[$j] == 1 && $this->g1['HSinenMrs'][$l]['ito1'] >= 31: // ｹｲｻﾝｲﾁ …$this->keisanIti
							$this->itoNo[$j] = $this->g1['HSinenMrs'][$l]['ito1']; // ｲﾄNO …itoNo
							$this->gentanni[$j] = $this->g1['HSinenMrs'][$l]['gen1'] * $this->gentanni[$j - 1]; // ｹﾞﾝﾀﾝｲ …gentanni // ｹﾞﾝﾀﾝｲ …gentanni
							$l = $this->itoNo[$j] - 31; // ｲﾄNO …itoNo
							$this->gentanniSet($j); // ｹﾞﾝﾀﾝｲSET …gentanniSet
							break;
						case  $this->keisanIti[$j] == 2 && $this->g1['HSinenMrs'][$l]['ito2'] < 31: // ｹｲｻﾝｲﾁ …$this->keisanIti
							$this->itoNo[$j] = $this->g1['HSinenMrs'][$l]['ito2']; // ｲﾄNO …itoNo
							$this->gentanni[$j] = $this->g1['HSinenMrs'][$l]['gen2'] * $this->gentanni[$j - 1]; // ｹﾞﾝﾀﾝｲ …gentanni // ｹﾞﾝﾀﾝｲ …gentanni
							$this->gentanniSet($j); // ｹﾞﾝﾀﾝｲSET …gentanniSet
							$j = $j - 1;
							break;
						case  $this->keisanIti[$j] == 2 && $this->g1['HSinenMrs'][$l]['ito2'] >= 31: // ｹｲｻﾝｲﾁ …$this->keisanIti
							$this->itoNo[$j] = $this->g1['HSinenMrs'][$l]['ito2']; // ｲﾄNO …itoNo
							$this->gentanni[$j] = $this->g1['HSinenMrs'][$l]['gen2'] * $this->gentanni[$j - 1]; // ｹﾞﾝﾀﾝｲ …gentanni // ｹﾞﾝﾀﾝｲ …gentanni
							$this->gentanniSet($j); // ｹﾞﾝﾀﾝｲSET …gentanniSet
							$l = $this->itoNo [$j] - 31; // ｲﾄNO …itoNo
							break;
						case  $this->keisanIti[$j] == 3 && $j > 2: // ｹｲｻﾝｲﾁ …$this->keisanIti
							$this->keisanIti[$j] = 0; // ｹｲｻﾝｲﾁ …$this->keisanIti
							$j = $j - 2;
							$l = $this->itoNo[$j] - 31; // ｲﾄNO …itoNo
							break;
					}
				}
			}
		}
		if ( $this->gentanniKei > 0
			&& $this->g1['ahab'] > 0
			&& $this->g1['auti'] > 0
			&& $this->g1['uti'] > 0
			&& $this->g1['tiji'] > 0) { // ｹﾞﾝﾀﾝｲｹｲ …gentanniKei
			if ( $this->g1['snag'] < 20) {
				$this->g1['itry'] = round($this->gentanniKei * 150 / $this->g1['ahab'] * 52 * $this->g1['auti'] / $this->g1['uti'] * 100 / $this->g1['tiji'] / 1000 * 1.05, 2); // ｹﾞﾝﾀﾝｲｹｲ …gentanni
			} else {
				$this->g1['itry'] = round($this->gentanniKei * $this->g1['snag'] / 1000, 2); // ｹﾞﾝﾀﾝｲｹｲ …gentanniKei
			}
		} else {
			$this->g1['itry'] = 0;
		}

	}
	// *****************************************************************
	private function gentanniSet($j) { // ｹﾞﾝﾀﾝｲSET
	// *----------------------------------------------------------------
		if ( $this->itoNo[$j] < 31) { // case  01 THRU 18:
			$m = $this->itoNo[$j] - 1; // ｲﾄNO …itoNo
			$this->g1['HSigenMrs'][$m]['gtni'] += $this->gentanni[$j]; // ｹﾞﾝﾀﾝｲ …gentanni
		} else { // case  31 THRU 66:
			$m = $this->itoNo[$j] - 31; // ｲﾄNO …itoNo
			$this->g1['HSinenMrs'][$m]['gtni'] += $this->gentanni[$j]; // ｹﾞﾝﾀﾝｲ …gentanni
		}
	}
	// *****************************************************************
	private function konritu_keisan() { // ｺﾝﾘﾂ-ｹｲｻﾝ
	// *----------------------------------------------------------------
		$j = 0;
		$i = 0;
		$siyoRyo = 0; // ｼﾖｳﾘｮｳ
		$hinsituRyo = []; // ﾋﾝｼﾂﾘｮｳ
		$hinsituRyoKei = 0;
		$konritu = [];
		for ($i = 0; $i < 9; $i++) {
			// konrituMeisai[$i] = 0; // ｺﾝﾘﾂﾒｲｻｲ …konrituMeisai
			$konritu[$i]['kon'] = '';
			$konritu[$i]['rit'] = 0;
			$hinsituRyo[$i] = 0; // ﾋﾝｼﾂﾘｮｳクリア
		}
		for ($i = 0; $i < count($this->g1['HSigenMrs']); $i++) {
			for ($k = 0; $k < count($this->g1['HSigenMrs'][$i]['HSigenKonMrs']); $k++) {
				if ( $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$k]['kon'] != '') {
					$siyoRyo = $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$k]['rit'] * $this->g1['HSigenMrs'][$i]['gtni'] / 100; // ｼﾖｳﾘｮｳ …siyoRyo
					for ($j = 0; $j < 9; $j++) { // ｲﾄﾂｶｲ …$konritu // ｲﾄﾂｶｲ …$konritu
						if ($konritu[$j]['kon'] == $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$k]['kon']
							|| $konritu[$j]['kon'] == '') {
							break;
						}
					}
					$konritu[$j]['kon'] = $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$k]['kon']; // ｲﾄﾂｶｲ …$konritu
					$hinsituRyo[$j] += $siyoRyo; // ｼﾖｳﾘｮｳ …siyoRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo
					$hinsituRyoKei += $siyoRyo; // ｼﾖｳﾘｮｳ …siyoRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo
				}
			}
		}
		$konrituKei = 0; // ｺﾝﾘﾂｹｲ …konrituKei
		for ($i = 0; $i < 9; $i++) {
			$konritu[$i]['rit'] = round($hinsituRyo[$i] * 100 / $hinsituRyoKei ,0); // ｺﾝﾘﾂ …konritu // ﾋﾝｼﾂﾘｮｳ …hinsituRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo // ﾋﾝｼﾂﾘｮｳ …hinsituRyo
			if ( $konritu[$i]['kon'] != '' && $konritu[$i]['rit'] == 0) { // ｲﾄﾂｶｲ …$konritu // ｺﾝﾘﾂ …konritu
				$konritu[$i]['rit'] = 1; // ｺﾝﾘﾂ 最小1%
			}
			$konrituKei += $konritu[$i]['rit']; // ｺﾝﾘﾂ …konritu // ｺﾝﾘﾂｹｲ …konrituKei
		}
		// ソート混率降順
		foreach ($konritu as $key => $value) {
			$sort[$key] = $value['rit'];
		}
		array_multisort($sort, SORT_DESC, $konritu);
		$konritu[0]['rit'] += 100 - $konrituKei; // ｺﾝﾘﾂｹｲ …konrituKei // ｺﾝﾘﾂ …konritu
		for ($i = 0; $i < 9; $i++) { // updatedを狂わせない
			if ($konritu[$i]['rit'] > 0) {
				if (!$this->g1['HSioriKonrituMrs'][$i]) {$this->g1['HSioriKonrituMrs'][$i] = [];}
				$this->g1['HSioriKonrituMrs'][$i]['kon'] = $konritu[$i]['kon'];
				$this->g1['HSioriKonrituMrs'][$i]['rit'] = $konritu[$i]['rit'];
			} else if ($this->g1['HSioriKonrituMrs'][$i]) {
				$this->g1['HSioriKonrituMrs'][$i]['kon'] = '';
				$this->g1['HSioriKonrituMrs'][$i]['rit'] = 0;
			}
		}
	}

	// *****************************************************************
	private function TailCheck() { // テールチェック …TailCheck
										$this->g1['point_1'][] = "T-CHECK";
	// *----------------------------------------------------------------
	// 最終チェックしてエラーが無ければ更新もする。
		$h_siori_mr = HSioriMrs::findfirst([
			'conditions' => ' cd = ?1 ',
			'bind' => [1 => $this->g1['cd']],
		]);
		if ($this->g1['skbn'] == '1') { // 新規登録の場合
			if ($h_siori_mr) {
				$this->g1['emsg'] = "織設計番号が先に登録されてしまいました。" . $h_siori_mr->kousin_user_id;
				$this->g1['errflg'] = 1;
				return;
			}
			$this->link_make_up();
			$h_siori_mr = new HSioriMrs();
			$h_siori_mr->cd = $this->g1['cd'];
			$this->tail_save($h_siori_mr);
			return;
		} else if ($this->g1['skbn'] == '2') { // 更新の場合
			if (!$h_siori_mr) {
				$this->g1['emsg'] = "織設計データが見つからなくなりました。" . $this->g1['cd'];
				$this->g1['errflg'] = 1;
				return;
			}
			if ($h_siori_mr->updated != $this->g1['updated']) {
				$this->g1['emsg'] = "織設計データが先に更新されてしまいました。" . $this->g1['cd'];
				$this->g1['errflg'] = 1;
				return;
			}
			$this->link_make_up();
			$chgflg = 0;
			foreach (self::H_SIORI_FLDS as $fld) {
				if ($h_siori_mr->$fld != $this->g1[$fld]) {
					$chgflg = 1;
					break;
				}
			}
			if ($chgflg == 0) {
				if ($this->link_change_check($h_siori_mr)) {
					$this->g1['emsg'] = "変更がないので、更新する必要はありません。" . $this->g1['cd'];
					$this->g1['errflg'] = 1;
					return;
				}
			}
//			if ($errp = $this->link_updated_check($h_siori_mr)) { // …織設計マスタを必ず更新するのでここは不要かも
//				$this->g1['emsg'] = "織設計類データが先に更新されてしまいました。" . $errp;
//				$this->g1['errflg'] = 1;
//				return;
//			}
			$this->tail_save($h_siori_mr, $chgflg); // $chgflg は　backOut するか制御
			return;
		} else if ($this->g1['skbn'] == '9') { // 削除の場合
			if (!$h_siori_mr) {
				$this->g1['emsg'] = "織設計番号が先に削除されてしまいました。" . $h_siori_mr->kousin_user_id;
				$this->g1['errflg'] = 1;
				return;
			}
			$this->tail_delete($h_siori_mr);
			return;
		}
	}

	const SAVE_H_SIORI_JOINS = [ // ex_fld:existence_field=存在確認項目ID
		'HSioriKakouMrs'=>['ex_fld'=>'kote'],
		'HSioriKonrituMrs'=>['ex_fld'=>'kon'],
		'HSigenMrs'=>['ex_fld'=>'gito',
			'HSigenKonMrs'=>['ex_fld'=>'kon'],
		],
		'HSinenMrs'=>['ex_fld'=>'ito1'],
		'HSiitoMrs'=>['ex_fld'=>'imei'],
		'HSihaireMrs'=>['ex_fld'=>'kigo'],
		'HSisosikiMrs'=>['ex_fld'=>'line'],
		'HSiayaMrs'=>['ex_fld'=>'kigo'],
		'HSioriJihonMrs'=>['ex_fld'=>'hiki'],
		'HSichuiMrs'=>['ex_fld'=>'chui'],
	];
	// *****************************************************************
	private function tail_save($h_siori_mr, $chgflg = 0) { // 処理区分1新規.2更新の実行
	// *----------------------------------------------------------------
		if ($chgflg = 1) {$h_siori_mr->backOut();} // 更新前の退避
		foreach (self::H_SIORI_FLDS as $fld) { // 織設計マスタ本体は必ず更新する
			$h_siori_mr->$fld = $this->g1[$fld];
		}
		foreach (self::SAVE_H_SIORI_JOINS as $tbl1=>$link1s) { // self::H_SIORI_JOINS
			$joins = [];
			$imax = max(count($h_siori_mr->$tbl1),count($this->g1[$tbl1]));
												$this->g1['point_1'][] = "imax-".$tbl1.':'.$imax;
			for ($i = 0; $i < $imax; $i++) {
												$this->g1['point_1'][] = "T-SAVE-jupd-".$i.':'.$link1s['ex_fld'].':'.$this->g1[$tbl1][$i][$link1s['ex_fld']];
				if ($i >= count($this->g1[$tbl1]) ||
						!$this->g1[$tbl1][$i][$link1s['ex_fld']]) { // 削除
					if ($i < count($h_siori_mr->$tbl1)) {
						foreach ($link1s as $link1=>$link2s) {
							if ($link1 != 'ex_fld') { // さらに下位にリンクがあれば…
								$jmax = count($h_siori_mr->$tbl1[$i]->$link1);
								for ($j = 0; $j < $jmax; $j++) {
									$h_siori_mr->$tbl1[$i]->$link1[$j]->backOut(1); // 削除前の退避
								//	$h_siori_mr->$tbl1[$i]->$link1[$j]->delete(); // モデルにRelation::ACTION_CASCADEがあればこの行は不要
								}
							}
						}
						$h_siori_mr->$tbl1[$i]->backOut(1); // 削除前の退避
						$h_siori_mr->$tbl1[$i]->delete();
					}
				} else { // 更新
					if (count($h_siori_mr->$tbl1)>$i) {
						$joins[$i] = $h_siori_mr->$tbl1[$i];
						foreach (self::H_SIORI_JOINS[$tbl1] as $fld1) {
							if ($joins[$i]->$fld1 != $this->g1[$tbl1][$i][$fld1]) { // １項目でも更新なら
								$chgflg = 1;
								$h_siori_mr->$tbl1[$i]->backOut(); // 更新前の退避
								break;
							}
						}
					} else {
						$joins[$i] = new $tbl1;
					}
					foreach (self::H_SIORI_JOINS[$tbl1] as $fld1) {
						$joins[$i]->$fld1 = $this->g1[$tbl1][$i][$fld1];
					}
					foreach ($link1s as $link1=>$link2s) {
						if ($link1 != 'ex_fld') {
							$join1s = [];
							$jmax = max(count($h_siori_mr->$tbl1[$i]->$link1),count($this->g1[$tbl1][$i][$link1]));
							for ($j = 0; $j < $jmax; $j++) {
								if ($j >= count($this->g1[$tbl1][$i][$link1]) ||
										!$this->g1[$tbl1][$i][$link1][$j][$link2s['ex_fld']]) { // 削除
									if ($j < count($h_siori_mr->$tbl1[$i]->$link1)) {
										$h_siori_mr->$tbl1[$i]->$link1[$j]->backOut(1); // 削除前の退避
										$h_siori_mr->$tbl1[$i]->$link1[$j]->delete();
									}
								} else { // 更新
									if ($h_siori_mr->$tbl1[$i]->$link1[$j]) {
										$join1s[$j] = $h_siori_mr->$tbl1[$i]->$link1[$j];
										foreach (self::H_SIORI_JOINS[$tbl1][$join1] as $fld1) {
											if ($join1s[$j]->$fld1 != $this->g1[$tbl1][$i][$link1][$j][$fld1]) { // １項目でも更新なら
												$chgflg = 1;
												$h_siori_mr->$tbl1[$i]->$link1[$j]->backOut(); // 更新前の退避
												break;
											}
										}
									} else {
										$join1s[$i] = new $join1;
									}
									foreach (self::H_SIORI_JOINS[$tbl1][$join1] as $fld1) {
										$join1s[$j]->$fld1 = $this->g1[$tbl1][$i][$link1][$j][$fld1];
									}
								}
							}
							$joins->$link1 = $join1s;
						}
					}
				}
			}
			$h_siori_mr->$tbl1 = $joins;
		}

		if (!$h_siori_mr->save()) {
			foreach ($h_siori_mr->getMessages() as $message) {
				$this->g1['point_1'][] = "save-err!".$message;
			}
			$this->g1['errflg'] = 1;
			return;
		}
		$this->g1['emsg'] = "設計書の情報を登録しました。";
	}

	// *****************************************************************
	private function tail_delete($h_siori_mr) { // 処理区分9削除の実行
	// *----------------------------------------------------------------
		foreach (self::SAVE_H_SIORI_JOINS as $tbl1=>$link1s) { // self::H_SIORI_JOINS
			$imax = count($h_siori_mr->$tbl1);
			for ($i = 0; $i < $imax; $i++) {
				foreach ($link1s as $link1=>$link2s) {
					if ($link1 != 'ex_fld') { // さらに下位にリンクがあれば…
						$jmax = count($h_siori_mr->$tbl1[$i]->$link1);
						for ($j = 0; $j < $jmax; $j++) {
							$h_siori_mr->$tbl1[$i]->$link1[$j]->backOut(1); // 削除前の退避
						//	$h_siori_mr->$tbl1[$i]->$link1[$j]->delete(); // モデルにRelation::ACTION_CASCADEがあればこの行は不要
						}
					}
				}
				$h_siori_mr->$tbl1[$i]->backOut(1); // 削除前の退避
			//	$h_siori_mr->$tbl1[$i]->delete(); // モデルにRelation::ACTION_CASCADEがあればこの行は不要
			}
		}
		$h_siori_mr->backOut(1); // 削除前の退避
		if (!$h_siori_mr->delete()) {
			$this->g1['emsg'] = "エラー！！設計書の情報を削除できませんでした。" . $this->g1['cd'];
			$this->g1['errflg'] = 1;
			return;
		}
		$this->g1['emsg'] = "設計書の情報を削除しました。";
	}

	// *****************************************************************
	private function link_updated_check($h_siori_mr) { // リンク先の既更新チェック…織設計マスタを必ず更新するのでここは不要かも
	// *----------------------------------------------------------------
		foreach (self::H_SIORI_JOINS as $tbl1=>$fld1s) {
			if (substr($tbl1,-1) == 's') { // hasManyは末尾にsとする
				$i1 = 0;
				foreach ($h_siori_mr->$tbl1 as $row1) { // 例：$tbl1='HSigenMrs'
					if ($row1->updated > $this->g1[$tbl1][$i1]['updated']??0) {
						return($tbl1.'['.$i1.']');
					}
					foreach ($fld1s as $fld1=>$fld1a) { // 例：$fld1='HSigenKonMrs',$fld1a=['cd','kon','rit']
						if (is_array($fld1a)) {
							$i2 = 0;
							foreach ($row1->$fld1 as $row2) { // 例：$fld1='HSigenKonMrs',$row2=[[id=4,cd=1,kon,rit],[id=5,cd=2,kon,rit]…]
								if ($row2->updated > $this->g1[$tbl1][$i1][$fld1][$i2]['updated']??0) {
									return($tbl1.'['.$i1.']'.$fld1.'['.$i2.']');
								}
								$i2++;
							}
						}
					}
					$i1++;
				}
			} else { // belongsToは末尾をs以外とする(hasOneも)
				if ($h_siori_mr->$tbl1->updated > $this->g1[$tbl1][0]['updated']??0) {
					return($tbl1);
				}
				foreach ($fld1s as $fld1=>$fld1a) {
					if (is_array($fld1a)) {
						$i2 = 0;
						foreach ($row1->$fld1 as $row2) {
							if ($row2->updated > $this->g1[$tbl1][0][$fld1][$i2]['updated']??0) {
								return($tbl1.'->'.$fld1.'['.$i2.']');
							}
							$i2++;
						}
					}
					$i1++;
				}
			}
		}
	}
	// *****************************************************************
	private function link_change_check($h_siori_mr) { // リンク先の変化有無チェック
	// *----------------------------------------------------------------
		foreach (self::H_SIORI_JOINS as $tbl1=>$fld1s) {
			if (substr($tbl1,-1) == 's') { // hasManyは末尾にsとする
				$i1 = 0;
				foreach ($h_siori_mr->$tbl1 as $row1) { // 例：$tbl1='HSigenMrs'
					$joinAdata=$this->g1[$tbl1][$i1];
					foreach ($fld1s as $fld1=>$fld1a) { // 例：$fld1='HSigenKonMrs',$fld1a=['cd','kon','rit']
						if (is_array($fld1a)) {
							$i2 = 0;
							foreach ($row1->$fld1 as $row2) { // 例：$fld1='HSigenKonMrs',$row2=[[id=4,cd=1,kon,rit],[id=5,cd=2,kon,rit]…]
								$joinBdata=$joinAdata[$fld1][$i2];
								foreach ($fld1a as $fld2) { // 例：$fld2='cd'
									if ($joinBdata[$fld2] != $row2->$fld2) {
										return; // 変化ありで正常
									}
								}
								$i2++;
							}
						} else {
							if ($joinAdata[$fld1a] != $row1->$fld1a) {
								return; // 変化ありで正常
							}
						}
					}
					$i1++;
				}
			} else { // belongsToは末尾をs以外とする(hasOneも)
				$joinAdata=$this->g1[$tbl1][0];
				$row1 = $h_siori_mr->$tbl1;
				foreach ($fld1s as $fld1=>$fld1a) {
					if (is_array($fld1a)) {
						$i2 = 0;
						foreach ($row1->$fld1 as $row2) {
							$joinBdata=$joinAdata[$fld1][$i2];
							foreach ($fld1a as $fld2) {
								if ($joinBdata[$fld2] != $row2->$fld2) {
									return; // 変化ありで正常
								}
							}
							$i2++;
						}
					} else {
						if ($joinAdata[$fld1a] != $row1->$fld1a) {
							return; // 変化ありで正常
						}
					}
				}
			}
		}
		return 1; // 変化なしは異常
	}

	// *****************************************************************
	private function link_make_up() { // リンク先の分離項目を再合成
	// *----------------------------------------------------------------
		for ($i = 0; $i < count($this->g1['htkg']); $i++) {
			$this->g1['HSihaireMrs'][$i]['cd'] = $i + 1;
			$this->g1['HSihaireMrs'][$i]['kigo'] = g1['htkg'][$i];
			$this->g1['HSihaireMrs'][$i]['tykb'] = 1;
		}
		for ($i1 = 0; $i1 < count($this->g1['hykg']); $i1++) {
			$this->g1['HSihaireMrs'][$i]['cd'] = $i + 1;
			$this->g1['HSihaireMrs'][$i]['kigo'] = g1['htkg'][$i1];
			$this->g1['HSihaireMrs'][$i]['tykb'] = 2;
			$i++;
		}
		for ($i = 0; $i < count($this->g1['HSiitoMrs']); $i++) {
			$i1 = self::J2N($this->g1['HSiitoMrs'][$i]['tjun']) - 1;
			$this->g1['HSiitoMrs'][$i]['cd'] = $i + 1;
			if ($i1 >= 0) {
				$this->g1['HSiitoMrs'][$i]['ttni'] = $this->g1['EHq'][$i1]['ttni'];
				$this->g1['HSiitoMrs'][$i]['thon'] = $this->g1['EHq'][$i1]['thon'];
				$this->g1['HSiitoMrs'][$i]['douk'] = $this->g1['EHq'][$i1]['douk'];
				$this->g1['HSiitoMrs'][$i]['kais'] = $this->g1['EHq'][$i1]['kais'];
			}
			$i2 = self::J2N($this->g1['HSiitoMrs'][$i]['yjun']) - 1;
			if ($i2 >= 0) {
				$this->g1['HSiitoMrs'][$i]['ytni'] = $this->g1['EHq'][$i2]['ytni'];
				$this->g1['HSiitoMrs'][$i]['yhon'] = $this->g1['EHq'][$i2]['yhon'];
			}
		}
		// 以下連番CDを付加
		for ($i = 0; $i < count($this->g1['HSioriKakouMrs']); $i++) {
			if ($this->g1['HSioriKakouMrs'][$i]['kote']) {
				$this->g1['HSioriKakouMrs'][$i]['cd'] = $i + 1;
			}
		}
		for ($i = 0; $i < count($this->g1['HSioriKonrituMrs']); $i++) {
			if ($this->g1['HSioriKonrituMrs'][$i]['kon']) {
				$this->g1['HSioriKonrituMrs'][$i]['cd'] = $i + 1;
			}
		}
		for ($i = 0; $i < count($this->g1['HSigenMrs']); $i++) {
			if ($this->g1['HSigenMrs'][$i]['gito']) {
				$this->g1['HSigenMrs'][$i]['cd'] = $i + 1;
				for ($i1 = 0; $i1 < count($this->g1['HSigenKonMrs']); $i1++) {
					if ($this->g1['HSigenKonMrs'][$i1]['kon']) {
						$this->g1['HSigenKonMrs'][$i1]['cd'] = $i1 + 1;
					}
				}
			}
		}
		for ($i = 0; $i < count($this->g1['HSinenMrs']); $i++) {
			if ($this->g1['HSinenMrs'][$i]['ito1']) {
				$this->g1['HSinenMrs'][$i]['cd'] = $i + 1;
			}
		}
		for ($i = 0; $i < count($this->g1['HSisosikiMrs']); $i++) {
			if ($this->g1['HSisosikiMrs'][$i]['line']) {
				$this->g1['HSisosikiMrs'][$i]['cd'] = $i + 1;
			}
		}
		for ($i = 0; $i < count($this->g1['HSiayaMrs']); $i++) {
			if ($this->g1['HSiayaMrs'][$i]['kigo']) {
				$this->g1['HSiayaMrs'][$i]['cd'] = $i + 1;
			}
		}
		for ($i = 0; $i < count($this->g1['HSioriJihonMrs']); $i++) {
			if ($this->g1['HSioriJihonMrs'][$i]['hiki']) {
				$this->g1['HSioriJihonMrs'][$i]['cd'] = $i + 1;
			}
		}
		for ($i = 0; $i < count($this->g1['HSichuiMrs']); $i++) {
			if ($this->g1['HSichuiMrs'][$i]['chui']) {
				$this->g1['HSichuiMrs'][$i]['cd'] = $i + 1;
			}
		}
	}

	// *****************************************************************
	public function modal_printAction($id){ // 印刷イメージでEXCEL出力する。
	// *----------------------------------------------------------------
		$this->view->exp = $this->url->get('mrp/haiz200/print/'.$id); //モーダル画面が出たときにExcelをexportする→app/views/index.volt
	}

	// *****************************************************************
	public function printAction($id){ // 印刷イメージでEXCEL出力する。
	// *----------------------------------------------------------------
		//DBのデータを読み込む
		$id=3;
        $h_siori_mr = HSioriMrs::findFirstByid($id);
        if (!$h_siori_mr) {
            $this->flash->error("試織伝票が見つからなくなりました。id=$id");

            $this->dispatcher->forward(array(
                'controller' => "h_siori_mrs",
                'action' => 'index'
            ));

            return;
        }
		return $this->_output_excel($h_siori_mr);
	}

	public function _output_excel($h_siori_mr){
		// Excel出力用ライブラリ
		include __DIR__ . '/../../vendor/PHPExcel/Classes/PHPExcel.php';
//		include __DIR__ . '/../../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
		include __DIR__ . '/../../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
		include __DIR__ . '/../../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php'; //Include PHPExcel_IOFactory
		
		//PHPExcelオブジェクトの作成
		//新規の場合
		//$PHPExcel = new PHPExcel();
		 
		//テンプレートの読み込み
		//PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		$objReader = PHPExcel_IOFactory::createReader('Excel5');
		$objReader->setIncludeCharts(TRUE); // ここがポイント
		//テンプレートファイルパス
		$temp_dir = __DIR__ . '/../temp/'; // テンプレート
		$temp_path = $temp_dir . 'h_siori.xls';
		$PHPExcel = $objReader->load($temp_path);
		
		//配列に設定
		//	項目名,項目ID,数0文字1日付2,参照テーブルID,参照テーブルID,…
		$flds = [
			['id','id',0,],
			['試織番号','cd',0,],
			['試織目的','moku',1,],
			['設計日付','symd',2,],
			['改訂日付','kymd',2,],
			['織物タイプ','type',1,],
			['依頼先','irai',1,],
			['営業担当','etnt',1,],
			['企画担当','ktnt',1,],
			['希望納期','kibo',1,],
			['依頼納期','inou',1,],
			['設計納期','snou',1,],
			['整経納期','tnou',1,],
			['織上納期','ynou',1,],
			['仕上納期','anou',1,],
			['経糸名数','tken',0,],
			['緯糸名数','yken',0,],
			['組織図コード','socd',1,],
			['組織経本数','soth',0,],
			['組織緯本数','soyh',0,],
			['経配列区分','htkb',0,],
			['経配列本','htho',0,],
			['経配列中心','htsi',0,],
			['緯配列区分','hykb',0,],
			['緯配列本数','hyho',0,],
			['綾通し枚数','ayma',0,],
			['綾通し順コード','aycd',1,],
			['綾通し本数','ayho',0,],
			['綾通し名','ayme',1,],
			['整経巾鯨寸','shab',0,],
			['整経長回数','snag',0,],
			['筬密度','osa',0,],
			['打込','uti',0,],
			['耳羽数','miha',0,],
			['耳引込本数','mihk',0,],
			['耳本数','miho',0,],
			['地羽数','jiha',0,],
			['地引込本数','jihk',0,],
			['同口引込本数','dohk',0,],
			['地本数','jiho',0,],
			['生機巾','khab',0,],
			['生機長','knag',0,],
			['織縮','tiji',0,],
			['仕上巾','ahab',0,],
			['仕上長','anag',0,],
			['仕上打込','auti',0,],
			['重量','jury',0,],
			['仮撚工費','kkoh',0,],
			['撚糸工費','nkoh',0,],
			['整経工費','tkoh',0,],
			['製織工費','ykoh',0,],
			['染色工費','dkoh',0,],
			['整理工費','skoh',0,],
			['撚糸負荷','nnfk',0,],
			['原単位重量','gjur',0,],
			['取扱絵記号1','ecod1',1,],
			['取扱絵記号2','ecod2',1,],
			['取扱絵記号3','ecod3',1,],
			['取扱絵記号4','ecod4',1,],
			['取扱絵記号5','ecod5',1,],
			['作成者','sakusei_user_id',0,],
			['作成日時','created',0,],
			['更新者','kousin_user_id',0,],
			['更新日時','updated',0,],
			['組織図タイプ','type',1,'HSosikiMr',],
			['組織図経本数','soth',0,'HSosikiMr',],
			['組織図緯本数','soyh',0,'HSosikiMr',],
			['組織図更新日時','updated',0,'HSosikiMr',],
//			['作成者','name',1,'SakuseiUsers',],
		];
		$links = [
			'HSiitoMrs'=>[
				'retu'=>5,
				'gyou'=>2,
				'flds'=>[
					['id','id',0,],
					['行番','cd',0,],
					['糸名','imei',1,],
					['経糸順','tjun',1,],
					['緯糸順','yjun',1,],
					['糸コード','h_itomei_mr_cd',1,],
					['経原単位ｇ','ttni',0,],
					['緯原単位ｇ','ytni',0,],
					['一柄本数','thon',0,],
					['同口構成','douk',0,],
					['同口回数','kais',0,],
					['緯柄本数','yhon',0,],
					['実デニール','denl',0,],
					['セット温度','ondo',0,],
					['セット時間','time',0,],
					['経糊区分','tnor',0,],
					['緯糊区分','ynor',0,],
					['糸量','iryo',0,],
					['更新日時','updated',2,],
				],
			],
			'HSiayaMrs'=>[
				'retu'=>25,
				'gyou'=>2,
				'flds'=>[
					['id','id',0,],
					['順','cd',0,],
					['綾通し記号','kigo',1,],
					['更新日時','updated',2,],
				],
			],
			'HSichuiMrs'=>[
				'retu'=>30,
				'gyou'=>2,
				'flds'=>[
					['id','id',0,],
					['コード','cd',0,],
					['注意対象区分','kbn',1,],
					['注意対象','tais',1,],
					['注意枝番','eda',0,],
					['注意内容','chui',1,],
					['更新日時','updated',2,],
				],
			],
			'HSihaireMrs'=>[
				'retu'=>38,
				'gyou'=>2,
				'flds'=>[
					['id','id',0,],
					['コード','cd',0,],
					['経緯区分','tykb',1,],
					['配列記号列','kigo',1,],
					['更新日時','updated',2,],
				],
			],
			'HSioriKonrituMrs'=>[
				'retu'=>44,
				'gyou'=>2,
				'flds'=>[
					['id','id',0,],
					['順','cd',0,],
					['混率糸使い','kon',1,],
					['混率','rit',0,],
					['更新日時','updated',2,],
				],
			],
			'HSioriJihonMrs'=>[
				'retu'=>50,
				'gyou'=>2,
				'flds'=>[
					['id','id',0,],
					['コード','cd',0,],
					['引込本数','hiki',0,],
					['地羽数','hasu',0,],
					['更新日時','updated',2,],
				],
			],
			'HSisosikiMrs'=>[
				'retu'=>56,
				'gyou'=>2,
				'flds'=>[
					['id','id',0,],
					['コード','cd',0,],
					['パターン一行','line',0,],
					['更新日時','updated',0,],
				],
			],
			'HSosikiMr'=>[
				'chain'=>'HSisosikiMrs',
				'retu'=>61,
				'gyou'=>2,
				'flds'=>[
					['id','id',0,],
					['コード','cd',0,],
					['パターン一行','line',0,],
					['更新日時','updated',0,],
				],
			],
		];
		//シートの設定
		$PHPExcel->setActiveSheetIndex(1);  //1はDATA(DATAのシート)
		$sheet = $PHPExcel->getActiveSheet();
		$gyou = 2;
		$retu = 0;
		foreach ($flds as $fld) {
			$sheet->setCellValueByColumnAndRow($retu, $gyou, $fld[0]);
			$tbl = $h_siori_mr;
			for ( $i=3 ; array_key_exists($i, $fld) && $fld[$i] != '' ; $i++) {
				$tbl = $tbl->{$fld[$i]};
			}
			if ($fld[2] == 1) {
				$sheet->getStyleByColumnAndRow($retu + 1, $gyou)->getNumberFormat()->setFormatCode('@');
				$sheet->setCellValueByColumnAndRow($retu + 1, $gyou, $tbl->{$fld[1]});
			} else if ($fld[2] == 2) {
				$sheet->getStyleByColumnAndRow($retu + 1, $gyou)->getNumberFormat()->setFormatCode('yyyy/m/d');
				if ($tbl->{$fld[1]} != '0000-00-00') {
					$sheet->setCellValueByColumnAndRow($retu + 1, $gyou, PHPExcel_Shared_Date::PHPToExcel(new DateTime($tbl->{$fld[1]})));
				}
			} else {
				$sheet->setCellValueByColumnAndRow($retu + 1, $gyou, $tbl->{$fld[1]});
			}
			$gyou++;
		}
		//ここからリンク群
		foreach ($links as $link1=>$tbl0) {
			$gyou = $tbl0['gyou'];
			$retu = $tbl0['retu'];
			foreach ($tbl0['flds'] as $fld) {
				$sheet->setCellValueByColumnAndRow($retu, $gyou, $fld[0]);
				$retu++;
			}
			$h_siori_mr2 = $h_siori_mr; // 組織図コードから組織図を得るため、以下６行
			$link2 = $link1;
			if (substr($links,-1)!='s' && $tbl0['chain']) {
				$link2 = $tbl0['chain'];
				$h_siori_mr2 = $h_siori_mr->$link1;
			}
			foreach($h_siori_mr2->$link2 as $tbl1) {
				$gyou++;
				$retu = $tbl0['retu'];
				foreach ($tbl0['flds'] as $fld) {
					$tbl = $tbl1;
					for ( $i=3 ; array_key_exists($i, $fld) && $fld[$i] != '' ; $i++) {
						$tbl = $tbl->{$fld[$i]};
					}
	//echo "<br>\n".$fld[1];
					if ($fld[2] == 1) {
						$sheet->getStyleByColumnAndRow($retu, $gyou)->getNumberFormat()->setFormatCode('@');
						$sheet->setCellValueByColumnAndRow($retu, $gyou, $tbl->{$fld[1]});
					} else if ($fld[2] == 2) {
						$sheet->getStyleByColumnAndRow($retu, $gyou)->getNumberFormat()->setFormatCode('yyyy/m/d');
						$sheet->setCellValueByColumnAndRow($retu, $gyou, PHPExcel_Shared_Date::PHPToExcel(new DateTime($tbl->{$fld[1]})));
					} else {
						$sheet->setCellValueByColumnAndRow($retu, $gyou, $tbl->{$fld[1]});
					}
					$retu++;
				}
			}
		}
//return;
		// Excelファイルの保存 ------------------------------------------  
		$PHPExcel->setActiveSheetIndex(0);  //0は印刷用のシート)
		
		//保存ファイル名
		$filename = "h_siori_" . $h_siori_mr->cd . '.xls'; // uniqid("h_siori_".$h_siori_mr->cd."_", true) . '.xls'; // ユニークの必要はない
		
		// 保存ファイルパス
		$upload = __DIR__ . '/../temp/';
		$path = $upload . $filename;
		
		$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5'); //2007形式で保存
		$objWriter->setIncludeCharts(TRUE); // ここがポイント
		$objWriter->save( $path );
		
		// Excelファイルをクライアントに出力 ----------------------------
		$response = new \Phalcon\Http\Response(); // Redirect output to a client's web browser (Excel2005) 
		$response->setHeader('Content-Type', 'application/octet-stream'); //vnd.ms-excel'); 
		$response->setHeader('Content-Disposition', 'attachment;filename="' . $filename . '"'); 
		$response->setHeader('Cache-Control', 'max-age=0');
		$response->setHeader('Cache-Control', 'max-age=1'); // If you're serving to IE 9, then the following may be needed 
		$response->setContent(file_get_contents($path)); //Set the content of the response 
		unlink($path); // delete temp file 
		return $response; //Return the response 
	}

}

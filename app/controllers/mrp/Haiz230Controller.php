<?php

class Haiz230Controller extends ControllerBase
{
	private $g1=[]; // jsとデータ交換
	private $p=0;
	private $p1=0;
	private $p2=0;
	private $p3=0;
	private $w_hohas=[];
	private $w_hohik=[];
	private $w_hikho=0;
	private $w_hyrec = '';

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
			case 'BODY1_CHECK':
				$this->Body1Check();
				break;
			case 'BODY2_CHECK':
				$this->Body2Check();
				break;
			case 'BODY3_CHECK':
				$this->Body3Check();
				break;
			case 'BODY3A_CHECK':
				$this->Body3ACheck();
				break;
			case 'BODY4_CHECK':
				$this->Body4Check();
				break;
			case 'BODY5_CHECK':
				$this->Body5Check();
				break;
			case 'BODY6_CHECK':
				$this->Body6Check();
				break;
		}
		$response->setContent(json_encode($this->g1)); // json変換 g1
		return $response;  // javascriptへ戻り値 g1
	}

	// *****************************************************************
	private function HeadCheck() { // ヘッドチェック …HeadCheck
										$this->g1['point_1'][] = "H-CHECK";
	// *----------------------------------------------------------------
		if ($this->g1['socd']) {
			$h_siori_mr = HSioriMrs::findfirst([
				'conditions' => ' cd = ?1 ',
				'bind' => [1 => $this->g1['socd']],
			]);
			if (!$h_siori_mr) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "入力された組織図コードは未登録です。";
				return;
			}
			$this->g1['some'] = $h_siori_mr->type;
			$this->g1['soth'] = $h_siori_mr->soth;
			$this->g1['soyh'] = $h_siori_mr->soyh;
			$this->g1['patn'] = []; // クリア
			foreach ($h_siori_mr->HSisosikiMrs as $h_sisosiki_mr) {
				$this->g1['patn'][] = $h_sisosiki_mr->line;
			}
		}
	}
	// *****************************************************************
	private function Body1Check() { // ボディ1チェック …Body1Check
										$this->g1['point_1'][] = "B1-CHECK";
	// *----------------------------------------------------------------
	}
	// *****************************************************************
	private function Body2Check() { // ボディ2チェック …Body1Check
										$this->g1['point_1'][] = "B2-CHECK";
	// *----------------------------------------------------------------
	}
	// *****************************************************************
	private function Body3Check() { // ボディ3チェック …Body1Check
										$this->g1['point_1'][] = "B3-CHECK";
	// *----------------------------------------------------------------
	}
	// *****************************************************************
	private function Body4Check() { // ボディ4チェック …Body1Check
										$this->g1['point_1'][] = "B4-CHECK";
	// *----------------------------------------------------------------
	//	試織コードがAYADではじまり＋枚数＋綾通し区分をキーとする試織マスタに綾通し名を入れ、そのhasmanyの綾通しマスタに綾通し記号をいれる。
		if ($this->g1['aycd'] == '') { // 独特なら次の参照しないで終わる
			return;
		}
		if ($this->g1['aycd'] == 9) { // 組織図による綾通し順を参照する
			$cd = $this->g1['socd'];
		} else {
			$cd = 'AYAD'.sprintf('%02d',$this->g1['ayma']).$this->g1['aycd'];
		}
		$h_siori_aya_mr = HSioriMrs::findfirst([
			'conditions' => ' cd = ?1 ',
			'bind' => [1 => $cd],
		]);
		if ($h_siori_aya_mr) {
			$this->g1['ayho'] = $h_siori_aya_mr->ayho;
			$this->g1['ayme'] = $h_siori_aya_mr->ayme;
			$this->g1['HSiayaMr2s']=[]; // 参照用エリアへ格納する。更新時には無視される。
			foreach ($h_siori_aya_mr->HSiayaMrs as $h_siaya_mr) {
				$this->g1['HSiayaMr2s'][] = ['cd'=>$h_siaya_mr->cd,'kigo'=>$h_siaya_mr->kigo];
			}
		} else {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "指定の綾通し順は未登録です。";
			return;
		}
	}
	// *****************************************************************
	private function Body5Check() { // ボディ5チェック …Body1Check
										$this->g1['point_1'][] = "B5-CHECK";
	// *----------------------------------------------------------------
		$this->AyadosiTenkai();
	}
	// *****************************************************************
	private function AyadosiTenkai() { // 綾通し順チェック
										$this->g1['point_1'][] = "ｱﾔﾄｵｼCHK";
	// *----------------------------------------------------------------
	// * P1 : 綾通し順記号を読む桁位置
	// * P2 : 繰返し範囲のレベル
	// * P3 : 綾通し順記号の前後の桁位置
		$kagflg = 0;
		$sula_ari = 0;
		$kagi_ari = 0;
		$kakko_ari = 0; // ZERO …0 // ｽﾗARI …$sula_ari // ｶｷﾞARI …$kagi_ari // ｶｯｺARI …$kakko_ari
		$w_last = '';
		$w_maekig = '';
		foreach ($this->g1['HSiayaMrs'] as $aymr) {$this->w_hyrec .= $aymr['kigo'];} // 綾記号を全部繋げる
		for ($this->p1 = 0; $this->p1 < strlen($this->w_hyrec); $this->p1++) {
			switch (true) {
				case substr($this->w_hyrec, $this->p1, 1) == "/":
					$sula_ari = 1; // ｽﾗARI
					$w_last = substr($this->w_hyrec, $this->p1, 1); // W-LAST …$w_last
					break;
				case substr($this->w_hyrec, $this->p1, 1) == "<":
					$kagi_ari = 1; // ｶｷﾞARI
					$w_last = substr($this->w_hyrec, $this->p1, 1); // W-LAST …$w_last
					break;
				case substr($this->w_hyrec, $this->p1, 1) == ">":
					$kagi_ari = 1; // ｶｷﾞARI
					$w_last = substr($this->w_hyrec, $this->p1, 1); // W-LAST …$w_last
					break;
				case substr($this->w_hyrec, $this->p1, 1) == "(":
					$kakko_ari = 1; // ｶｯｺARI
					$w_last = substr($this->w_hyrec, $this->p1, 1); // W-LAST …$w_last
					break;
				case substr($this->w_hyrec, $this->p1, 1) == ")":
					$kakko_ari = 1; // ｶｯｺARI
					while ($this->p1 + 1 < strlen($this->w_hyrec) &&
							(	substr($this->w_hyrec, $this->p1 + 1, 1) == ' ' ||
								substr($this->w_hyrec, $this->p1 + 1, 1) == "X" ||
								substr($this->w_hyrec, $this->p1 + 1, 1) >='0' && substr($this->w_hyrec, $this->p1 + 1, 1) <= '9')) {
						$this->p1++;
					}
					break;
				case  substr($this->w_hyrec, $this->p1, 1) >= '0' && substr($this->w_hyrec, $this->p1, 1) <= '9':
					$w_last = substr($this->w_hyrec, $this->p1, 1); // W-LAST
					break;
			}
		}
		if ($sula_ari == 1 && $w_last != "/") { // ｽﾗARI …$sula_ari // W-LAST …$w_last
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "／指定のある時は、一番最後は／で終わること。";
			return;
		}
		$this->p1 = -1;
		$this->p2 = 0;
		$this->p3 = 0;
		$num = 0;
		$ayahon = [];
		$w_hikikomi = 0; // W-ﾋｷｺﾐ …$w_hikikomi
		while ( $this->p1 < strlen($this->w_hyrec)) {
			$this->p1++;
			if ((substr($this->w_hyrec, $this->p1, 1) == "(" ||
				substr($this->w_hyrec, $this->p1, 1) == ")" ||
				substr($this->w_hyrec, $this->p1, 1) == "<") && $kagflg == 1) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "＜＞の中に（　）＜　の指定があります";
				return;
			}
			switch ( true) {
				case  substr($this->w_hyrec, $this->p1, 1) == ' ':
					break; // 空白は飛ばす
				case  substr($this->w_hyrec, $this->p1, 1) >= '0' && substr($this->w_hyrec, $this->p1, 1) <= '9':
					$this->p3 = $this->p1;
					$w_int = $this->AyadosiKenshutu($this->w_hyrec, $this->p3); // 綾通し順数字検出 …$this->AyadosiKenshutu
					if ( $w_int > $this->g1['ayma']) { // W-INT …$w_int
						$this->g1['errflg'] = 1;
						$this->g1['emsg'] = "綾通し枚数より大きな綾番号が入力されています。";
						return;
					}
					if ( $kagflg == 0) {
						$ayahon[$this->p2]++;
					}
					$this->w_hikho++;
					$w_maekig = substr($this->w_hyrec, $this->p1,1); // W-MAEKIG …$w_maekig
					$this->p1 = $this->p - 1;
					break;
				case  substr($this->w_hyrec, $this->p1, 1) == "(":
					if ( $sula_ari == 1 && $this->p1 >= 2 && $w_maekig != "/") { // ｽﾗARI …$sula_ari // W-MAEKIG …$w_maekig
						$this->g1['errflg'] = 1;
						$this->g1['emsg'] = "／指定のある時は、（　の直前は／でなければならない";
						return;
					}
					$w_maekig = substr($this->w_hyrec, $this->p1,1); // W-MAEKIG …$w_maekig
					$this->p2++;
					break;
				case  substr($this->w_hyrec, $this->p1, 1) == ")":
					if ( $this->p2 < 1) {
						$this->g1['errflg'] = 1;
						$this->g1['emsg'] = "（　が無いのに　）がある";
						return;
					}
					if ( $sula_ari == 1 && $w_maekig != "/") { // ｽﾗARI …$sula_ari // W-MAEKIG …$w_maekig
						$this->g1['errflg'] = 1;
						$this->g1['emsg'] = "／指定のある時は、）　の直前は／でなければならない";
						return;
					}
					$this->p3 = $this->p1 + 1;
					for ( $this->p= $this->p3; $this->p < strlen($this->w_hyrec) && (substr($this->w_hyrec,-1+ $this->p, 1) <= ' ' || substr($this->w_hyrec,-1+ $this->p, 1) == "X"); $this->p++) {
						;
					}
					if ( !(substr($this->w_hyrec, $this->p, 1) >= '0' && substr($this->w_hyrec, $this->p, 1) >= '0') ) {
						$this->g1['errflg'] = 1;
						$this->g1['emsg'] = "）の後は繰返し数を入力して下さい";
						return;
					}
					$this->p3 = $this->p;
					$w_int = $this->AyadosiKenshutu($this->w_hyrec, $this->p3); // 綾通し順数字検出 …AyadosiKenshutu
					$this->p3 = $this->p2 - 1;
					$ayahon[$this->p3] = $ayahon[$this->p2] * $w_in + $ayahon[$this->p3]; // W-IN …$w_in
					for ( $j = 1; $j < strlen($this->w_hohas); $j++) {
						$this->w_hohas[$j][$this->p3] = $this->w_hohas[$j][$this->p2] * $w_int + $this->w_hohas[$j][$this->p3]; // W-INT …$w_int
						$this->w_hohas[$j][$this->p2] = 0; // ZERO …0
					}
					$ayahon[$this->p2] = 0; // ZERO …0
					$this->p1 = $this->p - 1;
					$this->p2 = $this->p2 - 1;
					break;
				case  substr($this->w_hyrec, $this->p1, 1) == "<":
					$kagflg = 1;
					$ayahon[$this->p2]++;
					$w_maekig = substr($this->w_hyrec, $this->p1,1); // W-MAEKIG …前記号
					break;
				case  substr($this->w_hyrec, $this->p1, 1) == ">":
					if ( $kagflg == 0) {
						$this->g1['errflg'] = 1;
						$this->g1['emsg'] = "＜の数と＞の数が一致しない";
						return;
					}
					$kagflg = 0;
					$w_maekig = substr($this->w_hyrec, $this->p1,1); // W-MAEKIG …前記号
					break;
				case  substr($this->w_hyrec, $this->p1, 1) == "/":
					if ( $this->p1 == 1) {
						$this->g1['errflg'] = 1;
						$this->g1['emsg'] = "一番最初の／は不要です";
						return;
					}
					if ( $this->w_hikho > 9) {
						$this->g1['errflg'] = 1;
						$this->g1['emsg'] = "引込み本数が１０本以上になります";
						return;
					}
					for ( $j= 1; $j <= $max_hikho && $this->w_hikho != $this->w_hohik[$j]; $j++) { // W-HOHIK …引込配列
						;
					}
					if ( $j >= 6 && $this->w_hikho != $this->w_hohik [ $j ]) { // W-HOHIK …引込配列
						$this->g1['errflg'] = 1;
						$this->g1['emsg'] = "引込み本数の種類が６種類以上になる";
						return;
					}
					if ( $j > $max_hikho) {
						$max_hikho = $j;
					}
					$this->w_hohik[$j] = $this->w_hikho; // W-HOHIK …引込配列
					$this->w_hohas[$j][$this->p2]++;
					$this->w_hikho = 0;
					$w_maekig = substr($this->w_hyrec, $this->p1,1); // W-MAEKIG …前記号
					break;
			}
		}
		if ( $this->p2 != 0) {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "繰返しの範囲指定がおかしい。";
			return;
		}
		if ( $kagflg != 0) {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "同口の範囲指定がおかしい。";
			return;
		}
		$this->g1['ayho'] = $ayahon[1];
		if ( $sula_ari == 0) { // ｽﾗARI …$sula_ari
			$w_hikikomi = 0; // ZERO …0 // W-ﾋｷｺﾐ …$w_hikikomi
		} else {
			$this->HikikomiSort(); // 引込み本数並替 …$this->HikikomiSort
		}
	}
	// *****************************************************************
	private function AyadosiKenshutu() { // 綾通し順数字検出
											$this->g1['point_1'][] = "AYANUM";
	// *----------------------------------------------------------------
		$w_int = 0;
		for ($this->p= $this->p3; $this->p < strlen($this->w_hyrec) &&
					 (substr($this->w_hyrec, $this->p, 1) >='0' && substr($this->w_hyrec, $this->p, 1) <='9') ||
					  substr($this->w_hyrec, $this->p, 1) == "X"; $this->p++) {
			if ( substr($this->w_hyrec, $this->p, 1) >='0' && substr($this->w_hyrec, $this->p, 1) <='9') {
				$num = 0 + substr($this->w_hyrec, $this->p,1);
				$w_int = $w_int * 10 + $num; // eW-INT …$w_int // W-INT …$w_int
			}
		}
		return;
	}
	// *****************************************************************
	private function HikikomiSort() { // 引込み本数並替
											$this->g1['point_1'][] = "HIKSORT";
	// *----------------------------------------------------------------
		for ($j = 0; $j < strlen($this->w_hohas) - 1 && $this->w_hohas[$j+1][0] != 0; $j++) {
			for ($k = 0; $k < strlen($this->w_hohas) - 1 - $j && $this->w_hohas[$k+1][0] != 0; $k++) {
				if ( $this->w_hohas[$k+1][0] > $this->w_hohas[$k][0]) {
					$this->w_hikho = $this->w_hohik[$k]; // W-HOHIK …$this->w_hohik
					$this->w_hohik[$k] = $this->w_hohik[$k+1]; // W-HOHIK …$this->w_hohik // W-HOHIK …$this->w_hohik
					$this->w_hohik[$k+1] = $this->w_hikho; // W-HOHIK …$this->w_hohik
					$this->w_hohas79 = $this->w_hohas[$k][0]; // 79の意味は無い。COBOLGで(7,9)だった。
					$this->w_hohas[$k][0] = $this->w_hohas[$k+1][0];
					$this->w_hohas[$k+1][0] = $this->w_hohas79;
				}
			}
		}
	}
	// *****************************************************************
	private function Body6Check() { // ボディ6チェック …Body1Check
										$this->g1['point_1'][] = "B6-CHECK";
	// *----------------------------------------------------------------
	}

}

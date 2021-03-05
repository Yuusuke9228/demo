<?php

class Haiz220Controller extends ControllerBase
{
	private $g1=[]; // jsとデータ交換
	private $hrt='';
	private $hry='';
	private $hr='';
	private $cnt=0;
	private $douku_cnt=0;
	private $kbn=0;
	private $haire_suu=0;
	private $douku_keta=0;
	private $douku_kigo='';
	private $kigo='';
	private $w_kigo='';
	private $chk_kigo='';
	private $kakko_stck=0;
	private $kakko=[];
	private $t1=[];
	private $t_hons=0;
	private $t2=[];
	private $t3=[];
	private $t5_kigo='';
	private $t5_suji='';

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
			case 'ALLF_SET':
				$this->GamenDataGet(); // 内部用変換
				$this->GamenDataSet(); // 主要部分
				break;
			case 'BODY_CHECK':
				$this->GamenDataGet(); // 内部用変換
				$this->BodyCheck(); // 主要部分
				$this->GamenDataSet(); // 主要部分
				break;
			case 'TAIL_CHECK':
				$this->TailCheck();
				break;
		}
		$response->setContent(json_encode($this->g1)); // json変換 g1
		return $response;  // javascriptへ戻り値 g1
	}



	// *****************************************************************
	private function GamenDataGet() { // 画面データゲット …GamenDataGet
										$this->g1['point_1'] = [];
	// *----------------------------------------------------------------
		$this->hrt = '';
		for ($i = 0; $i < count($this->g1['htkg']); $i++) {
			$this->hrt .= $this->g1['htkg'][$i].str_repeat(' ',25-strlen($this->g1['htkg'][$i]));
		}
		$this->hry = '';
		for ($i = 0; $i < count($this->g1['hykg']); $i++) {
			$this->hry .= $this->g1['hykg'][$i].str_repeat(' ',25-strlen($this->g1['hykg'][$i]));
		}
		$this->g1['EHq']=[];
		for ($i = 0; $i < 8; $i++) {
			$this->g1['EHq'][$i] = [];
		}
	//	$this->g1['tkig']=[];
	//	$this->g1['tkur']=[];
	//	$this->g1['tjun']=[];
	//	$this->g1['thon']=[];
	//	$this->g1['ykig']=[];
	//	$this->g1['ykur']=[];
	//	$this->g1['yjun']=[];
	//	$this->g1['yhon']=[];
	}

	// *****************************************************************
	private function GamenDataSet() { // 画面データセット …GamenDataSet
										$this->g1['point_1'][] = "ﾃﾞｰﾀｾｯﾄ";
	// *----------------------------------------------------------------
		switch ( $this->g1['htkb']) { // W-HOHTKB …$this->g1['ho']['htkb']
			case  0:
				$this->g1['htme'] = "柄"; // G1-HTME …$this->g1['htme']
				$this->kbn = 1; // ｸﾌﾞﾝ …$this->kbn
				$this->hr = $this->hrt; // W-HRRECT …$this->g1['hr']['rect'] // W-HRREC …$this->g1['hr']['rec']
				$this->t_hons = 0;
				$this->HairetuShori(); // 配列処理 …HairetuShori
				for ( $i= 0; $i < strlen($this->t5_kigo)/25+1; $i++) {
					$this->g1['tkig'][$i] = substr($this->t5_kigo,$i*25,25); // G1-TKIG …$this->g1['tito'][$i]['tkig']
					$this->g1['tkur'][$i] = substr($this->t5_suji,$i*25,25); // G1-TKUR …$this->g1['tito'][$i]['tkur']
				}
				$this->g1['htho'] = $this->t_hons; // G1-HTHO …$this->g1['htho']
				for ($i = 0; $i < 8; $i++) {
					$this->g1['EHq'][$i]['tjun'] = '';
					$this->g1['EHq'][$i]['thon'] = 0;
				}
				for ($i=0; $i<count($this->t1); $i++) {
					$j=strpos('ABCDEFGHI',$this->t1[$i]['ijun']);
					$this->g1['EHq'][$j]['tjun']=$this->t1[$i]['ijun'];
					$this->g1['EHq'][$j]['thon']+=$this->t1[$i]['ihon'];
				}
				$this->DoukutiShiHyouji(); // 同口糸表示 …DoukutiShiHyouji
				break;
			case  1:
				$this->g1['htme'] = "無地"; // G1-HTME …$this->g1['htme']
				$this->g1['EHq'][0]['tjun'] = "A"; // G1-TJUN …$this->g1['tito'][$i]['tjun']
				$this->g1['EHq'][0]['thon'] = 1; // W-HQHONS …$this->g1['hq'][$t]['thon']
				$this->g1['htho'] = 1;
				break;
		}
		switch ( $this->g1['hykb']) { // W-HOHYKB …$this->g1['ho']['hykb']
			case  0:
				$this->g1['hyme'] = "柄"; // G1-HYME …$this->g1['hyme']
				$this->kbn = 2; // ｸﾌﾞﾝ …$this->kbn
				$this->hr = $this->hry; // W-HRRECY …$this->g1['hr']['recy'] // W-HRREC …$this->g1['hr']['rec']
				$this->t5_kigo = '';
				$this->t5_suji = '';
				$this->t_hons = 0;
				$this->HairetuShori(); // 配列処理 …HairetuShori
				for ( $i= 0; $i < strlen($this->t5_kigo)/25+1; $i++) {
					$this->g1['ykig'][$i] = substr($this->t5_kigo,$i*25,25); // G1-TKIG …$this->g1['tito'][$i]['tkig']
					$this->g1['ykur'][$i] = substr($this->t5_suji,$i*25,25); // G1-TKUR …$this->g1['tito'][$i]['tkur']
				}
				$this->g1['hyho'] = $this->t_hons; // G1-HYHO …$this->g1['hyho']
				for ($i = 0; $i < 8; $i++) {
					$this->g1['EHq'][$i]['yjun'] = '';
					$this->g1['EHq'][$i]['yhon'] = 0;
				}
				for ($i=0;$i<count($this->t1);$i++) {
					$j=strpos('ABCDEFGHI',$this->t1[$i]['ijun']);
					$this->g1['EHq'][$j]['yjun']=$this->t1[$i]['ijun'];
					$this->g1['EHq'][$j]['yhon']+=$this->t1[$i]['ihon'];
				}
			break;
			case  1:
				$this->g1['hyme'] = "無地"; // G1-HYME …$this->g1['hyme']
				$this->g1['EHq'][0]['yjun'] = "A"; // G1-YJUN …$this->g1['yito'][$i]['yjun']
				$this->g1['EHq'][0]['yhon'] = 1;
				$this->g1['hyho'] = 1;
			break;
			case  2:
				$this->g1['hyme'] = "共通"; // G1-HYME …$this->g1['hyme']
				$this->g1['hyho'] = $this->g1['htho']; // G1-HTHO …$this->g1['htho'] // G1-HYHO …$this->g1['hyho']
				$this->g1['ykig'] = $this->g1['tkig']; // G1-TKIG …$this->g1['tito'][$i]['tkig']
				$this->g1['ykur'] = $this->g1['tkur']; // G1-TKUR …$this->g1['tito'][$i]['tkur'] // G1-YKUR …$this->g1['yito'][$i]['ykur']
				for ($i = 0; $i < count($this->g1['EHq']); $i++) {
					$this->g1['EHq'][$i]['yjun'] = $this->g1['EHq'][$i]['tjun']; // G1-TJUN …$this->g1['tito'][$i]['tjun'] // G1-YJUN …$this->g1['yito'][$i]['yjun']
					$this->g1['EHq'][$i]['yhon'] = $this->g1['EHq'][$i]['thon']; // G1-THON …$this->g1['tito'][$i]['thon'] // G1-YHON …$this->g1['yito'][$i]['yhon']
				}
			break;
		}
	}
	// *****************************************************************
	private function DoukutiShiHyouji() { // 同口糸表示 …DoukutiShiHyouji
										$this->g1['point_1'][] = "ﾄﾞｳｸﾁﾋｮｳｼﾞ";
	// *----------------------------------------------------------------
		for ( $i= 0; $i < 8; $i++) {
			if ( $this->t3[$i]['douk'] > '') {
				$this->t2=[]; // ﾃｰﾌﾞﾙ2 …$this->table2 // ｶｳﾝﾄ …$this->cnt
				for ( $ii= 0; $ii < 4 && trim(substr($this->t3[$i]['douk'], $ii, 1)) != '';$ii++) {
					$flg = 0; // ZERO …0 // ﾌﾗｯｸﾞ …$flg
					for ( $jj= 0; $jj < 4 && $flg == 0; $jj++) { // ﾌﾗｯｸﾞ …$flg
						if ( trim(substr($this->t3[$i]['douk'], ii, 1)) == $this->t2[$jj]['jun']) {
							$flg = 1; // ﾌﾗｯｸﾞ …$flg
							$this->t2[$jj]['hon']++;
						}
					}
					if ( $flg == 0 && $this->cnt <= 7) { // ﾌﾗｯｸﾞ …$flg // ｶｳﾝﾄ …$this->cnt
						$this->t2[$this->cnt]['jun'] = substr($this->t3[$i]['douk'],$ii,1); // ｶｳﾝﾄ …$this->cnt
						$this->t2[$this->cnt]['hon'] = 1; // ｶｳﾝﾄ …$this->cnt
						$this->cnt++; // ｶｳﾝﾄ …$this->cnt
					}
				}
				if ( $this->cnt == 0) { // ｶｳﾝﾄ …$this->cnt
					$this->g1['tjun'][$this->j] = $this->t2[0]['jun'].$this->t2[0]['hon']; // G1-TJUN …$this->g1['tito'][$i]['tjun']
					$this->j++;
				}
				if ( $this->cnt >= 1) { // ｶｳﾝﾄ …$this->cnt
					$this->g1['tjun'][$this->j] = $this->t2[0]['jun'].$this->t2[1]['jun']; // G1-TJUN …$this->g1['tito'][$i]['tjun']
					$j++;
				}
				$this->g1['EHq'][$this->j]['thon'] = $this->t3['kais'][$i]; // G1-THON …$this->g1['tito'][$i]['thon']
			}
		}
	}
	// *****************************************************************
	private function HairetuShori() { // 配列処理 …HairetuShori
										$this->g1['point_1'][] = "ﾊｲﾚﾂｼｮﾘ";
	// *----------------------------------------------------------------
		$this->j = 0;
		$this->kakko=[]; // ｶｯｺﾜｰｸ …$this->kakko_work 
		$this->kakko_stck=0;
		$this->t1=[]; // ﾃｰﾌﾞﾙ1 …$this->table1
		$this->t3=[]; // ﾃｰﾌﾞﾙ3 …$this->table3
		$this->cnt=0; // ｶｳﾝﾄ …$this->cnt
		$this->douku_cnt=0; // ﾄﾞｳｸﾁCNT …$this->douku_cnt
		$this->HairetuKigouSearch(); // 配列記号サーチ …HairetuKigouSearch
		while ( $this->j < 400) {
			switch ( true) {
				case  is_numeric($this->kigo):
					$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
					if ( $this->chk_kigo == ">") {
						$this->g1['emsg'] = "同口のカッコの次に数字は書けません"; // G1-EMSG …$this->g1['emsg']
					} else {
						$this->g1['emsg'] = "数字の入力に誤りがあります"; // G1-EMSG …$this->g1['emsg']
					}
					return; // ﾊｲﾚﾂｼｮﾘ_e;
				break;
				case  $this->kigo >= "A" && $this->kigo <= "H":
					$this->w_kigo = $this->kigo;
					$this->HaireSuujiSearch(); // 配列数字サーチ …HaireSuujiSearch
					$this->HonsuuKeisan(); // 本数計算 …HonsuuKeisan
					$this->chk_kigo = '';
				break;
				case  $this->kigo == "(":
					$this->kakko_stck++; // ｶｯｺｽﾀｯｸ …$this->kakko_stck
					$this->kakko[$this->kakko_stck]['iti'] = $this->j; // ｶｯｺｲﾁ …$this->kakko_iti // ｶｯｺｽﾀｯｸ …$this->kakko_stck
					$this->kakko[$this->kakko_stck]['kai'] = 0; // ｶｯｺｶｲ …$this->kakko_kai // ｶｯｺｽﾀｯｸ …$this->kakko_stck
					$this->chk_kigo = "";
				break;
				case  $this->kigo == ")":
					$this->HaireSuujiSearch(); // 配列数字サーチ …HaireSuujiSearch
					$this->kakko[$this->kakko_stck]['kai']++; // ｶｯｺｶｲ …$this->kakko_kai // ｶｯｺｽﾀｯｸ …$this->kakko_stck
					if ( $this->kakko[$this->kakko_stck]['kai'] < $this->haire_suu) { // ｶｯｺｶｲ …$this->kakko_kai // ｶｯｺｽﾀｯｸ …$this->kakko_stck // 配列数 …haire_suu
						$this->j = $this->kakko[$this->kakko_stck]['iti']; // ｶｯｺｲﾁ …$this->kakko_iti // ｶｯｺｽﾀｯｸ …$this->kakko_stck
					} else {
						$this->kakko_stck += -1; // ｶｯｺｽﾀｯｸ …$this->kakko_stck
					}
					$this->chk_kigo = "";
				break;
				case  $this->kigo == "<":
					$this->douku_keta = 0; // 同口桁 …douku_keta
					$this->douku_kigo = ''; // 同口記号 …douku_kigo
					$this->HairetuKigouSearch(); // 配列記号サーチ …HairetuKigouSearch
					while ( $this->j <= 400 && $this->kigo != ">") {
						if ( $this->kigo >= "A" && $this->kigo <= "Z") {
							$this->w_kigo = $this->kigo;
							$this->HaireSuujiSearch(); // 配列数字サーチ …HaireSuujiSearch
							for ( $times=0; $times<1; $times++) { // 配列数 …haire_suu
								$this->douku_keta++; // 同口桁 …douku_keta
								if ( $this->douku_keta > 4) { // 同口桁 …douku_keta
									$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
									$this->g1['emsg'] = "同口本数は１回に４本までです"; // G1-EMSG …$this->g1['emsg']
									return; // ﾊｲﾚﾂｼｮﾘ_e;
								}
								$this->douku_kigo .= $this->w_kigo; // 同口記号 …douku_kigo // 同口桁 …douku_keta
							}
						}
						$this->HairetuKigouSearch(); // 配列記号サーチ …HairetuKigouSearch
					}
					if ( $this->j >= 400) {
						$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
						$this->g1['emsg'] = "同口のカッコの数が合っていません"; // G1-EMSG …$this->g1['emsg']
						return; // ﾊｲﾚﾂｼｮﾘ_e;
					}
					$this->HonsuuKeisan1(); // 本数計算１ …HonsuuKeisan1
					$this->DoukutiKaisuuSan(); // 同口回数算出 …DoukutiKaisuuSan
					$this->chk_kigo = ">";
				break;
			}
			$this->HairetuKigouSearch(); // 配列記号サーチ …HairetuKigouSearch
		}
		if ( $this->kakko_stck != 0) { // ｶｯｺｽﾀｯｸ …$this->kakko_stck
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			if ( $this->kbn == 1) { // ｸﾌﾞﾝ …$this->kbn
				$this->g1['emsg'] = "経糸配列の繰返しのカッコの数が合っていません"; // G1-EMSG …$this->g1['emsg']
			} else {
				$this->g1['emsg'] = "緯糸配列の繰返しのカッコの数が合っていません"; // G1-EMSG …$this->g1['emsg']
			}
			return; // ﾊｲﾚﾂｼｮﾘ_e;
		}
		$this->HairetuTenkai(); // 配列展開 …HairetuTenkai
	}
	// *****************************************************************
	private function HairetuKigouSearch() { // 配列記号サーチ …HairetuKigouSearch
	//									$this->g1['point_1'][] = "KIGOｻｰﾁ";
	// *----------------------------------------------------------------
		$this->kigo = '';
		while ( $this->j < 400 && substr($this->hr, $this->j, 1) == "X") { // W-HRREC …$this->g1['hr']['rec']
			$this->j++;
		}
		if ( $this->j < 400) {
			$this->kigo = substr($this->hr, $this->j, 1); // W-HRREC …$this->g1['hr']['rec']
		}
		$this->j++;
	}
	// *****************************************************************
	private function HaireSuujiSearch() { // 配列数字サーチ …HaireSuujiSearch
										$this->g1['point_1'][] = "HAISｻｰﾁ  ";
	// *----------------------------------------------------------------
		$this->haire_suu = 0; // ZERO …0 // 配列数 …haire_suu
		$this->HairetuKigouSearch(); // 配列記号サーチ …HairetuKigouSearch
		while ( $this->j < 400 && is_numeric($this->kigo)) {
			$this->haire_suu = $this->haire_suu * 10 + (int)$this->kigo; // 配列数 …haire_suu // 配列数 …haire_suu
			$this->HairetuKigouSearch(); // 配列記号サーチ …HairetuKigouSearch
		}
		if ( $this->haire_suu == 0) { // 配列数 …haire_suu // ZERO …0
			$this->haire_suu = 1; // 配列数 …haire_suu
		}
		$this->j--;
	}
	// *****************************************************************
	private function HonsuuKeisan() { // 本数計算 …HonsuuKeisan
										$this->g1['point_1'][] = "ﾎﾝｽｳｹｲｻﾝ";
	// *----------------------------------------------------------------
		for ( $ii= 0; $ii < $this->cnt && $this->w_kigo != $this->t_ijun[$ii]; $ii++) { // ｶｳﾝﾄ …$this->cnt
			;
		}
		if ( $ii >= $this->cnt) { // ｶｳﾝﾄ …$this->cnt
			$this->cnt++; // ｶｳﾝﾄ …$this->cnt
			$this->t1[$ii]=[];
			$this->t1[$ii]['ijun'] = $this->w_kigo; // ｶｳﾝﾄ …$this->cnt
			$this->t1[$ii]['ihon'] = $this->haire_suu; // 配列数 …haire_suu // ｶｳﾝﾄ …$this->cnt
			$this->t_hons += $this->haire_suu; // ｶｳﾝﾄ …$this->cnt
		} else {
			$this->t1[$ii]['ihon'] += $this->haire_suu; // 配列数 …haire_suu
			$this->t_hons += $this->haire_suu; // ｶｳﾝﾄ …$this->cnt
		}
		if ( $this->t_hons > 999) {
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			if ( $this->kbn == 1) { // ｸﾌﾞﾝ …$this->kbn
				$this->g1['emsg'] = "経糸配列の大きさがオーバーします"; // G1-EMSG …$this->g1['emsg']
			} else {
				$this->g1['emsg'] = "緯糸配列の大きさがオーバーします"; // G1-EMSG …$this->g1['emsg']
			}
		}
	}
	// *****************************************************************
	private function HonsuuKeisan1() { // 本数計算１ …HonsuuKeisan1
										$this->g1['point_1'][] = "ﾎﾝｽｳｹｲｻﾝ1";
	// *----------------------------------------------------------------
		for ( $i= 0; $i < $this->douku_keta; $i++) { // 同口桁 …douku_keta
			for ( $ii= 0; $ii < $this->cnt && substr($this->douku_kigo, $i, 1) != $this->t1[$ii]['ijun']; $ii++) { // ｶｳﾝﾄ …$this->cnt // 同口記号 …douku_kigo
				;
			}
			if ( $ii >= $this->cnt) { // ｶｳﾝﾄ …$this->cnt
				$this->cnt++; // ｶｳﾝﾄ …$this->cnt
				$this->t1[$ii]=[];
				$this->t1[$ii]['ijun'] = $this->w_kigo; // ｶｳﾝﾄ …$this->cnt
				$this->t1[$ii]['ihon'] = $this->haire_suu;
				$this->t_hons += $this->haire_suu; // ｶｳﾝﾄ …$this->cnt
			} else {
				$this->t1[$ii]['ihon'] += $this->haire_suu;
				$this->t_hons += $this->haire_suu;
			}
		}
		if ( $this->t_hons >= 999) {
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			if ( $this->kbn == 1) { // ｸﾌﾞﾝ …$this->kbn
				$this->g1['emsg'] = "経糸配列の大きさがオーバーします"; // G1-EMSG …$this->g1['emsg']
			} else {
				$this->g1['emsg'] = "緯糸配列の大きさがオーバーします"; // G1-EMSG …$this->g1['emsg']
			}
		}
	}
	// *****************************************************************
	private function DoukutiKaisuuSan() { // 同口回数算出 …DoukutiKaisuuSan
										$this->g1['point_1'][] = "ﾄﾞｳｸﾁｶｲｽｳ";
	// *----------------------------------------------------------------
		for ( $i= 0; $i < $this->douku_cnt && $this->douku_kigo != $this->t3[$i]['douk']; $i++) { // ﾄﾞｳｸﾁCNT …$this->douku_cnt // 同口記号 …douku_kigo
			;
		}
		if ( $i >= $this->douku_cnt) { // ﾄﾞｳｸﾁCNT …$this->douku_cnt
			for ( $i= 0; $i < 8; $i++) {
				if ( substr($this->douku_kigo, 0, 1) == substr($this->t3[$i]['douk'], 0, 1)) { // 同口記号 …douku_kigo
					$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
					$this->g1['emsg'] = "同口で複数の糸指定はできません"; // G1-EMSG …$this->g1['emsg']
					return; // ﾄﾞｳｸﾁｶｲｽｳ_e;
				}
			}
			$this->douku_cnt++; // ﾄﾞｳｸﾁCNT …$this->douku_cnt
			$this->t3[$this->douku_cnt]['douk'] = $this->douku_kigo; // 同口記号 …douku_kigo // ﾄﾞｳｸﾁCNT …$this->douku_cnt
			$this->t3[$this->douku_cnt]['kais'] = 1; // ﾄﾞｳｸﾁCNT …$this->douku_cnt
		} else {
			$this->t3[$i]['kais']++;
		}
	}
	// *****************************************************************
	private function HairetuTenkai() { // 配列展開 …HairetuTenkai
										$this->g1['point_1'][] = "ﾊｲﾚﾂﾃﾝｶｲ";
	// *----------------------------------------------------------------
		for ( $i= 0; $i < strlen($this->hr); $i++) {
			$x = substr($this->hr, $i, 1);
			switch ( true) {
				case $x >= "A" && $x <= "H": // W-HRREC …$this->g1['hr']['rec']
					$this->ItokigouHanbetu($x); // 糸記号判別 …ItokigouHanbetu
					$this->t5_suji .= ' ';
				break;
				case $x == "(" || $x == ")" || substr($this->hr, $i, 1) == "X": // W-HRREC …$this->g1['hr']['rec']
					$this->t5_suji .= $x; // W-HRREC …$this->g1['hr']['rec']
					$this->t5_kigo .= ' ';
				break;
				case $x == "<" || $x == ">": // W-HRREC …$this->g1['hr']['rec']
					$this->t5_kigo .= $x; // W-HRREC …$this->g1['hr']['rec']
					$this->t5_suji .= ' ';
				break;
				case is_numeric($x): // W-HRREC …$this->g1['hr']['rec']
					$this->t5_suji .= $x; // W-HRREC …$this->g1['hr']['rec']
					$this->t5_kigo .= ' ';
				break;
				default:
					$this->t5_kigo .= ' ';
					$this->t5_suji .= ' ';
				break;
			}
		}
	}
	// *****************************************************************
	private function ItokigouHanbetu($x) { // 糸記号判別 …ItokigouHanbetu
//										$this->g1['point_1'][] = "ｲﾄﾊﾝﾍﾞﾂ";
	// *----------------------------------------------------------------
		switch ( $x) { // W-HRREC …$this->g1['hr']['rec']
			case  "A":
				$this->t5_kigo .= "|";
			break;
			case  "B":
				$this->t5_kigo .= ".";
			break;
			case  "C":
				$this->t5_kigo .= "S";
			break;
			case  "D":
				$this->t5_kigo .= "#";
			break;
			case  "E":
				$this->t5_kigo .= "$";
			break;
			case  "F":
				$this->t5_kigo .= "F";
			break;
			case  "G":
				$this->t5_kigo .= "G";
			break;
			case  "H":
				$this->t5_kigo .= "H";
			break;
		}
	}
	// *****************************************************************
	private function BodyCheck() { // ボディチェック …BodyCheck
										$this->g1['point_1'][] = "B-CHECK";
	// *----------------------------------------------------------------
		if ( $this->g1['htkb'] >= 2) { // G1-HTKB …$this->g1['htkb']
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "経糸配列区分は０～１です"; // G1-EMSG …$this->g1['emsg']
			return;
		}
		if ( $this->g1['hykb'] >= 3) { // G1-HYKB …$this->g1['hykb']
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "緯糸配列区分は０～２です"; // G1-EMSG …$this->g1['emsg']
			return;
		}
		if ( $this->g1['htkb'] == 1 && $this->g1['hykb'] == 2) { // G1-HTKB …$this->g1['htkb'] // G1-HYKB …$this->g1['hykb']
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "経緯無地の場合は、緯糸配列区分にも１を入力して下さい"; // G1-EMSG …$this->g1['emsg']
			return;
		}
		$cnt = 0; // ZERO …0 // ｶｳﾝﾄ …$this->cnt
		for ( $i= 0; $i < count($this->g1['chui']); $i++) {
			for ( $j= 0; $j < count($this->g1['chui'][$i]); $j++) {
				if ( $this->g1['chui'][$i][$j] > "") {
					$cnt++; // ｶｳﾝﾄ …$this->cnt
				}
			}
		}
		if ( $this->g1['chui_cnt'] + $cnt > 16) { // ﾁｭｳｲCNT …$this-chui_cnt // ｶｳﾝﾄ …$this->cnt
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "注意事項が多すぎます"; // G1-EMSG …$this->g1['emsg']
			return;
		}
		if ( $this->g1['htkb'] == 1) { // G1-HTKB …$this->g1['htkb']
			if ( trim($this->hrt) > "") { // W-HRRECT …$this->g1['hr']['rect']
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "無地の時、配列記号の入力はできません"; // G1-EMSG …$this->g1['emsg']
				return;
			}
			if ( $this->g1['htsi'] > 0) { // G1-HTSI …$this->g1['htsi']
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "無地の時、中心の入力はできません"; // G1-EMSG …$this->g1['emsg']
				return;
			}
		}
		if ( $this->g1['hykb'] == 1 || $this->g1['hykb'] == 2) { // G1-HYKB …$this->g1['hykb']
			if ( trim($this->hry) > "") { // W-HRRECY …$this->g1['hr']['recy']
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "無地，共通の時、配列記号の入力はできません"; // G1-EMSG …$this->g1['emsg']
				return;
			}
		}
	}
	// *****************************************************************
	private function TailCheck() { // テールチェック …TailCheck
										$this->g1['point_1'][] = "T-CHECK";
	// *----------------------------------------------------------------
	}

}

<?php

class Haiz210Controller extends ControllerBase
{
	private $iu=[]; // 糸原価マスター
	private $ik; 	// 糸名マスター
	private $ht=[]; // 糸条件マスター
	private $hd; 	// デシテックスマスター
	private $hv=[]; 	// 工費算出条件マスター
	private $invflg=0;
	private $g1=[]; // jsとデータ交換
	private $t_itotukai = "T CDN R CUACTAW C L RAS PUVNANLMCBSNMALYPVHENEPSPLSLSTOJMOFPNPP"; // T-ｲﾄﾂｶｲ
	private $sv=[]; // body3のtayo[]セーブ
	private $j=0;
	private $k=0;
	private $l=0; // L=糸名作成ネストレベル
	private $w_itomei='';
	private $w_denl=0;
	private $kakko_flg=0;
	private $hv_start=[]; 	// 工費算出各条件開始行
	private $hv_end=[]; 	// 工費算出各条件最終行
	private $mm=[];
	private $w1_glvl_x='';

	/**
	 * Index action
	 */
	public function indexAction()
	{
	}

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
			case 'BODY1_CHECK':
				$this->Body1Check();
				break;
			case 'BODY2_CHECK':
				$this->Body2Check();
				break;
			case 'BODY3_CHECK':
				$this->Body3Check();
				break;
		}
		$response->setContent(json_encode($this->g1)); // json変換 g1
		return $response;  // javascriptへ戻り値 g1
	}

	// *****************************************************************
	private function Body1Check() { // ﾎﾞﾃﾞｨ1ﾁｪｯｸ …Body1Check
											$this->g1['point_1'] .= "Body1Check()\n";
	// *----------------------------------------------------------------
		$this->iu[] = new HItogenMrs();
		$this->ik = new HItomeiMrs();
		$this->ht[] = new HItojoMrs();
		$this->hd = new HDtexMrs();
		for ($i=0; $i<18 && $this->g1['errflg'] == 0; $i++) {
			$this->Body1MeisaiCheck($i);
		}
	}

	// *****************************************************************
	private function Body1MeisaiCheck($i) { // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ …Body1MeisaiCheck
											$this->g1['point_1'] .= "Body1MeisaiCheck($i)\n";
	// *----------------------------------------------------------------
		if ( substr( $this->g1['HSigenMrs'][$i]['biko'],0,1) == "#") {
			$ik_cd = trim(substr( $this->g1['HSigenMrs'][$i]['biko'],1,5));
			$this->ItocdCheck($ik_cd); // ｲﾄｺｰﾄﾞﾁｪｯｸ …ItocdCheck
			if ( $this->g1['errflg'] == 1) {
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $this->g1['HSigenMrs'][$i]['gno'], $pos, 3);
				return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			}
			if ( $this->ik->gumu == 1) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "糸№　糸コードは購入糸にしてください。!";
				$okikae = $this->g1['HSigenMrs'][$i]['gno'];
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
				return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			}
			$this->GensiMeiTori($i); // 原糸名データ取り込み …GensiMeiTori
		} else {
			$this->g1['HSigenMrs'][$i]['wbiko'] = $this->g1['HSigenMrs'][$i]['biko'];
		}

	// *ｲﾄﾂｶｲ･ｺﾝﾘﾂﾁｪｯｸ
		$itotukai=[];
		for ($j=0; $j<strlen($this->t_itotukai); $j+=2) {
			$itotukai[]=trim(substr($this->t_itotukai,$j,2));
		}
	
		if ( $this->g1['HSigenMrs'][$i]['gito'] == '') {
			if ( !$this->g1['HSigenMrs'][$i]['kik1'] 
				&& !$this->g1['HSigenMrs'][$i]['kik2'] 
				&& !$this->g1['HSigenMrs'][$i]['ktni'] 
				&& !$this->g1['HSigenMrs'][$i]['wbiko'] 
				&& $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][0]['kon'].
					$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][1]['kon'].
					$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][2]['kon'].
					$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][3]['kon'] == ""
				&& $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][0]['rit']+
					$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][1]['rit']+
					$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][2]['rit']+
					$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][3]['rit'] == 0
				) { // ZERO …0
				;
			} else {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "糸№　糸名が入力されていない。";
				$okikae = $this->g1['HSigenMrs'][$i]['gno'];
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
				return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			}
			return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
		}
		if ( $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][0]['kon'] == '') {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "糸№　糸使いが入力されていない。";
			$okikae = $this->g1['HSigenMrs'][$i]['gno'];
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
			return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
		}
		if ( $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][0]['rit'] == 0) {
			$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][0]['rit'] = 100
			- $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][1]['rit']
			- $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][2]['rit']
			- $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][3]['rit'];
		}
		for ($j = 0; $j < 4; $j++) {
			if ( $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$j]['kon'] == '' && $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$j]['rit'] > 0) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "糸№　混率だけが入力されている。".($j+1).':'.$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$j]['kon'].'=='.$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$j]['rit'];
				$okikae = $this->g1['HSigenMrs'][$i]['gno'];
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
				return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			}
			if ( $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$j]['kon'] > '' && $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$j]['rit'] == 0) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "糸№　混率が入力されていない。";
				$okikae = $this->g1['HSigenMrs'][$i]['gno'];
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
				return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			}
		}
		if ( $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][2 ]['kon'] == '' && $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][3 ]['kon'] > '' || $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][3 ]['kon'] == '' && $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][4 ]['kon'] > '') {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "糸№　糸使いは前詰めで入力してください";
			$okikae = $this->g1['HSigenMrs'][$i]['gno'];
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
			return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
		}
		for ( $j= 0; $j < 4 && $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$j]['kon'] != '';$j +=  1) {
			for ( $k= 0; $k < count($itotukai) && $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$j]['kon'] != $itotukai [ $k ];$k +=  1) { // ｲﾄﾂｶｲCNT …itotukai_cnt // ｲﾄﾂｶｲ …itotukai
				;
			}
			if ( $k >= count($itotukai)) { // ｲﾄﾂｶｲCNT …itotukai_cnt
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "糸№　糸使いコードが間違えている。";
				$okikae = $this->g1['HSigenMrs'][$i]['gno'];
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
				return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			}
			for ( $k= $j+1; $k < 4 && $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$j]['kon']
								 != $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$k]['kon']; $k++) {
				;
			}
			if ( $k < 4) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "糸№　糸使いコードが重複している。".$j.$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][$k]['kon'].$k;
				$okikae = $this->g1['HSigenMrs'][$i]['gno'];
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
				return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			}
		}
		if ( $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][0]['rit'] == 0) {
			if ( $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][1]['rit']
				+ $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][2]['rit']
				+ $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][3]['rit'] >= 100) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "糸№　混率が１００％を越えている。";
				$okikae = $this->g1['HSigenMrs'][$i]['gno'];
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
				return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			} else {
				$this->g1['HSigenMrs'][$i]['HSigenKonMrs'][0]['rit'] = 100
				- $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][1]['rit']
				- $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][2]['rit']
				- $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][3]['rit'];
			}
		} else {
			if ( $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][0]['rit']
				+ $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][1]['rit']
				+ $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][2]['rit']
				+ $this->g1['HSigenMrs'][$i]['HSigenKonMrs'][3]['rit'] != 100) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "糸№　混率合計が１００％にならない。";
				$okikae = $this->g1['HSigenMrs'][$i]['gno'];
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
				return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			}
		}
	// *
		switch ( $this->g1['HSigenMrs'][$i]['ktni'] ) {
		case "":
		case "D":
		case "W":
		case "C":
		case "L":
		case "A":
		case "T":
		case "K":
			break;
		default:
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "糸№　規格単位はＤ・Ａ＝デニール，Ｗ・Ｃ・Ｌ＝毛綿麻番手，Ｔ・Ｋ＝デシテ";
			$okikae = $this->g1['HSigenMrs'][$i]['gno'];
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
			return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			break;
		}
		switch ( $this->g1['HSigenMrs'][$i]['ktni'] ) {
		case "T":
		case "K":
			$hddtex = $this->g1['HSigenMrs'][$i]['kik1'];
			$this->DtexChain($hddtex); // デシテックス変換の索引 …DtexChain
			if ( invflg == 1) {
				$this->g1['errflg'] = 1;
				$this->g1['emsg'] = "糸№　のデシテックス値が変換表にありません。";
				$okikae = $this->g1['HSigenMrs'][$i]['gno'];
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3);
				return; // ﾎﾞﾃﾞｨ1ﾒｲｻｲﾁｪｯｸ_e;
			} else {
				$this->g1['HSigenMrs'][$i]['kikd'] = $this->hd->cd;
				if ( $this->g1['HSigenMrs'][$i]['ktni'] == "T") {
					$this->g1['HSigenMrs'][$i]['ktnd'] = "D";
				} else {
					$this->g1['HSigenMrs'][$i]['ktnd'] = "A";
				}
			}
			break;
		default:
			$this->g1['HSigenMrs'][$i]['kikd'] = $this->g1['HSigenMrs'][$i]['kik1'];
			$this->g1['HSigenMrs'][$i]['ktnd'] = $this->g1['HSigenMrs'][$i]['ktni'];
			break;
		}
		$this->GensiDnl($i); // 原糸デニール計算 …GensiDnl
	}

	// *****************************************************************
	private function GensiMeiTori($m) { // 原糸名データ取り込み …GensiMeiTori
											$this->g1['point_1'] .= "GensiMeiTori($m)\n";
	// *----------------------------------------------------------------
		$im = str_replace("ﾃﾄﾛﾝ","T",$this->ik->itme);
		$this->g1['HSigenMrs'][$m]['biko'] = '#'.$this->ik->cd;
		$n = strpos($im," ");
		if ( $this->ik->biko == '' && $n >= 3) {
			$this->g1['HSigenMrs'][$m]['gito'] = trim(mb_strimwidth(substr($im, 0, $n),0,8));
			$this->g1['HSigenMrs'][$m]['wbiko'] = trim(mb_strimwidth($this->ik->itme, $n,8));
		} else {
			$this->g1['HSigenMrs'][$m]['gito'] = mb_strimwidth($im,0,8);
			$this->g1['HSigenMrs'][$m]['wbiko'] = mb_strimwidth($this->ik->biko,0,8);
		}
		$this->g1['HSigenMrs'][$m]['kota'] = $this->ik->ktak;
		$this->g1['HSigenMrs'][$m]['kik1'] = $this->g1['HSigenMrs'][$m]['kikd'] = (int)$this->ik->kden;
		$this->g1['HSigenMrs'][$m]['kik2'] = (int)$this->ik->kfil;
		for ( $n= 0; $n < count($this->iu);$n++) {
			$this->g1['HSigenMrs'][$m]['HSigenKonMrs'][$n]['kon'] = $this->iu[$n]->gcd;
			$this->g1['HSigenMrs'][$m]['HSigenKonMrs'][$n]['rit'] = $this->iu[$n]->tani * 100;
		}
	}

	// *****************************************************************
	private function GensiDnl($m) { // 原糸デニール計算 …GensiDnl
											$this->g1['point_1'] .= "GensiDnl($m)\n";
	// *----------------------------------------------------------------
		switch ( true ) {
			case  $this->g1['HSigenMrs'][$m]['kik2'] < 5 && $this->g1['HSigenMrs'][$m]['kik1'] >= 5 && $this->g1['HSigenMrs'][$m]['ktni']=='':
				$this->g1['HSigenMrs'][$m]['ktnd'] = $this->g1['HSigenMrs'][$m]['ktni'] = "C";
				break;
			case  $this->g1['HSigenMrs'][$m]['kik1'] < 5 && $this->g1['HSigenMrs'][$m]['kik2'] >= 5 && $this->g1['HSigenMrs'][$m]['ktni']=='':
				$this->g1['HSigenMrs'][$m]['ktnd'] = $this->g1['HSigenMrs'][$m]['ktni'] = "W";
				break;
			case  $this->g1['HSigenMrs'][$m]['ktni']=='':
				$this->g1['HSigenMrs'][$m]['ktnd'] = $this->g1['HSigenMrs'][$m]['ktni'] = "D";
				break;
		}
		switch ( true ) {
			case  $this->g1['HSigenMrs'][$m]['ktni']=="W" && $this->g1['HSigenMrs'][$m]['kikd'] > 1:
				$this->g1['HSigenMrs'][$m]['gendenl'] = 9000 / $this->g1['HSigenMrs'][$m]['kik2'] * $this->g1['HSigenMrs'][$m]['kik1'];
				break;
			case  $this->g1['HSigenMrs'][$m]['ktni']=="W":
				$this->g1['HSigenMrs'][$m]['gendenl'] = 9000 / $this->g1['HSigenMrs'][$m]['kik2'];
				break;
			case  $this->g1['HSigenMrs'][$m]['ktni']=="C" && $this->g1['HSigenMrs'][$m]['kik2'] > 1:
				$this->g1['HSigenMrs'][$m]['gendenl'] = 5315 / $this->g1['HSigenMrs'][$m]['kik1'] * $this->g1['HSigenMrs'][$m]['kik2'];
				break;
			case  $this->g1['HSigenMrs'][$m]['ktni']=="C":
				$this->g1['HSigenMrs'][$m]['gendenl'] = 5315 / $this->g1['HSigenMrs'][$m]['kik1'];
				break;
			case  $this->g1['HSigenMrs'][$m]['ktni']=="L" && $this->g1['HSigenMrs'][$m]['kik2'] > 1:
				$this->g1['HSigenMrs'][$m]['gendenl'] = 14882 / $this->g1['HSigenMrs'][$m]['kik1'] * $this->g1['HSigenMrs'][$m]['kik2'];
				break;
			case  $this->g1['HSigenMrs'][$m]['ktni']=="L":
				$this->g1['HSigenMrs'][$m]['gendenl'] = 14882 / $this->g1['HSigenMrs'][$m]['kik1'];
				break;
			default:
				$this->g1['HSigenMrs'][$m]['gendenl'] = $this->g1['HSigenMrs'][$m]['kikd'];
				break;
		}
	}

	// *****************************************************************
	// private function ﾆﾎﾝｺﾞﾍﾝｶﾝ() {} // 使いません
	//										$this->g1['point_1'] .= "ﾆﾎﾝｺﾞﾍﾝｶﾝ()\n";
	// *----------------------------------------------------------------
	// *****************************************************************
	private function ItocdCheck($cd) { // ｲﾄｺｰﾄﾞﾁｪｯｸ …ItocdCheck
											$this->g1['point_1'] .= "ItocdCheck($cd)\n";
	// *----------------------------------------------------------------
		$invflg = $this->ItogenMrChain($cd); // 糸原価マスターの索引 …ItogenMrChain
											$this->g1['point_1'] .= "invflg($invflg)\n";
		if ( $invflg == 1) {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "糸№　糸コード糸原価ＭＲになし";
			return; // ｲﾄｺｰﾄﾞﾁｪｯｸ_e;
		}
		$invflg = $this->ItomeiMrChain($cd); // 糸名マスターの索引 …ItomeiMrChain
											$this->g1['point_1'] .= "invflg($invflg)\n";
		if ( $invflg == 1) {
			$this->g1['errflg'] = 1;
			$this->g1['emsg'] = "糸№　糸コード糸名ＭＲになし";
			return; // ｲﾄｺｰﾄﾞﾁｪｯｸ_e;
		}
		if ( $this->ik->gumu == 1) {
			$invflg = $this->HItojoMrsStart($cd); // 糸条件マスターの位置決め …ItomeiMrStart + 糸条件マスターの読込み …ItojoMrRead
		}
	}

	// *****************************************************************
	private function Body2Check() { // ﾎﾞﾃﾞｨﾁｪｯｸ2 …$this->Body2Check		point_1 = "B2-CHECK";
											$this->g1['point_1'] .= "Body2Check()\n";
	// *----------------------------------------------------------------
		$this->iu[] = new HItogenMrs();
		$this->ik = new HItomeiMrs();
		$this->ht[] = new HItojoMrs();
		$this->hd = new HDtexMrs();

		$this->KohisanSet(); // 工費算出条件ＰＦセット
		$this->j = 0;
		for ( $i= 0; $i < 36 && $this->g1['errflg'] != 1;$i++) { // I …$i // I …$i // ERRFLG …$this->g1['errflg']
			$this->Body2KihonCheck($i); // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ …$this->Body2KihonCheck
			$this->g1['HSinenMrs'][$i]['kohi']=0; // W1-KOHI …$this->g1['HSinenMrs'][$i]['kohi'] // I …$i // W1-HQICD …$this->g1['HSinenMrs'][$i]['hqicd'] // I …$i // W1-ｹﾞﾝﾀﾝｲ1 …$this->g1['HSinenMrs'][$i]['gen1'] // I …$i // W1-ｹﾞﾝﾀﾝｲ2 …$this->g1['HSinenMrs'][$i]['gen2'] // I …$i // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // I …$i
		}
		$this->j = 0;
		$flg_siyou = 0; // ZERO …0 // J …$j // FLG-SIYOU …$flg_siyou
// *                                     J=経糸緯糸名の行数
		for ( $i= 0; $i < 36 && $this->g1['errflg'] != 1;$i++) { // I …$i // I …$i // ERRFLG …$this->g1['errflg']
			if ( $this->g1['HSinenMrs'][$i]['ijun'] > '') { // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // SPACE …''
				$this->w_itomei = ''; // SPACE …'' // W-ｲﾄﾒｲ …$this->w_itomei
				$this->k = 0; // K …$k
				$this->l = 0; // L …$l
				$m = $i + 30; // M …$m // I …$i
// *                                     K=経糸緯糸名の桁数
// *                                     L=糸名作成ﾙｰﾁﾝ呼出しﾚﾍﾞﾙ
// *                                     M=糸名作成ﾙｰﾁﾝ呼出時糸№
				$this->sv['tayo']=$this->g1['HSiitoMrs']; // 後でセット温度など戻せるようにセーブ

				$this->ItoMei($m); // 糸名作成 …$this->ItoMei
				
				for ( $k= $this->j;
					!($k < 1
						|| $this->g1['HSinenMrs'][$i]['ijun'] > $this->g1['HSiitoMrs'][$k - 1]['mjun']
							&& $this->g1['HSinenMrs'][$i]['ijun'] >= "A"
							&& $this->g1['HSiitoMrs'][$k - 1]['mjun'] >= "A"
						|| $this->g1['HSinenMrs'][$i]['ijun'] > $this->g1['HSiitoMrs'][$k - 1]['mjun']
							&& $this->g1['HSinenMrs'][$i]['ijun'] <= " H"
							&& $this->g1['HSiitoMrs'][$k - 1]['mjun'] <= " H"
						|| $this->g1['HSinenMrs'][$i]['ijun'] <= " H"
							&& $this->g1['HSiitoMrs'][$k - 1]['mjun'] >= "A"
						);
					$k--) { // K …$k // J …$j // K …$k // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // K …$k // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // K …$k // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // K …$k // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // K …$k // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // K …$k
					$this->g1['HSiitoMrs'][$k] = $this->g1['HSiitoMrs'][$k-1]; // W1-TAYO …$this->g1['HSiitoMrs'][$i] // K …$k // W1-TAYO …$this->g1['HSiitoMrs'][$i] // K …$k
				}
				$this->g1['HSiitoMrs'][$k]['imei'] = $this->w_itomei; // W-ｲﾄﾒｲ …$this->w_itomei // W1-ITOM …$this->g1['HSiitoMrs'][$i]['imei'] // K …$k
				$this->g1['HSiitoMrs'][$k]['mjun'] = $this->g1['HSinenMrs'][$i]['ijun']; // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // K …$k
				$this->g1['HSiitoMrs'][$k]['mjun'] = $this->g1['HSinenMrs'][$i]['ijun']; // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // K …$k
				$this->g1['HSiitoMrs'][$k]['kakouban'] = $i + 30; // W1-ｶｺｳﾊﾞﾝｺﾞｳ …$this->g1['HSiitoMrs'][$i]['kakouban'] // K …$k // I …$i
				$this->g1['HSiitoMrs'][$k]['denl'] = $this->w_denl; // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-DENL …$this->g1['HSiitoMrs'][$i]['denl'] // K …$k
				$this->g1['HSiitoMrs'][$k]['ondo']=0; // W1-ONDO …$this->g1['HSiitoMrs'][$i]['ondo'] // K …$k 
				$this->g1['HSiitoMrs'][$k]['hun']=0; // W1-HUN …$this->g1['HSinenMrs'][$i]['hun'] // K …$k 
				$this->g1['HSiitoMrs'][$k]['nori']=""; // W1-NORI …$this->g1['HSiitoMrs'][$i]['nori'] // K …$k
				$this->j += 1; // J …$j
			}
		}
		while ( $this->j < 15 && $this->g1['errflg'] != 1) { // J …$j // ERRFLG …$this->g1['errflg']
			$this->g1['HSiitoMrs'][$this->j]=[]; // W1-TAYO …$this->g1['HSiitoMrs'][$i] // J …$j
			$this->j++; // J …$j
		}
		$this->Body2AtoCheck(); // ﾎﾞﾃﾞｨ2ｱﾄﾁｪｯｸ …$this->Body2AtoCheck
	}
	// *****************************************************************
	private function KohisanSet() { // 工費算出条件ＰＦセット …$this->KohisanSet		point_1 = "HV-SET";
											$this->g1['point_1'] .= "KohisanSet()\n";
	// *----------------------------------------------------------------
		$this->hv = HKohisanMrs::find(['order'=>'cd']); // 工費算出条件ＰＦセット
		for ($i=0;$i<count($this->hv);$i++) {
			if ($this->hv_start[$this->hv[$i]->kono]==0) {
				$this->hv_start[$this->hv[$i]->kono]=$i;
			}
			$this->hv_end[$this->hv[$i]->kono]=$i;
		}
	}
	// *****************************************************************
	private function Body2KihonCheck($i) { // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ …$this->Body2KihonCheck		point_1 = "B2ｷﾎﾝ CK";
											$this->g1['point_1'] .= "Body2KihonCheck($i)\n";
	// *----------------------------------------------------------------
		if ( $this->g1['HSinenMrs'][$i]['ito1']==0
			&& $this->g1['HSinenMrs'][$i]['hon1']==0
			&& $this->g1['HSinenMrs'][$i]['ito2']==0
			&& $this->g1['HSinenMrs'][$i]['hon2']==0
			&& $this->g1['HSinenMrs'][$i]['yori']==0
			&& $this->g1['HSinenMrs'][$i]['hoko']==''
			&& $this->g1['HSinenMrs'][$i]['kbn1']==''
			&& $this->g1['HSinenMrs'][$i]['kbn2']==''
			&& $this->g1['HSinenMrs'][$i]['kako']==''
			) { // ZERO …0 // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // I …$i // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // I …$i // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // I …$i // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // I …$i // W1-YORI …$this->g1['HSinenMrs'][$i]['yori'] // I …$i // SPACE …'' // W1-HOKO …$this->g1['HSinenMrs'][$i]['hoko'] // I …$i // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // I …$i // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // I …$i // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // I …$i
			if ( $this->g1['HSinenMrs'][$i]['ijun'] > '') { // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // SPACE …''
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　糸順があるのに構成データがない。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
			}
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['ito1'] == 0
			&& substr($this->g1['HSinenMrs'][$i]['kako'], 0, 1) != "#") { // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // I …$i // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // I …$i
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　糸１か糸コードがない。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( substr($this->g1['HSinenMrs'][$i]['ijun']." ", 0, 1) == " " 
			||	substr($this->g1['HSinenMrs'][$i]['ijun'], 0, 1) >= "A" && 
				substr($this->g1['HSinenMrs'][$i]['ijun'], 0, 1) <= "H") { // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i
			;
		} else {
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　経糸順はＡ～Ｈです。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( substr($this->g1['HSinenMrs'][$i]['ijun']."  ", 1, 1) == " " 
			||	substr($this->g1['HSinenMrs'][$i]['ijun'], 1, 1) >= "A" && 
				substr($this->g1['HSinenMrs'][$i]['ijun'], 1, 1) <= "G") { // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i
			;
		} else {
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　緯糸順はＡ～Ｇです。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['ijun'] != '') { // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // SPACE …''
			$this->j += 1; // J …$j
			if ( $this->j > 15) { // J …$j
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　経糸緯糸要素が１５件を越えた"; // G1-EMSG …$this->g1['emsg']
				$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
			}
		}
	// *
		for ( $k= 1; 
			!(	$k >= $i
			 || substr($this->g1['HSinenMrs'][$i]['ijun'].' ',0, 1) == ' ' 
			 || substr($this->g1['HSinenMrs'][$k]['ijun'].' ',0, 1) == substr($this->g1['HSinenMrs'][$i]['ijun'].' ',0, 1)
			);
			$k +=  1) { // K …$k // K …$k // I …$i // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // SPACE …'' // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // K …$k // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i
			;
		}
		if ( substr($this->g1['HSinenMrs'][$i]['ijun'].' ', 0, 1) > ' ' && $k < $i) { // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // SPACE …'' // K …$k // I …$i
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　と　の経糸順が重複している。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$k]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // K …$k
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		for ( $k= 1; 
			!(	$k >= $i
			 || substr($this->g1['HSinenMrs'][$i]['ijun'].'  ', 1, 1) == ' ' 
			 || substr($this->g1['HSinenMrs'][$k]['ijun'].'  ', 1, 1) == substr($this->g1['HSinenMrs'][$i]['ijun'].'  ',1, 1)
			);
			$k +=  1) { // K …$k // K …$k // I …$i // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // SPACE …'' // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // K …$k // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i
			;
		}
		if ( substr($this->g1['HSinenMrs'][$i]['ijun'], 1, 1) > '' && $k < $i) { // W1-IJUN …$this->g1['HSinenMrs'][$i]['ijun'] // I …$i // SPACE …'' // K …$k // I …$i
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　と　の緯糸順が重複している。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$k]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // K …$k
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['ito1'] <= 18 
			||	$this->g1['HSinenMrs'][$i]['ito1'] > 30 && 
				$this->g1['HSinenMrs'][$i]['ito1'] <= 66) { // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // I …$i
			;
		} else {
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　糸１が原糸１～１８か加工糸３１～６６でない。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['ito1'] >= 1 && $this->g1['HSinenMrs'][$i]['ito1'] <= 18) { // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // I …$i
			$k = $this->g1['HSinenMrs'][$i]['ito1']-1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // I …$i // K …$k
			if ( $this->g1['HSigenMrs'][$k]['gito'] == '') { // W1-GITO …$this->g1['HSigenMrs'][$i]['gito'] // K …$k // SPACE …''
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　糸１の原糸番号は原糸名がない。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
			}
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['ito2'] >= 1 && $this->g1['HSinenMrs'][$i]['ito2'] <= 18) { // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // I …$i
			$k = $this->g1['HSinenMrs'][$i]['ito2']-1; // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // I …$i // K …$k
			if ( $this->g1['HSigenMrs'][$k]['gito'] == '') { // W1-GITO …$this->g1['HSigenMrs'][$i]['gito'] // K …$k // SPACE …''
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　糸２の原糸番号は原糸名がない。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
			}
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['ito1'] > 30) { // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // I …$i
			$k = $this->g1['HSinenMrs'][$i]['ito1'] - 30 - 1; // K …$k // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // I …$i
			if ( $this->g1['HSinenMrs'][$k]['ito1'] == 0 && substr($this->g1['HSinenMrs'][$k]['kako'], 0, 1) != "#") { // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // K …$k // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // K …$k
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　糸１の加工番号は糸がない。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
			}
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['ito2'] > 30) { // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // I …$i
			$k = $this->g1['HSinenMrs'][$i]['ito2'] - 30 - 1; // K …$k // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // I …$i
			if ( $this->g1['HSinenMrs'][$k]['ito1'] == 00 && substr($this->g1['HSinenMrs'][$k]['kako'], 0, 1) != "#") { // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // K …$k // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // K …$k
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　糸２の加工番号は糸がない。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
			}
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['ito1'] == 0 && $this->g1['HSinenMrs'][$i]['hon1'] > 0) { // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // I …$i // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // I …$i
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　本数１があるのに糸１がない。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['ito2'] == 0 && $this->g1['HSinenMrs'][$i]['hon2'] > 0) { // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // I …$i // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // I …$i
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　本数２があるのに糸２がない。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		$k = $this->g1['HSinenMrs'][$i]['kote'];
		if ( $k == 0 || $k == 2 || $k == 3) { // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // I …$i
			;
		} else {
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　工程は０加工無し、２仮撚、３撚糸です。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		$h = $this->g1['HSinenMrs'][$i]['hoko'];
		if ( $this->g1['HSinenMrs'][$i]['kote'] == 0 && $h == "" 
			|| $this->g1['HSinenMrs'][$i]['kote'] == 2 && ( $h == "S" || $h == "Z" || $h == "" ) 
			|| $this->g1['HSinenMrs'][$i]['kote'] == 3 && ( $h == "S" || $h == "Z" )
			|| substr($this->g1['HSinenMrs'][$i]['kako'], 0, 1) == "#") { // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // I …$i // W1-HOKO …$this->g1['HSinenMrs'][$i]['hoko'] // I …$i // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // I …$i // W1-HOKO …$this->g1['HSinenMrs'][$i]['hoko'] // I …$i // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // I …$i // W1-HOKO …$this->g1['HSinenMrs'][$i]['hoko'] // I …$i // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // I …$i
			;
		} else {
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　撚方向はＳ右撚、Ｚ左撚です。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['kote'] == 0 && $this->g1['HSinenMrs'][$i]['yori'] == 0 
			|| $this->g1['HSinenMrs'][$i]['kote'] == 2 
			|| $this->g1['HSinenMrs'][$i]['kote'] == 3 && $this->g1['HSinenMrs'][$i]['yori'] > 0) { // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // I …$i // W1-YORI …$this->g1['HSinenMrs'][$i]['yori'] // I …$i // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // I …$i // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // I …$i // W1-YORI …$this->g1['HSinenMrs'][$i]['yori'] // I …$i
			;
		} else {
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　撚数がおかしい。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['kote'] == 0 && 
				( $this->g1['HSinenMrs'][$i]['kbn1'] > '' || $this->g1['HSinenMrs'][$i]['kbn2'] > '' )) { // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // I …$i // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // I …$i // SPACE …'' // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // I …$i // SPACE …''
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　工程が０の時、加工主副は指定できません。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['kbn1'] == '' && $this->g1['HSinenMrs'][$i]['kbn2'] > '') { // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // I …$i // SPACE …'' // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // I …$i // SPACE …''
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　加工主副は前詰めで入力してください。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		for ( $k= 1; 
			!(	substr($this->g1['HSinenMrs'][$i]['kako'], 0, 1) != "#"
			 || $k >= $i
			 || $this->g1['HSinenMrs'][$k]['kako'] == $this->g1['HSinenMrs'][$i]['kako']
			);
			$k +=  1) { // K …$k // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // I …$i // K …$k // I …$i // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // K …$k // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // I …$i
			;
		}
		if ( substr($this->g1['HSinenMrs'][$i]['kako'], 0, 1) == "#" && $k < $i) { // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // I …$i // K …$k // I …$i
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　と　の糸コードが重複している。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$k]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // K …$k
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ2ｷﾎﾝﾁｪｯｸ_e;
		}
	// *
		if ( $this->g1['HSinenMrs'][$i]['ito1'] > 0 && $this->g1['HSinenMrs'][$i]['hon1'] == 0) { // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // I …$i // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // I …$i
			$this->g1['HSinenMrs'][$i]['hon1'] = 1; // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // I …$i
		}
		if ( $this->g1['HSinenMrs'][$i]['ito2'] > 0 && $this->g1['HSinenMrs'][$i]['hon2'] == 0) { // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // I …$i // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // I …$i
			$this->g1['HSinenMrs'][$i]['hon2'] = 1; // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // I …$i
		}
	}
	// *****************************************************************
	private function ItoMei($m) { // 糸名作成 …$this->ItoMei		point_1 = "B-ITOME ";
											$this->g1['point_1'] .= "ItoMei($m)\n";
	// *----------------------------------------------------------------
		if ( $this->l > 8) { // L …$l
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　加工回数が８回を越えた。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
		} else {
			if ( $m >= 30) { // M …$m
				$this->g1['HSinenMrs'][$m-30]['siyoflg'] = 1; // F-KAKOU …$f_kakou // M …$m
			} else {
				$this->g1['HSigenMrs'][$m]['siyoflg'] = 1; // F-GENSI …$f_gensi // M …$m
			}
			switch ( true) {
				case  $m >= 30 && substr($this->g1['HSinenMrs'][$m - 30]['kako'], 0, 1) == "#": // M …$m // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M …$m
					$this->KakouTenkai($m); // 糸加工マスタ展開 …$this->KakouTenkai
					break;
				case  $m >= 30: // M …$m
					if ($this->g1['HSinenMrs'][$m - 30]['ito2'] == 0 && $this->g1['HSigenMrs'][$m - 30]['hon1'] <= 1) { // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
						switch ( $this->g1['HSinenMrs'][$m - 30]['kote'] ) { // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // M …$m
							case  0:
								$this->GensiMei($m); // 原糸名作成 …$this->GensiMei
								break;
							case  2:
								$this->KariyoriMei($m); // 仮撚名作成 …$this->KariyoriMei
								break;
							case  3:
								$this->NensiMei($m); // 撚糸名作成 …$this->NensiMei
								break;
						}
					} else {
						switch ( $this->g1['HSinenMrs'][$m - 30]['kote'] ) { // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // M …$m
							case  0:
								$this->GousiMei($m); // 合糸名作成 …$this->GousiMei
								break;
							case  2:
								$this->DoukariMei($m); // 同仮名作成 …$this->DoukariMei
								break;
							case  3:
								$this->GounenMei($m); // 合撚名作成 …$this->GounenMei
								break;
						}
					}
					break;
				case  $m < 30 && substr($this->g1['HSigenMrs'][$m]['biko'], 0, 1) == "#": // M …$m // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M …$m
					$this->GensiMrMei($m); // 原糸マスタ名作成 …$this->GensiMrMei
					break;
				default:
					$this->GensiMeiChu($m); // 原糸名抽出 …$this->GensiMeiChu
					break;
			}
		}
	}
	// *****************************************************************
	private function GensiMeiChu($m) { // 原糸名抽出 …$this->GensiMeiChu		point_1 = "B-GENSL ";
											$this->g1['point_1'] .= "GensiMeiChu($m)\n";
	// *----------------------------------------------------------------
	// *  原糸名
		$this->w_itomei .= $this->g1['HSigenMrs'][$m]['gito']; // W1-GITO …$this->g1['HSigenMrs'][$i]['gito'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		if ( $this->g1['HSigenMrs'][$m]['ktnd'] == "D") { // W1-KTND …$this->g1['HSigenMrs'][$i]['ktnd'] // M …$m
			$this->w_itomei .= "F"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  デシテックス表記
		$kt = $this->g1['HSigenMrs'][$m]['ktni']; // W1-KTNI …$this->g1['HSigenMrs'][$i]['ktni'] // M …$m
		if ( $kt == "T" || $kt == "K") {
			$this->w_itomei .= "<"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			$this->w_itomei .= $this->g1['HSigenMrs'][$m]['kik1']; // W1-KIK1 …$this->g1['HSinenMrs'][$i]['kik1'] // M …$m // Z …$z // W-ｲﾄﾒｲ …$this->w_itomei // K …$k // Z …$z
			$this->w_itomei .= "T>"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  光沢
		if ( $this->g1['HSigenMrs'][$m]['kota'] > '') { // W1-KOTA …$this->g1['HSigenMrs'][$i]['kota'] // M …$m // SPACE …''
			if ( $kt == "T" || $kt == "K") { // W1-KTNI …$this->g1['HSigenMrs'][$i]['ktni'] // M …$m
				$this->w_itomei .= $this->g1['HSigenMrs'][$m]['kota']; // W1-KOTA …$this->g1['HSigenMrs'][$i]['kota'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			} else {
				$this->w_itomei .= "("; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
				$this->w_itomei .= $this->g1['HSigenMrs'][$m]['kota']; // W1-KOTA …$this->g1['HSigenMrs'][$i]['kota'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
				$this->w_itomei .= ")"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			}
		} else {
			$this->w_itomei .= " ";
		}
	// *  規格
		if ( $this->g1['HSigenMrs'][$m]['kikd'] == 0) {
			$this->w_itomei .= "-"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		} else {
			$this->w_itomei .= $this->g1['HSigenMrs'][$m]['kikd']; // W1-KIKD …$this->g1['HSigenMrs'][$i]['kikd'] // M …$m // Z …$z // W-ｲﾄﾒｲ …$this->w_itomei // K …$k // Z …$z
		}
		$this->w_itomei .= "/"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		if ( $this->g1['HSigenMrs'][$m]['kik2'] == 0) {
			$this->w_itomei .= "-"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		} else {
			$this->w_itomei .= $this->g1['HSigenMrs'][$m]['kik2']; // W1-KIK2 …$this->g1['HSigenMrs'][$i]['kik2'] // M …$m // Z …$z // W-ｲﾄﾒｲ …$this->w_itomei // K …$k // Z …$z
		}
	// *  原糸備考
		$this->w_itomei .= $this->g1['HSigenMrs'][$m]['wbiko']; // W1-ﾋﾞｺｳ …$this->g1['HSigenMrs'][$i]['biko'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *  デニール計算
		$this->w_denl = $this->g1['HSigenMrs'][$m]['gendenl']; // W1-ｹﾞﾝﾃﾞﾆｰﾙ …$this->g1['HSigenMrs'][$i]['gendenl'] // M …$m // W-ﾃﾞﾆｰﾙ …$this->w_denl
	}
	// *****************************************************************
	private function GensiMei($m) { // 原糸名作成 …$this->GensiMei		point_1 = "B-GENME ";
											$this->g1['point_1'] .= "GensiMei($m)\n";
	// *----------------------------------------------------------------
		$this->l += 1; // L …$l
		$this->mm[$this->l] = $m;
		$m1 = $this->g1['HSinenMrs'][$m-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m // M …$m

		$this->ItoMei($m1); // 糸名作成 …$this->ItoMei

		$this->l += -1; // L …$l
	// *  デニール計算
		$this->g1['HSinenMrs'][$m-30]['denl'] = $this->w_denl; // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
		$this->g1['HSinenMrs'][$m-30]['gen1'] = 1; // W1-ｹﾞﾝﾀﾝｲ1 …$this->g1['HSinenMrs'][$i]['gen1'] // M …$m
	// *  原単位計算
	// *  工費係数計算
		$this->g1['HSinenMrs'][$m-30]['kohi'] = 0; // W1-KOHI …$this->g1['HSinenMrs'][$i]['kohi'] // M …$m
	}
	// *****************************************************************
	private function GousiMei($m) { // 合糸名作成 …$this->GousiMei		point_1 = "B-GOUSI ";
											$this->g1['point_1'] .= "GousiMei($m)\n";
	// *----------------------------------------------------------------
	// *  糸名１
		$this->l += 1; // L …$l
		$this->mm[$this->l] = $m;
	// *         糸名作成ﾙｰﾁﾝ呼出時糸№ﾃｰﾌﾞﾙ↑
		$m1 = $this->g1['HSinenMrs'][$m-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m // M …$m

		$this->ItoMei($m1); // 糸名作成 …$this->ItoMei

		$this->l += -1; // L …$l
		$this->g1['HSinenMrs'][$m-30]['denl'] = $this->w_denl; // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
	// *  本数
		if ( $this->g1['HSinenMrs'][$m-30]['hon1'] >= 2) { // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
			$this->w_itomei .= "/"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['hon1']; // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
		if ( $this->g1['HSinenMrs'][$m-30]['ito2'] > 0) { // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m
	// *  糸名２
	// *  改行
			$this->w_itomei .= ":"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *
			$this->l += 1; // L …$l
			$this->mm[$this->l] = $m;
	// *             糸名作成ﾙｰﾁﾝ呼出時糸№ﾃｰﾌﾞﾙ↑
			$m = $this->g1['HSinenMrs'][$m-30]['ito2'] - 1; // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m // M …$m
			$this->ItoMei(); // 糸名作成 …$this->ItoMei
			$this->l += -1; // L …$l
	// *  本数
			if ( $this->g1['HSinenMrs'][$m-30]['hon2'] >= 2) { // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m
				$this->w_itomei .= "/"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
				$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['hon2']; // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			}
		}
	// *  デニール計算
		$w_denl1 = $this->g1['HSinenMrs'][$m-30]['denl'] * $this->g1['HSinenMrs'][$m-30]['hon1']; // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
		$w_denl2 = $this->w_denl * $this->g1['HSinenMrs'][$m-30]['hon2']; // W-ﾃﾞﾆｰﾙ2 …$w_denl2 // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m
		$this->w_denl = $this->g1['HSinenMrs'][$m-30]['denl'] = $w_denl1 + $w_denl2; // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W-ﾃﾞﾆｰﾙ2 …$w_denl2
	// *  原単位計算
		$this->g1['HSinenMrs'][$m-30]['gen1'] = round($w_denl1 / $this->w_denl, 2); // W1-ｹﾞﾝﾀﾝｲ1 …$this->g1['HSinenMrs'][$i]['gen1'] // M …$m // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W-ﾃﾞﾆｰﾙ …$this->w_denl
		$this->g1['HSinenMrs'][$m-30]['gen2'] = round($w_denl2 / $this->w_denl, 2); // W1-ｹﾞﾝﾀﾝｲ2 …$this->g1['HSinenMrs'][$i]['gen2'] // M …$m // W-ﾃﾞﾆｰﾙ2 …$w_denl2 // W-ﾃﾞﾆｰﾙ …$this->w_denl
	// *  工費係数計算
		$this->g1['HSinenMrs'][$m-30]['kohi'] = 0; // W1-KOHI …$this->g1['HSinenMrs'][$i]['kohi'] // M …$m
	}
	// *****************************************************************
	private function KariyoriMei($m) { // 仮撚名作成 …$this->KariyoriMei		point_1 = "B-KARME ";
											$this->g1['point_1'] .= "KariyoriMei($m)\n";
	// *----------------------------------------------------------------
	// *  糸名１後で消す。原料展開デニール計算のため。
		$k = strlen($this->w_itomei);
		$this->l += 1; // L …$l
		$this->mm[$this->l] = $m;
	// *         糸名作成ﾙｰﾁﾝ呼出時糸№ﾃｰﾌﾞﾙ↑
		$m1 = $this->g1['HSinenMrs'][$m-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m // M …$m

		$this->ItoMei($m1); // 糸名作成 …$this->ItoMei

		$m1 = $this->g1['HSinenMrs'][$m-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m // M1 …$m1
		if ( $m1 > 30 && 
				( $this->g1['HSinenMrs'][ $m1 - 30 ]['ito1'] > 30 
				|| $this->g1['HSinenMrs'][ $m1 - 30 ]['ito2'] > 0 )
			) { // M1 …$m1 // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M1 …$m1 // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M1 …$m1
	// *      加工糸を仮撚する先撚の時
			$this->w_itomei .= "ｻｷﾖﾘ"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		} else {
	// *      原糸からか先撚の時
			$this->w_itomei = substr($this->w_itomei, 0, $k); // 糸名１で消す。
			$this->l += -1; // L …$l
	// *      最終原料№
			$m1 = $m; // M …$m // M1 …$m1
			while ( $m1 > 30) { // M1 …$m1
				$m1 = $this->g1['HSinenMrs'][$m1-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M1 …$m1 // M1 …$m1
			}
	// *      原糸名
			$this->w_itomei .= $this->g1['HSigenMrs'][$m1]['gito']; // W1-GITO …$this->g1['HSigenMrs'][$i]['gito'] // M1 …$m1 // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			$this->w_itomei .= "W"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *      デシテックス表記
			$kt = $this->g1['HSigenMrs'][ $m1 ]['ktni'];
			if ( $kt == "T" || $kt == "K") { // W1-KTNI …$this->g1['HSigenMrs'][$i]['ktni'] // M1 …$m1
				$this->w_itomei .= "<"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
				$this->w_itomei .= $this->g1['HSinenMrs'][$m1]['kik1']; // W1-KIK1 …$this->g1['HSinenMrs'][$i]['kik1'] // M1 …$m1 // Z …$z // W-ｲﾄﾒｲ …$this->w_itomei // K …$k // Z …$z
				$this->w_itomei .= "T>"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			}
	// *      光沢
			if ( $this->g1['HSinenMrs'][ $m1 ]['kota'] > '') { // W1-KOTA …$this->g1['HSigenMrs'][$i]['kota'] // M1 …$m1 // SPACE …''
				if ( $this->g1['HSigenMrs'][ $m1 ]['ktni'] == "T" || "K") { // W1-KTNI …$this->g1['HSigenMrs'][$i]['ktni'] // M1 …$m1
					$this->w_itomei .= $this->g1['HSinenMrs'][$m1]['kota']; // W1-KOTA …$this->g1['HSigenMrs'][$i]['kota'] // M1 …$m1 // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
				} else {
					$this->w_itomei .= "("; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
					$this->w_itomei .= $this->g1['HSinenMrs'][$m1]['kota']; // W1-KOTA …$this->g1['HSigenMrs'][$i]['kota'] // M1 …$m1 // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
					$this->w_itomei .= ")"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
				}
			} else {
				$this->w_itomei .= " ";
			}
	// *      規格
			if ( $this->g1['HSigenMrs'][ $m1 ]['kikd'] == 0) { // Z …$z
				$this->w_itomei .= "-"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			} else {
				$this->w_itomei .= $this->g1['HSigenMrs'][$m1]['kikd']; // W1-KIKD …$this->g1['HSigenMrs'][$i]['kikd'] // M1 …$m1 // Z …$z // W-ｲﾄﾒｲ …$this->w_itomei // K …$k // Z …$z
			}
			$this->w_itomei .= substr_replace($this->w_itomei,"/",$this->k,1); // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			if ( $this->g1['HSinenMrs'][ $m1 ]['kik2'] == 0) { // Z …$z
				$this->w_itomei .= "-"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			} else {
				$this->w_itomei .= $this->g1['HSinenMrs'][$m1]['kik2']; // W1-KIK2 …$this->g1['HSigenMrs'][$i]['kik2'] // M1 …$m1 // Z …$z // W-ｲﾄﾒｲ …$this->w_itomei // K …$k // Z …$z
			}
	// *      本数
			if ( $this->g1['HSinenMrs'][$m-30]['hon1'] >= 2) { // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
				$this->w_itomei .= "/"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
				$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['hon1']; // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			}
	// *      仮撚方向
			$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['hoko']; // W1-HOKO …$this->g1['HSinenMrs'][$i]['hoko'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *      先撚
			if ( $this->g1['HSiitoMrs'][$m-30]['ito1'] > 30) { // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m
				$this->w_itomei .= "ｻｷ"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			}
		}
	// *  原糸備考
		$this->w_itomei .= $this->g1['HSigenMrs'][$m1]['wbiko']; // W1-ﾋﾞｺｳ …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *  加工区分
		if ( $this->g1['HSinenMrs'][$m-30]['kbn1'] > '') { // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m // SPACE …''
			$this->w_itomei .= " ".$this->g1['HSinenMrs'][$m-30]['kbn1']; // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
		if ( $this->g1['HSinenMrs'][$m-30]['kbn2'] > '') { // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m // SPACE …''
			$this->w_itomei .= " ".$this->g1['HSinenMrs'][$m-30]['kbn2']; // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  加工条件
		if ($this->g1['HSinenMrs'][$m-30]['kako'] > '') {
			$this->w_itomei .= " ".$this->g1['HSinenMrs'][$m-30]['kako']; // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  デニール計算
		$w_denl1 = $this->w_denl * $this->g1['HSinenMrs'][$m-30]['hon1']; // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
		$this->w_denl = $this->g1['HSinenMrs'][$m-30]['denl'] = $w_denl1; // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
		$this->g1['HSinenMrs'][$m-30]['gen1'] = 1.01; // W1-ｹﾞﾝﾀﾝｲ1 …$this->g1['HSinenMrs'][$i]['gen1'] // M …$m
	// *  原単位計算
	// *  工費係数計算
	//	$kouhi_keisan_kbn = 1; // ｺｳﾋｹｲｻﾝｸﾌﾞﾝ …$kouhi_keisan_kbn
		$this->KouhiKeisan($m, 1); // 工費係数計算 …$this->KouhiKeisan
	}
	// *****************************************************************
	private function DoukariMei($m) { // 同仮名作成 …$this->DoukariMei		point_1 = "B-DOUME ";
											$this->g1['point_1'] .= "DoukariMei($m)\n";
	// *----------------------------------------------------------------
	// *  パールレイン
		$kbn1 = $this->g1['HSinenMrs'][$m-30]['kbn1'];
		if ( $kbn1 == "PR" || $kbn1 == "PA") { // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m
			$this->w_itomei .= $kbn1."."; // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
		$kbn2 = $this->g1['HSinenMrs'][$m-30]['kbn2'];
		if ( $kbn2 == "PR" || $kbn2 == "PA") { // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m
			$this->w_itomei .= $kbn2."."; // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  糸名１
		$this->l += 1; // L …$l
		$this->mm[$this->l] = $m;
	// *         糸名作成ﾙｰﾁﾝ呼出時糸№ﾃｰﾌﾞﾙ↑
		$m1 = $this->g1['HSinenMrs'][$m-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m // M …$m

		$this->ItoMei($m1); // 糸名作成 …$this->ItoMei

		$this->l += -1; // L …$l
		$this->g1['HSinenMrs'][$m-30]['denl'] = $this->w_denl; // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
	// *  本数
		if ( $this->g1['HSinenMrs'][$m-30]['hon1'] >= 2) { // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
			$this->w_itomei .= "/".$this->g1['HSinenMrs'][$m-30]['hon1']; // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
		if ( $this->g1['HSinenMrs'][$m-30]['ito2'] > 0) { // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m
	// *  糸名２
	// *  改行
			$this->w_itomei .= ":"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *  パールレイン
			$kbn1 = $this->g1['HSinenMrs'][$m-30]['kbn1'];
			$kbn2 = $this->g1['HSinenMrs'][$m-30]['kbn2'];
			if ( $kbn1 == "PR" || $kbn1 == "PA" || $kbn2 == "PR" || $kbn2 == "PA") { // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m
				$this->w_itomei .= "  ";
			}
			$this->l += 1; // L …$l
			$this->mm[$this->l] = $m;
	// *         糸名作成ﾙｰﾁﾝ呼出時糸№ﾃｰﾌﾞﾙ↑
			$m1 = $this->g1['HSinenMrs'][$m-30]['ito2'] - 1; // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m // M …$m

			$this->ItoMei($m1); // 糸名作成 …$this->ItoMei

			$this->l += -1; // L …$l
	// *  本数
			if ( $this->g1['HSinenMrs'][$m-30]['hon2'] >= 2) { // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m
				$this->w_itomei .= "/".$this->g1['HSinenMrs'][$m-30]['hon2']; // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			}
		}
	// *  同仮
		$hoko = $this->g1['HSinenMrs'][$m-30]['hoko'];
		$kbn1 = $this->g1['HSinenMrs'][$m-30]['kbn1'];
		$kbn2 = $this->g1['HSinenMrs'][$m-30]['kbn2'];
		if ( ( $hoko == "S" || $hoko == "Z" ) && !( $kbn1 == "PR" || $kbn1 == "PA" || $kbn2 == "PR" || $kbn2 == "PA" )) { // W1-HOKO …$this->g1['HSinenMrs'][$i]['hoko'] // M …$m // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m
			$this->w_itomei .= "ﾄﾞｳｶﾘ"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  加工区分
		if ( $kbn1 > '' && ! ( $kbn1 == "PR" || $kbn1 == "PA" )) { // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m // SPACE …'' // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m
			$this->w_itomei .= " ".$kbn1; // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
		if ( $kbn2 > '' && ! ( $kbn2 == "PR" || $kbn2 == "PA" )) { // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m // SPACE …'' // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m
			$this->w_itomei .= " ".$kbn2; // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  加工条件
		if ($this->g1['HSinenMrs'][$m-30]['kako']>'') {
			$this->w_itomei .= " ".$this->g1['HSinenMrs'][$m-30]['kako']; // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  デニール計算
		$w_denl1 = $this->g1['HSinenMrs'][$m-30]['denl'] * $this->g1['HSinenMrs'][$m-30]['hon1']; // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
		$w_denl2 = $this->w_denl * $this->g1['HSinenMrs'][$m-30]['hon2']; // W-ﾃﾞﾆｰﾙ2 …$w_denl2 // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m
		if ( $kbn1 == "PR" || $kbn1 == "PA" || $kbn2 == "PR" || $kbn2 == "PA") { // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m
			$w_denl2 = $w_denl2 * 2; // W-ﾃﾞﾆｰﾙ2 …$w_denl2 // W-ﾃﾞﾆｰﾙ2 …$w_denl2
		}
		$this->w_denl = $this->g1['HSinenMrs'][$m-30]['denl'] = $w_denl1 + $w_denl2; // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W-ﾃﾞﾆｰﾙ2 …$w_denl2
	// *  原単位計算
		if ($this->w_denl == 0) {$this->w_denl = 1;} // エラー回避
		$this->g1['HSinenMrs'][$m-30]['gen1'] = round($w_denl1 / $this->w_denl * 1.01, 2); // W1-ｹﾞﾝﾀﾝｲ1 …$this->g1['HSinenMrs'][$i]['gen1'] // M …$m // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W-ﾃﾞﾆｰﾙ …$this->w_denl
		$this->g1['HSinenMrs'][$m-30]['gen2'] = round($w_denl2 / $this->w_denl * 1.01, 2); // W1-ｹﾞﾝﾀﾝｲ2 …$this->g1['HSinenMrs'][$i]['gen2'] // M …$m // W-ﾃﾞﾆｰﾙ2 …$w_denl2 // W-ﾃﾞﾆｰﾙ …$this->w_denl
	// *  工費係数計算
	//	$kouhi_keisan_kbn = 2; // ｺｳﾋｹｲｻﾝｸﾌﾞﾝ …$kouhi_keisan_kbn
		$this->KouhiKeisan($m, 2); // 工費係数計算 …$this->KouhiKeisan
	}
	// *****************************************************************
	private function NensiMei($m) { // 撚糸名作成 …$this->NensiMei		point_1 = "B-NENME ";
											$this->g1['point_1'] .= "NensiMei($m)\n";
	// *----------------------------------------------------------------
		$this->l += 1; // L …$l
		$this->mm[$this->l] = $m;
	// *         糸名作成ﾙｰﾁﾝ呼出時糸№ﾃｰﾌﾞﾙ↑
		$m1 = $this->g1['HSinenMrs'][$m-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m // M …$m

		$this->ItoMei($m1); // 糸名作成 …$this->ItoMei

		$this->l += -1; // L …$l
	// *  本数
		if ( $this->g1['HSinenMrs'][$m-30]['hon1'] >= 2) { // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
			$this->w_itomei .= "/"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['hon1']; // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  加工区分
		if ($this->g1['HSinenMrs'][$m-30]['kbn1']>'') {
			$this->w_itomei .= " ".$this->g1['HSinenMrs'][$m-30]['kbn1']; // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
		if ($this->g1['HSinenMrs'][$m-30]['kbn2']>'') {
			$this->w_itomei .= " ".$this->g1['HSinenMrs'][$m-30]['kbn2']; // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  撚方向
		$this->w_itomei .= "("; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['hoko']; // W1-HOKO …$this->g1['HSinenMrs'][$i]['hoko'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		//$this->w_itomei .= "-"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *  撚数
		$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['yori']; // W1-YORI …$this->g1['HSinenMrs'][$i]['yori'] // M …$m // Z …$z // Z …$z // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		$this->w_itomei .= ")"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *  加工条件
		$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['kako']; // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *  デニール計算
		$w_denl1 = $this->w_denl * $this->g1['HSinenMrs'][$m-30]['hon1'] ; // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
		$this->w_denl = $this->g1['HSinenMrs'][$m-30]['denl'] = $w_denl1; // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
		$this->g1['HSinenMrs'][$m-30]['gen1'] = 1.02; // W1-ｹﾞﾝﾀﾝｲ1 …$this->g1['HSinenMrs'][$i]['gen1'] // M …$m
	// *  原単位計算
	// *  工費係数計算
	//	$kouhi_keisan_kbn = 3; // ｺｳﾋｹｲｻﾝｸﾌﾞﾝ …$kouhi_keisan_kbn
		$this->KouhiKeisan($m, 3); // 工費係数計算 …$this->KouhiKeisan
	}
	// *****************************************************************
	private function GounenMei($m) { // 合撚名作成 …$this->GounenMei		point_1 = "B-GOUME ";
											$this->g1['point_1'] .= "GounenMei($m)\n";
	// *----------------------------------------------------------------
		$this->kakko_flg = 0; // ｶｯｺﾌﾗｸﾞ …$this->kakko_flg
	// *  糸名１
		$this->l += 1; // L …$l
		$this->mm[$this->l] = $m;
	// *         糸名作成ﾙｰﾁﾝ呼出時糸№ﾃｰﾌﾞﾙ↑
		$m1 = $this->g1['HSinenMrs'][$m-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m // M …$m

		$this->ItoMei($m1); // 糸名作成 …$this->ItoMei

		$this->l += -1; // L …$l
		$this->g1['HSinenMrs'][$m-30]['denl'] = $this->w_denl; // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
	// *  本数
		if ( $this->g1['HSinenMrs'][$m-30]['hon1']  >= 2) { // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
			$this->w_itomei .= "/"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['hon1']; // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  加工区分
		if ($this->g1['HSinenMrs'][$m-30]['kbn1']>'') {
			$this->w_itomei .= " ".$this->g1['HSinenMrs'][$m-30]['kbn1']; // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
		if ($this->g1['HSinenMrs'][$m-30]['kbn2']>'') {
			$this->w_itomei .= " ".$this->g1['HSinenMrs'][$m-30]['kbn2']; // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
	// *  加工条件
		if ($this->g1['HSinenMrs'][$m-30]['kako']>'') {
			$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['kako']; // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
		if ( $this->g1['HSinenMrs'][$m-30]['ito2']  > 0) { // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m
	// *  糸名２
	// *  改行
			$this->w_itomei .= ":"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *
			$this->l += 1; // L …$l
			$this->mm[$this->l] = $m;
	// *             糸名作成ﾙｰﾁﾝ呼出時糸№ﾃｰﾌﾞﾙ↑
			$m1 = $this->g1['HSinenMrs'][$m-30]['ito2'] - 1 ; // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m // M …$m

			$this->ItoMei($m1); // 糸名作成 …$this->ItoMei

			$this->l += -1; // L …$l
	// *  本数
			if ( $this->g1['HSinenMrs'][$m-30]['hon2'] >= 2) { // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m
				$this->w_itomei .= "/"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
				$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['hon2']; // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			}
		}
	// *  撚数
		if ( $this->g1['HSinenMrs'][$m-30]['yori'] > 0) { // W1-YORI …$this->g1['HSinenMrs'][$i]['yori'] // M …$m
			if ( $this->kakko_flg == 0) { // ｶｯｺﾌﾗｸﾞ …$this->kakko_flg
				$this->w_itomei .= "("; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			} else {
				$this->w_itomei .= "<"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			}
	// *   *  撚方向
			$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['hoko']; // W1-HOKO …$this->g1['HSinenMrs'][$i]['hoko'] // M …$m // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			//$this->w_itomei .= "-"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *   *  撚数
			$this->w_itomei .= $this->g1['HSinenMrs'][$m-30]['yori']; // W1-YORI …$this->g1['HSinenMrs'][$i]['yori'] // M …$m // Z …$z // Z …$z // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
	// *
			if ( $this->kakko_flg == 0) { // ｶｯｺﾌﾗｸﾞ …$this->kakko_flg
				$this->w_itomei .= ")"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			} else {
				$this->w_itomei .= ">"; // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
			}
		}
		$this->w_itomei .= " ";
		$this->kakko_flg = 1; // ｶｯｺﾌﾗｸﾞ …$this->kakko_flg
	// *  デニール計算
		$w_denl1 = $this->g1['HSinenMrs'][$m-30]['denl']  * $this->g1['HSinenMrs'][$m-30]['hon1']; // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
		$w_denl2 = $this->w_denl * $this->g1['HSinenMrs'][$m-30]['hon2']; // W-ﾃﾞﾆｰﾙ2 …$w_denl2 // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m
		$this->w_denl = $this->g1['HSinenMrs'][$m-30]['denl'] = $w_denl1 + $w_denl2; // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W-ﾃﾞﾆｰﾙ2 …$w_denl2
	// *  原単位計算
		if ($this->w_denl == 0) { $this->w_denl = 1;} // エラー回避
		$this->g1['HSinenMrs'][$m-30]['gen1'] = round($w_denl1 / $this->w_denl * 1.02, 2); // W1-ｹﾞﾝﾀﾝｲ1 …$this->g1['HSinenMrs'][$i]['gen1'] // M …$m // W-ﾃﾞﾆｰﾙ1 …$w_denl1 // W-ﾃﾞﾆｰﾙ …$this->w_denl
		$this->g1['HSinenMrs'][$m-30]['gen2'] = round($w_denl2 / $this->w_denl * 1.02, 2); // W1-ｹﾞﾝﾀﾝｲ2 …$this->g1['HSinenMrs'][$i]['gen2'] // M …$m // W-ﾃﾞﾆｰﾙ2 …$w_denl2 // W-ﾃﾞﾆｰﾙ …$this->w_denl
	// *  工費係数計算
	//	$kouhi_keisan_kbn = 4; // ｺｳﾋｹｲｻﾝｸﾌﾞﾝ …$kouhi_keisan_kbn
		$this->KouhiKeisan($m, 4); // 工費係数計算 …$this->KouhiKeisan
	}
	// *****************************************************************
	private function KakouTenkai($m) { // 糸加工マスタ展開 …$this->KakouTenkai		point_1 = "ｶｺｳ M/R ";
											$this->g1['point_1'] .= "KakouTenkai($m)\n";
	// *----------------------------------------------------------------
		$icd = trim(substr($this->g1['HSinenMrs'][$m-30]['kako'],1,5)); // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M …$m // IUICD3 …$this->ik->cd3
		$glvl_x = trim(substr($this->g1['HSinenMrs'][$m-30]['kako'],6,1));
		$this->g1_glvl = (int)$glvl_x;
		$this->ItocdCheck($icd); // ｲﾄｺｰﾄﾞﾁｪｯｸ …$this->ItocdCheck
		if ( $this->g1['errflg'] == 1) { // ERRFLG …$this->g1['errflg']
			$okikae = $this->g1['HSinenMrs'][$m-30]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // M …$m
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
		}
		$this->g1['HSinenMrs'][$m-30]['hqicd'] = $this->ik->cd; // IKICD …$this->ik->icd // W1-HQICD …$this->g1['HSinenMrs'][$i]['hqicd'] // M …$m
		if ( $this->l > 0) { // L …$l
			$m1 = $this->mm[$this->l]; // MM …$mm // L …$this->l // M1 …$m1
		}
		if ( $this->l > 0 && substr($this->g1['HSinenMrs'][$m1-30]['kako'],0, 1) == "#") { // L …$this->l // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1
			;
		} else { // IKREC …$this->ik->rec
			$this->w_itomei .= HitomeiMrs::Itozs04($this->ik); // IKDATA …$this->ik->data // W-ｲﾄﾒｲ …$this->w_itomei // K …$k
		}
		if ( $this->g1_glvl == 0) { // W1-GLVL …$w1_glvl
			$this->g1['HSinenMrs'][$m-30]['kohi'] = $this->ik->kohi; // IUGOKE …$this->iu[$t]->goke // W1-KOHI …$this->g1['HSinenMrs'][$i]['kohi'] // M …$m
			if ( count($this->ht) && $this->ht[0]->denr > 0) { // HTYORS …$this->ht[$t]->yors // ZERO …0
				$this->g1['HSinenMrs'][$m-30]['yori'] = $this->ht[0]->yors; // HTYORS …$this->ht[$t]->yors // W1-YORI …$this->g1['HSinenMrs'][$i]['yori'] // M …$m
			}
	// *       DISPLAY "TEST ERR M=" M ",KEY=" HTKEY UPON ｺﾝｿｰﾙ
			if	(	$this->g1['HSinenMrs'][$m-30]['yori'] == 0 &&
					$this->ik->ishu == 3 &&
					substr($this->ik->cd, 0, 1) < "R"
				) { // W1-YORI …$this->g1['HSinenMrs'][$i]['yori'] // M …$m // IUICD1 …$this->ik->cd1 // IUICD3 …$this->ik->cd3
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　撚数未登録のため入力して下さい。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $m + 1; // M …$m
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
			}
	// *ﾖﾘﾁｼﾞﾐｺｳﾘｮｽﾙ    HTDENR          TO      W1-ｶｺｳﾃﾞﾆｰﾙ(M - 30)
			if (count($this->ht)) {
				$this->g1['HSinenMrs'][$m-30]['denl'] = $this->ht[0]->denr * ( 1 + $this->ht[0]->deme * 0.001 ) + 0.5; // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m // HTDENR …$this->ht[$t]->denr // HTDEME …$this->ht[$t]->deme
			}
		} else {
			$this->g1['HSinenMrs'][$m-30]['kohi'] = 0; // ZERO …0 // W1-KOHI …$this->g1['HSinenMrs'][$i]['kohi'] // M …$m
			$this->g1['HSinenMrs'][$m-30]['yori'] = 0; // ZERO …0 // W1-YORI …$this->g1['HSinenMrs'][$i]['yori'] // M …$m
			$this->g1['HSinenMrs'][$m-30]['denl'] = 0; // ZERO …0 // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
		}
	// *
		if ( $this->ik->gumu == 2 || count($this->iu) <= 2 || $this->g1_glvl == 0) { // IUGUMU …$this->ik->gumu // IUGKNS …$this->ik->gkns // W1-GLVL …$w1_glvl
			$this->g1_glvl = 0; // W1-GLVL …$w1_glvl
		}
		if ( $this->ik->gumu == 1 && $this->g1_glvl == 0) { // IUGUMU …$this->ik->gumu // W1-GLVL …$w1_glvl
			$this->g1['HSinenMrs'][$m-30]['kote'] = $this->ik->ishu; // IUICD1 …$this->ik->cd1 // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // M …$m
		} else {
			$this->g1['HSinenMrs'][$m-30]['kote'] = 0; // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // M …$m
		}
		$gu = $this->ik->gumu; // IUGUMU …$this->ik->gumu
		if ($gu == 1 && count($this->iu) - $this->g1_glvl > 2) { // IUGKNS …$this->ik->gkns // W1-GLVL …$w1_glvl
			$s_icd = $this->ik->cd; // IUICD …$this->ik->cd // S-ICD …$s_icd
			$s_ishu = $this->ik->ishu;
			$s_glvl = $this->g1_glvl + 1; // S-GLVL …$s_glvl // W1-GLVL …$w1_glvl
			$this->g1['HSinenMrs'][$m-30]['gen1'] = 1; // W1-ｹﾞﾝﾀﾝｲ1 …$this->g1['HSinenMrs'][$i]['gen1'] // M …$m
			$m1 = count($this->iu) - $this->g1_glvl - 1; // M1 …$m1 // IUGKNS …$this->ik->gkns // W1-GLVL …$w1_glvl
			$this->g1['HSinenMrs'][$m-30]['gen2'] = $this->iu[$m1]->tani; // IUTANI …$this->iu[$t]->tani // M1 …$m1 // W1-ｹﾞﾝﾀﾝｲ2 …$this->g1['HSinenMrs'][$i]['gen2'] // M …$m
		} else if ($gu == 1) {
			$s_icd = $this->iu[0]->gcd; // IUGCD …$this->iu[$t]->gcd // S-ICD …$s_icd
			$s_ishu = $this->iu[0]->HItomeiMr->ishu;
			$s_glvl = 0; // SPACE …'' // S-GLVL-X …$s_glvl_x
			$this->g1['HSinenMrs'][$m-30]['gen1'] = $this->iu[0]->tani; // IUTANI …$this->iu[$t]->tani // W1-ｹﾞﾝﾀﾝｲ1 …$this->g1['HSinenMrs'][$i]['gen1'] // M …$m
			if (count($this->iu)>1) {
				$this->g1['HSinenMrs'][$m-30]['gen2'] = $this->iu[1]->tani; // IUTANI …$this->iu[$t]->tani // W1-ｹﾞﾝﾀﾝｲ2 …$this->g1['HSinenMrs'][$i]['gen2'] // M …$m
			}
		} else if ($gu == 2) {
			$s_icd = $this->ik->cd; // IUICD …$this->ik->cd // S-ICD …$s_icd
			$s_ishu = $this->ik->ishu;
			$s_glvl = 0; // SPACE …'' // S-GLVL-X …$s_glvl_x
			$this->g1['HSinenMrs'][$m-30]['gen1'] = 1; // W1-ｹﾞﾝﾀﾝｲ1 …$this->g1['HSinenMrs'][$i]['gen1'] // M …$m
			$this->g1['HSinenMrs'][$m-30]['gen2'] = 0; // W1-ｹﾞﾝﾀﾝｲ2 …$this->g1['HSinenMrs'][$i]['gen2'] // M …$m
		}
		$m1 = $this->g1['HSinenMrs'][$m-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m // M1 …$m1
		$sw2 = $this->ik->gumu == 2 || $s_ishu == 1; // M1 …$m1 // IUGUMU …$this->ik->gumu // S-ICD1 …$s_ishu
		if ($m1 == 00 && $sw2) {
			for ( $m1= 0; 
				!(	$m1 >= 18 
				 ||	trim(substr($this->g1['HSigenMrs'][$m1]['biko'],0, 6)) == "#".$s_icd
				);
				$m1++) { // M1 …$m1 // M1 …$m1 // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // S-ICD3 …$s_icd3
				;
			}
			if ( $m1 >= 18) { // M1 …$m1
				for ( $m1= 0; 
					!(	$m1 >= 18 
					 || $this->g1['HSigenMrs'][$m1]['gito'] == '' && 
						$this->g1['HSigenMrs'][$m1]['biko'] == ''
					);
					$m1++) { // M1 …$m1 // M1 …$m1 // W1-GITO …$this->g1['HSigenMrs'][$i]['gito'] // M1 …$m1 // SPACE …'' // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // SPACE …''
					;
				}
			}
			if ( $m1 >= 18) { // M1 …$m1
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　糸コード展開中に原糸があふれた。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $m + 1; // M …$m
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
			}
			$this->g1['HSinenMrs'][$m-30]['ito1'] = $m1 + 1; // M1 …$m1 // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m
			$this->g1['HSigenMrs'][$m1]['biko'] = "#".$s_icd; // S-ICD3 …$s_icd // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1
		} else if ($m1 == 0 && !$sw2) {
			for ( $m1= 0; 
				!(	$m1 >= 36 
				 || trim(substr($this->g1['HSinenMrs'][$m1]['kako'], 0, 6)) == "#".$s_icd && 
					trim(substr($this->g1['HSinenMrs'][$m1]['kako'], 6, 1)) == $s_glvl_x
				);
				$m1++) { // M1 …$m1 // M1 …$m1 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // S-ICD3 …$s_icd3 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // S-GLVL-X …$s_glvl_x
				;
			}
			if ( $m1 >= 36) { // M1 …$m1
				for ( $m1= 0;
					!($m1 >= 36
					|| $this->g1['HSinenMrs'][$m1]['ito1'] == 0 &&
						$this->g1['HSinenMrs'][$m1]['kako'] == '');
					$m1++) { // M1 …$m1 // M1 …$m1 // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M1 …$m1 // ZERO …0 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // SPACE …''
					;
				}
			}
			if ( $m1 >= 36) { // M1 …$m1
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　糸コード展開中に加工糸があふれた。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $m + 1; // M …$m
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
			}
			$this->g1['HSinenMrs'][$m-30]['ito1'] = $this->g1['HSinenMrs'][$m1]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // M1 …$m1 // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m
			$this->g1['HSinenMrs'][$m1]['kako'] = "#".$s_icd.$s_glvl_x; // S-GLVL-X …$s_glvl_x // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1
		} else if ($m1 >= 0 && $m1 < 18 && $sw2) {
			if ( trim(substr($this->g1['HSigenMrs'][$m1]['biko'], 0, 6)) == "#".$s_icd) { // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // S-ICD3 …$s_icd3
				;
			} else {
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　　糸１の原糸コードが違う。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $m + 1; // M …$m
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
			}
		} else if ($m1 >= 30 && $m1 < 66 && !$sw2) {
			if ( trim(substr($this->g1['HSinenMrs'][$m1-30]['kako'], 0, 6)) == "#".$s_icd &&
				trim(substr($this->g1['HSinenMrs'][$m1-30]['kako'], 6, 1)) == $s_glvl_x) { // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // S-ICD3 …$s_icd3 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // S-GLVL-X …$s_glvl_x
				;
			} else {
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　　糸１の加工糸コードが違う。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $m + 1; // M …$m
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
			}
		} else {
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸№　の原料が糸１と違う。"; // G1-EMSG …$this->g1['emsg']
			$okikae = $m + 1; // M …$m
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
		}
	// *
		if ( $this->ik->gumu == 2 || count($this->iu) < 2) { // IUGUMU …$this->ik->gumu // IUGKNS …$this->ik->gkns
			$this->g1['HSinenMrs'][$m-30]['ito2'] = 0; // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m
		} else {
			$m1 = count($this->iu) - (int)$this->g1_glvl_x - 1; // M1 …$m1 // IUGKNS …$this->ik->gkns // W1-GLVL …$w1_glvl
			$s_icd = $this->iu[$m1]->gcd; // IUGCD …$this->iu[$t]->gcd // M1 …$m1 // S-ICD …$s_icd
			$s_glvl_x = ''; // SPACE …'' // S-GLVL-X …$s_glvl_x
			$m1 = $this->g1['HSinenMrs'][$m-30]['ito2'] - 1; // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m // M1 …$m1
			if ($m1 == 0 && $s_ishu == 1) { // M1 …$m1 // S-ICD1 …$s_ishu
				for ( $m1= 0; 
					!(	$m1 >= 18
					 || trim(substr($this->g1['HSigenMrs'][$m1]['biko'], 0, 6)) == "#".$s_icd
					);
					$m1++) { // M1 …$m1 // M1 …$m1 // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // S-ICD3 …$s_icd3
					;
				}
				if ( $m1 >= 18) { // M1 …$m1
					for ( $m1= 0; 
						!(	$m1 >= 18
						 || $this->g1['HSigenMrs'][$m1]['gito'] == '' && 
						 	$this->g1['HSigenMrs'][$m1]['biko'] == ''
						);
						$m1++) { // M1 …$m1 // M1 …$m1 // W1-GITO …$this->g1['HSigenMrs'][$i]['gito'] // M1 …$m1 // SPACE …'' // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // SPACE …''
						;
					}
				}
				if ( $m1 >= 18) { // M1 …$m1
					$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
					$this->g1['emsg'] = "糸№　糸コード展開中に原糸があふれた。"; // G1-EMSG …$this->g1['emsg']
					$okikae = $m + 1; // M …$m
					$pos = strpos($this->g1['emsg'], '　');
					$this->g1['emsg'] = substr_replace($this->g1['emsg'],$okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
					return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
				}
				$this->g1['HSinenMrs'][$m-30]['ito2'] = $m1 + 1; // M1 …$m1 // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m
				$this->g1['HSigenMrs'][$m1]['biko'] = "#".$s_icd; // S-ICD3 …$s_icd3 // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1
			} else if ($m1 == 00 && $s_ishu != 1) {
				for ( $m1= 0; 
					!(	$m1 >= 36
					 || trim(substr($this->g1['HSinenMrs'][$m1]['kako'], 0, 6)) == "#".$s_icd &&
					 	trim(substr($this->g1['HSinenMrs'][$m1]['kako'], 6, 1)) == $s_glvl_x
					 );
					 $m1++) { // M1 …$m1 // M1 …$m1 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // S-ICD3 …$s_icd3 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // S-GLVL-X …$s_glvl_x
					;
				}
				if ( $m1 >= 36) { // M1 …$m1
					for ( $m1= 0; 
						!(	$m1 >= 36
						 || $this->g1['HSinenMrs'][$m1]['ito1'] == 0 && 
						 	$this->g1['HSinenMrs'][$m1]['kako'] == ''
						);
						$m1++) { // M1 …$m1 // M1 …$m1 // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M1 …$m1 // ZERO …0 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // SPACE …''
						;
					}
				}
				if ( $m1 >= 36) { // M1 …$m1
					$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
					$this->g1['emsg'] = "糸№　糸コード展開中に加工糸があふれた。"; // G1-EMSG …$this->g1['emsg']
					$okikae = $m + 1; // M …$m
					$pos = strpos($this->g1['emsg'], '　');
					$this->g1['emsg'] = substr_replace($this->g1['emsg'],$okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
					return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
				}
				$this->g1['HSinenMrs'][$m-30]['ito2'] = $this->g1['HSinenMrs'][$m1]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // M1 …$m1 // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m
				$this->g1['HSinenMrs'][$m1]['kako'] = "#".$s_icd.$s_glvl_x; // S-GLVL-X …$s_glvl_x // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1
			} else if ($m1 >= 0 && $m1 < 18 && $s_ishu == 1) {
				if ( trim(substr($this->g1['HSigenMrs'][$m1]['biko'], 0, 6)) == "#".$s_icd) { // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M1 …$m1 // S-ICD3 …$s_icd3
					;
				} else {
					$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
					$this->g1['emsg'] = "糸№　　糸２の原糸コードが違う。"; // G1-EMSG …$this->g1['emsg']
					$okikae = $m + 1; // M …$m
					$pos = strpos($this->g1['emsg'], '　');
					$this->g1['emsg'] = substr_replace($this->g1['emsg'],$okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
					return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
				}
			} else if ($m1 >= 30 && $m1 < 66 && $s_ishu != 1) {
				if ( trim(substr($this->g1['HSinenMrs'][$m1-30]['kako'], 0, 6)) == "#".$s_icd &&
					 trim(substr($this->g1['HSinenMrs'][$m1-30]['kako'], 6, 1)) == $s_glvl_x) { // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // S-ICD3 …$s_icd3 // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M1 …$m1 // S-GLVL-X …$s_glvl_x
					;
				} else {
					$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
					$this->g1['emsg'] = "糸№　　糸２の加工糸コードが違う。"; // G1-EMSG …$this->g1['emsg']
					$okikae = $m + 1; // M …$m
					$pos = strpos($this->g1['emsg'], '　');
					$this->g1['emsg'] = substr_replace($this->g1['emsg'],$okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
					return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
				}
			} else {
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　の原料が糸２と違う。".$s_ishu; // G1-EMSG …$this->g1['emsg']
				$okikae = $m + 1; // M …$m
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'],$okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ｲﾄｶｺｳﾏｽﾀﾃﾝｶｲ_e;
			}
		}
		if ( $this->g1['HSinenMrs'][$m-30]['hon1'] == 0) { // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
			$this->g1['HSinenMrs'][$m-30]['hon1'] = 1; // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m
		}
	// *
		$this->l++; // L …$l
		$this->mm[$this->l] = $m;
	// *         糸名作成ﾙｰﾁﾝ呼出時糸№ﾃｰﾌﾞﾙ↑
		$m2 = $this->g1['HSinenMrs'][$m-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m // M …$m

		$this->ItoMei($m2); // 糸名作成 …$this->ItoMei

		$this->l--; // L …$l
		if ( $this->g1['HSinenMrs'][$m-30]['ito2'] == 0) { // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m
			if ( $this->g1['HSinenMrs'][$m-30]['denl'] == 0) { // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m // ZERO …0
				$this->g1['HSinenMrs'][$m-30]['denl'] = $this->w_denl; // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
			}
		} else {
			$this->l++; // L …$l
			$this->mm[$this->l] = $m;
	// *             糸名作成ﾙｰﾁﾝ呼出時糸№ﾃｰﾌﾞﾙ↑
			$m2 = $this->g1['HSinenMrs'][$m-30]['ito2'] - 1; // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // M …$m // M …$m

			$this->ItoMei($m2); // 糸名作成 …$this->ItoMei

			$this->l--; // L …$l
			if ( $this->g1['HSinenMrs'][$m-30]['denl'] == 0) { // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m // ZERO …0
				$this->g1['HSinenMrs'][$m-30]['denl'] = $this->w_denl; // W-ﾃﾞﾆｰﾙ …$this->w_denl // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
				$m1 = $this->g1['HSinenMrs'][$m-30]['ito1'] - 1; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // M …$m // M1 …$m1
				if ( $m1 >= 30) { // M1 …$m1
					$this->g1['HSinenMrs'][$m-30]['denl'] += $this->g1['HSinenMrs'][$m1-30]['denl']; // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M1 …$m1 // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
				} else {
					$this->g1['HSinenMrs'][$m-30]['denl'] += $this->g1['HSigenMrs'][$m1]['gendenl']; // W1-ｹﾞﾝﾃﾞﾆｰﾙ …$this->g1['HSigenMrs'][$i]['gendenl'] // M1 …$m1 // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m
				}
			}
			if ( $this->g1['HSinenMrs'][$m-30]['hon2'] == 0) { // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m
				$this->g1['HSinenMrs'][$m-30]['hon2'] = 1; // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m
			}
		}
		$this->w_denl = $this->g1['HSinenMrs'][$m-30]['denl'] ; // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // M …$m // W-ﾃﾞﾆｰﾙ …$this->w_denl
	}
	// *****************************************************************
	private function GensiMrMei($m) { // 原糸マスタ名作成 …$this->GensiMrMei		point_1 = "ｹﾞﾝ M/R ";
											$this->g1['point_1'] .= "GensiMrMei($m)\n";
	// *----------------------------------------------------------------
		$icd = trim(substr($this->g1['HSigenMrs'][$m]['biko'],1,5)); // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // M …$m // IUICD3 …$this->ik->cd3
		$this->ItocdCheck($icd); // ｲﾄｺｰﾄﾞﾁｪｯｸ …$this->ItocdCheck
		if ( $this->g1['errflg'] == 1) { // ERRFLG …$this->g1['errflg']
			$okikae = $this->g1['HSigenMrs'][$m]['gno']; // W1-GNO …$this->g1['HSigenMrs'][$i]['gno'] // M …$m
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'],$okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ｹﾞﾝｼﾏｽﾀｻｸｾｲ_e;
		}
		if ( $this->g1['HSigenMrs'][ $m ]['gito'] == '') { // W1-GITO …$this->g1['HSigenMrs'][$i]['gito'] // M …$m // SPACE …''
			$this->GensiMeiTori($m); // 原糸名データ取り込み …$this->GensiMeiTori
			$this->GensiDnl($m); // 原糸デニール計算 …$this->GenDnlKei
		}
		$this->w_denl = $this->g1['HSigenMrs'][$m]['gendenl']; // W1-ｹﾞﾝﾃﾞﾆｰﾙ …$this->g1['HSigenMrs'][$i]['gendenl'] // M …$m // W-ﾃﾞﾆｰﾙ …$this->w_denl
		if ($this->l > 0) {$m1 = $this->mm[$this->l];}
		if ($this->l == 0) {
			$this->w_itomei .= HItomeiMrs::Itozs04($this->ik); // L …$this->l // IKREC …$this->ik->rec
		} else if (substr($this->g1['HSinenMrs'][$m1-30]['kako'],0,1) != '#') {
			$this->GensiMeiChu($m); // 原糸名抽出
		}
	}
	// *****************************************************************
	private function KouhiKeisan($m, $kouhi_keisan_kbn) { // 工費係数計算 …$this->KouhiKeisan		point_1 = "ｺｳﾋ ｹｲｻﾝ";
											$this->g1['point_1'] .= "KouhiKeisan($m, $kouhi_keisan_kbn)\n";
	// *----------------------------------------------------------------
		if ( substr($this->g1['HSinenMrs'][$m-30]['kako'], 0, 1) == "%") { // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M …$m
			$this->g1['HSinenMrs'][$m-30]['kohi'] = 0; // W1-KOHI …$this->g1['HSinenMrs'][$i]['kohi'] // M …$m
			for ( $n= 2; 
				!(	$n > 4
				 || $n > strlen($this->g1['HSinenMrs'][$m-30]['kako'])
				 || !is_numeric(substr($this->g1['HSinenMrs'][$m-30]['kako'], -1+ $n, 1))
				 );
				$n +=  1) 
			{ // N …$n // N …$n // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // M …$m // N …$n
				;
			}
			$this->g1['HSinenMrs'][$m-30]['kohi'] = (int)substr($this->g1['HSinenMrs'][$m-30]['kako'] , 1, $n-1);
			return; // ｺｳﾋｹｲｻﾝ_e;
		}
		$hv_flg1 = 0;
		$hv_flg2 = 0;
		$this->g1['HSinenMrs'][$m-30]['kohi'] = 0; // HV-FLG1 …$hv_flg1 // HV-FLG2 …$hv_flg2 // W1-KOHI …$this->g1['HSinenMrs'][$i]['kohi'] // M …$m
		for ( $hv = $this->hv_start[ $kouhi_keisan_kbn ]; 
			$hv <= $this->hv_end[ $kouhi_keisan_kbn ];
			$hv++) 
		{ // HV …$hv // HV-START …$this->hv_start// ｺｳﾋｹｲｻﾝｸﾌﾞﾝ …$kouhi_keisan_kbn // HV …$hv // HV-END …$this->hv_end// ｺｳﾋｹｲｻﾝｸﾌﾞﾝ …$kouhi_keisan_kbn
			if ( $hv_flg1 == 0 || $this->hv[$hv]->fugo == "+") { // HV-FLG1 …$hv_flg1 // T-HVFUGO …$this->hv[$t]->fugo // HV …$hv
				$hv_ito = $m; // M …$m // HV-ITO …$hv_ito
				$hv_hon = $this->g1['HSinenMrs'][$m-30]['hon1'] + $this->g1['HSinenMrs'][$m-30]['hon2']; // HV-HON …$hv_hon // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // M …$m // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // M …$m
				for ( $hv1= 0; 
					!(	$hv1 >= 5
					 || trim(substr($this->hv[$hv]->levl, $hv1, 1)) == '' 
					 || $hv_flg2 == 1
					);
					$hv1++) 
				{ // HV1 …$hv1 // HV1 …$hv1 // T-HVLEVL …$this->hv[$t]->levl // HV …$hv // HV1 …$hv1 // SPACE …'' // HV-FLG2 …$hv_flg2
					if ( $hv_ito < 30) { // HV-ITO …$hv_ito
						$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
					} else {
						if ( substr($this->hv[$hv]->levl, $hv1, 1) == "1") { // T-HVLEVL …$this->hv[$t]->levl // HV …$hv // HV1 …$hv1
							$hv_hon = $this->g1['HSinenMrs'][$hv_ito-30]['hon1']; // W1-HON1 …$this->g1['HSinenMrs'][$i]['hon1'] // HV-ITO …$hv_ito // HV-HON …$hv_hon
							$hv_ito = $this->g1['HSinenMrs'][$hv_ito-30]['ito1']; // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // HV-ITO …$hv_ito // HV-ITO …$hv_ito
						} else {
							$hv_hon = $this->g1['HSinenMrs'][$hv_ito-30]['hon2']; // W1-HON2 …$this->g1['HSinenMrs'][$i]['hon2'] // HV-ITO …$hv_ito // HV-HON …$hv_hon
							$hv_ito = $this->g1['HSinenMrs'][$hv_ito-30]['ito2']; // W1-ITO2 …$this->g1['HSinenMrs'][$i]['ito2'] // HV-ITO …$hv_ito // HV-ITO …$hv_ito
						}
					}
				}
				if ( $hv_flg2 == 0) { // HV-FLG2 …$hv_flg2
					$hv_kai = 1; // HV-KAI …$hv_kai
					$km = $this->hv[$hv]->komk; // T-HVKOMK …$this->hv[$t]->komk // HV …$hv
					$h30 = $hv_ito < 30; // HV-ITO …$hv_ito
					if ($km == "ｲﾄｼｭ"     && $h30) {
						$hv_data = $this->g1['HSigenMrs'][$hv_ito]['gito']; // W1-GITO …$this->g1['HSigenMrs'][$i]['gito'] // HV-ITO …$hv_ito // HV-DATA …$hv_data
					} else if ($km == "ｲﾄｼｭ"     && !$h30) {
						$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
					} else if ($km == "ﾃﾞﾆｰﾙ"    && $h30) {
						$hv_data = $this->g1['HSigenMrs'][$hv_ito]['gendenl']; // W1-ｹﾞﾝﾃﾞﾆｰﾙ …$this->g1['HSigenMrs'][$i]['gendenl'] // HV-ITO …$hv_ito // HV-DATA …$hv_data
					} else if ($km == "ﾃﾞﾆｰﾙ"    && !$h30) {
						$hv_data = $this->g1['HSinenMrs'][$hv_ito-30]['denl']; // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // HV-ITO …$hv_ito // HV-DATA …$hv_data
					} else if ($km == "ｲﾄ"      ) {
						$hv_data = $hv_ito; // HV-ITO …$hv_ito // HV-DATA …$hv_data
					} else if ($km == "ｶｺｳ"      && $h30) {
						$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
					} else if ($km == "ｶｺｳ"      && !$h30) {
						$hv_data1 = $this->g1['HSiitoMrs'][$hv_ito-30]['kbn1']; // W1-KBN1 …$this->g1['HSinenMrs'][$i]['kbn1'] // HV-ITO …$hv_ito // HV-DATA1 …$hv_data1
						$hv_data2 = $this->g1['HSinenMrs'][$hv_ito-30]['kbn2']; // W1-KBN2 …$this->g1['HSinenMrs'][$i]['kbn2'] // HV-ITO …$hv_ito // HV-DATA2 …$hv_data2
						$hv_kai = 2; // HV-KAI …$hv_kai
					} else if ($km == "ﾎﾝｽｳ"    ) {
						$hv_data = $hv_hon; // HV-HON …$hv_hon // HV-DATA …$hv_data
					} else if ($km == "ｺｳﾃｲ"     && $h30) {
						$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
					} else if ($km == "ｺｳﾃｲ"     && !$h30) {
						$hv_data = $this->g1['HSigenMrs'][$hv_ito-30]['kote']; // W1-KOTE …$this->g1['HSinenMrs'][$i]['kote'] // HV-ITO …$hv_ito // HV-DATA …$hv_data
					} else if ($km == "ﾖﾘｽｳ"     && $h30) {
						$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
					} else if ($km == "ﾖﾘｽｳ"     && !$h30) {
						$hv_data = $this->g1['HSinenMrs'][$hv_ito-30]['yori']; // W1-YORI …$this->g1['HSinenMrs'][$i]['yori'] // HV-ITO …$hv_ito // HV-DATA …$hv_data
					} else if ($km == "ﾖﾘﾎｳｺｳ"   && $h30) {
						$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
					} else if ($km == "ﾖﾘﾎｳｺｳ"   && !$h30) {
						$hv_data = $this->g1['HSiitoMrs'][$hv_ito-30]['hoko']; // W1-HOKO …$this->g1['HSinenMrs'][$i]['hoko'] // HV-ITO …$hv_ito // HV-DATA …$hv_data
					} else if ($km == "ｷｶｸﾀﾝｲ"   && $h30) {
						$hv_data = $this->g1['HSinenMrs'][$hv_ito]['ktnd']; // W1-KTND …$this->g1['HSigenMrs'][$i]['ktnd'] // HV-ITO …$hv_ito // HV-DATA …$hv_data
					} else if ($km == "ｷｶｸﾀﾝｲ"   && !$h30) {
						$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
					} else if ($km == "ﾋﾞｺｳ"     && $h30) {
						$hv_data = $this->g1['HSigenMrs'][$hv_ito]['biko']; // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // HV-ITO …$hv_ito // HV-DATA …$hv_data
					} else if ($km == "ﾋﾞｺｳ"     && !$h30) {
						$hv_data = $this->g1['HSinenMrs'][$hv_ito-30]['kako']; // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // HV-ITO …$hv_ito // HV-DATA …$hv_data
					} else if ($km == "ｺｳﾋｹｲｽｳ" ) {
						$hv_data = $this->g1['HSinenMrs'][$m-30]['kohi']; // W1-KOHI …$this->g1['HSinenMrs'][$i]['kohi'] // M …$m // HV-DATA …$hv_data
					} else if ($km =="") {
						;
					} else {
						$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
					}
				}
				if ( $hv_flg2 == 0) { // HV-FLG2 …$hv_flg2
					$hik = $this->hv[$hv]->hika; // T-HVHIKA …$this->hv[$t]->hika // HV …$hv
					if ($hik == "="  && $hv_kai == 1) {
						if ( substr($hv_data, 0, $this->hv[$hv]->keta) == substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA …$hv_data // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							;
						} else {
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == "="  && $hv_kai == 2) {
						if ( substr($hv_data1, 0, $this->hv[$hv]->keta) == substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta) 
						  || substr($hv_data2, 0, $this->hv[$hv]->keta) == substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA1 …$hv_data1 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta // HV-DATA2 …$hv_data2 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							;
						} else {
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == ">"  && $hv_kai == 1) {
						if ( substr($hv_data, 0, $this->hv[$hv]->keta) > substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA …$hv_data // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							;
						} else {
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == ">"  && $hv_kai == 2) {
						if ( substr($hv_data1, 0, $this->hv[$hv]->keta) > substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)
						  || substr($hv_data2, 0, $this->hv[$hv]->keta) > substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA1 …$hv_data1 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta // HV-DATA2 …$hv_data2 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							;
						} else {
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == ">=" && $hv_kai == 1) {
						if ( substr($hv_data, 0, $this->hv[$hv]->keta) >= substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA …$hv_data // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							;
						} else {
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == ">=" && $hv_kai == 2) {
						if ( substr($hv_data1, 0, $this->hv[$hv]->keta) >= substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)
						  || substr($hv_data2, 0, $this->hv[$hv]->keta) >= substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA1 …$hv_data1 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta // HV-DATA2 …$hv_data2 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							;
						} else {
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == "<"  && $hv_kai == 1) {
						if ( substr($hv_data, 0, $this->hv[$hv]->keta) < substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA …$hv_data // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							;
						} else {
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == "<"  && $hv_kai == 2) {
						if ( substr($hv_data1, 0, $this->hv[$hv]->keta) < substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)
						  || substr($hv_data2, 0, $this->hv[$hv]->keta) < substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA1 …$hv_data1 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta // HV-DATA2 …$hv_data2 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							;
						} else {
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == "<=" && $hv_kai == 1) {
						if ( substr($hv_data, 0, $this->hv[$hv]->keta) <= substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA …$hv_data // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							;
						} else {
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == "<=" && $hv_kai == 2) {
						if ( substr($hv_data1, 0, $this->hv[$hv]->keta) <= substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)
						  || substr($hv_data2, 0, $this->hv[$hv]->keta) <= substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA1 …$hv_data1 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta // HV-DATA2 …$hv_data2 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							;
						} else {
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == "^=" && $hv_kai == 1) {
						if ( substr($hv_data, 0, $this->hv[$hv]->keta) == substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA …$hv_data // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					} else if ($hik == "^=" && $hv_kai == 2) {
						if ( substr($hv_data1, 0, $this->hv[$hv]->keta) == substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)
						  || substr($hv_data2, 0, $this->hv[$hv]->keta) == substr($this->hv[$hv]->atai, 0, $this->hv[$hv]->keta)) { // HV-DATA1 …$hv_data1 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta // HV-DATA2 …$hv_data2 // T-HVKETA …$this->hv[$t]->keta // T-HVATAI …$this->hv[$t]->atai // HV …$hv // T-HVKETA …$this->hv[$t]->keta
							$hv_flg2 = 1; // HV-FLG2 …$hv_flg2
						}
					}
				}
	// ***  DISPLAY HV T-HVRECX(HV) HV-DATA HV-FLG2 UPON ｺﾝｿｰﾙ
				$ak = $this->hv[$hv]->andk; // T-HVAND …$this->hv[$t]->and // HV …$hv
				$fg = $this->hv[$hv]->fugo; // T-HVFUGO …$this->hv[$t]->fugo // HV …$hv // HV-FLG2 …$hv_flg2
				if ($ak == "" && $fg ==  "" && $hv_flg2 == 0) {
					$this->g1['HSinenMrs'][$m-30]['kohi'] = $this->hv[$hv]->kohi; // T-HVKOHI …$this->hv[$t]->kohi // HV …$hv // W1-KOHI …$this->g1['HSinenMrs'][$i]['kohi'] // M …$m
					$hv_flg1 = 1; // HV-FLG1 …$hv_flg1
				} else if ($ak == "" && $fg == "+" && $hv_flg2 == 0) {
					$this->g1['HSinenMrs'][$m-30]['kohi'] += $this->hv[$hv]->kohi; // T-HVKOHI …$this->hv[$t]->kohi // HV …$hv // W1-KOHI …$this->g1['HSinenMrs'][$i]['kohi'] // M …$m
				} else if ($ak == "" && $hv_flg2 == 1) {
					$hv_flg2 = 0; // HV-FLG2 …$hv_flg2
				}
			}
		}
	}
	// *****************************************************************
	private function Body2AtoCheck() { // ﾎﾞﾃﾞｨ2ｱﾄﾁｪｯｸ …$this->Body2AtoCheck		point_1 = "B2ｱﾄ  CK";
											$this->g1['point_1'] .= "Body2AtoCheck()\n";
	// *----------------------------------------------------------------
		for ( $i= 0; !($i >= 15 || $this->g1['HSiitoMrs'][$i]['mjun'] == '');$i++) { // I …$i // I …$i // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // I …$i // SPACE …''
			if ( $this->g1['HSiitoMrs'][$i]['mjun'] == $this->g1['HSiitoMrs'][$i]['mjun'] &&
				$this->g1['HSiitoMrs'][$i]['kakouban'] == $this->sv['tayo'][$i]['kakouban']) { // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // I …$i // SV-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // I …$i // W1-ｶｺｳﾊﾞﾝｺﾞｳ …$this->g1['HSiitoMrs'][$i]['kakouban'] // I …$i // SV-ｶｺｳﾊﾞﾝｺﾞｳ …$this->g1['HSiitoMrs'][$i]['kakouban'] // I …$i
				$this->g1['HSiitoMrs'][$i]['denl'] = $this->sv['tayo'][$i]['denl']; // SV-DENL …$this->g1['HSiitoMrs'][$i]['denl'] // I …$i // W1-DENL …$this->g1['HSiitoMrs'][$i]['denl'] // I …$i
				$this->g1['HSiitoMrs'][$i]['ondo'] = $this->sv['tayo'][$i]['ondo']; // SV-ONDO …$this->g1['HSiitoMrs'][$i]['ondo'] // I …$i // W1-ONDO …$this->g1['HSiitoMrs'][$i]['ondo'] // I …$i
				$this->g1['HSinenMrs'][$i]['hun'] = $this->sv['tayo'][$i]['hun']; // SV-HUN …$this->g1['HSiitoMrs'][$i]['hun'] // I …$i // W1-HUN …$this->g1['HSinenMrs'][$i]['hun'] // I …$i
				$this->g1['HSiitoMrs'][$i]['nori'] = $this->sv['tayo'][$i]['nori']; // SV-NORI …$this->g1['HSiitoMrs'][$i]['nori'] // I …$i // W1-NORI …$this->g1['HSiitoMrs'][$i]['nori'] // I …$i
			}
		}
	// *
		for ( $i= 0; !($i >= 18 || $this->g1['errflg'] == 1); $i++) { // I …$i // I …$i // ERRFLG …$this->g1['errflg']
			if ( 	$this->g1['HSigenMrs'][$i]['gito'] == '' &&
					$this->g1['HSigenMrs'][$i]['biko'] == ''
				|| 	$this->g1['HSigenMrs'][$i]['siyoflg'] == 1) { // W1-GITO …$this->g1['HSigenMrs'][$i]['gito'] // I …$i // SPACE …'' // W1-BIKO …$this->g1['HSigenMrs'][$i]['biko'] // I …$i // SPACE …'' // F-GENSI …$f_gensi // I …$i
				;
			} else {
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　は使用されていません。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $this->g1['HSigenMrs'][$i]['gno']; // W1-GNO …$this->g1['HSigenMrs'][$i]['gno'] // I …$i
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'],$okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			}
		}
	// *
		for ( $i= 0; !($i >= 36 || $this->g1['errflg'] == 1);$i++) { // I …$i // I …$i // ERRFLG …$this->g1['errflg']
			if (	$this->g1['HSinenMrs'][$i]['ito1'] == 0 &&
					$this->g1['HSinenMrs'][$i]['kako'] == ''
				||	$this->g1['HSinenMrs'][$i]['siyoflg'] == 1) { // W1-ITO1 …$this->g1['HSinenMrs'][$i]['ito1'] // I …$i // W1-KAKO …$this->g1['HSinenMrs'][$i]['kako'] // I …$i // SPACE …'' // F-KAKOU …$f_kakou // I …$i
				;
			} else {
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "糸№　は使用されていません。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $this->g1['HSinenMrs'][$i]['kno']; // W1-KNO …$this->g1['HSinenMrs'][$i]['kno'] // I …$i
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'],$okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			}
		}
	// *
		$f_tjun = []; // ZERO …0 // FLG-TYJUN …$flg_tyjun
		$f_yjun = []; // ZERO …0 // FLG-TYJUN …$flg_tyjun
		for ( $i= 0; !($i >= 15 || $this->g1['errflg'] == 1);$i++) { // I …$i // I …$i // ERRFLG …$this->g1['errflg']
			if ( trim(substr($this->g1['HSiitoMrs'][$i]['mjun'],0, 1)) > '') { // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // I …$i // SPACE …''
				$s9x = substr($this->g1['HSiitoMrs'][$i]['mjun'],0,1); // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // I …$i // S9-X …$s9_x
				$s9=strpos('ABCDEFGH',$s9x);
				$f_tjun[$s9] = 1; // F-TJUN …$f_tjun // S9 …$s9
			}
			if ( trim(substr($this->g1['HSiitoMrs'][$i]['mjun'],1, 1)) > '') { // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // I …$i // SPACE …''
				$s9_x = substr($this->g1['HSiitoMrs'][$i]['mjun'],1, 1); // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // I …$i // S9-X …$s9_x
				$s9=strpos('ABCDEFGH',$s9x);
				$f_yjun[$s9] = 1; // F-YJUN …$f_yjun // S9 …$s9
			}
		}
		for ( $s9= 1; !($s9 >= 8 || $this->g1['errflg'] == 1); $s9++) { // S9 …$s9 // S9 …$s9 // ERRFLG …$this->g1['errflg']
			if ( $f_tjun [ $s9 - 1 ] == 0 && $f_tjun [ $s9 ] > 0) { // F-TJUN …$f_tjun // S9 …$s9 // F-TJUN …$f_tjun // S9 …$s9
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "経順　は前詰めの糸順にしてください。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $s9 + 1; // S9-X …$s9_x
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			}
			if ( $f_yjun [ $s9 - 1 ] == 0 && $f_yjun [ $s9 ] > 0 && $this->g1['errflg'] == 0) { // F-YJUN …$f_yjun // S9 …$s9 // F-YJUN …$f_yjun // S9 …$s9 // ERRFLG …$this->g1['errflg']
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "緯順　は前詰めの糸順にしてください。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $s9 + 1; // S9-X …$s9_x
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'], $okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			}
		}
	}

	// *****************************************************************
	private function Body3Check() { // ﾎﾞﾃﾞｨﾁｪｯｸ3 …$this->Body3Check		point_1 = "B3-CHECK";
											$this->g1['point_1'] .= "Body3Check()\n";
	// *----------------------------------------------------------------
		$this->iu[] = new HItogenMrs();
		$this->ik = new HItomeiMrs();
		$this->ht[] = new HItojoMrs();
		$this->hd = new HDtexMrs();

		for ( $i= 0; !($i >= 15 || $this->g1['errflg'] == 1);$i++) { // ﾎﾞﾃﾞｨ3ｲﾄﾁｪｯｸ …$this->Body3ItoCheck // I …$i // I …$i // ERRFLG …$this->g1['errflg']
			$this->Body3ItoCheck($i);
		}
		for ( $i= 0; !($i >= 4 || $this->g1['errflg'] == 1);$i++) { // ﾎﾞﾃﾞｨ3ﾁｭｳｲﾁｪｯｸ …$this->Body3ChuiCheck // I …$i // I …$i // ERRFLG …$this->g1['errflg']
			$this->Body3ChuiCheck($i);
		}
	}
	// *****************************************************************
	private function Body3ItoCheck($i) { // ﾎﾞﾃﾞｨ3ｲﾄﾁｪｯｸ …$this->Body3ItoCheck		point_1 = "B3ｲﾄ  CK";
											$this->g1['point_1'] .= "Body3ItoCheck()\n";
	// *----------------------------------------------------------------
		if ( trim($this->g1['HSiitoMrs'][$i]['mjun']) == '') { // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // I …$i // SPACE …''
			if ( $this->g1['HSiitoMrs'][$i]['denl'] > 0
				|| $this->g1['HSiitoMrs'][$i]['ondo'] > 0
				|| $this->g1['HSinenMrs'][$i]['hun'] > 0
				|| $this->g1['HSiitoMrs'][$i]['nori'] > '') { // W1-DENL …$this->g1['HSiitoMrs'][$i]['denl'] // I …$i // W1-ONDO …$this->g1['HSiitoMrs'][$i]['ondo'] // I …$i // W1-HUN …$this->g1['HSinenMrs'][$i]['hun'] // I …$i // W1-NORI …$this->g1['HSiitoMrs'][$i]['nori'] // I …$i // SPACE …''
				$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
				$this->g1['emsg'] = "行№　糸順が無いのに入力データがある。"; // G1-EMSG …$this->g1['emsg']
				$okikae = $i + 1; // W1-GNO …$this->g1['HSigenMrs'][$i]['gno'] // I …$i
				$pos = strpos($this->g1['emsg'], '　');
				$this->g1['emsg'] = substr_replace($this->g1['emsg'],$okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
				return; // ﾎﾞﾃﾞｲ3ｲﾄﾁｪｯｸ_e;
			}
			return; // ﾎﾞﾃﾞｲ3ｲﾄﾁｪｯｸ_e;
		}
		if ( $this->g1['HSiitoMrs'][$i]['denl'] == 0) { // W1-DENL …$this->g1['HSiitoMrs'][$i]['denl'] // I …$i
			$j = $this->g1['HSiitoMrs'][$i]['kakouban']; // W1-ｶｺｳﾊﾞﾝｺﾞｳ …$this->g1['HSiitoMrs'][$i]['kakouban'] // I …$i // J …$j
			$this->g1['HSiitoMrs'][$i]['denl'] = $this->g1['HSinenMrs'][$j-30]['denl']; // W1-ｶｺｳﾃﾞﾆｰﾙ …$this->g1['HSinenMrs'][$i]['denl'] // J …$j // W1-DENL …$this->g1['HSiitoMrs'][$i]['denl'] // I …$i
		}
		$nori = $this->g1['HSiitoMrs'][$i]['nori'];
		if ( $nori == "" || $nori == "1" || $nori == " 1" || $nori == "11") { // W1-NORI …$this->g1['HSiitoMrs'][$i]['nori'] // I …$i
			;
		} else {
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "糸順　糊付区分を正しく入力してください"; // G1-EMSG …$this->g1['emsg']
			$okikae = $this->g1['HSiitoMrs'][$i]['mjun']; // W1-MJUN …$this->g1['HSiitoMrs'][$i]['mjun'] // I …$i
			$pos = strpos($this->g1['emsg'], '　');
			$this->g1['emsg'] = substr_replace($this->g1['emsg'],$okikae, $pos, 3); // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｲ3ｲﾄﾁｪｯｸ_e;
		}
	}
	// *****************************************************************
	private function Body3ChuiCheck($i) { // ﾎﾞﾃﾞｨ3ﾁｭｳｲﾁｪｯｸ …$this->Body3ChuiCheck		point_1 = "B3ﾁｭｳｲCK";
											$this->g1['point_1'] .= "Body3ChuiCheck()\n";
	// *----------------------------------------------------------------
		$chui_cnt1 = 0; // ﾁｭｳｲCNT1 …$chui_cnt1
		for ( $i= 0; !($i >= 6); $i++) { // I …$i // I …$i
			if ( $this->g1['chuj'][$i] > '') { // W1-CHUJ …$this->g1['chuj'][$i] // I …$i // SPACE …''
				$chui_cnt1 += 1; // ﾁｭｳｲCNT1 …$chui_cnt1
			}
		}
	// *
		if ( $chui_cnt + $this->g1['chui_cnt1'] > 16) { // ﾁｭｳｲCNT …$chui_cnt // ﾁｭｳｲCNT1 …$chui_cnt1
			$this->g1['errflg'] = 1; // ERRFLG …$this->g1['errflg']
			$this->g1['emsg'] = "注意事項がオーバーします！！"; // G1-EMSG …$this->g1['emsg']
			return; // ﾎﾞﾃﾞｨ3ﾁｭｳｲﾁｪｯｸ_e;
		}
	}

	// *****************************************************************
	private function ItogenMrChain($cd) { // 糸原価マスターの索引 …ItogenMrChain
											$this->g1['point_1'] .= "ItogenMrChain($cd)\n";
	// *----------------------------------------------------------------
		$invflg = 0;
		if (count(trim($cd))<5) {
			$iu = HItogenMrs::findFirst([ // READ 糸原価マスター INVALID
				"conditions"=>"cd LIKE ?1",
				"bind"=>[1=>trim($cd).'%'],
			]);
			if (!$iu) {return 1;}
			$cd = $iu->cd;
		}
		$this->iu = HItogenMrs::find([ // READ 糸原価マスター INVALID
			"conditions"=>"cd = ?1",
			"bind"=>[1=>$cd],
		]);
		if (count($this->iu)==0) {$invflg = 1;}
		return $invflg;
	}
	// *****************************************************************
	private function ItomeiMrChain($cd) { // 糸名マスターの索引 …ItomeiMrChain
											$this->g1['point_1'] .= "ItomeiMrChain($cd)\n";
	// *----------------------------------------------------------------
		$invflg = 0;
		if (count(trim($cd))<5) {
			$ik = HItomeiMrs::findFirst([ // READ 糸原価マスター INVALID
				"conditions"=>"cd LIKE ?1",
				"bind"=>[1=>trim($cd).'%'],
			]);
			if (!$ik) {return 1;}
			$cd = $ik->cd;
		}
		$this->ik = HItomeiMrs::findFirst([ // READ 糸名マスター INVALID;
			"conditions"=>"cd = ?1",
			"bind"=>[1=>$cd],
		]);
		if (!$this->ik) {$invflg = 1;}
		return $invflg;
	}
	// *****************************************************************
	private function HItojoMrsStart($cd) { // 糸条件マスターの位置決め …HitojoMrsStart
	// *----------------------------------------------------------------
		$invflg = 0;
		$this->ht = HItojoMrs::find([ // START 糸条件マスター KEY>=HTKEY INVALID;
			"conditions"=>"cd = ?1",
			"order"=>"kish",
			"bind"=>[1=>$cd],
		]);
		if (!$this->ht) {$invflg = 1;}
		return $invflg;
	}
	// *****************************************************************
	private function DtexChain($dtex) { // デシテックス変換の索引 …DtexChain
	// *----------------------------------------------------------------
		$invflg = 0;
		$this->hd = HdtexMrs::findFirst([ // READ デシテックス変換 INVALID;
			"conditions"=>"dtex = ?1",
			"order"=>"cd",
			"bind"=>[1=>$dtex],
		]);
		if (!$this->hd) {$invflg = 1;}
		return $invflg;
	}

}

<?php

class GyoumuMeisaiDts extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $cd;

    /**
     *
     * @var string
     */
    public $utiwake_kbn_cd;

    /**
     *
     * @var integer
     */
    public $gyoumu_dt_id;

    /**
     *
     * @var string
     */
    public $kousei;

    /**
     *
     * @var integer
     */
    public $kaisou;

    /**
     *
     * @var integer
     */
    public $oya_meisai_cd;

    /**
     *
     * @var string
     */
    public $chuumon_kanryoubi;

    /**
     *
     * @var string
     */
    public $zaiko_kanryoubi;

    /**
     *
     * @var string
     */
    public $shouhin_mr_cd;

    /**
     *
     * @var string
     */
    public $tekiyou;

    /**
     *
     * @var string
     */
    public $lot;

    /**
     *
     * @var string
     */
    public $iro;

    /**
     *
     * @var string
     */
    public $iromei;

    /**
     *
     * @var string
     */
    public $kobetucd;

    /**
     *
     * @var string
     */
    public $hinsitu_kbn_cd;

    /**
     *
     * @var string
     */
    public $souko_mr_cd;

    /**
     *
     * @var integer
     */
    public $tanaban;

    /**
     *
     * @var integer
     */
    public $barcode;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $suuryou;

    /**
     *
     * @var string
     */
    public $keisu;

    /**
     *
     * @var string
     */
    public $irisuu;

    /**
     *
     * @var string
     */
    public $tanni_mr1_cd;

    /**
     *
     * @var string
     */
    public $tanni_mr2_cd;

    /**
     *
     * @var string
     */
    public $juch_zan_ryou1;

    /**
     *
     * @var string
     */
    public $juch_zan_ryou2;

    /**
     *
     * @var string
     */
    public $hach_zan_ryou1;

    /**
     *
     * @var string
     */
    public $hach_zan_ryou2;

    /**
     *
     * @var string
     */
    public $zaiko_henka_ryou1;

    /**
     *
     * @var string
     */
    public $zaiko_henka_ryou2;

    /**
     *
     * @var string
     */
    public $azu_henka_ryou1;

    /**
     *
     * @var string
     */
    public $azu_henka_ryou2;

    /**
     *
     * @var string
     */
    public $mitu_ryou1;

    /**
     *
     * @var string
     */
    public $mitu_ryou2;

    /**
     *
     * @var string
     */
    public $juch_ryou1;

    /**
     *
     * @var string
     */
    public $juch_ryou2;

    /**
     *
     * @var string
     */
    public $hach_ryou1;

    /**
     *
     * @var string
     */
    public $hach_ryou2;

    /**
     *
     * @var string
     */
    public $shiire_ryou1;

    /**
     *
     * @var string
     */
    public $shiire_ryou2;

    /**
     *
     * @var string
     */
    public $uriage_ryou1;

    /**
     *
     * @var string
     */
    public $uriage_ryou2;

    /**
     *
     * @var string
     */
    public $shukkairai_ryou1;

    /**
     *
     * @var string
     */
    public $shukkairai_ryou2;

    /**
     *
     * @var string
     */
    public $idou_ryou1;

    /**
     *
     * @var string
     */
    public $idou_ryou2;

    /**
     *
     * @var integer
     */
    public $zaiko_kbn;

    /**
     *
     * @var integer
     */
    public $tanka_kbn;

    /**
     *
     * @var string
     */
    public $gentanka;

    /**
     *
     * @var string
     */
    public $tanka;

    /**
     *
     * @var integer
     */
    public $kingaku;

    /**
     *
     * @var integer
     */
    public $genkagaku;

    /**
     *
     * @var integer
     */
    public $zeinukigaku;

    /**
     *
     * @var integer
     */
    public $zeigaku;

    /**
     *
     * @var string
     */
    public $project_mr_cd;

    /**
     *
     * @var integer
     */
    public $zeiritu_mr_cd;

    /**
     *
     * @var string
     */
    public $bikou;

    /**
     *
     * @var string
     */
    public $nouki;

    /**
     *
     * @var integer
     */
    public $oya_meisai_id;

    /**
     *
     * @var string
     */
    public $shouhin_kakou_cd;

    /**
     *
     * @var string
     */
    public $h_kishu_mr_cd;

    /**
     *
     * @var integer
     */
    public $gouki;

    /**
     *
     * @var integer
     */
    public $juchuu_nasi_flg;

    /**
     *
     * @var string
     */
    public $mtot_juch_ryou1;

    /**
     *
     * @var string
     */
    public $moto_juch_ryou2;

    /**
     *
     * @var string
     */
    public $zaikoseisan_ryou1;

    /**
     *
     * @var string
     */
    public $zaikoseisan_ryou2;

    /**
     *
     * @var string
     */
    public $loss_ryou1;

    /**
     *
     * @var string
     */
    public $loss_ryou2;

    /**
     *
     * @var string
     */
    public $keikaku_ryou1;

    /**
     *
     * @var string
     */
    public $keikaku_ryou2;

    /**
     *
     * @var string
     */
    public $kagi;

    /**
     *
     * @var string
     */
    public $kouritu;

    /**
     *
     * @var string
     */
    public $kouritu_tanni;

    /**
     *
     * @var string
     */
    public $heiretu_suu;

    /**
     *
     * @var string
     */
    public $kadou_nissuu;

    /**
     *
     * @var string
     */
    public $kaisi_hiduke;

    /**
     *
     * @var string
     */
    public $shuuryou_hiduke;

    /**
     *
     * @var string
     */
    public $json_params;

    /**
     *
     * @var integer
     */
    public $id_moto;

    /**
     *
     * @var integer
     */
    public $hikae_dltflg;

    /**
     *
     * @var integer
     */
    public $hikae_user_id;

    /**
     *
     * @var string
     */
    public $hikae_nichiji;

    /**
     *
     * @var integer
     */
    public $sakusei_user_id;

    /**
     *
     * @var string
     */
    public $created;

    /**
     *
     * @var integer
     */
    public $kousin_user_id;

    /**
     *
     * @var string
     */
    public $updated;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
//        $this->setSchema("sfn");
        $this->setSource("gyoumu_meisai_dts");
        $this->belongsTo('gyoumu_dt_id', 'GyoumuDts', 'id', array('alias' => 'GyoumuDts'));
        $this->belongsTo('shouhin_mr_cd', 'ShouhinMrs', 'cd', array('alias' => 'ShouhinMrs'));
        $this->belongsTo('tanni_mr1_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr1s'));
        $this->belongsTo('tanni_mr2_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr2s'));
        $this->belongsTo('hinsitu_kbn_cd', 'HinsituKbns', 'cd', array('alias' => 'HinsituKbns'));
        $this->belongsTo('zeiritu_mr_cd', 'ZeirituMrs', 'cd', array('alias' => 'ZeirituMrs'));
        $this->belongsTo('utiwake_kbn_cd', 'UtiwakeKbns', 'cd', array('alias' => 'UtiwakeKbns'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));
        $this->belongsTo('h_kishu_mr_cd', 'HKishuMrs', 'cd', array('alias' => 'HKishuMrs'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GyoumuMeisaiDts[]|GyoumuMeisaiDts|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GyoumuMeisaiDts|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    public function beforeCreate()
    {
        $this->created = date("Y-m-d H:i:s");
        $this->sakusei_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $this->updated = date("Y-m-d H:i:s");
        $this->kousin_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
    }


    public function beforeUpdate()
    {
        $this->updated = date("Y-m-d H:i:s");
        $this->kousin_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
    }


    public function backOut($dlt_flg = 0)
    {
        $bak = new BakGyoumuMeisaiDts(); // 書き換え忘れ注意！！
        foreach ($this as $fld=>$val) {
            if (substr($fld,0,1) != '_') {
               $bak->$fld = $this->$fld;
            }
        }
        $bak->id = NULL;
        $bak->id_moto = $this->id;
        $bak->hikae_dltflg = $dlt_flg;
        $bak->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak->hikae_nichiji = date("Y-m-d H:i:s");
        return $bak->save();
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'gyoumu_meisai_dts';
    }

	const SQL_P1A = '
		SELECT p1a.cd AS shouhin_mr_cd
		, p1.tantou_mr_cd
		, p1.tanni_mr1_cd
		, p1.tanni_mr2_cd
		, p1.iro
		, p1.iromei
		, p1.lot
		, p1.kobetucd
		, p1.hinsitu_kbn_cd
		, p0b.hinsitu_hyouka_kbn_cd
		, p1.souko_mr_cd
		, MAX(IF(p1.zaiko_henka_ryou1+p1.zaiko_henka_ryou2>0,p0a.hakkoubi,"0000-00-00")) AS nyuukobi
		, MAX(IF(p1.zaiko_henka_ryou1+p1.zaiko_henka_ryou2<0,p0a.hakkoubi,"0000-00-00")) AS shukkobi
		, MAX(p0a.hakkoubi) AS nyuushukkobi
		, SUBSTRING(p0a.hakkoubi,1,7) AS nyuushukkoym
		, p0a.denpyou_mr_id
		, p1.gyoumu_dt_id AS id
		, p0a.cd AS cd
		, p1.cd AS gyou_cd
		, p1.utiwake_kbn_cd
		, IF(p0a.tokuisaki_mr_cd="",p0a.shiiresaki_mr_cd,p0a.tokuisaki_mr_cd) AS torihikisaki_cd
		, p1.bikou
		, SUM(p1.zaiko_henka_ryou1) AS zaiko_ryou1
		, SUM(p1.zaiko_henka_ryou2) AS zaiko_ryou2
		, IF(p1.tanka_kbn=1,p1.tanni_mr1_cd,p1.tanni_mr2_cd) AS tanka_tanni_mr_cd
		, MAX(CONCAT(p0a.hakkoubi,p1.gentanka)) AS shiirebi_tanka
		, SUM(p1.zeinukigaku) AS shiire_gaku
		, SUM(p1.shiire_ryou1) AS shiire_ryou1
		, SUM(p1.shiire_ryou2) AS shiire_ryou2
		, SUM(IF(p1.zaiko_henka_ryou1>0,p1.idou_ryou1,0)) AS hokanyuuko_ryou1
		, SUM(IF(p1.zaiko_henka_ryou2>0,p1.idou_ryou2,0)) AS hokanyuuko_ryou2
		, SUM(IF(p1.zaiko_henka_ryou1<0,p1.idou_ryou1,0)) AS hokashukko_ryou1
		, SUM(IF(p1.zaiko_henka_ryou2<0,p1.idou_ryou2,0)) AS hokashukko_ryou2
		, SUM(p1.uriage_ryou1) AS uriage_ryou1
		, SUM(p1.uriage_ryou2) AS uriage_ryou2
		, p0a.shiiresaki_mr_cd
		, p0a.tokuisaki_mr_cd
		, p0a.nounyuu_kijitu
		, p1.nouki
		, p0a.hacchuu_dt_id
		, p0a.juchuu_dt_id
		, SUM(p1.hach_zan_ryou1) AS hacchuuzan_ryou1
		, SUM(p1.hach_zan_ryou2) AS hacchuuzan_ryou2
		, SUM(p1.juch_zan_ryou1) AS juchuuzan_ryou1
		, SUM(p1.juch_zan_ryou2) AS juchuuzan_ryou2
		, SUM(p1.azu_henka_ryou1) AS azukari_zan1
		, SUM(p1.azu_henka_ryou2) AS azukari_zan2
		, SUM(IF(p1.azu_henka_ryou1>0,azu_henka_ryou1,0)) AS azukari_tasi1
		, SUM(IF(p1.azu_henka_ryou2>0,azu_henka_ryou2,0)) AS azukari_tasi2
		, SUM(IF(p1.azu_henka_ryou1<0,-azu_henka_ryou1,0)) AS azukari_hiki1
		, SUM(IF(p1.azu_henka_ryou2<0,-azu_henka_ryou2,0)) AS azukari_hiki2
		, p0a.created
		, p0a.kousin_user_id
		, p0a.updated
	';

    public static function findZaikos($param=[])
    {
		$def = [
			'conditions' => null, 
			'bind' => [], 
			'kyou' => date("Y-m-d"), 
			'groupby' => ["shouhin_mr_cd"],
			'orderby' => null,
			'fields' => "",
			'joins' => "",
		];
		//初期値と引数マージ
		$set = array_merge($def,$param);
		$group_by = "";
		foreach ($set['groupby'] as $group) {
			if ($group != "") {
				if ($group_by != "") {
					$group_by .= "\n, ";
				}
				$group_by .= $group;
			}
		}
		$db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方は限られている。
		$stmt = $db->prepare(
			self::SQL_P1A
			.$set['fields']
			." FROM gyoumu_meisai_dts AS p1"
			." JOIN gyoumu_dts as p0a ON p0a.id = p1.gyoumu_dt_id"
			." JOIN hinsitu_kbns as p0b ON p0b.cd = p1.hinsitu_kbn_cd"
			." RIGHT JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd"
			." ".$set['joins']
			." WHERE p0a.hakkoubi <= :kyou".($set['conditions']?" AND (".$set['conditions'].")":"")
			." GROUP BY ".$group_by . ($set['orderby']?" ORDER BY ".$set['orderby']:"")
		);
// echo "\n<br>=".$set['joins'];
// echo "\n<br>=".$set['conditions'];
// echo "\n<pre>";
// print_r(array_merge(["kyou" => $set['kyou']], $set['bind']));
// echo "\n</pre>";
// 最終仕入日付とその単価を繋いでMAXを取ると最終仕入単価となるか？
// 在庫金額と仕入金額を合計して在庫数量と仕入数量を合計して金額÷数量で総平均単価がでるか？
// それらは商品コード別に計算するべきか？
		$stmt->execute(array_merge(["kyou" => $set['kyou']], $set['bind']));
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rows;
    }

    public static function findTankas($param=[])
    {
		$def = [
			'conditions' => null, 
			'bind' => [], 
			'kyou' => date("Y-m-d"), 
		];
		//初期値と引数マージ
		$set = array_merge($def,$param);
		$db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方は限られている。
		$stmt = $db->prepare("SELECT
			p1.shouhin_mr_cd,
			IF(p1.tanka_kbn=1,p1.tanni_mr1_cd,p1.tanni_mr2_cd) AS tanka_tanni_mr_cd,
			p1a.hyoujun_genka,
			SUM(p1.shiire_ryou1+p1.idou_ryou1),
			SUM(p1.shiire_ryou2+p1.idou_ryou2),
			SUM(p1.zaiko_henka_ryou1),
			SUM(p1.zaiko_henka_ryou2),
			SUM(p1.genkagaku)
			FROM gyoumu_meisai_dts AS p1
			JOIN gyoumu_dts as p0a ON p0a.id = p1.gyoumu_dt_id
			JOIN hinsitu_kbns as p0b ON p0b.cd = p1.hinsitu_kbn_cd
			JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd
			WHERE p0a.denpyou_mr_id IN (2,6,10)
				AND p1.utiwake_kbn_cd IN (1,10,20)
				AND p1a.zaikokanri = 1
				AND p0b.hinsitu_hyouka_kbn_cd = 1
				AND p1a.zaiko_hyouka_kbn_cd > 1
				AND p0a.hakkoubi <= :kyou".($set['conditions']?" AND (".$set['conditions'].")":"")."
			GROUP BY IF(p1.tanka_kbn=1,p1.tanni_mr1_cd,p1.tanni_mr2_cd), p1.shouhin_mr_cd, SUBSTRING(p0a.hakkoubi,1,7)
			ORDER BY IF(p1.tanka_kbn=1,p1.tanni_mr1_cd,p1.tanni_mr2_cd), p1.shouhin_mr_cd, SUBSTRING(p0a.hakkoubi,1,7)
		"); // 仕入と生産と導入在庫
		$stmt->execute(array_merge(["kyou" => $set['kyou']], $set['bind']));
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rows;
	}
}

<?php

class ShimezaikoDts extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $cd;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $shouhin_mr_cd;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $tanni_mr_cd;

    /**
     *
     * @var string
     */
    public $zaiko_ryou;

    /**
     *
     * @var string
     */
    public $suu_tanni_mr_cd;

    /**
     *
     * @var string
     */
    public $zaiko_suu;

    /**
     *
     * @var string
     */
    public $simebi;

    /**
     *
     * @var string
     */
    public $lot;

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
     * @var string
     */
    public $nyuukobi;

    /**
     *
     * @var string
     */
    public $shukkobi;

    /**
     *
     * @var string
     */
    public $tanka;

    /**
     *
     * @var string
     */
    public $zaiko_hyouka_kbn_cd;

    /**
     *
     * @var string
     */
    public $shiire_ryou;

    /**
     *
     * @var string
     */
    public $hokanyuuko_ryou;

    /**
     *
     * @var string
     */
    public $uriage_ryou;

    /**
     *
     * @var string
     */
    public $hokashukko_ryou;

    /**
     *
     * @var string
     */
    public $shiire_suu;

    /**
     *
     * @var string
     */
    public $hokanyuuko_suu;

    /**
     *
     * @var string
     */
    public $uriage_suu;

    /**
     *
     * @var string
     */
    public $hokashukko_suu;

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
        $this->belongsTo('tanni_mr_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMrs'));
        $this->belongsTo('suu_tanni_mr_cd', 'TanniMrs', 'cd', array('alias' => 'SuuTanniMrs'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));
        $this->belongsTo('shouhin_mr_cd', 'ShouhinMrs', 'cd', array('alias' => 'ShouhinMrs'));
        $this->belongsTo('hinsitu_kbn_cd', 'HinsituKbns', 'cd', array('alias' => 'HinsituKbns'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShimezaikoDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShimezaikoDts
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * 商品別倉庫別他詳細別在庫表を出力する。抽出条件はパラメタで与えられる
     *
     * @ $conditions は "shouhin_mr_cd = :shouhin_cd"、bind は ["shouhin_cd"=>"1/00000"] などとする
     * @return $rows は 配列となる。$rows[0]["shouhin_mr_cd"]などで参照できる。
     */
//	商品コード,担当,単位,数単位,ロット,品質,倉庫,在庫量,在庫数,仕入量,仕入数,他入庫量,他入庫数,売上量,売上数,他出庫量,他出庫数,入庫日,出庫日,,,入出庫日,伝票区分,伝票番号,伝票内訳,
	const SQL_P1A = '
		SELECT p1a.cd AS shouhin_mr_cd
		, p1.tantou_mr_cd
		, p1.tanni_mr_cd
		, p1.suu_tanni_mr_cd
		, p1.lot, p1.kobetucd
		, p1.hinsitu_kbn_cd
		, p1.souko_mr_cd
		, SUM(p1.zaiko_ryou) AS zaiko_ryou
		, SUM(p1.zaiko_suu) AS zaiko_suu
		, MAX(p1.shiirebi_tanka) AS shiirebi_tanka
		, SUM(p1.shiire_gaku) AS shiire_gaku
		, SUM(p1.shiire_ryou) AS shiire_ryou
		, SUM(p1.shiire_suu) AS shiire_suu
		, SUM(p1.hokanyuuko_ryou) AS hokanyuuko_ryou
		, SUM(p1.hokanyuuko_suu) AS hokanyuuko_suu
		, SUM(p1.uriage_ryou) AS uriage_ryou
		, SUM(p1.uriage_suu) AS uriage_suu
		, SUM(p1.hokashukko_ryou) AS hokashukko_ryou
		, SUM(p1.hokashukko_suu) AS hokashukko_suu
		, MAX(p1.nyuukobi) AS nyuukobi
		, MAX(p1.shukkobi) AS shukkobi
		, MAX(p1.nyuushukkobi) AS nyuushukkobi
		, p1.nyuushukkoym
		, p1.denpyou_mr_cd
		, p1.oya_cd
		, p1.utiwake_kbn_cd
	';
/*	const SQL_P2 = '
		SELECT p2.shouhin_mr_cd
		, p2.tantou_mr_cd
		, p2.tanni_mr_cd
		, p2.suu_tanni_mr_cd
		, p2.lot
		, p2.kobetucd
		, p2.hinsitu_kbn_cd
		, p2.souko_mr_cd
		, p2.zaiko_ryou
		, p2.zaiko_suu
		, 0 AS shiire_ryou
		, 0 AS shiire_suu
		, 0 AS hokanyuuko_ryou
		, 0 AS hokanyuuko_suu
		, 0 AS uriage_ryou
		, 0 AS uriage_suu
		, 0 AS hokashukko_ryou
		, 0 AS hokashukko_suu
		, p2.nyuukobi
		, p2.shukkobi
		FROM shimezaiko_dts p2
		WHERE p2.simebi = :simebi
	';
*/
	const SQL_P3 = '
		SELECT p3.shouhin_mr_cd
		, p3a.tantou_mr_cd
		, p3.tanni_mr_cd
		, p3.suu_tanni_mr_cd
		, p3.lot
		, p3.kobetucd
		, p3.hinsitu_kbn_cd
		, p3.souko_mr_cd
		, p3.suuryou * p3b.shiire_zaiko_flg AS zaiko_ryou
		, p3.keisu * p3b.shiire_zaiko_flg AS zaiko_suu
		, CASE
			WHEN p3.utiwake_kbn_cd < 20 THEN CONCAT(p3a.shiirebi, p3.tanka)
			WHEN p3.utiwake_kbn_cd = 20 THEN CONCAT(p3a.shiirebi, p3.gentanka)
			ELSE "0000-00-000"
			END AS shiirebi_tanka
		, CASE
			WHEN p3.utiwake_kbn_cd < 20 THEN p3.zeinukigaku
			WHEN p3.utiwake_kbn_cd = 20 THEN p3.genkagaku
			ELSE 0
			END AS shiire_gaku
		, p3.suuryou * (p3b.shiire_zaiko_flg + 1) / 2 AS shiire_ryou
		, p3.keisu * (p3b.shiire_zaiko_flg + 1) / 2 AS shiire_suu
		, 0 AS hokanyuuko_ryou
		, 0 AS hokanyuuko_suu
		, 0 AS uriage_ryou
		, 0 AS uriage_suu
		, p3.suuryou * (1 - p3b.shiire_zaiko_flg) / 2 AS hokashukko_ryou
		, p3.keisu * (1 - p3b.shiire_zaiko_flg) / 2 AS hokashukko_suu
		, p3a.shiirebi AS nyuukobi
		, NULL AS shukkobi
		, p3a.shiirebi AS nyuushukkobi
		, DATE_FORMAT(p3a.shiirebi, "%Y%m") as nyuushukkoym
		, "shiire" as denpyou_mr_cd
		, p3a.cd as oya_cd
		, p3.utiwake_kbn_cd
		FROM shiire_meisai_dts p3
		JOIN shiire_dts p3a ON p3a.id = p3.shiire_dt_id
		JOIN utiwake_kbns p3b ON p3b.cd = p3.utiwake_kbn_cd
		WHERE p3a.shiirebi <= :kyou AND p3b.shiire_zaiko_flg <> 0
	';
	const SQL_P4 = '
		SELECT p4.shouhin_mr_cd
		, p4a.tantou_mr_cd
		, p4.tanni_mr_cd
		, p4.suu_tanni_mr_cd
		, p4.lot
		, p4.kobetucd
		, p4.hinsitu_kbn_cd
		, p4.souko_mr_cd
		, (0 - p4.suuryou) AS zaiko_ryou
		, (0 - p4.keisu) AS zaiko_suu
		, "0000-00-000" AS shiirebi_tanka
		, 0 AS shiire_gaku
		, 0 AS shiire_ryou
		, 0 AS shiire_suu
		, 0 AS hokanyuuko_ryou
		, 0 AS hokanyuuko_suu
		, p4.suuryou AS uriage_ryou
		, p4.keisu AS uriage_suu
		, 0 AS hokashukko_ryou
		, 0 AS hokashukko_suu
		, NULL AS nyuukobi
		, p4a.uriagebi AS shukkobi
		, p4a.uriagebi AS nyuushukkobi
		, DATE_FORMAT(p4a.uriagebi, "%Y%m") as nyuushukkoym
		, "uriage" as denpyou_mr_cd
		, p4a.cd as oya_cd
		, p4.utiwake_kbn_cd
		FROM uriage_meisai_dts p4
		JOIN uriage_dts p4a ON p4a.id = p4.uriage_dt_id
		JOIN utiwake_kbns p4b ON p4b.cd = p4.utiwake_kbn_cd
		WHERE p4a.uriagebi <= :kyou AND p4b.uriage_zaiko_flg = 1
	';
	const SQL_P5 = '
		SELECT p5.shouhin_mr_cd
		, p5a.tantou_mr_cd
		, p5.tanni_mr_cd
		, p5.suu_tanni_mr_cd
		, p5.lot
		, p5.kobetucd
		, p5.hinsitu_kbn_cd
		, p5a.souko_mr_cd
		, p5.suuryou AS zaiko_ryou
		, p5.keisu AS zaiko_suu
		, CONCAT(p5a.henkanbi, p5.tanka) AS shiirebi_tanka
		, p5.kingaku AS shiire_gaku
		, p5b.shiire_flg * p5.suuryou AS shiire_ryou
		, p5b.shiire_flg * p5.keisu shiire_suu
		, p5b.nyuuko_flg * p5.suuryou AS hokanyuuko_ryou
		, p5b.nyuuko_flg * p5.keisu AS hokanyuuko_suu
		, 0 AS uriage_ryou
		, 0 AS uriage_suu
		, 0 AS hokashukko_ryou
		, 0 AS hokashukko_suu
		, p5a.henkanbi AS nyuukobi
		, NULL AS shukkobi
		, p5a.henkanbi AS nyuushukkobi
		, DATE_FORMAT(p5a.henkanbi, "%Y%m") as nyuushukkoym
		, p5b.denpyou_mr_cd
		, p5a.cd as oya_cd
		, "1" as utiwake_kbn_cd
		FROM zaiko_henkan_meisai_dts p5
		JOIN zaiko_henkan_dts p5a ON p5a.id = p5.zaiko_henkan_dt_id
		JOIN zaiko_henkan_kbns p5b ON p5b.cd = p5a.zaiko_henkan_kbn_cd
		WHERE p5a.henkanbi <= :kyou AND p5.henkansaki_flg > 0
			AND (p5b.shiire_flg = 1 OR p5b.nyuuko_flg = 1)
	';
	const SQL_P6 = '
		SELECT p6.shouhin_mr_cd
		, p6a.moto_tantou_mr_cd
		, p6.tanni_mr_cd
		, p6.suu_tanni_mr_cd
		, p6.lot
		, p6.kobetucd
		, p6.hinsitu_kbn_cd
		, p6a.moto_souko_mr_cd
		, (0 - p6.suuryou) AS zaiko_ryou
		, (0 - p6.keisu) AS zaiko_suu
		, "0000-00-000" AS shiirebi_tanka
		, 0 AS shiire_gaku
		, 0 AS shiire_ryou
		, 0 AS shiire_suu
		, 0 AS hokanyuuko_ryou
		, 0 AS hokanyuuko_suu
		, p6b.uriage_flg * p6.suuryou AS uriage_ryou
		, p6b.uriage_flg * p6.keisu AS uriage_suu
		, p6b.shukko_flg * p6.suuryou AS hokashukko_ryou
		, p6b.shukko_flg * p6.keisu AS hokashikko_suu
		, NULL AS nyuukobi
		, p6a.henkanbi AS shukkobi
		, p6a.henkanbi AS nyuushukkobi
		, DATE_FORMAT(p6a.henkanbi, "%Y%m") as nyuushukkoym
		, p6b.denpyou_mr_cd
		, p6a.cd as oya_cd
		, "0" as utiwake_kbn_cd
		FROM zaiko_henkan_meisai_dts p6
		JOIN zaiko_henkan_dts p6a ON p6a.id = p6.zaiko_henkan_dt_id
		JOIN zaiko_henkan_kbns p6b ON p6b.cd = p6a.zaiko_henkan_kbn_cd
		WHERE p6a.henkanbi <= :kyou AND p6.henkansaki_flg <> 1
			AND (p6b.uriage_flg = 1 OR p6b.shukko_flg = 1)
	';

    public static function findNow($param=[])
    {
		$def = [
			'conditions' => null, 
			'bind' => [], 
			'kyou' => date("Y-m-d"), 
			'groupby' => ["shouhin_mr_cd","tanni_mr_cd","hinsitu_kbn_cd"],
			'fields' => "",
			'joins' => ""
		];
		//初期値と引数マージ
		$set = array_merge($def,$param);
		$group_by = "";
		foreach ($set['groupby'] as $group) {
			if ($group_by != "") {
				$group_by .= "\n, ";
			}
			$group_by .= "p1.".$group;
		}
		$db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方は限られている。
		$stmt = $db->prepare(
			self::SQL_P1A.$set['fields'].
//			', p1a.name as shouhin_name'.
			' FROM ('  .self::SQL_P3.
			'UNION ALL'.self::SQL_P4.
			'UNION ALL'.self::SQL_P5.
			'UNION ALL'.self::SQL_P6.
			") p1
			RIGHT JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd
			".$set['joins']."
			WHERE p1a.zaikokanri = 1".($set['conditions']?" AND (".$set['conditions'].")":"")."
			GROUP BY ".$group_by
		);
// 最終仕入日付とその単価を繋いでMAXを取ると最終仕入単価となるか？
// 在庫金額と仕入金額を合計して在庫数量と仕入数量を合計して金額÷数量で総平均単価がでるか？
// それらは商品コード別に計算するべきか？
		$stmt->execute(array_merge(["kyou" => $set['kyou']], $set['bind']));
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rows;
    }

    /**
     * 商品別在庫額表を出力する。抽出条件はパラメタで与えられる
     *
     * @ $conditions は "shouhin_mr_cd = :shouhin_cd"、bind は ["shouhin_cd"=>"1/00000"] などとする
     * @return $rows は 配列となる。$rows[0]["shouhin_mr_cd"]などで参照できる。
     */
    public static function findGaku($conditions = null, $bind = [], $simebi = null, $kyou = null)
    {
    	if (!$simebi) {
    		$chokkinsime_bi = ChokkinsimeBis::findfirst(["conditions"=>"cd = '1'"]);
    		$simebi = $chokkinsime_bi->simebi;
    	}
		if (!$kyou) {
			$kyou = date("Y-m-d");
		}
		$db = \Phalcon\DI::getDefault()->get('db');
		$stmt = $db->prepare("
			SELECT p1.shouhin_mr_cd
				, p1.tanni_mr_cd
				, SUM(p1.mae_ryou) AS mae_ryou
				, SUM(p1.mae_suu) AS mae_suu
				, SUM(p1.zaiko_ryou) AS zaiko_ryou
				, SUM(p1.zaiko_suu) AS zaiko_suu
				, SUM(p1.shiire_ryou) AS shiire_ryou
				, SUM(p1.shiire_suu) AS shiire_suu
				, SUM(p1.hokanyuuko_ryou) AS hokanyuuko_ryou
				, SUM(p1.hokanyuuko_suu) AS hokanyuuko_suu
				, SUM(p1.uriage_ryou) AS uriage_ryou
				, SUM(p1.uriage_suu) AS uriage_suu
				, SUM(p1.hokashukko_ryou) AS hokashukko_ryou
				, SUM(p1.hokashukko_suu) AS hokashukko_suu
				, MAX(p1.nyuukobi) AS nyuukobi
				, MAX(p1.shukkobi) AS shukkobi
				, MAX(p1.mae_tanka) AS mae_tanka
				, CASE p1a.zaiko_hyouka_kbn_cd
					WHEN 2 THEN ROUND(SUBSTRING(MAX(p1.shiirebi_tanka),11), p1a.tanka_shousuu)
					WHEN 3 THEN ROUND(SUM(p1.bunsi_gaku) / SUM(p1.bunbo_ryou), p1a.tanka_shousuu)
					ELSE p1a.hyoujun_genka
					END AS genka
			FROM (
				SELECT p2.shouhin_mr_cd
					, p2.tanni_mr_cd
					, p2.zaiko_ryou AS mae_ryou
					, p2.zaiko_suu AS mae_suu
					, p2.zaiko_ryou
					, p2.zaiko_suu
					, 0 AS shiire_ryou
					, 0 AS shiire_suu
					, 0 AS hokanyuuko_ryou
					, 0 AS hokanyuuko_suu
					, 0 AS uriage_ryou
					, 0 AS uriage_suu
					, 0 AS hokashukko_ryou
					, 0 AS hokashukko_suu
					, p2.nyuukobi
					, p2.shukkobi
					, p2.tanka AS mae_tanka
					, CONCAT(p2.nyuukobi, p2.tanka) AS shiirebi_tanka
					, p2.zaiko_ryou * p2.tanka AS bunsi_gaku
					, p2.zaiko_ryou AS bunbo_ryou
				FROM shimezaiko_dts p2
				WHERE p2.simebi = :simebi
			UNION ALL
				SELECT p3.shouhin_mr_cd
					, p3.tanni_mr_cd
					, 0 AS mae_ryou
					, 0 AS mae_suu
					, p3.suuryou AS zaiko_ryou
					, p3.keisu AS zaiko_suu
					, p3.suuryou AS shiire_ryou
					, p3.keisu AS shiire_suu
					, 0 AS hokanyuuko_ryou
					, 0 AS hokanyuuko_suu
					, 0 AS uriage_ryou
					, 0 AS uriage_suu
					, 0 AS hokashukko_ryou
					, 0 AS hokashukko_suu
					, p3a.shiirebi AS nyuukobi
					, NULL AS shukkobi
					, 0 AS mae_tanka
					, CASE p3.utiwake_kbn_cd
						WHEN 1 THEN CONCAT(p3a.shiirebi, p3.tanka)
						ELSE '0000-00-000'
						END AS shiirebi_tanka
					, CASE p3.utiwake_kbn_cd
						WHEN 1 THEN p3.zeinukigaku
						ELSE 0
						END AS bunsi_gaku
					, CASE p3.utiwake_kbn_cd
						WHEN 1 THEN p3.suuryou
						ELSE 0
						END AS bunbo_ryou
				FROM shiire_meisai_dts p3
				JOIN shiire_dts p3a ON p3a.id = p3.shiire_dt_id
				WHERE p3a.shiirebi > :simebi AND p3a.shiirebi <= :kyou
			UNION ALL
				SELECT p4.shouhin_mr_cd
					, p4.tanni_mr_cd
					, 0 AS mae_ryou
					, 0 AS mae_suu
					, (0 - p4.suuryou) AS zaiko_ryou
					, (0 - p4.keisu) AS zaiko_suu
					, 0 AS shiire_ryou
					, 0 AS shiire_suu
					, 0 AS hokanyuuko_ryou
					, 0 AS hokanyuuko_suu
					, p4.suuryou AS uriage_ryou
					, p4.keisu AS uriage_suu
					, 0 AS hokashukko_ryou
					, 0 AS hokashukko_suu
					, NULL AS nyuukobi
					, p4a.uriagebi AS shukkobi
					, 0 AS mae_tanka
					, '0000-00-000' AS shiirebi_tanka
					, 0 AS bunsi_gaku
					, 0 AS bunbo_ryou
				FROM uriage_meisai_dts p4
				JOIN uriage_dts p4a ON p4a.id = p4.uriage_dt_id
				WHERE p4a.uriagebi > :simebi AND p4a.uriagebi <= :kyou
			UNION ALL
				SELECT p5.shouhin_mr_cd
					, p5.tanni_mr_cd
					, 0 AS mae_ryou
					, 0 AS mae_suu
					, p5.suuryou AS zaiko_ryou
					, p5.keisu AS zaiko_suu
					, CASE p5a.zaiko_henkan_kbn_cd
						WHEN 1 THEN p5.suuryou
						ELSE 0
						END AS shiire_ryou
					, CASE p5a.zaiko_henkan_kbn_cd
						WHEN 1 THEN p5.keisu
						ELSE 0
						END AS shiire_suu
					, CASE p5a.zaiko_henkan_kbn_cd
						WHEN 1 THEN 0
						ELSE p5.suuryou
						END AS hokanyuuko_ryou
					, CASE p5a.zaiko_henkan_kbn_cd
						WHEN 1 THEN 0
						ELSE p5.keisu
						END AS hokanyuuko_suu
					, 0 AS uriage_ryou
					, 0 AS uriage_suu
					, 0 AS hokashukko_ryou
					, 0 AS hokashukko_suu
					, p5a.henkanbi AS nyuukobi
					, NULL AS shukkobi
					, 0 AS mae_tanka
					, CASE p5a.zaiko_henkan_kbn_cd
						WHEN 1 THEN CONCAT(p5a.henkanbi, p5.tanka)
						ELSE '0000-00-000'
						END AS shiirebi_tanka
					, CASE p5a.zaiko_henkan_kbn_cd
						WHEN 1 THEN p5.kingaku
						ELSE 0
						END AS bunsi_gaku
					, CASE p5a.zaiko_henkan_kbn_cd
						WHEN 1 THEN p5.suuryou
						ELSE 0
						END AS bunbo_ryou
				FROM zaiko_henkan_meisai_dts p5
				JOIN zaiko_henkan_dts p5a ON p5a.id = p5.zaiko_henkan_dt_id
				WHERE p5a.henkanbi > :simebi AND p5a.henkanbi <= :kyou AND p5.henkansaki_flg = 1
			UNION ALL
				SELECT p6.shouhin_mr_cd
					, p6.tanni_mr_cd
					, 0 AS mae_ryou
					, 0 AS mae_suu
					, (0 - p6.suuryou) AS zaiko_ryou
					, (0 - p6.keisu) AS zaiko_suu
					, 0 AS shiire_ryou
					, 0 AS shiire_suu
					, 0 AS hokanyuuko_ryou
					, 0 AS hokanyuuko_suu
					, 0 AS uriage_ryou
					, 0 AS uriage_suu
					, p6.suuryou AS hokashukko_ryou
					, p6.keisu AS hokashukko_suu
					, NULL AS nyuukobi
					, p6a.henkanbi AS shukkobi
					, 0 AS mae_tanka
					, '0000-00-000' AS shiirebi_tanka
					, 0 AS bunsi_gaku
					, 0 AS bunbo_ryou
				FROM zaiko_henkan_meisai_dts p6
				JOIN zaiko_henkan_dts p6a ON p6a.id = p6.zaiko_henkan_dt_id
				WHERE p6a.henkanbi > :simebi AND p6a.henkanbi <= :kyou AND p6.henkansaki_flg = 0
			) p1
			JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd
			WHERE p1a.zaikokanri = 1".($conditions?" AND (".$conditions.")":"")."
			GROUP BY p1.shouhin_mr_cd
				, p1.tanni_mr_cd
		");
// 最終仕入日付とその単価を繋いでMAXを取ると最終仕入単価となるか？
// 在庫金額と仕入金額を合計して在庫数量と仕入数量を合計して金額÷数量で総平均単価がでる
// それらは商品コード別に計算する
		$stmt->execute(array_merge(["simebi" => $simebi, "kyou" => $kyou], $bind));
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rows;
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

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'shimezaiko_dts';
    }

}

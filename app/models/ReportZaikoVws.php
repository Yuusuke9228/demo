<?php

class ReportZaikoVws extends \Phalcon\Mvc\Model
{

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
    public $zaiko_ryou1s;

    /**
     *
     * @var string
     */
    public $zaiko_ryou2s;

    /**
     *
     * @var string
     */
    public $shiirebi_tankas;

    /**
     *
     * @var string
     */
    public $shiire_gakus;

    /**
     *
     * @var string
     */
    public $shiire_ryou1s;

    /**
     *
     * @var string
     */
    public $shiire_ryou2s;

    /**
     *
     * @var string
     */
    public $hokanyuuko_ryou1s;

    /**
     *
     * @var string
     */
    public $hokanyuuko_ryou2s;

    /**
     *
     * @var string
     */
    public $uriage_ryou1s;

    /**
     *
     * @var string
     */
    public $uriage_ryou2s;

    /**
     *
     * @var string
     */
    public $hokashukko_ryou1s;

    /**
     *
     * @var string
     */
    public $hokashukko_ryou2s;

    /**
     *
     * @var string
     */
    public $nyuukobis;

    /**
     *
     * @var string
     */
    public $shukkobis;

    /**
     *
     * @var string
     */
    public $nyuushukkobi;

    /**
     *
     * @var string
     */
    public $nyuushukkoym;

    /**
     *
     * @var string
     */
    public $denpyou_mr_cd;

    /**
     *
     * @var integer
     */
    public $oya_id;

    /**
     *
     * @var integer
     */
    public $oya_cd;

    /**
     *
     * @var integer
     */
    public $gyou_cd;

    /**
     *
     * @var string
     */
    public $utiwake_kbn_cd;

    /**
     *
     * @var string
     */
    public $torihikisaki_cd;

    /**
     *
     * @var string
     */
    public $bikou;

    /**
     *
     * @var integer
     */
    public $hinsitu_hyouka_kbn_cd;

    /**
     *
     * @var integer
     */
    public $kousin_user_id;

    /**
     *
     * @var integer
     */
    public $updated;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('kousin_user_id', 'Users', 'id', array('alias' => 'Users'));
        $this->belongsTo('tanni_mr1_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr1s'));
        $this->belongsTo('tanni_mr2_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr2s'));
        $this->belongsTo('utiwake_kbn_cd', 'UtiwakeKbns', 'cd', array('alias' => 'UtiwakeKbns'));
        $this->belongsTo('denpyou_mr_cd', 'DenpyouMrs', 'cd', array('alias' => 'DenpyouMrs'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        $this->belongsTo('hinsitu_kbn_cd', 'HinsituKbns', 'cd', array('alias' => 'HinsituKbns'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));

        //納入先、気付先を取得するため。 Add By Nishiyama 2019/2/14
        $this->belongsTo('denpyou_mr_cd','UriageDts','cd',array('alias' => 'UriageDts'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'report_zaiko_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ReportZaikoVws[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ReportZaikoVws
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

	const SQL_P1A = '
		SELECT p1a.cd AS shouhin_mr_cd
		, p1.tantou_mr_cd
		, p1.tanni_mr1_cd
		, p1.tanni_mr2_cd
		, p1.lot, p1.kobetucd
		, p1.hinsitu_kbn_cd
		, p1.souko_mr_cd
		, SUM(p1.zaiko_ryou1s) AS zaiko_ryou1
		, SUM(p1.zaiko_ryou2s) AS zaiko_ryou2
		, MAX(p1.shiirebi_tankas) AS shiirebi_tanka
		, SUM(p1.shiire_gakus) AS shiire_gaku
		, SUM(p1.shiire_ryou1s) AS shiire_ryou1
		, SUM(p1.shiire_ryou2s) AS shiire_ryou2
		, SUM(p1.hokanyuuko_ryou1s) AS hokanyuuko_ryou1
		, SUM(p1.hokanyuuko_ryou2s) AS hokanyuuko_ryou2
		, SUM(p1.uriage_ryou1s) AS uriage_ryou1
		, SUM(p1.uriage_ryou2s) AS uriage_ryou2
		, SUM(p1.hokashukko_ryou1s) AS hokashukko_ryou1
		, SUM(p1.hokashukko_ryou2s) AS hokashukko_ryou2
		, MAX(p1.nyuukobis) AS nyuukobi
		, MAX(p1.shukkobis) AS shukkobi
		, MAX(p1.nyuushukkobi) AS nyuushukkobi
		, p1.nyuushukkoym
		, p1.denpyou_mr_cd
		, p1.oya_id
		, p1.oya_cd
		, p1.gyou_cd
		, p1.utiwake_kbn_cd
		, p1.torihikisaki_cd
		, p1.bikou
		, p1.hinsitu_hyouka_kbn_cd
		, p1.kousin_user_id
		, p1.updated
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
				$group_by .= "p1.".$group;
			}
		}
		$db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方は限られている。
		$stmt = $db->prepare(
			self::SQL_P1A.$set['fields'].
			" FROM report_zaiko_vws AS p1
			RIGHT JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd
			".$set['joins']."
			WHERE p1a.zaikokanri = 1
				AND nyuushukkobi <= :kyou".($set['conditions']?" AND (".$set['conditions'].")":"")."
			GROUP BY ".$group_by. ($set['orderby']?" ORDER BY ".$set['orderby']:"")
		);
//echo "\n<br>=".$set['conditions'];
// 最終仕入日付とその単価を繋いでMAXを取ると最終仕入単価となるか？
// 在庫金額と仕入金額を合計して在庫数量と仕入数量を合計して金額÷数量で総平均単価がでるか？
// それらは商品コード別に計算するべきか？
		$stmt->execute(array_merge(["kyou" => $set['kyou']], $set['bind']));
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rows;
    }
}

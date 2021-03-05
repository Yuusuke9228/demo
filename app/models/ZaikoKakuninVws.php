<?php

class ZaikoKakuninVws extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $hinsitu_hyouka_kbn_cd;

    /**
     *
     * @var string
     */
    public $souko_mr_cd;

    /**
     *
     * @var string
     */
    public $zaiko_ryou1;

    /**
     *
     * @var string
     */
    public $zaiko_ryou2;

    /**
     *
     * @var string
     */
    public $hacchuuzan_ryou1;

    /**
     *
     * @var string
     */
    public $hacchuuzan_ryou2;

    /**
     *
     * @var string
     */
    public $juchuuzan_ryou1;

    /**
     *
     * @var string
     */
    public $juchuuzan_ryou2;

    /**
     *
     * @var string
     */
    public $denpyou_mr_cd;

    /**
     *
     * @var integer
     */
    public $meisai_id;

    /**
     *
     * @var integer
     */
    public $meisai_cd;

    /**
     *
     * @var string
     */
    public $utiwake_kbn_cd;

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
    public $shiiresaki_mr_cd;

    /**
     *
     * @var string
     */
    public $tokuisaki_mr_cd;

    /**
     *
     * @var string
     */
    public $nounyuu_kijitu;

    /**
     *
     * @var string
     */
    public $nouki;

    /**
     *
     * @var string
     */
    public $hacchuu_dt_id;

    /**
     *
     * @var string
     */
    public $juchuu_dt_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('tanni_mr1_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr1s'));
        $this->belongsTo('tanni_mr2_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr2s'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));
        $this->belongsTo('shouhin_mr_cd', 'ShouhinMrs', 'cd', array('alias' => 'ShouhinMrs'));
        $this->belongsTo('utiwake_kbn_cd', 'UtiwakeKbns', 'cd', array('alias' => 'UtiwakeKbns'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        $this->belongsTo('tokuisaki_mr_cd', 'TokuisakiMrs', 'cd', array('alias' => 'TokuisakiMrs'));
        $this->belongsTo('shiiresaki_mr_cd', 'ShiiresakiMrs', 'cd', array('alias' => 'ShiiresakiMrs'));
        $this->belongsTo('hinsitu_kbn_cd', 'HinsituKbns', 'cd', array('alias' => 'HinsituKbns'));
        $this->belongsTo('denpyou_mr_cd', 'DenpyouMrs', 'cd', array('alias' => 'DenpyouMrs'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'zaiko_kakunin_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZaikoKakuninVws[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZaikoKakuninVws
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
		, p1.iro
		, p1.iromei
		, p1.lot
		, p1.kobetucd
		, p1.hinsitu_kbn_cd
		, p1.hinsitu_hyouka_kbn_cd
		, p1.souko_mr_cd
		, SUM(p1.zaiko_ryou1) AS zaiko_ryou1
		, SUM(p1.zaiko_ryou2) AS zaiko_ryou2
		, SUM(p1.hacchuuzan_ryou1) AS hacchuuzan_ryou1
		, SUM(p1.hacchuuzan_ryou2) AS hacchuuzan_ryou2
		, SUM(p1.juchuuzan_ryou1) AS juchuuzan_ryou1
		, SUM(p1.juchuuzan_ryou2) AS juchuuzan_ryou2
		, p1a.zaiko_tekisei AS zaiko_tekisei_ryou
		, SUM(p1.zaiko_ryou1)+SUM(p1.hacchuuzan_ryou1)-SUM(p1.juchuuzan_ryou1)-p1a.zaiko_tekisei AS kabusoku_ryou1
		, SUM(p1.zaiko_ryou2)+SUM(p1.hacchuuzan_ryou2)-SUM(p1.juchuuzan_ryou2)-p1a.zaiko_tekisei AS kabusoku_ryou2
		, p1.denpyou_mr_cd
		, p1.meisai_id
		, p1.meisai_cd
		, p1.utiwake_kbn_cd
		, p1.id
		, p1.cd
		, p1.shiiresaki_mr_cd
		, p1.tokuisaki_mr_cd
		, p1.nounyuu_kijitu
		, p1.nouki
		, p1.hacchuu_dt_id
		, p1.juchuu_dt_id
	';

    public static function findZaikos($param=[])
    {
		$def = [
			'conditions' => null, 
			'bind' => [], 
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
			" FROM zaiko_kakunin_vws AS p1
			JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd
			".$set['joins']."
			WHERE p1a.zaikokanri = 1".($set['conditions']?" AND (".$set['conditions'].")":"")."
			GROUP BY ".$group_by. ($set['orderby']?" ORDER BY ".$set['orderby']:"")
		);
//echo "\n<br>=".$set['conditions'];
// 最終仕入日付とその単価を繋いでMAXを取ると最終仕入単価となるか？
// 在庫金額と仕入金額を合計して在庫数量と仕入数量を合計して金額÷数量で総平均単価がでるか？
// それらは商品コード別に計算するべきか？
		$stmt->execute($set['bind']);
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rows;
    }

}

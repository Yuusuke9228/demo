<?php

class ZaikoKakuninAzukariVws extends \Phalcon\Mvc\Model
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
    public $id;

    /**
     *
     * @var integer
     */
    public $cd;

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
    public $azukari_zan1s;

    /**
     *
     * @var string
     */
    public $azukari_zan2s;

    /**
     *
     * @var string
     */
    public $azukari_tasi1s;

    /**
     *
     * @var string
     */
    public $azukari_tasi2s;

    /**
     *
     * @var string
     */
    public $azukari_hiki1s;

    /**
     *
     * @var string
     */
    public $azukari_hiki2s;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('torihikisaki_cd', 'TokuisakiMrs', 'cd', array('alias' => 'TorihikisakiMrs'));
        $this->belongsTo('shouhin_mr_cd', 'ShouhinMrs', 'cd', array('alias' => 'ShouhinMrs'));
        $this->belongsTo('tanni_mr1_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr1s'));
        $this->belongsTo('tanni_mr2_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr2s'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));
        $this->belongsTo('denpyou_mr_cd', 'DenpyouMrs', 'cd', array('alias' => 'DenpyouMrs'));
        $this->belongsTo('utiwake_kbn_cd', 'UtiwakeKbns', 'cd', array('alias' => 'UtiwakeKbns'));
        $this->belongsTo('hinsitu_kbn_cd', 'HinsituKbns', 'cd', array('alias' => 'HinsituKbns'));
        $this->belongsTo('sakusei_user_id', 'Users', 'id', array('alias' => 'Users'));
        $this->belongsTo('meisai_id', 'UriageMeisaiDts', 'id', array('alias' => 'UriageMeisaiDts'));
        $this->hasMany('shukka_kbn_max', 'UriageShukkaMaxs', 'shouhin_mr_cd', array('alias' => 'UriageShukkaMaxs'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'zaiko_kakunin_azukari_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZaikoKakuninAzukariVws[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZaikoKakuninAzukariVws
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    //抽出フィールドに、createdを追加。(ソートの為） Add By Nishiyama 2019/3/26
    const SQL_P1A = "
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
		, MAX(p1.nyuukobis) AS nyuukobi
		, MAX(p1.shukkobis) AS shukkobi
		, MAX(p1.nyuushukkobi) AS nyuushukkobi
		, p1.nyuushukkoym
		, p1.denpyou_mr_cd
		, p1.id
		, p1.cd
		, p1.meisai_id
		, p1.meisai_cd
		, p1.utiwake_kbn_cd
		, p1.torihikisaki_cd
		, p1.bikou
		, SUM(p1.zaiko_ryou1s) AS zaiko_ryou1
		, SUM(p1.zaiko_ryou2s) AS zaiko_ryou2
		, p1.tanka_tanni_mr_cd
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
		, p1.shiiresaki_mr_cd
		, p1.tokuisaki_mr_cd
		, p1.nounyuu_kijitu
		, p1.nouki
		, p1.hacchuu_dt_id
		, p1.juchuu_dt_id
		, p1.created
		, SUM(p1.hacchuuzan_ryou1) - SUM(CASE WHEN p1.utiwake_kbn_cd = '21' THEN p1.hacchuuzan_ryou1 ELSE 0 END) AS hacchuuzan_ryou1
		, SUM(CASE WHEN p1.utiwake_kbn_cd = '21' THEN p1.hacchuuzan_ryou1 ELSE 0 END) AS hikiate_ryou1
		, SUM(p1.hacchuuzan_ryou2) - SUM(CASE WHEN p1.utiwake_kbn_cd = '21' THEN p1.hacchuuzan_ryou2 ELSE 0 END) AS hacchuuzan_ryou2
		, SUM(CASE WHEN p1.utiwake_kbn_cd = '21' THEN p1.hacchuuzan_ryou2 ELSE 0 END) AS hikiate_ryou2
		, SUM(p1.juchuuzan_ryou1) AS juchuuzan_ryou1
		, SUM(p1.juchuuzan_ryou2) AS juchuuzan_ryou2
		, SUM(p1.azukari_zan1s) AS azukari_zan1
		, SUM(p1.azukari_zan2s) AS azukari_zan2
		, SUM(p1.azukari_tasi1s) AS azukari_tasi1
		, SUM(p1.azukari_tasi2s) AS azukari_tasi2
		, SUM(p1.azukari_hiki1s) AS azukari_hiki1
		, SUM(p1.azukari_hiki2s) AS azukari_hiki2
	";

    public static function findZaikos($param = [])
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
        $set = array_merge($def, $param);
        $group_by = "";
        foreach ($set['groupby'] as $group) {
            if ($group != "") {
                if ($group_by != "") {
                    $group_by .= "\n, ";
                }
                $group_by .= "p1." . $group;
            }
        }

        $db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方は限られている。
        $stmt = $db->prepare(
            self::SQL_P1A . $set['fields'] .
            " FROM zaiko_kakunin_azukari_vws AS p1
			RIGHT JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd
			" . $set['joins'] . "
			WHERE nyuushukkobi <= :kyou" . ($set['conditions'] ? " AND (" . $set['conditions'] . ")" : "") . "
			GROUP BY " . $group_by . ($set['orderby'] ? " ORDER BY " . $set['orderby'] : "")
        );
        //echo "\n<br>=".$set['conditions'];
        // 最終仕入日付とその単価を繋いでMAXを取ると最終仕入単価となるか？
        // 在庫金額と仕入金額を合計して在庫数量と仕入数量を合計して金額÷数量で総平均単価がでるか？
        // それらは商品コード別に計算するべきか？
        if ($set['bind'] !== '') {
            $stmt->execute(array_merge(["kyou" => $set['kyou']], $set['bind']));
        } else {
            $stmt->execute(array_merge(['kyou' => $set['kyou']]));
        }

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }

    /*
     * 倉庫ごとのロット絞込
     * ロットでの抽出も行う(入出庫明細ロットクリック時)
     * Add By Nishiyama 2019/2/12
     */
    public static function findSoukoZaiko($param = [])
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
        $set = array_merge($def, $param);
        $group_by = "";
        foreach ($set['groupby'] as $group) {
            if ($group != "") {
                if ($group_by != "") {
                    $group_by .= "\n, ";
                }
                $group_by .= "p1." . $group;
            }
        }
        $bindCd['conditions']['cd'] = $set['conditions'][0];
        $bindSoukoCode['conditions']['souko_mr_cd'] = $set['conditions'][1];
        $bindLot['conditions']['lot'] = $set['conditions'][2];

        $db = \Phalcon\DI::getDefault()->get('db');

        if ($set['bind']['lot'] !== null) {
            $stmt = $db->prepare(
                self::SQL_P1A . $set['fields'] .
                " FROM zaiko_kakunin_azukari_vws AS p1
			RIGHT JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd
			" . $set['joins'] . "
			WHERE nyuushukkobi <= :kyou" . ($set['conditions'] ? " AND (" . $bindCd['conditions']['cd'] . " AND " . $bindSoukoCode['conditions']['souko_mr_cd'] . " AND " . $bindLot['conditions']['lot'] . ")" : "") . "
			GROUP BY " . $group_by . ($set['orderby'] ? " ORDER BY " . $set['orderby'] : "")
            );

            $stmt->execute(["kyou" => $set['kyou'], ':cd' => $set['bind']['cd'], ':souko_mr_cd' => $set['bind']['souko_mr_cd'], ':lot' => $set['bind']['lot']]);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $stmt = $db->prepare(
                self::SQL_P1A . $set['fields'] .
                " FROM zaiko_kakunin_azukari_vws AS p1
			RIGHT JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd
			" . $set['joins'] . "
			WHERE nyuushukkobi <= :kyou" . ($set['conditions'] ? " AND (" . $bindCd['conditions']['cd'] . " AND " . $bindSoukoCode['conditions']['souko_mr_cd'] . ")" : "") . "
			GROUP BY " . $group_by . ($set['orderby'] ? " ORDER BY " . $set['orderby'] : "")
            );

            $stmt->execute(["kyou" => $set['kyou'], ':cd' => $set['bind']['cd'], ':souko_mr_cd' => $set['bind']['souko_mr_cd']]);
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $rows;
    }

    //抽出フィールドに、createdを追加。test中
    const SQL_P1A_TEST = "
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
		, MAX(p1.nyuukobis) AS nyuukobi
		, MAX(p1.shukkobis) AS shukkobi
		, MAX(p1.nyuushukkobi) AS nyuushukkobi
		, p1.nyuushukkoym
		, p1.denpyou_mr_cd
		, p1.id
		, p1.cd
		, p1.meisai_id
		, p1.meisai_cd
		, p1.utiwake_kbn_cd
		, p1.torihikisaki_cd
		, p1.bikou
		, SUM(p1.zaiko_ryou1s) AS zaiko_ryou1
		, SUM(p1.zaiko_ryou2s) AS zaiko_ryou2
		, p1.tanka_tanni_mr_cd
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
		, p1.shiiresaki_mr_cd
		, p1.tokuisaki_mr_cd
		, p1.nounyuu_kijitu
		, p1.nouki
		, p1.hacchuu_dt_id
		, p1.juchuu_dt_id
		, p1.created
		, SUM(p1.hacchuuzan_ryou1) AS hacchuuzan_ryou1
		, SUM(p1.hacchuuzan_ryou2) AS hacchuuzan_ryou2
		, sum(p1.juchuuzan_ryou1) as juchuuzan_ryou1 	
        , sum(p1.juchuuzan_ryou2) as juchuuzan_ryou2 	
		, SUM(p1.azukari_zan1s) AS azukari_zan1
		, SUM(p1.azukari_zan2s) AS azukari_zan2
		, SUM(p1.azukari_tasi1s) AS azukari_tasi1
		, SUM(p1.azukari_tasi2s) AS azukari_tasi2
		, SUM(p1.azukari_hiki1s) AS azukari_hiki1
		, SUM(p1.azukari_hiki2s) AS azukari_hiki2
	";

    public static function findZaikos_test($param = [])
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
        $set = array_merge($def, $param);
        $group_by = "";
        foreach ($set['groupby'] as $group) {
            if ($group != "") {
                if ($group_by != "") {
                    $group_by .= "\n, ";
                }
                $group_by .= "p1." . $group;
            }
        }
        $db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方は限られている。
        $stmt = $db->prepare(
            self::SQL_P1A_TEST . $set['fields'] .
            " FROM zaiko_kakunin_azukari_vws AS p1
			RIGHT JOIN shouhin_mrs p1a ON p1a.cd = p1.shouhin_mr_cd
			" . $set['joins'] . "
			WHERE nyuushukkobi <= :kyou" . ($set['conditions'] ? " AND (" . $set['conditions'] . ")" : "") . "
			GROUP BY " . $group_by . ($set['orderby'] ? " ORDER BY " . $set['orderby'] : "")
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

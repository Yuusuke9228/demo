<?php

class TokuisakiSimeDts extends \Phalcon\Mvc\Model
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
    public $name;

    /**
     *
     * @var string
     */
    public $tokuisaki_mr_cd;

    /**
     *
     * @var string
     */
    public $sime_hiduke;

    /**
     *
     * @var integer
     */
    public $nendo;

    /**
     *
     * @var string
     */
    public $kaishuu_yoteibi;

    /**
     *
     * @var integer
     */
    public $zenkai_seikyuugaku;

    /**
     *
     * @var integer
     */
    public $nyuukingaku;

    /**
     *
     * @var integer
     */
    public $konkai_uriagegaku;

    /**
     *
     * @var integer
     */
    public $uti_shouhizeigaku;

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
        $this->belongsTo('tokuisaki_mr_cd', 'TokuisakiMrs', 'cd', array('alias' => 'TokuisakiMrs'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TokuisakiSimeDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TokuisakiSimeDts
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tokuisaki_sime_dts';
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
     * 指定の得意先の日付期間内の入金額を集計する
     * TokuisakiSimeDtsController.php から呼び出す
     *
     * @param $tokuisaki_mr_cd : 得意先コード
     * @return $rows[0]->goukeigaku : 入金額合計
     */
    public static function findKonkaiSeikyuu($shimegrp_kbn_cd, $date_to, $cd = null)
    {
        $db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方と同じ。
        $stmt = $db->prepare('
			select
				a.seikyuusaki_mr_cd cd,
				a.name,
				a.harai_saikuru_kbn_cd,
				a.haraibi,
				ifnull(b.zenkai_hiduke,"") zenkai_hiduke,
				sum(ifnull(c.zenkai_seikyuugaku-c.nyuukingaku+c.konkai_uriagegaku,0)) zenkai_seikyuugaku,
				sum(ifnull(d.nyuukingaku,0)) nyuukingaku,
				sum(ifnull(e.zeinukigaku_kei+e.zeigaku_kei,0)) uriagegaku,
				sum(ifnull(e.zeigaku_kei,0)) shouhizeigaku
			from tokuisaki_mrs a
			left join (
				select tokuisaki_mr_cd,max(sime_hiduke) zenkai_hiduke from tokuisaki_sime_dts group by tokuisaki_mr_cd
			) b on b.tokuisaki_mr_cd = a.cd
			left join tokuisaki_sime_dts c on c.tokuisaki_mr_cd = a.cd and c.sime_hiduke = b.zenkai_hiduke
			left join (
				select
					d1.seikyuusaki_mr_cd,
					sum(kingaku) nyuukingaku
				from nyuukin_dts d1
				join nyuukin_meisai_dts d2 on d2.nyuukin_dt_id = d1.id
				where d1.nyuukinbi > ifnull((
					select max(sime_hiduke) from tokuisaki_sime_dts where tokuisaki_mr_cd=d1.seikyuusaki_mr_cd
				),"") and d1.nyuukinbi <= :to
				group by d1.seikyuusaki_mr_cd
			) d on d.seikyuusaki_mr_cd = a.cd
			left join (
				select
					e1.tokuisaki_mr_cd,
					sum(zeinukigaku) zeinukigaku_kei,
					sum(zeigaku) zeigaku_kei
				from uriage_dts e1
				join uriage_meisai_dts e2 on e2.uriage_dt_id = e1.id
				where e1.shimekiri_flg = 0 and
					e1.uriagebi > ifnull((
						select max(sime_hiduke) from tokuisaki_sime_dts where tokuisaki_mr_cd=e1.tokuisaki_mr_cd
					),"") and e1.uriagebi <= :to
				or e1.shimekiri_flg = 1 and
					e1.uriagebi <= ifnull((
						select max(sime_hiduke) from tokuisaki_sime_dts where tokuisaki_mr_cd=e1.tokuisaki_mr_cd
					),"") and
					e1.uriagebi > ifnull((
						select max(sime_hiduke) from tokuisaki_sime_dts where tokuisaki_mr_cd=e1.tokuisaki_mr_cd and sime_hiduke<ifnull((
							select max(sime_hiduke) from tokuisaki_sime_dts where tokuisaki_mr_cd=e1.tokuisaki_mr_cd 
						),"")
					),"")
				group by e1.tokuisaki_mr_cd
			) e on e.tokuisaki_mr_cd = a.cd
			where ifnull(b.zenkai_hiduke,"")<:to
				and a.shimegrp_kbn_cd=:grp' . ($cd ? ' and a.seikyuusaki_mr_cd=:cd' : '') . '
			group by a.seikyuusaki_mr_cd
		'); // 締切フラグ0と1で締切る範囲をかえている
        // ifnull(c.zenkai_seikyuugaku-c.nyuukingaku+c.konkai_uriagegaku,0)-ifnull(d.nyuukingaku,0)+ifnull(e.zeinukigaku_kei+e.zeigaku_kei,0)<>0 and
        $stmt->execute(array_merge(['grp' => $shimegrp_kbn_cd, 'to' => $date_to], $cd ? ['cd' => $cd] : []));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }


    /**
     * 指定の得意先の日付期間内の入金額を集計する
     * TokuisakiSimeDtsController.php から呼び出す
     *
     * @param $tokuisaki_mr_cd : 得意先コード
     * @return $rows[0]->goukeigaku : 入金額合計
     */
    public static function findSeikyuuMeisai($seikyuusaki_mr_cd, $shuukei_tanni, $zenzen_from, $date_from, $simebi)
    {
        $db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方と同じ。
        $stmt = $db->prepare('
			select
				e1.seikyuusaki_mr_cd,
				tokuisaki_mr_cd,
				hiduke,
				denpyou_kbn,
				denpyou_bangou,
				gyou,
				kubun,
				naiyou,
			    e.tanni,
			    uri_memo,
				sum(nyuukingaku) as nyuukingakuk,
				kazeikubun,
				sum(suuryou) as suuryouk,
				tanka,
				sum(zeinukigaku) as zeinukigakuk,
				sum(zeigaku) as zeigakuk,
				nounyuusaki,
				e.zei_tenka_kbn_cd,
				e.id as denpyou_id
			from
			(	select
					a.tokuisaki_mr_cd,
					a.uriagebi as hiduke,
			        a.tekiyou as uri_memo,
					1 as denpyou_kbn,
					a.cd as denpyou_bangou,
					b.cd as gyou,
			        if(b.tanka_kbn = 1,b3.name,b4.name) as tanni,
					b1.name as kubun,
					0 as nyuukingaku,
					b.tekiyou as naiyou,
					concat(b2.ryakushou,b2.zeiritu,"%") as kazeikubun,
					if(b.tanka_kbn=1,b.suuryou1,b.suuryou2) as suuryou,
					b.tanka,
					b.zeinukigaku,
					b.zeigaku,
					a.nounyuusaki,
					a.zei_tenka_kbn_cd,
					a.id,
					a.shimekiri_flg
				from uriage_dts a
				join uriage_meisai_dts b on b.uriage_dt_id = a.id
				left join utiwake_kbns b1 on b1.cd = b.utiwake_kbn_cd
				left join zeiritu_mrs b2 on b2.cd = b.zeiritu_mr_cd
				left join tanni_mrs b3 on b3.cd = b.tanni_mr1_cd
				left join tanni_mrs b4 on b4.cd = b.tanni_mr2_cd ' .
//				where kingaku<>0 or zeigaku<>0
				'union all select
					c.seikyuusaki_mr_cd tokuisaki_mr_cd,
					c.nyuukinbi as hiduke,
					"" as uri_memo,
					2 as denpyou_kbn,
					c.cd as denpyou_bangou,
					d.cd as gyou,
				    "" as tanni,
					d1.name as kubun,
					d.kingaku as nyuukingaku,
					d.name as naiyou,
					"" as kazeikubun,
					0 as suuryou,
					0 as tanka,
					0 as zeinukigaku,
					0 as zeigaku,
					"" as nounyuusaki,
					0 as zei_tenka_kbn_cd,
					c.id,
					0 as shimekiri_flg
				from nyuukin_dts c
				join nyuukin_meisai_dts d on c.id = d.nyuukin_dt_id
				left join nyuukin_kbns d1 on d1.cd = d.nyuukin_kbn_cd
			) e
			left join tokuisaki_mrs e1 on e1.cd = tokuisaki_mr_cd
			where ' . ($shuukei_tanni ? 'e.tokuisaki_mr_cd' : 'e1.seikyuusaki_mr_cd') . '=:seikyuusaki_mr_cd
				and (e.shimekiri_flg=0 and hiduke>:from and hiduke<=:to or e.shimekiri_flg=1 and hiduke>:zenzen and hiduke<=:from)
			GROUP BY hiduke,denpyou_kbn,denpyou_bangou,gyou WITH ROLLUP
		');
        $stmt->execute(['seikyuusaki_mr_cd' => $seikyuusaki_mr_cd, 'zenzen' => $zenzen_from, 'from' => $date_from, 'to' => $simebi]);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
//echo "\n<br>".$seikyuusaki_mr_cd." date_from=".$date_from." simrbi=".$simebi." count=".count($rows);
        return $rows;
    }
}

<?php

class ShiiresakiSimeDts extends \Phalcon\Mvc\Model
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
    public $shiiresaki_mr_cd;

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
    public $shiharai_yoteibi;

    /**
     *
     * @var integer
     */
    public $zenkai_siiregaku;

    /**
     *
     * @var integer
     */
    public $shukkingaku;

    /**
     *
     * @var integer
     */
    public $konkai_siiregaku;

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
        $this->belongsTo('shiiresaki_mr_cd', 'ShiiresakiMrs', 'cd', array('alias' => 'ShiiresakiMrs'));
        $this->hasMany('id', 'ShiiresakiSimeNaiyouDts', 'shiiresaki_sime_dt_id', array('alias' => 'ShiiresakiSimeNaiyouDts'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'shiiresaki_sime_dts';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShiiresakiSimeDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShiiresakiSimeDts
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

    /**
     * 指定の仕入先の日付期間内の出金内容を確認する
     * ShiiresakiSimeDtsController.php から呼び出す
     *
     * @param
     * @return $rows : 出金内容
     */
    public static function findShukkinNaiyou($shimegrp_kbn_cd, $kikan_flg, $kikan_from, $kikan_to, $shiharai_kbn_cd)
    {
		$db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方と同じ。
		if ($shiharai_kbn_cd) {
			$stmt = $db->prepare('
				select
					a.cd,
					a.name,
					a.shimegrp_kbn_cd,
					b.sime_hiduke,
					b.shiharai_yoteibi,
					b1.shiharai_kbn_cd shiharai_kbn1_cd,
					b1a.name shiharai_kbn1_name,
					b1.kingaku kingaku1,
					a.tegata_sight,
					ifnull(b.zenkai_siiregaku,0)-ifnull(b.shukkingaku,0)+ifnull(b.konkai_siiregaku,0)+ifnull(b.uti_shouhizeigaku,0) kingaku
				from shiiresaki_mrs a
				join shiiresaki_sime_dts b on b.shiiresaki_mr_cd = a.cd
				left join shiiresaki_sime_naiyou_dts b1 on b1.shiiresaki_sime_dt_id = b.id
				where a.shimegrp_kbn_cd = :grp and b1.shiharai_kbn_cd = :shiharai_kbn_cd and
					 b.zenkai_siiregaku-b.shukkingaku+b.konkai_siiregaku+b.uti_shouhizeigaku<>0 and
					'.($kikan_flg?'b.shiharai_yoteibi > :from and b.shiharai_yoteibi <= :to'
						:'b.sime_hiduke > :from and b.sime_hiduke <= :to')
			);
			$stmt->execute(['grp'=>$shimegrp_kbn_cd, 'from'=>$kikan_from, 'to'=>$kikan_to ,'shiharai_kbn_cd'=>$shiharai_kbn_cd]);
		} else {
			$stmt = $db->prepare('
				select
					a.cd,
					a.name,
					a.shimegrp_kbn_cd,
					b.sime_hiduke,
					b.shiharai_yoteibi,
					b1.shiharai_kbn_cd shiharai_kbn1_cd,
					b1a.name shiharai_kbn1_name,
					b1.kingaku kingaku1,
					b2.shiharai_kbn_cd shiharai_kbn2_cd,
					b2a.name shiharai_kbn2_name,
					b2.kingaku kingaku2,
					b3.shiharai_kbn_cd shiharai_kbn3_cd,
					b3a.name shiharai_kbn3_name,
					b3.kingaku kingaku3,
					a.tegata_sight,
					ifnull(b.zenkai_siiregaku,0)-ifnull(b.shukkingaku,0)+ifnull(b.konkai_siiregaku,0)+ifnull(b.uti_shouhizeigaku,0) kingaku
				from shiiresaki_mrs a
				join shiiresaki_sime_dts b on b.shiiresaki_mr_cd = a.cd
				left join shiiresaki_sime_naiyou_dts b1 on b1.cd = 1 and b1.shiiresaki_sime_dt_id = b.id
				left join shiiresaki_sime_naiyou_dts b2 on b2.cd = 2 and b2.shiiresaki_sime_dt_id = b.id
				left join shiiresaki_sime_naiyou_dts b3 on b3.cd = 3 and b3.shiiresaki_sime_dt_id = b.id
				left join shiharai_kbns b1a on b1a.cd = b1.shiharai_kbn_cd
				left join shiharai_kbns b2a on b2a.cd = b2.shiharai_kbn_cd
				left join shiharai_kbns b3a on b3a.cd = b3.shiharai_kbn_cd
				where a.shimegrp_kbn_cd = :grp and
					ifnull(b.zenkai_siiregaku,0)-ifnull(b.shukkingaku,0)+ifnull(b.konkai_siiregaku,0)+ifnull(b.uti_shouhizeigaku,0) <> 0 and
					'.($kikan_flg?'b.sime_hiduke > :from and b.sime_hiduke <= :to'
						:'b.shiharai_yoteibi > :from and b.shiharai_yoteibi <= :to')
			);
			$stmt->execute(['grp'=>$shimegrp_kbn_cd, 'from'=>$kikan_from, 'to'=>$kikan_to]);
		}
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rows;
    }

    /**
     * 指定の仕入先の日付期間内の出金額を集計する
     * ShiiresakiSimeDtsController.php から呼び出す
     *
     * @param $shiiresaki_mr_cd : 仕入先コード
     * @return $rows[0]->goukeigaku : 出金額合計
     */
    public static function findKonkaiShiharai($shimegrp_kbn_cd, $date_to, $cd)
    {
		$db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方と同じ。
		$stmt = $db->prepare('
			select
				a.cd,
				a.name,
				a.harai_saikuru_kbn_cd,
				a.haraibi,
				ifnull(b.zenkai_hiduke,"") zenkai_hiduke,
				sum(ifnull(c.zenkai_siiregaku-c.shukkingaku+c.konkai_siiregaku,0)) zenkai_siiregaku,
				sum(ifnull(d.shukkingaku,0)) shukkingaku,
				sum(ifnull(e.zeinukigaku_kei+e.zeigaku_kei,0)) siiregaku,
				sum(ifnull(e.zeigaku_kei,0)) shouhizaigaku,
				a.harai_houhou_kbn_cd shiharai_kbn_cd,
				a.harai2_houhou_kbn_cd shiharai2_kbn_cd,
				a.wakekata,
				a.yoshin_gendogaku
			from shiiresaki_mrs a
			left join (
				select shiiresaki_mr_cd,max(sime_hiduke) zenkai_hiduke from shiiresaki_sime_dts group by shiiresaki_mr_cd
			) b on b.shiiresaki_mr_cd = a.cd
			left join shiiresaki_sime_dts c on c.shiiresaki_mr_cd = a.cd and c.sime_hiduke = b.zenkai_hiduke
			left join (
				select
					d1.shiiresaki_mr_cd,
					sum(kingaku) shukkingaku
				from shukkin_dts d1
				join shukkin_meisai_dts d2 on d2.shukkin_dt_id = d1.id
				where d1.shukkinbi > ifnull((
					select max(sime_hiduke) from shiiresaki_sime_dts where shiiresaki_mr_cd=d1.shiiresaki_mr_cd
				),"") and d1.shukkinbi <= :to
				group by d1.shiiresaki_mr_cd
			) d on d.shiiresaki_mr_cd = a.cd
			left join (
				select
					e1.shiiresaki_mr_cd,
					sum(e2.zeinukigaku) zeinukigaku_kei,
					sum(e2.zeigaku) zeigaku_kei
				from shiire_dts e1
				join shiire_meisai_dts e2 on e2.shiire_dt_id = e1.id
				where e1.shimekiri_flg = 0 and
					e1.shiirebi > ifnull((
						select max(sime_hiduke) from shiiresaki_sime_dts where shiiresaki_mr_cd=e1.shiiresaki_mr_cd
					),"") and e1.shiirebi <= :to
				or e1.shimekiri_flg = 1 and
					e1.shiirebi <= ifnull((
						select max(sime_hiduke) from shiiresaki_sime_dts where shiiresaki_mr_cd=e1.shiiresaki_mr_cd
					),"") and
					e1.shiirebi > ifnull((
						select max(sime_hiduke) from shiiresaki_sime_dts where shiiresaki_mr_cd=e1.shiiresaki_mr_cd and sime_hiduke<ifnull((
							select max(sime_hiduke) from shiiresaki_sime_dts where shiiresaki_mr_cd=e1.shiiresaki_mr_cd 
						),"")
					),"")
				group by e1.shiiresaki_mr_cd
			) e on e.shiiresaki_mr_cd = a.cd
			where ifnull(b.zenkai_hiduke,"")<:to
				and a.shimegrp_kbn_cd=:grp'.($cd?' and a.cd=:cd':'').'
			group by a.cd
		'); // 締切フラグ0と1で締切る範囲をかえている
		// ifnull(c.zenkai_siiregaku-c.shukkingaku+c.konkai_siiregaku,0)-ifnull(d.shukkingaku,0)+ifnull(e.zeinukigaku_kei+e.zeigaku_kei,0)<>0 and
		$stmt->execute(array_merge(['grp'=>$shimegrp_kbn_cd, 'to'=>$date_to],$cd?['cd'=>$cd]:[]));
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $rows;
    }


    /**
     * 指定の仕入先の日付期間内の出金額を集計する
     * ShiiresakiSimeDtsController.php から呼び出す
     *
     * @param $shiiresaki_mr_cd : 仕入先コード
     * @return $rows[0]->goukeigaku : 出金額合計
     */
    public static function findShiharaiMeisai($shiiresaki_mr_cd, $zenzen_from, $date_from, $simebi)
    {
		$db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方と同じ。
		$stmt = $db->prepare('
			select
				shiiresaki_mr_cd,
				hiduke,
				denpyou_kbn,
				denpyou_bangou,
			    shi_memo,
				gyou,
				kubun,
				shouhin_mr_cd,
				naiyou,
				sum(shukkingaku) as shukkingakuk,
				kazeikubun,
				sum(suuryou) as suuryouk,
				tani,
				tanka,
				sum(zeinukigaku) as zeinukigakuk,
				sum(zeigaku) as zeigakuk,
				hacchuu_dt_id,
				e.zei_tenka_kbn_cd,
				e.id as denpyou_id
			from
			(	select
					a.shiiresaki_mr_cd,
					a.shiirebi as hiduke,
					1 as denpyou_kbn,
					a.cd as denpyou_bangou,
			        a.tekiyou as shi_memo,
					b.cd as gyou,
					b1.name as kubun,
					0 as shukkingaku,
					b.shouhin_mr_cd as shouhin_mr_cd,
					b.tekiyou as naiyou,
					concat(b2.ryakushou,b2.zeiritu,"%") as kazeikubun,
					if(b.tanka_kbn=1,b.suuryou1,b.suuryou2) as suuryou,
					if(b.tanka_kbn=1,tan1.name,tan2.name) as tani,
					b.tanka,
					b.zeinukigaku,
					b.zeigaku,
					a.hacchuu_dt_id,
					a.zei_tenka_kbn_cd,
					a.id,
					a.shimekiri_flg
				from shiire_dts a
				join shiire_meisai_dts b on b.shiire_dt_id = a.id
				left join utiwake_kbns b1 on b1.cd = b.utiwake_kbn_cd
				left join tanni_mrs tan1 on tan1.cd = b.tanni_mr1_cd
				left join tanni_mrs tan2 on tan2.cd = b.tanni_mr2_cd
				left join zeiritu_mrs b2 on b2.cd = b.zeiritu_mr_cd
			    where b.utiwake_kbn_cd < 15
			' .
//				where kingaku<>0 or zeigaku<>0
				'union all select
					c.shiiresaki_mr_cd shiiresaki_mr_cd,
					c.shukkinbi as hiduke,
					2 as denpyou_kbn,
					c.cd as denpyou_bangou,
					"" as shi_memo,
					d.cd as gyou,
					d1.name as kubun,
					d.kingaku as shukkingaku,
					"" as shouhin_mr_cd,
					d.name as naiyou,
					"" as kazeikubun,
					"" as tani,
					0 as suuryou,
					0 as tanka,
					0 as zeinukigaku,
					0 as zeigaku,
					"" as hacchuu_dt_cd,
					0 as zei_tenka_kbn_cd,
					c.id,
					0 as shimekiri_flg
				from shukkin_dts c
				join shukkin_meisai_dts d ON c.id = d.shukkin_dt_id
				left join shiharai_kbns d1 on d1.cd = d.shiharai_kbn_cd
			) e
			where e.shiiresaki_mr_cd=:shiiresaki_mr_cd
				and (e.shimekiri_flg=0 and hiduke>:from and hiduke<=:to or e.shimekiri_flg=1 and hiduke>:zenzen and hiduke<=:from)
			GROUP BY hiduke,denpyou_kbn,denpyou_bangou,gyou WITH ROLLUP
		');
		$stmt->execute(['shiiresaki_mr_cd'=>$shiiresaki_mr_cd, 'zenzen'=>$zenzen_from, 'from'=>$date_from, 'to'=>$simebi]);
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
//echo "\n<br>".$shiiresaki_mr_cd." date_from=".$date_from." simrbi=".$simebi." count=".count($rows) . "zenzen=" . $zenzen_from;
		return $rows;
    }
}

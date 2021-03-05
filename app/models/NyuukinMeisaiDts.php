<?php

class NyuukinMeisaiDts extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $nyuukin_dt_id;

    /**
     *
     * @var string
     */
    public $nyuukin_kbn_cd;

    /**
     *
     * @var string
     */
    public $tegata_kijitu;

    /**
     *
     * @var string
     */
    public $kingaku;

    /**
     *
     * @var string
     */
    public $bikou;

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
        $this->belongsTo('nyuukin_dt_id', 'NyuukinDts', 'id', array('alias' => 'NyuukinDts'));
        $this->belongsTo('nyuukin_kbn_cd', 'NyuukinKbns', 'cd', array('alias' => 'NyuukinKbns'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'nyuukin_meisai_dts';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return NyuukinMeisaiDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return NyuukinMeisaiDts
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
     * 指定の得意先の日付期間内の入金額を集計する
     * TokuisakiSimeDtsController.php から呼び出す
     *
     * @param $tokuisaki_mr_cd : 得意先コード
     * @return $rows[0]->goukeigaku : 入金額合計
     */
    public static function findNyuukingaku($tokuisaki_mr_cd, $date_from, $date_to)
    {
		$db = \Phalcon\DI::getDefault()->get('db'); //UNIONを使える書き方と同じ。
		$stmt = $db->prepare('
			select sum(a.kingaku) as goukeigaku
			from nyuukin_meisai_dts a
			left join nyuukin_dts b on b.id = a.nyuukin_dt_id
			where b.seikyuusaki_mr_cd=:cd and b.nyuukinbi > :from and b.nyuukinbi <= :to
		');
		$stmt->execute(['cd'=>$tokuisaki_mr_cd, 'from'=>$date_from, 'to'=>$date_to]);
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $row;
    }

}

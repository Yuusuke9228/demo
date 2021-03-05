<?php

class UriageMeisaiDts extends \Phalcon\Mvc\Model
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
    public $uriage_dt_id;

    /**
     *
     * @var string
     */
    public $shukka_kbn_cd;

    /**
     *
     * @var string
     */
    public $shouhin_mr_cd;

    /**
     *
     * @var string
     */
    public $tanni_mr_cd;

    /**
     *
     * @var string
     */
    public $kousei;

    /**
     *
     * @var string
     */
    public $irisuu;

    /**
     *
     * @var string
     */
    public $keisu;

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
    public $kikaku;

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
    public $size;

    /**
     *
     * @var string
     */
    public $suuryou;

    /**
     *
     * @var string
     */
    public $suuryou1;

    /**
     *
     * @var string
     */
    public $tanni_mr1_cd;

    /**
     *
     * @var string
     */
    public $suuryou2;

    /**
     *
     * @var string
     */
    public $tanni_mr2_cd;

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
        $this->belongsTo('uriage_dt_id', 'UriageDts', 'id', array('alias' => 'UriageDts'));
        $this->belongsTo('tanni_mr1_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr1s'));
        $this->belongsTo('tanni_mr2_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr2s'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));
        $this->belongsTo('shouhin_mr_cd', 'ShouhinMrs', 'cd', array('alias' => 'ShouhinMrs'));
        $this->belongsTo('zeiritu_mr_cd', 'ZeirituMrs', 'cd', array('alias' => 'ZeirituMrs'));
        $this->belongsTo('utiwake_kbn_cd', 'UtiwakeKbns', 'cd', array('alias' => 'UtiwakeKbns'));
        $this->belongsTo('shukka_kbn_cd', 'ShukkaKbns', 'cd', array('alias' => 'ShukkaKbns'));
        $this->belongsTo('hinsitu_kbn_cd', 'HinsituKbns', 'cd', array('alias' => 'HinsituKbns'));
        $this->hasOne('id', 'NyuukinKesikomiDts', 'uriage_meisai_dt_id', array('alias' => 'NyuukinKesikomiDts'));
        $this->hasOne('id', 'ZaikokakuninAzukariVws', 'meisai_id', array('alias' => 'ZaikokakuninAzukariVws'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UriageMeisaiDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UriageMeisaiDts
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
     * �w��̓��Ӑ�̓��t���ԓ��̔���z���W�v����
     * TokuisakiSimeDtsController.php ����Ăяo��
     *
     * @param $tokuisaki_mr_cd : ���Ӑ�R�[�h
     * @return $rows[0]->zeinukigaku_kei : �Ŕ��z���v
     * @return $rows[0]->zeigaku_kei : �Ŋz���v
     */
    public static function findUriagegaku($tokuisaki_mr_cd, $date_from, $date_to)
    {
		$db = \Phalcon\DI::getDefault()->get('db'); //UNION���g���鏑�����Ɠ����B
		$stmt = $db->prepare('
			select
			sum(zeinukigaku) as zeinukigaku_kei,
			sum(zeigaku) as zeigaku_kei
			from uriage_meisai_dts a
			left join uriage_dts b on b.id = a.uriage_dt_id
			left join tokuisaki_mrs c on c.cd = b.tokuisaki_mr_cd
			where c.seikyuusaki_mr_cd=:cd and b.uriagebi > :from and b.uriagebi <= :to
		');
		$stmt->execute(['cd'=>$tokuisaki_mr_cd, 'from'=>$date_from, 'to'=>$date_to]);
		$row = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $row;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'uriage_meisai_dts';
    }

}

<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class MitumoriDts extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $nendo;

    /**
     *
     * @var string
     */
    public $tekiyou;

    /**
     *
     * @var string
     */
    public $mitumoribi;

    /**
     *
     * @var integer
     */
    public $stamp;

    /**
     *
     * @var string
     */
    public $zeiritu_tekiyoubi;

    /**
     *
     * @var string
     */
    public $tokuisaki_mr_cd;

    /**
     *
     * @var string
     */
    public $gotantousha;

    /**
     *
     * @var string
     */
    public $keishou;

    /**
     *
     * @var string
     */
    public $tel;

    /**
     *
     * @var string
     */
    public $fax;

    /**
     *
     * @var integer
     */
    public $torihiki_kbn_cd;

    /**
     *
     * @var integer
     */
    public $zei_tenka_kbn_cd;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $shimekiri_flg;

    /**
     *
     * @var string
     */
    public $nounyuu_kijitu;

    /**
     *
     * @var string
     */
    public $nounyuusaki_mr_cd;

    /**
     *
     * @var string
     */
    public $nounyuusaki;

    /**
     *
     * @var string
     */
    public $chokusousaki_kbn_cd;

    /**
     *
     * @var string
     */
    public $kenmei;

    /**
     *
     * @var string
     */
    public $nounyuu_kigen;

    /**
     *
     * @var string
     */
    public $nounyuu_basho;

    /**
     *
     * @var string
     */
    public $torihiki_houhoou;

    /**
     *
     * @var string
     */
    public $yuukou_kigen;

    /**
     *
     * @var string
     */
    public $kingaku_meishou;

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
        $this->hasMany('id', 'MitumoriMeisaiDts', 'mitumori_dt_id', array('alias' => 'MitumoriMeisaiDts', 'params'=>['order'=>'cd']));
       // $this->belongsTo('juchuu_dt_cd', 'JuchuuDts', 'cd', array('alias' => 'JuchuuDts'));
        $this->belongsTo('tokuisaki_mr_cd', 'TokuisakiMrs', 'cd', array('alias' => 'TokuisakiMrs'));
        $this->belongsTo('nounyuusaki_mr_cd', 'NounyuusakiMrs', 'cd', array('alias' => 'NounyuusakiMrs'));
        $this->belongsTo('sakusei_user_id', 'Users', 'id', array('alias' => 'SakuseiUsers'));
        $this->belongsTo('zei_tenka_kbn_cd', 'ZeitenkaKbns', 'cd', array('alias' => 'ZeitenkaKbns'));
        $this->belongsTo('torihiki_kbn_cd', 'TorihikiKbns', 'cd', array('alias' => 'TorihikiKbns'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        $this->belongsTo('tanka_shurui_kbn_cd', 'TankaShuruiKbns', 'cd', array('alias' => 'TankaShuruiKbns'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mitumori_dts';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MitumoriDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MitumoriDts
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

}

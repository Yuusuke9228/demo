<?php

class ZaikoHenkanDts extends \Phalcon\Mvc\Model
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
    public $name;

    /**
     *
     * @var string
     */
    public $henkanbi;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $zaiko_henkan_kbn_cd;

    /**
     *
     * @var string
     */
    public $sasizu_dt_cd;

    /**
     *
     * @var string
     */
    public $tokuisaki_mr_cd;

    /**
     *
     * @var string
     */
    public $souko_mr_cd;

    /**
     *
     * @var string
     */
    public $moto_souko_mr_cd;

    /**
     *
     * @var string
     */
    public $moto_tantou_mr_cd;

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
        $this->hasMany('id', 'ZaikoHenkanMeisaiDts', 'zaiko_henkan_dt_id', array('alias' => 'ZaikoHenkanMeisaiDts', 'params'=>['order'=>'cd']));
        $this->belongsTo('tokuisaki_mr_cd', 'TokuisakiMrs', 'cd', array('alias' => 'TokuisakiMrs'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));
        $this->belongsTo('zaiko_henkan_kbn_cd', 'ZaikoHenkanKbns', 'cd', array('alias' => 'ZaikoHenkanKbns'));
        $this->belongsTo('sakusei_user_id', 'Users', 'id', array('alias' => 'SakuseiUsers'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZaikoHenkanDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZaikoHenkanDts
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'zaiko_henkan_dts';
    }

}

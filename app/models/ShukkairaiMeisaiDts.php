<?php

class ShukkairaiMeisaiDts extends \Phalcon\Mvc\Model
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
    public $shukkairai_dt_id;

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
     * @var integer
     */
    public $genkagaku;

    /**
     *
     * @var string
     */
    public $nouki;

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
        $this->belongsTo('shukkairai_dt_id', 'ShukkairaiDts', 'id', array('alias' => 'ShukkairaiDts'));
        $this->belongsTo('tanni_mr1_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr1s'));
        $this->belongsTo('tanni_mr2_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr2s'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));
        $this->belongsTo('shouhin_mr_cd', 'ShouhinMrs', 'cd', array('alias' => 'ShouhinMrs'));
        $this->belongsTo('utiwake_kbn_cd', 'UtiwakeKbns', 'cd', array('alias' => 'UtiwakeKbns'));
        $this->belongsTo('shukka_kbn_cd', 'ShukkaKbns', 'cd', array('alias' => 'ShukkaKbns'));
        $this->belongsTo('hinsitu_kbn_cd', 'HinsituKbns', 'cd', array('alias' => 'HinsituKbns'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShukkairaiMeisaiDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShukkairaiMeisaiDts
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
        return 'shukkairai_meisai_dts';
    }

}

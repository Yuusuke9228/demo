<?php

class JuchuuMeisaiDts extends \Phalcon\Mvc\Model
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
    public $juchuu_dt_id;

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
     * @var string
     */
    public $nouki;

    /**
     *
     * @var integer
     */
    public $hacchuurendou_flg;

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
        $this->belongsTo('juchuu_dt_id', 'JuchuuDts', 'id', array('alias' => 'JuchuuDts'));
        $this->belongsTo('tanni_mr1_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr1s'));
        $this->belongsTo('tanni_mr2_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr2s'));
        $this->belongsTo('shouhin_mr_cd', 'ShouhinMrs', 'cd', array('alias' => 'ShouhinMrs'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));
        $this->belongsTo('zeiritu_mr_cd', 'ZeirituMrs', 'cd', array('alias' => 'ZeirituMrs'));
        $this->belongsTo('utiwake_kbn_cd', 'UtiwakeKbns', 'cd', array('alias' => 'UtiwakeKbns'));
        $this->belongsTo('hinsitu_kbn_cd', 'HinsituKbns', 'cd', array('alias' => 'HinsituKbns'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return JuchuuMeisaiDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return JuchuuMeisaiDts
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
        return 'juchuu_meisai_dts';
    }

}

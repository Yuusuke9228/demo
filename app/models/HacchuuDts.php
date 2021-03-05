<?php

class HacchuuDts extends \Phalcon\Mvc\Model
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
    public $hacchuubi;

    /**
     *
     * @var string
     */
    public $nounyuu_kijitu;

    /**
     *
     * @var integer
     */
    public $juchuu_dt_cd;

    /**
     *
     * @var string
     */
    public $zeiritu_tekiyoubi;

    /**
     *
     * @var string
     */
    public $shiiresaki_mr_cd;

    /**
     *
     * @var string
     */
    public $torihiki_kbn_cd;

    /**
     *
     * @var string
     */
    public $zei_tenka_kbn_cd;

    /**
     *
     * @var string
     */
    public $kakeritu;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $hassousaki_kbn_cd;

    /**
     *
     * @var string
     */
    public $hassousaki_mr_cd;

    /**
     *
     * @var string
     */
    public $hassousaki_mr_name;

    /**
     *
     * @var integer
     */
    public $shounin_joutai_flg;

    /**
     *
     * @var string
     */
    public $shounin_sha_mr_cd;

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
        $this->hasMany('id', 'HacchuuMeisaiDts', 'hacchuu_dt_id', array('alias' => 'HacchuuMeisaiDts', 'params'=>['order'=>'cd,id']));
        $this->belongsTo('shiiresaki_mr_cd', 'ShiiresakiMrs', 'cd', array('alias' => 'ShiiresakiMrs'));
        $this->belongsTo('shounin_sha_mr_cd', 'Users', 'cd', array('alias' => 'Users'));
        $this->belongsTo('sakusei_user_id', 'Users', 'id', array('alias' => 'SakuseiUsers'));
        $this->belongsTo('zei_tenka_kbn_cd', 'ZeitenkaKbns', 'cd', array('alias' => 'ZeitenkaKbns'));
        $this->belongsTo('torihiki_kbn_cd', 'TorihikiKbns', 'cd', array('alias' => 'TorihikiKbns'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        $this->belongsTo('hassousaki_mr_cd', 'TokuisakiMrs', 'cd', array('alias' => 'Hassousaki2Mrs'));
        $this->belongsTo('hassousaki_mr_cd', 'NounyuusakiMrs', 'cd', array('alias' => 'Hassousaki3Mrs'));
        $this->belongsTo('hassousaki_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'Hassousaki4Mrs'));
        $this->hasOne('id', 'KakouIraiDts', 'hacchuu_dt_id', array('alias' => 'kakouIraiDt'));
        $this->hasMany('id', 'KakouSaiFaxDts', 'hacchuu_dt_id', array('alias' => 'KakouSaiFaxDts', 'params'=>['order'=>'hiduke']));
        $this->hasMany('id', 'KakoujouChouseiDts', 'hacchuu_dt_id', array('alias' => 'KakoujouChouseiDts', 'params'=>['order'=>'hiduke']));
        $this->hasMany('id', 'KakouNagareDts', 'hacchuu_dt_id', array('alias' => 'KakouNagareDts', 'params'=>['order'=>'cd']));
        $this->hasMany('id', 'KakouZenkaiMokuriDts', 'hacchuu_dt_id', array('alias' => 'KakouZenkaiMokuriDts', 'params'=>['order'=>'hiduke']));
        $this->hasMany('id', 'KakouIraiLogDts', 'hacchuu_dt_id', array('alias' => 'KakouIraiLogDts'));
        $this->hasMany('juchuu_dt_cd', 'JuchuuDts', 'cd', array('alias' => 'JuchuuDts', 'params'=>['order'=>'juchuubi DESC']));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'hacchuu_dts';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HacchuuDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HacchuuDts
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

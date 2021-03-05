<?php

class ShukkairaiDts extends \Phalcon\Mvc\Model
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
    public $tekiyou;

    /**
     *
     * @var integer
     */
    public $nendo;

    /**
     *
     * @var string
     */
    public $iraibi;

    /**
     *
     * @var integer
     */
    public $irai_kbn_cd;

    /**
     *
     * @var integer
     */
    public $juchuu_dt_id;

    /**
     *
     * @var integer
     */
    public $hacchuu_dt_id;

    /**
     *
     * @var string
     */
    public $souko_mr_cd;

    /**
     *
     * @var string
     */
    public $gotantou;

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
    public $hassousaki;

    /**
     *
     * @var string
     */
    public $kidukesaki_mr_cd;

    /**
     *
     * @var string
     */
    public $kiduke;

    /**
     *
     * @var string
     */
    public $shukkabi;

    /**
     *
     * @var string
     */
    public $nouki_memo;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $assistant;

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
        $this->hasMany('id', 'ShukkairaiMeisaiDts', 'shukkairai_dt_id', array('alias' => 'ShukkairaiMeisaiDts', 'params' => ['order' => 'cd']));
        // $this->belongsTo('hacchuu_dt_cd', 'HacchuuDts', 'cd', array('alias' => 'HacchuuDts'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));
        $this->belongsTo('hassousaki_mr_cd', 'TokuisakiMrs', 'cd', array('alias' => 'Hassousaki2Mrs'));
        $this->belongsTo('hassousaki_mr_cd', 'NounyuusakiMrs', 'cd', array('alias' => 'Hassousaki3Mrs'));
        $this->belongsTo('hassousaki_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'Hassousaki4Mrs'));
        $this->belongsTo('sakusei_user_id', 'Users', 'id', array('alias' => 'SakuseiUsers'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        $this->belongsTo('hacchuu_dt_id', 'HacchuuDts', 'id', array('alias' => 'HacchuuDts'));
        $this->belongsTo('juchuu_dt_id', 'JuchuuDts', 'id', array('alias' => 'JuchuuDts'));

    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShukkairaiDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShukkairaiDts
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
        return 'shukkairai_dts';
    }

}

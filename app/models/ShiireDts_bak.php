<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class ShiireDts extends \Phalcon\Mvc\Model
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
    public $shiirebi;

    /**
     *
     * @var integer
     */
    public $hacchuu_dt_id;

    /**
     *
     * @var integer
     */
    public $juchuu_dt_cd;

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
    public $tantou_mr_cd;

    /**
     *
     * @var integer
     */
    public $shimekiri_flg;

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
        $this->hasMany('id', 'ShiireMeisaiDts', 'shiire_dt_id', array('alias' => 'ShiireMeisaiDts', 'params' => ['order' => 'cd']));
        // $this->belongsTo('hacchuu_dt_cd', 'HacchuuDts', 'cd', array('alias' => 'HacchuuDts'));
        $this->belongsTo('shiiresaki_mr_cd', 'ShiiresakiMrs', 'cd', array('alias' => 'ShiiresakiMrs'));
        $this->belongsTo('shounin_sha_mr_cd', 'Users', 'cd', array('alias' => 'Users'));
        $this->belongsTo('sakusei_user_id', 'Users', 'id', array('alias' => 'SakuseiUsers'));
        $this->belongsTo('zei_tenka_kbn_cd', 'ZeitenkaKbns', 'cd', array('alias' => 'ZeitenkaKbns'));
        $this->belongsTo('torihiki_kbn_cd', 'TorihikiKbns', 'cd', array('alias' => 'TorihikiKbns'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        $this->belongsTo('hacchuu_dt_id', 'HacchuuDts', 'id', array('alias' => 'HacchuuDts'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShiireDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShiireDts
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
        return 'shiire_dts';
    }

}

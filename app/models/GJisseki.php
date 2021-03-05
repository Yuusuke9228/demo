<?php

class GJisseki extends \Phalcon\Mvc\Model
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
    public $jissekibi;

    /**
     *
     * @var integer
     */
    public $hacchuu_dt_id;

    /**
     *
     * @var integer
     */
    public $gyoumu_dt_id;

    /**
     *
     * @var double
     */
    public $jisseki_suu;

    /**
     *
     * @var double
     */
    public $jisseki_ryou;

    /**
     *
     * @var string
     */
    public $hinsitsu_kbn_cd;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     * @var integer
     */
    public $kanryou_flg;

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
        $this->setSchema("smm");
        $this->setSource("g_jisseki");

        $this->belongsTo('sakusei_user_id', 'Users', 'id', ['alias' => 'SakuseiUsers']);
        $this->belongsTo('kousin_user_id', 'Users', 'id', ['alias' => 'KousinUsers']);
        $this->belongsTo('hacchuu_dt_id', 'HacchuuDts', 'id', ['alias' => 'HacchuuDts']);   //発注と紐づける
        $this->belongsTo('gyoumu_dt_id', 'GyoumuDts', 'id', ['alias' => 'GyoumuDts']);   //計画と紐づける
        $this->belongsTo('hinsitsu_kbn_cd', 'HinsituKbns', 'cd', ['alias', 'HinsituKbns']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'g_jisseki';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GJisseki[]|GJisseki|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GJisseki|\Phalcon\Mvc\Model\ResultInterface
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

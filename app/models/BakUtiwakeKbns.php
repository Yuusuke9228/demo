<?php

class BakUtiwakeKbns extends \Phalcon\Mvc\Model
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
     * @var string
     */
    public $bikou;

    /**
     *
     * @var integer
     */
    public $juchuu_flg;

    /**
     *
     * @var integer
     */
    public $hacchuu_flg;

    /**
     *
     * @var integer
     */
    public $uriage_flg;

    /**
     *
     * @var integer
     */
    public $shiire_flg;

    /**
     *
     * @var integer
     */
    public $uriage_zaiko_flg;

    /**
     *
     * @var integer
     */
    public $shiire_zaiko_flg;

    /**
     *
     * @var integer
     */
    public $uriage_azukari_flg;

    /**
     *
     * @var integer
     */
    public $shiire_azukari_flg;

    /**
     *
     * @var integer
     */
    public $juchuu_zan_flg;

    /**
     *
     * @var integer
     */
    public $hacchuu_zan_flg;

    /**
     *
     * @var integer
     */
    public $yayoi_kbn;

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
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakUtiwakeKbns[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakUtiwakeKbns
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'bak_utiwake_kbns';
    }

}

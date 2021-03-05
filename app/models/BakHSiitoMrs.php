<?php

class BakHSiitoMrs extends \Phalcon\Mvc\Model
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
    public $imei;

    /**
     *
     * @var string
     */
    public $h_siori_mr_cd;

    /**
     *
     * @var string
     */
    public $tjun;

    /**
     *
     * @var string
     */
    public $yjun;

    /**
     *
     * @var string
     */
    public $h_itomei_mr_cd;

    /**
     *
     * @var string
     */
    public $ttni;

    /**
     *
     * @var string
     */
    public $ytni;

    /**
     *
     * @var integer
     */
    public $thon;

    /**
     *
     * @var string
     */
    public $douk;

    /**
     *
     * @var integer
     */
    public $kais;

    /**
     *
     * @var integer
     */
    public $yhon;

    /**
     *
     * @var integer
     */
    public $denl;

    /**
     *
     * @var integer
     */
    public $ondo;

    /**
     *
     * @var integer
     */
    public $time;

    /**
     *
     * @var integer
     */
    public $tnor;

    /**
     *
     * @var integer
     */
    public $ynor;

    /**
     *
     * @var integer
     */
    public $iryo;

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
     * @return BakHSiitoMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHSiitoMrs
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
        return 'bak_h_siito_mrs';
    }

}

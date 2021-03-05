<?php

class BakHItomeiMrs extends \Phalcon\Mvc\Model
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
    public $eda;

    /**
     *
     * @var integer
     */
    public $ishu;

    /**
     *
     * @var integer
     */
    public $gumu;

    /**
     *
     * @var string
     */
    public $itme;

    /**
     *
     * @var string
     */
    public $ktak;

    /**
     *
     * @var string
     */
    public $kden;

    /**
     *
     * @var string
     */
    public $kfil;

    /**
     *
     * @var string
     */
    public $biko;

    /**
     *
     * @var string
     */
    public $itm2;

    /**
     *
     * @var string
     */
    public $meik;

    /**
     *
     * @var integer
     */
    public $dtex;

    /**
     *
     * @var string
     */
    public $rykg;

    /**
     *
     * @var string
     */
    public $shin;

    /**
     *
     * @var string
     */
    public $hana;

    /**
     *
     * @var string
     */
    public $turi;

    /**
     *
     * @var string
     */
    public $gaic;

    /**
     *
     * @var string
     */
    public $hnyk;

    /**
     *
     * @var string
     */
    public $bnam;

    /**
     *
     * @var string
     */
    public $symd;

    /**
     *
     * @var string
     */
    public $stnk;

    /**
     *
     * @var string
     */
    public $tate;

    /**
     *
     * @var integer
     */
    public $tank;

    /**
     *
     * @var integer
     */
    public $kohi;

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
     * @return BakHItomeiMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHItomeiMrs
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
        return 'bak_h_itomei_mrs';
    }

}

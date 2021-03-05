<?php

class BakHSinenMrs extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $ito1;

    /**
     *
     * @var integer
     */
    public $hon1;

    /**
     *
     * @var string
     */
    public $gen1;

    /**
     *
     * @var integer
     */
    public $ito2;

    /**
     *
     * @var integer
     */
    public $hon2;

    /**
     *
     * @var string
     */
    public $gen2;

    /**
     *
     * @var integer
     */
    public $kote;

    /**
     *
     * @var string
     */
    public $hoko;

    /**
     *
     * @var integer
     */
    public $yori;

    /**
     *
     * @var string
     */
    public $kbn1;

    /**
     *
     * @var string
     */
    public $kbn2;

    /**
     *
     * @var string
     */
    public $kako;

    /**
     *
     * @var integer
     */
    public $kohi;

    /**
     *
     * @var integer
     */
    public $denl;

    /**
     *
     * @var string
     */
    public $gtni;

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
     * @return BakHSinenMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHSinenMrs
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
        return 'bak_h_sinen_mrs';
    }

}

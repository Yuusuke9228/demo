<?php

class BakHItojoMrs extends \Phalcon\Mvc\Model
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
    public $kish;

    /**
     *
     * @var integer
     */
    public $denr;

    /**
     *
     * @var string
     */
    public $deme;

    /**
     *
     * @var integer
     */
    public $yors;

    /**
     *
     * @var string
     */
    public $kitn;

    /**
     *
     * @var string
     */
    public $kado;

    /**
     *
     * @var string
     */
    public $yote;

    /**
     *
     * @var string
     */
    public $kiri;

    /**
     *
     * @var string
     */
    public $hmki;

    /**
     *
     * @var string
     */
    public $smki;

    /**
     *
     * @var integer
     */
    public $kigo;

    /**
     *
     * @var integer
     */
    public $iro1;

    /**
     *
     * @var integer
     */
    public $iro2;

    /**
     *
     * @var integer
     */
    public $iro3;

    /**
     *
     * @var integer
     */
    public $iro4;

    /**
     *
     * @var integer
     */
    public $iro5;

    /**
     *
     * @var integer
     */
    public $juni;

    /**
     *
     * @var integer
     */
    public $hmkm;

    /**
     *
     * @var integer
     */
    public $smkm;

    /**
     *
     * @var integer
     */
    public $setf;

    /**
     *
     * @var integer
     */
    public $seto;

    /**
     *
     * @var integer
     */
    public $seth;

    /**
     *
     * @var integer
     */
    public $jiue;

    /**
     *
     * @var integer
     */
    public $biro;

    /**
     *
     * @var string
     */
    public $kied;

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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'bak_h_itojo_mrs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHItojoMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHItojoMrs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

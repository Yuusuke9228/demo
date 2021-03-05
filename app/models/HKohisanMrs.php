<?php

class HKohisanMrs extends \Phalcon\Mvc\Model
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
    public $name;

    /**
     *
     * @var integer
     */
    public $kono;

    /**
     *
     * @var integer
     */
    public $gyou;

    /**
     *
     * @var string
     */
    public $kote;

    /**
     *
     * @var string
     */
    public $komk;

    /**
     *
     * @var string
     */
    public $levl;

    /**
     *
     * @var string
     */
    public $hika;

    /**
     *
     * @var string
     */
    public $atai;

    /**
     *
     * @var integer
     */
    public $keta;

    /**
     *
     * @var string
     */
    public $andk;

    /**
     *
     * @var integer
     */
    public $errf;

    /**
     *
     * @var string
     */
    public $fugo;

    /**
     *
     * @var integer
     */
    public $kohi;

    /**
     *
     * @var integer
     */
    public $expt;

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
     * @return HKohisanMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HKohisanMrs
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
        return 'h_kohisan_mrs';
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

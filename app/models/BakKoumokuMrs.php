<?php

class BakKoumokuMrs extends \Phalcon\Mvc\Model
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
    public $table_mr_cd;

    /**
     *
     * @var integer
     */
    public $jun;

    /**
     *
     * @var string
     */
    public $data_kata;

    /**
     *
     * @var integer
     */
    public $nagasa;

    /**
     *
     * @var string
     */
    public $shougoujunjo;

    /**
     *
     * @var string
     */
    public $zokusei;

    /**
     *
     * @var integer
     */
    public $nullka;

    /**
     *
     * @var string
     */
    public $default_ti;

    /**
     *
     * @var string
     */
    public $sonota;

    /**
     *
     * @var string
     */
    public $indekkusu;

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
        return 'bak_koumoku_mrs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakKoumokuMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakKoumokuMrs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

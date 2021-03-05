<?php

class ShiiregakuVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $shiire_dt_id;

    /**
     *
     * @var double
     */
    public $kingaku;

    /**
     *
     * @var double
     */
    public $kesikomi_gaku;

    /**
     *
     * @var string
     */
    public $shiiresaki_mr_cd;

    /**
     *
     * @var string
     */
    public $shiirebi;

    /**
     *
     * @var integer
     */
    public $cd;

    /**
     *
     * @var integer
     */
    public $kesikomi_id;


    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'shiiregaku_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShiiregakuVws[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShiiregakuVws
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

<?php

class UriageShukkaMaxVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $juchuu_dt_id;

    /**
     *
     * @var string
     */
    public $cd;

    /**
     *
     * @var string
     */
    public $irocd;

    /**
     *
     * @var string
     */
    public $shukka_kbn_max;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'uriage_shukka_max_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UriageShukkaMaxVws[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UriageShukkaMaxVws
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

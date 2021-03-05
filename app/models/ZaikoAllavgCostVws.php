<?php

class ZaikoAllavgCostVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $shouhin_cd;

    /**
     *
     * @var string
     */
    public $souko_cd;

    /**
     *
     * @var string
     */
    public $avg_cost;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'zaiko_allavg_cost_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZaikoAllavgCostVws[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ZaikoAllavgCostVws
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

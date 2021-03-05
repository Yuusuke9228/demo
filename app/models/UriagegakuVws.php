<?php

class UriagegakuVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $uriage_dt_id;

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
    public $seikyuusaki_mr_cd;

    /**
     *
     * @var string
     */
    public $uriagebi;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasOne('uriage_dt_id', 'UriageDts', 'id', array('alias' => 'UriageDts'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UriagegakuVws[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UriagegakuVws
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
        return 'uriagegaku_vws';
    }

}

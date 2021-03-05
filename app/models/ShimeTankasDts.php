<?php

class ShimeTankasDts extends \Phalcon\Mvc\Model
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
    public $nyuushukkoym;

    /**
     *
     * @var string
     */
    public $shouhin_mr_cd;

    /**
     *
     * @var double
     */
    public $zengetsu_tanka;

    /**
     *
     * @var double
     */
    public $tougetsu_tanka;

    /**
     *
     * @var string
     */
    public $tanka_kbn;

    /**
     *
     * @var string
     */
    public $zaiko_hyouka_kbn_cd;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("smm");
        $this->setSource("shime_tankas_dts");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'shime_tankas_dts';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShimeTankasDts[]|ShimeTankasDts|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShimeTankasDts|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

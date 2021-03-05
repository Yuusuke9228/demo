<?php

class HigenrVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $sasizu_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $genryou_jun;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $itoshu;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $itocode;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $gentanni;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $chokuyori_kbn;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $chokuyori_sasizu_no;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $ukeire_sasizu;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $ukeire_zumi;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $free_ukeire_sasizu;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $free_ukeire_zumi;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $shouhi_chousei_sasizu;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $shouhi_chousei_zumi;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $shouhi_zumi;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $kanryou_kbn;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $kuuhaku;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("higenr_vws");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HigenrVws[]|HigenrVws|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HigenrVws|\Phalcon\Mvc\Model\ResultInterface
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
        return 'higenr_vws';
    }

}

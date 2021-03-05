<?php

class Hisasip2Dts extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    public $指図番号2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $指図本数;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $合格本数;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $小玉本数;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $納品本数;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $ワインダ行;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $小玉量;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $指図量;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $生産量;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $納品量;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $先造り指図分;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $フリー払出量;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $在庫調整量;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $空白;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("hisasip2_dts");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'hisasip2_dts';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Hisasip2Dts[]|Hisasip2Dts|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Hisasip2Dts|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

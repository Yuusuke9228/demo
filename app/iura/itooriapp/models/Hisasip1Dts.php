<?php

class Hisasip1Dts extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $整経番号;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $分解番号;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $指図順;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    public $指図番号;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $備考;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $ワインダ区分;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $ボビン色;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $完了区分;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $確定指図区分;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $糸機種;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $工場;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $糸種;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $コード;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $生産開始;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $生産完了;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $直撚り区分;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $色付け;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $真空セット;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("hisasip1_dts");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'hisasip1_dts';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Hisasip1Dts[]|Hisasip1Dts|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Hisasip1Dts|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

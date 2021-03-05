<?php

class PropHikiateVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $sasizu_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $sasizu_eda;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $kakou_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $kakou_no1;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $tanka;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $tanni;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $itomei;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $itomei2;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $lot;

    /**
     *
     * @var string
     * @Column(type="string", length=70, nullable=true)
     */
    public $bikou;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $shukka_saki;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $juusho;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $tel;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    public $label_keisiki;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("prop_hikiate_vws");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PropHikiateVws[]|PropHikiateVws|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PropHikiateVws|\Phalcon\Mvc\Model\ResultInterface
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
        return 'prop_hikiate_vws';
    }

}

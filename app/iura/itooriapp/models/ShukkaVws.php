<?php

class ShukkaVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $ito_code;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $hiduke;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $denpyou_no;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $kakou_no;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $lot;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $suuryou;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $honsuu;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $hinsitu;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $bikou1;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $bikou2;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $shukkasaki;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("shukka_vws");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'shukka_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShukkaVws[]|ShukkaVws|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShukkaVws|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

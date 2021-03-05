<?php

class ItomeiVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    public $itoshu;

    /**
     *
     * @var string
     * @Column(type="string", length=5, nullable=true)
     */
    public $ito_code;

    /**
     *
     * @var string
     * @Column(type="string", length=36, nullable=true)
     */
    public $itomei1;

    /**
     *
     * @var string
     * @Column(type="string", length=36, nullable=true)
     */
    public $itomei2;

    /**
     *
     * @var string
     * @Column(type="string", length=36, nullable=true)
     */
    public $itomei3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    public $koushin_kbn;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $kousin_date;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("itomei_vws");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'itomei_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ItomeiVws[]|ItomeiVws|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ItomeiVws|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

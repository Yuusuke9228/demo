<?php

class UkeireVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $itomei;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $hinmei;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $niukebi;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $shukka_moto;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $suuryou;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $honsuu;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $hakosuu;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $lot;

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
    public $sasizu_no;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $bikou;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $kishu;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $seihin_code;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $genryou_code;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $henkyaku;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("ukeire_vws");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ukeire_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UkeireVws[]|UkeireVws|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UkeireVws|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

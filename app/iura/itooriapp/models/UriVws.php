<?php

class UriVws extends \Phalcon\Mvc\Model
{

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
    public $uriagesaki;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $uriage_no;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $gyou;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $hinban;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $tantou;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $kibata_no;

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
    public $irai_no;

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
    public $suuryou_meisai;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $suuryou_goukei;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $tanka;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $tanni;

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
    public $lot;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $kishu;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("uri_vws");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'uri_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UriVws[]|UriVws|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UriVws|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

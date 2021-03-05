<?php

class IraikirokuVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $kakou_no;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $hakkou_date;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $kaisha_mei;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $sf_tantou;

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
    public $agari_hinmei;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $siyousi;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $kakouo_suuryou;

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
    public $seihin_lot;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $tanni1;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $nouki;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $shukkasaki;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $juusho;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $tel;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou1;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou2;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou3;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou4;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou5;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou6;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou7;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou8;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou9;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou10;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $naiyou11;

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
    public $urisaki;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $urine;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $shukkameisai;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $kanryou;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $gensi_nyuukasaki;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $sofina_kakoutin;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $tanni2;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $seisan_koujoumei;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $kishumei;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $bikou;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("iraikiroku_vws");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return IraikirokuVws[]|IraikirokuVws|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return IraikirokuVws|\Phalcon\Mvc\Model\ResultInterface
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
        return 'iraikiroku_vws';
    }

}

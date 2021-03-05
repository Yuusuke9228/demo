<?php

class IyyiohstVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $nyuuryoku_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $itiren_no;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $denpyou_date;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $shiiresaki;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $nyuushukko_kbn;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $denpyou_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $denpyou_eda;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $rec_kbn;

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
    public $ito_code;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $bobin;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $itoryou;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $tanni;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $tanka;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $kingaku;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $zaiko_ryou;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $haraidasi_saki;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $chuumon_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $hako_suu;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $hon1hako;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("iyyiohst_vws");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'iyyiohst_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return IyyiohstVws[]|IyyiohstVws|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return IyyiohstVws|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

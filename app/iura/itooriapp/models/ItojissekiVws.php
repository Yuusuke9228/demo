<?php

class ItojissekiVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $nichiji;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $rec_kbn;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $seikei_no;

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
    public $sasizu_no;

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
     * @Column(type="string", nullable=true)
     */
    public $itoryou;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $honsuu;

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
    public $floor;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $gouki;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $moto_kishu;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $moto_floor;

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
    public $sagyousha_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $nouhinn_kbn;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $oodama;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("itojisseki_vws");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ItojissekiVws[]|ItojissekiVws|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ItojissekiVws|\Phalcon\Mvc\Model\ResultInterface
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
        return 'itojisseki_vws';
    }

}

<?php

class GoukiVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    public $koutei_kbn;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $kishu;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $kishu_yobi;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $koujou;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=true)
     */
    public $gouki;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $gouki_eda;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    public $kai;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=true)
     */
    public $suisuu;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    public $bikou;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("gouki_vws");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'gouki_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoukiVws[]|GoukiVws|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoukiVws|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

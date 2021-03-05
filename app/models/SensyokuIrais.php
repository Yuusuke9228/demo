<?php

class SensyokuIrais extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $h_id;

    /**
     *
     * @var integer
     */
    public $h_meisai_id;

    /**
     *
     * @var integer
     */
    public $row;

    /**
     *
     * @var string
     */
    public $bunkatsu;

    /**
     *
     * @var string
     */
    public $nouki_hensin;

    /**
     *
     * @var integer
     */
    public $bika;

    /**
     *
     * @var string
     */
    public $bika_henji;

    /**
     *
     * @var string
     */
    public $genryou_bikou;

    /**
     *
     * @var string
     */
    public $kakou_shurui;

    /**
     *
     * @var string
     */
    public $atomaki_oiru;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var string
     */
    public $seikyuusaki;

    /**
     *
     * @var string
     */
    public $koujou_hensin;

    /**
     *
     * @var string
     */
    public $sensyokubi;

    /**
     *
     * @var string
     */
    public $shukkabi;

    /**
     *
     * @var string
     */
    public $shanai_bikou;

    /**
     *
     * @var string
     */
    public $sai_fax_bikou;

    /**
     *
     * @var integer
     */
    public $asistant;

    /**
     *
     * @var string
     */
    public $gotantousha;

    /**
     *
     * @var integer
     */
    public $insatsu_flg;

    /**
     *
     * @var string
     */
    public $genryou;

    /**
     *
     * @var string
     */
    public $koutin;

    /**
     *
     * @var integer
     */
    public $sakusei_user_id;

    /**
     *
     * @var string
     */
    public $created;

    /**
     *
     * @var integer
     */
    public $kousin_user_id;

    /**
     *
     * @var string
     */
    public $updated;


    /**
     * Initialize method for model.
     */
    public function initialize()
    {
//        $this->setSchema("smm");
        $this->setSource("sensyoku_irais");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sensyoku_irais';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SensyokuIrais[]|SensyokuIrais|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SensyokuIrais|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function beforeCreate()
    {
        $this->created = date("Y-m-d H:i:s");
        $this->sakusei_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $this->updated = date("Y-m-d H:i:s");
        $this->kousin_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
    }


    public function beforeUpdate()
    {
        $this->updated = date("Y-m-d H:i:s");
        $this->kousin_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
    }

}

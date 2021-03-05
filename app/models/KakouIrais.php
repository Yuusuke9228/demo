<?php

class KakouIrais extends \Phalcon\Mvc\Model
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
    public $meisai_row;

    /**
     *
     * @var string
     */
    public $nouki_memo;

    /**
     *
     * @var string
     */
    public $nouki_memo2;

    /**
     *
     * @var string
     */
    public $naiyou_1;

    /**
     *
     * @var string
     */
    public $naiyou_2;

    /**
     *
     * @var string
     */
    public $naiyou_3;

    /**
     *
     * @var string
     */
    public $naiyou_4;

    /**
     *
     * @var string
     */
    public $naiyou_5;

    /**
     *
     * @var string
     */
    public $naiyou_6;

    /**
     *
     * @var string
     */
    public $naiyou_7;

    /**
     *
     * @var string
     */
    public $naiyou_8;

    /**
     *
     * @var string
     */
    public $naiyou_9;

    /**
     *
     * @var string
     */
    public $naiyou_10;

    /**
     *
     * @var string
     */
    public $naiyou_11;

    /**
     *
     * @var string
     */
    public $naiyou_12;

    /**
     *
     * @var string
     */
    public $naiyou_13;

    /**
     *
     * @var string
     */
    public $memo_1;

    /**
     *
     * @var string
     */
    public $memo_2;

    /**
     *
     * @var string
     */
    public $meisai;

    /**
     *
     * @var string
     */
    public $gen_nyuukasaki;

    /**
     *
     * @var string
     */
    public $sai_fax_memo;

    /**
     *
     * @var string
     */
    public $seisan_koujou;

    /**
     *
     * @var string
     */
    public $kishumei;

    /**
     *
     * @var string
     */
    public $kakou_kbn;

    /**
     *
     * @var string
     */
    public $sfn_cd;

    /**
     *
     * @var string
     */
    public $nouki_hensin;

    /**
     *
     * @var string
     */
    public $gen_hensin;

    /**
     *
     * @var string
     */
    public $synai_memo1;

    /**
     *
     * @var string
     */
    public $synai_memo2;

    /**
     *
     * @var string
     */
    public $eda;

    /**
     *
     * @var string
     */
    public $gen_nyuuka;

    /**
     *
     * @var string
     */
    public $case_mark;

    /**
     *
     * @var integer
     */
    public $asistant;

    /**
     *
     * @var string
     */
    public $shouhin_mr_cd;

    /**
     *
     * @var string
     */
    public $gotantousha;

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
        $this->setSource("kakou_irais");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'kakou_irais';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return KakouIrais[]|KakouIrais|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return KakouIrais|\Phalcon\Mvc\Model\ResultInterface
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

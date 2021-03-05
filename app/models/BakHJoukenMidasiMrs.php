<?php

class BakHJoukenMidasiMrs extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $タイプ;

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $h_kouteimei_mr_cd;

    /**
     *
     * @var string
     */
    public $cd;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $tanni_mr_cd;

    /**
     *
     * @var integer
     */
    public $retu;

    /**
     *
     * @var integer
     */
    public $gyou;

    /**
     *
     * @var integer
     */
    public $val_type;

    /**
     *
     * @var integer
     */
    public $seisuuketa;

    /**
     *
     * @var integer
     */
    public $shousuuketa;

    /**
     *
     * @var string
     */
    public $h_jouken_kouho_mr_cd;

    /**
     *
     * @var string
     */
    public $yuuikey;

    /**
     *
     * @var string
     */
    public $jikan_keisan;

    /**
     *
     * @var integer
     */
    public $jikan_keisan_jun;

    /**
     *
     * @var string
     */
    public $sagyou_keisan;

    /**
     *
     * @var integer
     */
    public $sagyou_keisan_jun;

    /**
     *
     * @var string
     */
    public $koutin_keisan;

    /**
     *
     * @var integer
     */
    public $koutin_keisan_jun;

    /**
     *
     * @var integer
     */
    public $id_moto;

    /**
     *
     * @var integer
     */
    public $hikae_dltflg;

    /**
     *
     * @var integer
     */
    public $hikae_user_id;

    /**
     *
     * @var string
     */
    public $hikae_nichiji;

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
//        $this->setSchema("sfn");
        $this->setSource("bak_h_jouken_midasi_mrs");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHJoukenMidasiMrs[]|BakHJoukenMidasiMrs|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHJoukenMidasiMrs|\Phalcon\Mvc\Model\ResultInterface
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
        return 'bak_h_jouken_midasi_mrs';
    }

}

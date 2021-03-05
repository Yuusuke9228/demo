<?php

class BakHKishuMrs extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

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
    public $h_kouteimei_mr_cd;

    /**
     *
     * @var integer
     */
    public $daisuu;

    /**
     *
     * @var integer
     */
    public $sou_suisuu;

    /**
     *
     * @var integer
     */
    public $kaitensuu;

    /**
     *
     * @var string
     */
    public $kadouritu;

    /**
     *
     * @var integer
     */
    public $kadouhun_aday;

    /**
     *
     * @var string
     */
    public $seisansei;

    /**
     *
     * @var string
     */
    public $max_haba;

    /**
     *
     * @var string
     */
    public $max_kei;

    /**
     *
     * @var string
     */
    public $max_makiryou;

    /**
     *
     * @var integer
     */
    public $max_yorisuu;

    /**
     *
     * @var string
     */
    public $ryakushou;

    /**
     *
     * @var string
     */
    public $bikou;

    /**
     *
     * @var string
     */
    public $h_calendar_patan_dt_cd;

    /**
     *
     * @var string
     */
    public $irowake;

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
        $this->setSource("bak_h_kishu_mrs");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHKishuMrs[]|BakHKishuMrs|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHKishuMrs|\Phalcon\Mvc\Model\ResultInterface
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
        return 'bak_h_kishu_mrs';
    }

}

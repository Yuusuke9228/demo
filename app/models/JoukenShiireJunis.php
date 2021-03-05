<?php

class JoukenShiireJunis extends \Phalcon\Mvc\Model
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
    public $junjo_kbn_cd;

    /**
     *
     * @var integer
     */
    public $koujun_flg;

    /**
     *
     * @var string
     */
    public $hanni_from;

    /**
     *
     * @var string
     */
    public $hanni_to;

    /**
     *
     * @var string
     */
    public $kikan_sitei_kbn_cd;

    /**
     *
     * @var string
     */
    public $kikan_from;

    /**
     *
     * @var string
     */
    public $kikan_to;

    /**
     *
     * @var integer
     */
    public $zeikomi_flg;

    /**
     *
     * @var integer
     */
    public $meisaigyou_flg;

    /**
     *
     * @var integer
     */
    public $goukeigyou_flg;

    /**
     *
     * @var integer
     */
    public $torihikiari_flg;

    /**
     *
     * @var integer
     */
    public $torihikinasi_flg;

    /**
     *
     * @var integer
     */
    public $hokakei_flg;

    /**
     *
     * @var integer
     */
    public $zennnen_flg;

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
        $this->setSchema("smm");
        $this->setSource("jouken_shiire_junis");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'jouken_shiire_junis';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return JoukenShiireJunis[]|JoukenShiireJunis|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return JoukenShiireJunis|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

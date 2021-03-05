<?php

class JoukenShiireMeisais extends \Phalcon\Mvc\Model
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
    public $tokuisaki_mr_cd;

    /**
     *
     * @var string
     */
    public $shouhin_mr_cd;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $souko_mr_cd;

    /**
     *
     * @var string
     */
    public $project_mr_cd;

    /**
     *
     * @var string
     */
    public $project_sub_cd;

    /**
     *
     * @var integer
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
    public $cd_from;

    /**
     *
     * @var integer
     */
    public $cd_to;

    /**
     *
     * @var integer
     */
    public $simekiri_kbn;

    /**
     *
     * @var integer
     */
    public $tuujou_flg;

    /**
     *
     * @var integer
     */
    public $henpin_flg;

    /**
     *
     * @var integer
     */
    public $nebiki_flg;

    /**
     *
     * @var integer
     */
    public $shokeihi_flg;

    /**
     *
     * @var integer
     */
    public $tekiyou_flg;

    /**
     *
     * @var integer
     */
    public $memo_flg;

    /**
     *
     * @var integer
     */
    public $shouhizei_flg;

    /**
     *
     * @var integer
     */
    public $jinyuuryoku_flg;

    /**
     *
     * @var integer
     */
    public $keitekiyou_flg;

    /**
     *
     * @var integer
     */
    public $goukeigyou_flg;

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
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return JoukenShiireMeisais[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return JoukenShiireMeisais
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

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'jouken_shiire_meisais';
    }

}

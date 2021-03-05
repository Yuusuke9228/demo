<?php

class BakZaikoHenkanDts extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $nendo;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $henkanbi;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $zaiko_henkan_kbn_cd;

    /**
     *
     * @var string
     */
    public $sasizu_dt_cd;

    /**
     *
     * @var string
     */
    public $tokuisaki_mr_cd;

    /**
     *
     * @var string
     */
    public $souko_mr_cd;

    /**
     *
     * @var string
     */
    public $moto_souko_mr_cd;

    /**
     *
     * @var string
     */
    public $moto_tantou_mr_cd;

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
     * @return BakZaikoHenkanDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakZaikoHenkanDts
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
        return 'bak_zaiko_henkan_dts';
    }

}

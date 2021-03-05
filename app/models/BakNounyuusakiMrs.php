<?php

class BakNounyuusakiMrs extends \Phalcon\Mvc\Model
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
    public $kana;

    /**
     *
     * @var string
     */
    public $ryakushou;

    /**
     *
     * @var string
     */
    public $yuubin_bangou;

    /**
     *
     * @var string
     */
    public $juusho1;

    /**
     *
     * @var string
     */
    public $juusho2;

    /**
     *
     * @var string
     */
    public $bushomei;

    /**
     *
     * @var string
     */
    public $yakushoku;

    /**
     *
     * @var string
     */
    public $gotantousha;

    /**
     *
     * @var string
     */
    public $keishou;

    /**
     *
     * @var string
     */
    public $tokuisaki_mr_cd;

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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'bak_nounyuusaki_mrs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakNounyuusakiMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakNounyuusakiMrs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

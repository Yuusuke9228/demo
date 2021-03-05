<?php

class BakChouhyouMrs extends \Phalcon\Mvc\Model
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
    public $chouhyou_kbn_cd;

    /**
     *
     * @var string
     */
    public $chouhyou_tool_kbn_cd;

    /**
     *
     * @var string
     */
    public $hinagata;

    /**
     *
     * @var string
     */
    public $yousi_size;

    /**
     *
     * @var string
     */
    public $yousi_houkou;

    /**
     *
     * @var integer
     */
    public $meisai_pp;

    /**
     *
     * @var string
     */
    public $meisai_yokokan;

    /**
     *
     * @var string
     */
    public $meisai_tatekan;

    /**
     *
     * @var integer
     */
    public $meisai_lvl;

    /**
     *
     * @var string
     */
    public $comment;

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
     * @return BakChouhyouMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakChouhyouMrs
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
        return 'bak_chouhyou_mrs';
    }

}

<?php

class ReportJoukenMeisaiMrs extends \Phalcon\Mvc\Model
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
    public $report_jouken_mr_id;

    /**
     *
     * @var integer
     */
    public $jun;

    /**
     *
     * @var string
     */
    public $koumoku_mr_cd;

    /**
     *
     * @var integer
     */
    public $sortkeys;

    /**
     *
     * @var integer
     */
    public $grouping_kbn;

    /**
     *
     * @var integer
     */
    public $siyou_kbn;

    /**
     *
     * @var string
     */
    public $henshuu_cd;

    /**
     *
     * @var integer
     */
    public $shousuu;

    /**
     *
     * @var integer
     */
    public $zero_flg;

    /**
     *
     * @var integer
     */
    public $align;

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
        return 'report_jouken_meisai_mrs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ReportJoukenMeisaiMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ReportJoukenMeisaiMrs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

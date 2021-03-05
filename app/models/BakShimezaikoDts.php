<?php

class BakShimezaikoDts extends \Phalcon\Mvc\Model
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
    public $tanni_mr_cd;

    /**
     *
     * @var string
     */
    public $zaiko_ryou;

    /**
     *
     * @var string
     */
    public $suu_tanni_mr_cd;

    /**
     *
     * @var string
     */
    public $zaiko_suu;

    /**
     *
     * @var string
     */
    public $simebi;

    /**
     *
     * @var string
     */
    public $lot;

    /**
     *
     * @var string
     */
    public $kobetucd;

    /**
     *
     * @var string
     */
    public $hinsitu_kbn_cd;

    /**
     *
     * @var string
     */
    public $souko_mr_cd;

    /**
     *
     * @var string
     */
    public $nyuukobi;

    /**
     *
     * @var string
     */
    public $shukkobi;

    /**
     *
     * @var string
     */
    public $tanka;

    /**
     *
     * @var string
     */
    public $zaiko_hyouka_kbn_cd;

    /**
     *
     * @var string
     */
    public $shiire_ryou;

    /**
     *
     * @var string
     */
    public $hokanyuuko_ryou;

    /**
     *
     * @var string
     */
    public $uriage_ryou;

    /**
     *
     * @var string
     */
    public $hokashukko_ryou;

    /**
     *
     * @var string
     */
    public $shiire_suu;

    /**
     *
     * @var string
     */
    public $hokanyuuko_suu;

    /**
     *
     * @var string
     */
    public $uriage_suu;

    /**
     *
     * @var string
     */
    public $hokashukko_suu;

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
     * @return BakShimezaikoDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakShimezaikoDts
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
        return 'bak_shimezaiko_dts';
    }

}

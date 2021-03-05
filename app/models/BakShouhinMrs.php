<?php

class BakShouhinMrs extends \Phalcon\Mvc\Model
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
    public $tanni_mr_cd;

    /**
     *
     * @var string
     */
    public $suu_tanni_mr_cd;

    /**
     *
     * @var string
     */
    public $tanni_mr1_cd;

    /**
     *
     * @var string
     */
    public $tanni_mr2_cd;

    /**
     *
     * @var integer
     */
    public $tanka_kbn;

    /**
     *
     * @var integer
     */
    public $zaiko_kbn;

    /**
     *
     * @var string
     */
    public $irisuu;

    /**
     *
     * @var string
     */
    public $kikaku;

    /**
     *
     * @var string
     */
    public $iro;

    /**
     *
     * @var string
     */
    public $iromei;

    /**
     *
     * @var string
     */
    public $size;

    /**
     *
     * @var string
     */
    public $lot;

    /**
     *
     * @var string
     */
    public $hinsitu_kbn_cd;

    /**
     *
     * @var integer
     */
    public $suu_shousuu;

    /**
     *
     * @var integer
     */
    public $suu1_shousuu;

    /**
     *
     * @var integer
     */
    public $suu2_shousuu;

    /**
     *
     * @var integer
     */
    public $tanka_shousuu;

    /**
     *
     * @var integer
     */
    public $kazei_kbn_cd;

    /**
     *
     * @var integer
     */
    public $zaikokanri;

    /**
     *
     * @var string
     */
    public $hacchuu_lot;

    /**
     *
     * @var integer
     */
    public $lead_time;

    /**
     *
     * @var string
     */
    public $zaiko_tekisei;

    /**
     *
     * @var string
     */
    public $zaiko_hyouka_kbn_cd;

    /**
     *
     * @var string
     */
    public $shu_shiiresaki_mr_cd;

    /**
     *
     * @var string
     */
    public $shu_souko_mr_cd;

    /**
     *
     * @var integer
     */
    public $hacchuu_rendou;

    /**
     *
     * @var string
     */
    public $gen_zaiko;

    /**
     *
     * @var string
     */
    public $last_shukko_date;

    /**
     *
     * @var string
     */
    public $last_nyuuko_date;

    /**
     *
     * @var string
     */
    public $joudai;

    /**
     *
     * @var string
     */
    public $uri_tanka1;

    /**
     *
     * @var string
     */
    public $uri_tanka2;

    /**
     *
     * @var string
     */
    public $uri_tanka3;

    /**
     *
     * @var string
     */
    public $uri_tanka4;

    /**
     *
     * @var string
     */
    public $uri_genka;

    /**
     *
     * @var string
     */
    public $shiire_tanka;

    /**
     *
     * @var string
     */
    public $hyoujun_genka;

    /**
     *
     * @var string
     */
    public $hyoukasage_genka;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui1_kbn_cd;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui2_kbn_cd;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui3_kbn_cd;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui4_kbn_cd;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui5_kbn_cd;

    /**
     *
     * @var integer
     */
    public $sanshou_hyouji;

    /**
     *
     * @var string
     */
    public $memo;

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
     * @return BakShouhinMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakShouhinMrs
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
        return 'bak_shouhin_mrs';
    }

}

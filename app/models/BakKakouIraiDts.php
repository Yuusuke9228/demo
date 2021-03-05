<?php

class BakKakouIraiDts extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $hacchuu_dt_id;

    /**
     *
     * @var string
     */
    public $gotantou;

    /**
     *
     * @var string
     */
    public $keishou;

    /**
     *
     * @var string
     */
    public $seisan_kanri_user_cd;

    /**
     *
     * @var string
     */
    public $assistant_user_cd;

    /**
     *
     * @var string
     */
    public $loss_ritu;

    /**
     *
     * @var string
     */
    public $kibou_nouki;

    /**
     *
     * @var string
     */
    public $kouki;

    /**
     *
     * @var string
     */
    public $kakou_shu;

    /**
     *
     * @var string
     */
    public $kishu;

    /**
     *
     * @var string
     */
    public $yori_houkou;

    /**
     *
     * @var integer
     */
    public $yorisuu;

    /**
     *
     * @var string
     */
    public $yori_tanni;

    /**
     *
     * @var integer
     */
    public $makiryou;

    /**
     *
     * @var string
     */
    public $makiryou_tanni;

    /**
     *
     * @var string
     */
    public $seimaki_mae;

    /**
     *
     * @var string
     */
    public $seimaki_suu;

    /**
     *
     * @var string
     */
    public $seimaki_tanni;

    /**
     *
     * @var string
     */
    public $sikan_sitei;

    /**
     *
     * @var integer
     */
    public $set_umu;

    /**
     *
     * @var integer
     */
    public $set_ondo;

    /**
     *
     * @var integer
     */
    public $set_hun;

    /**
     *
     * @var integer
     */
    public $tail_kbn;

    /**
     *
     * @var integer
     */
    public $komaki_kbn;

    /**
     *
     * @var integer
     */
    public $tunagi_kbn;

    /**
     *
     * @var string
     */
    public $youto;

    /**
     *
     * @var string
     */
    public $case_kbn;

    /**
     *
     * @var integer
     */
    public $irihonsuu;

    /**
     *
     * @var string
     */
    public $zansi_kbn;

    /**
     *
     * @var string
     */
    public $shukka_kbn;

    /**
     *
     * @var string
     */
    public $sonota1;

    /**
     *
     * @var string
     */
    public $sonota2;

    /**
     *
     * @var string
     */
    public $sonota3;

    /**
     *
     * @var string
     */
    public $bikou_ka;

    /**
     *
     * @var string
     */
    public $bikou_yor;

    /**
     *
     * @var string
     */
    public $bikou_ma;

    /**
     *
     * @var string
     */
    public $bikou_si;

    /**
     *
     * @var string
     */
    public $bikou_se;

    /**
     *
     * @var string
     */
    public $bikou_ta;

    /**
     *
     * @var string
     */
    public $bikou_ko;

    /**
     *
     * @var string
     */
    public $bikou_tu;

    /**
     *
     * @var string
     */
    public $bikou_you;

    /**
     *
     * @var string
     */
    public $bikou_ca;

    /**
     *
     * @var string
     */
    public $bikou_za;

    /**
     *
     * @var string
     */
    public $bikou_sh;

    /**
     *
     * @var string
     */
    public $bikou_so1;

    /**
     *
     * @var string
     */
    public $bikou_so2;

    /**
     *
     * @var string
     */
    public $bikou_so3;

    /**
     *
     * @var string
     */
    public $tokki;

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
        return 'bak_kakou_irai_dts';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakKakouIraiDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakKakouIraiDts
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

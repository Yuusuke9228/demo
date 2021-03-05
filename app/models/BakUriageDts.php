<?php

class BakUriageDts extends \Phalcon\Mvc\Model
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
    public $tekiyou;

    /**
     *
     * @var string
     */
    public $uriagebi;

    /**
     *
     * @var integer
     */
    public $juchuu_dt_id;

    /**
     *
     * @var integer
     */
    public $mitumori_dt_id;

    /**
     *
     * @var integer
     */
    public $saki_hacchuu_cd;

    /**
     *
     * @var integer
     */
    public $shounin_joutai_flg;

    /**
     *
     * @var string
     */
    public $shounin_sha_mr_cd;

    /**
     *
     * @var string
     */
    public $zeiritu_tekiyoubi;

    /**
     *
     * @var string
     */
    public $tokuisaki_mr_cd;

    /**
     *
     * @var string
     */
    public $tokuisaki_name;

    /**
     *
     * @var string
     */
    public $torihiki_kbn_cd;

    /**
     *
     * @var string
     */
    public $zei_tenka_kbn_cd;

    /**
     *
     * @var integer
     */
    public $shikiri_flg;

    /**
     *
     * @var string
     */
    public $nounyuusaki_mr_cd;

    /**
     *
     * @var string
     */
    public $nounyuusaki;

    /**
     *
     * @var string
     */
    public $kidukesaki_mr_cd;

    /**
     *
     * @var string
     */
    public $kiduke;

    /**
     *
     * @var string
     */
    public $shukkabi;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $shimekiri_flg;

    /**
     *
     * @var string
     */
    public $tanka_shurui_kbn_cd;

    /**
     *
     * @var string
     */
    public $kaishuu_yoteibi;

    /**
     *
     * @var integer
     */
    public $seikyuusho_dt_cd;

    /**
     *
     * @var integer
     */
    public $keshikomi_flg;

    /**
     *
     * @var string
     */
    public $nounyuu_kijitu;

    /**
     *
     * @var string
     */
    public $bunrui_cd;

    /**
     *
     * @var string
     */
    public $denpyou_kbn;

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
     * @return BakUriageDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakUriageDts
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
        return 'bak_uriage_dts';
    }

}

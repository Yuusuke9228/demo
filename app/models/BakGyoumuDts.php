<?php

class BakGyoumuDts extends \Phalcon\Mvc\Model
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
    public $denpyou_mr_id;

    /**
     *
     * @var integer
     */
    public $cd;

    /**
     *
     * @var string
     */
    public $hakkoubi;

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
    public $tel;

    /**
     *
     * @var string
     */
    public $fax;

    /**
     *
     * @var integer
     */
    public $torihiki_kbn_cd;

    /**
     *
     * @var integer
     */
    public $zei_tenka_kbn_cd;

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
    public $nounyuu_kijitu;

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
    public $kenmei;

    /**
     *
     * @var string
     */
    public $nouki_memo;

    /**
     *
     * @var string
     */
    public $nounyuu_basho;

    /**
     *
     * @var string
     */
    public $torihiki_houhou;

    /**
     *
     * @var string
     */
    public $yuukou_kigen;

    /**
     *
     * @var string
     */
    public $kingaku_meishou;

    /**
     *
     * @var string
     */
    public $saki_hacchuu_cd;

    /**
     *
     * @var integer
     */
    public $mitumori_dt_id;

    /**
     *
     * @var integer
     */
    public $juchuu_dt_id;

    /**
     *
     * @var integer
     */
    public $hacchuu_dt_id;

    /**
     *
     * @var integer
     */
    public $keikaku_meisai_id;

    /**
     *
     * @var integer
     */
    public $sasizu_jun;

    /**
     *
     * @var string
     */
    public $shiiresaki_mr_cd;

    /**
     *
     * @var string
     */
    public $hassousaki_kbn_cd;

    /**
     *
     * @var string
     */
    public $hassousaki_mr_cd;

    /**
     *
     * @var string
     */
    public $hassousaki;

    /**
     *
     * @var string
     */
    public $shukkabi;

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
     * @var integer
     */
    public $irai_kbn_cd;

    /**
     *
     * @var string
     */
    public $souko_mr_cd;

    /**
     *
     * @var string
     */
    public $assistant;

    /**
     *
     * @var string
     */
    public $sasizu_dt_cd;

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
    public $shounin_joutai_flg;

    /**
     *
     * @var string
     */
    public $shounin_sha_mr_cd;

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
//        $this->setSchema("sfn");
        $this->setSource("bak_gyoumu_dts");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakGyoumuDts[]|BakGyoumuDts|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakGyoumuDts|\Phalcon\Mvc\Model\ResultInterface
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
        return 'bak_gyoumu_dts';
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

}

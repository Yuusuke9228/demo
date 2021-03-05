<?php

class BakGyoumuMeisaiDts extends \Phalcon\Mvc\Model
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
    public $utiwake_kbn_cd;

    /**
     *
     * @var integer
     */
    public $gyoumu_dt_id;

    /**
     *
     * @var string
     */
    public $kousei;

    /**
     *
     * @var integer
     */
    public $kaisou;

    /**
     *
     * @var integer
     */
    public $oya_meisai_cd;

    /**
     *
     * @var string
     */
    public $chuumon_kanryoubi;

    /**
     *
     * @var string
     */
    public $zaiko_kanryoubi;

    /**
     *
     * @var string
     */
    public $shouhin_mr_cd;

    /**
     *
     * @var string
     */
    public $tekiyou;

    /**
     *
     * @var string
     */
    public $lot;

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
     * @var integer
     */
    public $tanaban;

    /**
     *
     * @var integer
     */
    public $barcode;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $suuryou;

    /**
     *
     * @var string
     */
    public $keisu;

    /**
     *
     * @var string
     */
    public $irisuu;

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
     * @var string
     */
    public $juch_zan_ryou1;

    /**
     *
     * @var string
     */
    public $juch_zan_ryou2;

    /**
     *
     * @var string
     */
    public $hach_zan_ryou1;

    /**
     *
     * @var string
     */
    public $hach_zan_ryou2;

    /**
     *
     * @var string
     */
    public $zaiko_henka_ryou1;

    /**
     *
     * @var string
     */
    public $zaiko_henka_ryou2;

    /**
     *
     * @var string
     */
    public $azu_henka_ryou1;

    /**
     *
     * @var string
     */
    public $azu_henka_ryou2;

    /**
     *
     * @var string
     */
    public $mitu_ryou1;

    /**
     *
     * @var string
     */
    public $mitu_ryou2;

    /**
     *
     * @var string
     */
    public $juch_ryou1;

    /**
     *
     * @var string
     */
    public $juch_ryou2;

    /**
     *
     * @var string
     */
    public $hach_ryou1;

    /**
     *
     * @var string
     */
    public $hach_ryou2;

    /**
     *
     * @var string
     */
    public $shiire_ryou1;

    /**
     *
     * @var string
     */
    public $shiire_ryou2;

    /**
     *
     * @var string
     */
    public $uriage_ryou1;

    /**
     *
     * @var string
     */
    public $uriage_ryou2;

    /**
     *
     * @var string
     */
    public $shukkairai_ryou1;

    /**
     *
     * @var string
     */
    public $shukkairai_ryou2;

    /**
     *
     * @var string
     */
    public $idou_ryou1;

    /**
     *
     * @var string
     */
    public $idou_ryou2;

    /**
     *
     * @var integer
     */
    public $zaiko_kbn;

    /**
     *
     * @var integer
     */
    public $tanka_kbn;

    /**
     *
     * @var string
     */
    public $gentanka;

    /**
     *
     * @var string
     */
    public $tanka;

    /**
     *
     * @var integer
     */
    public $kingaku;

    /**
     *
     * @var integer
     */
    public $genkagaku;

    /**
     *
     * @var integer
     */
    public $zeinukigaku;

    /**
     *
     * @var integer
     */
    public $zeigaku;

    /**
     *
     * @var string
     */
    public $project_mr_cd;

    /**
     *
     * @var integer
     */
    public $zeiritu_mr_cd;

    /**
     *
     * @var string
     */
    public $bikou;

    /**
     *
     * @var string
     */
    public $nouki;

    /**
     *
     * @var integer
     */
    public $oya_meisai_id;

    /**
     *
     * @var string
     */
    public $shouhin_kakou_cd;

    /**
     *
     * @var string
     */
    public $h_kishu_mr_cd;

    /**
     *
     * @var integer
     */
    public $gouki;

    /**
     *
     * @var integer
     */
    public $juchuu_nasi_flg;

    /**
     *
     * @var string
     */
    public $moto_juch_ryou1;

    /**
     *
     * @var string
     */
    public $moto_juch_ryou2;

    /**
     *
     * @var string
     */
    public $zaikoseisan_ryou1;

    /**
     *
     * @var string
     */
    public $zaikoseisan_ryou2;

    /**
     *
     * @var string
     */
    public $loss_ryou1;

    /**
     *
     * @var string
     */
    public $loss_ryou2;

    /**
     *
     * @var string
     */
    public $keikaku_ryou1;

    /**
     *
     * @var string
     */
    public $keikaku_ryou2;

    /**
     *
     * @var string
     */
    public $kagi;

    /**
     *
     * @var string
     */
    public $kouritu;

    /**
     *
     * @var string
     */
    public $kouritu_tanni;

    /**
     *
     * @var string
     */
    public $heiretu_suu;

    /**
     *
     * @var string
     */
    public $kadou_nissuu;

    /**
     *
     * @var string
     */
    public $kaisi_hiduke;

    /**
     *
     * @var string
     */
    public $shuuryou_hiduke;

    /**
     *
     * @var string
     */
    public $json_params;

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
        $this->setSource("bak_gyoumu_meisai_dts");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakGyoumuMeisaiDts[]|BakGyoumuMeisaiDts|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakGyoumuMeisaiDts|\Phalcon\Mvc\Model\ResultInterface
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
        return 'bak_gyoumu_meisai_dts';
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

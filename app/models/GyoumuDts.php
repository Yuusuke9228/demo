<?php

class GyoumuDts extends \Phalcon\Mvc\Model
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
        $this->setSource("gyoumu_dts");
        $this->hasMany('id', 'GyoumuMeisaiDts', 'gyoumu_dt_id', array('alias' => 'GyoumuMeisaiDts', 'params'=>['order'=>'cd,id']));
        $this->belongsTo('shiiresaki_mr_cd', 'ShiiresakiMrs', 'cd', array('alias' => 'ShiiresakiMrs'));
        $this->belongsTo('tokuisaki_mr_cd', 'TokuisakiMrs', 'cd', array('alias' => 'TokuisakiMrs'));
        $this->belongsTo('shounin_sha_mr_cd', 'Users', 'cd', array('alias' => 'Users'));
        $this->belongsTo('sakusei_user_id', 'Users', 'id', array('alias' => 'SakuseiUsers'));
        $this->belongsTo('kousin_user_id', 'Users', 'id', array('alias' => 'KousinUsers'));
        $this->belongsTo('zei_tenka_kbn_cd', 'ZeitenkaKbns', 'cd', array('alias' => 'ZeitenkaKbns'));
        $this->belongsTo('torihiki_kbn_cd', 'TorihikiKbns', 'cd', array('alias' => 'TorihikiKbns'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        $this->belongsTo('moto_tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'MotoTantouMrs'));
        $this->belongsTo('souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'SoukoMrs'));
        $this->belongsTo('moto_souko_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'MotoSoukoMrs'));
        $this->belongsTo('hacchuu_dt_id', 'HacchuuDts', 'id', ['alias' => 'HacchuuDts']);   //発注と紐づける
        $this->belongsTo('hassousaki_mr_cd', 'TokuisakiMrs', 'cd', array('alias' => 'Hassousaki2Mrs'));
        $this->belongsTo('hassousaki_mr_cd', 'NounyuusakiMrs', 'cd', array('alias' => 'Hassousaki3Mrs'));
        $this->belongsTo('hassousaki_mr_cd', 'SoukoMrs', 'cd', array('alias' => 'Hassousaki4Mrs'));
        $this->belongsTo('juchuu_dt_id', 'GyoumuDts', 'id', array('alias' => 'JuchuuDts'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GyoumuDts[]|GyoumuDts|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GyoumuDts|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
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


    public function backOut($dlt_flg = 0)
    {
        $bak = new BakGyoumuDts(); // 書き換え忘れ注意！！
        foreach ($this as $fld=>$val) {
            if (substr($fld,0,1) != '_') {
               $bak->$fld = $this->$fld;
            }
        }
        $bak->id = NULL;
        $bak->id_moto = $this->id;
        $bak->hikae_dltflg = $dlt_flg;
        $bak->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak->hikae_nichiji = date("Y-m-d H:i:s");
        return $bak->save();
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'gyoumu_dts';
    }

}

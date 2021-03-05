<?php

class HisasiVws extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $seikei_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $bunkai_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $sasizu_jun;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $sasizu_no;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $bikou;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $winder_kbn;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $bobin_iro;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $kanryou_kbn;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $kakutei_kbn;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $kishu;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $koujou;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $itoshu;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $ito_code;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $seisan_kaishi;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $seisan_kanryou;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $tyokuyori_kbn;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $irotuke;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $shinkuu_set;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $sasizu_no2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $sasizu_honsuu;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $goukaku_honsuu;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $kodama_honsuu;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $nouhin_honsuu;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $winder_yuki;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $kodama_ryou;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $sasizu_ryou;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $seisan_ryou;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $nouhin_ryou;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $sakizukuri;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $free_haraidasi_ryou;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $zaiko_tyousei_ryou;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $kuuhaku;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("hisasi_vws");

       // $this->hasMany('id', 'UriageMeisaiDts', 'uriage_dt_id', array('alias' => 'UriageMeisaiDts', 'params'=>['order'=>'cd']));
        $this->belongsTo('sasizu_no', 'PropHikiateVws', 'sasizu_no', array('alias' => 'PropHikiateVws'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HisasiVws[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HisasiVws
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
        return 'hisasi_vws';
    }

}

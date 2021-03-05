<?php

class JuchuuMeisaiDts extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $cd;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $utiwake_kbn_cd;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $juchuu_dt_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $shouhin_mr_cd;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $tanni_mr_cd;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $kousei;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $irisuu;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $keisu;

    /**
     *
     * @var string
     * @Column(type="string", length=40, nullable=true)
     */
    public $tekiyou;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $lot;

    /**
     *
     * @var string
     * @Column(type="string", length=24, nullable=true)
     */
    public $kobetucd;

    /**
     *
     * @var string
     * @Column(type="string", length=4, nullable=true)
     */
    public $hinsitu_kbn_cd;

    /**
     *
     * @var string
     * @Column(type="string", length=12, nullable=true)
     */
    public $souko_mr_cd;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    public $kikaku;

    /**
     *
     * @var string
     * @Column(type="string", length=8, nullable=true)
     */
    public $iro;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=true)
     */
    public $iromei;

    /**
     *
     * @var string
     * @Column(type="string", length=8, nullable=true)
     */
    public $size;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $suuryou;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $suuryou1;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $tanni_mr1_cd;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $suuryou2;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $tanni_mr2_cd;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    public $tanka_kbn;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $gentanka;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $tanka;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $kingaku;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $genkagaku;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $zeinukigaku;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $zeigaku;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    public $project_mr_cd;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $zeiritu_mr_cd;

    /**
     *
     * @var string
     * @Column(type="string", length=14, nullable=true)
     */
    public $bikou;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $nouki;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    public $hacchuurendou_flg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $id_moto;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    public $hikae_dltflg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $hikae_user_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $hikae_nichiji;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $sakusei_user_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $created;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $kousin_user_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("juchuu_meisai_dts");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return JuchuuMeisaiDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return JuchuuMeisaiDts
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
        return 'juchuu_meisai_dts';
    }

}

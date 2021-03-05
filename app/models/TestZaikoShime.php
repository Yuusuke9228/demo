<?php

class TestZaikoShime extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    public $p_id;
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
     * @var integer
     */
    public $hinsitu_hyouka_kbn_cd;

    /**
     *
     * @var string
     */
    public $souko_mr_cd;

    /**
     *
     * @var string
     */
    public $nyuukobis;

    /**
     *
     * @var string
     */
    public $shukkobis;

    /**
     *
     * @var string
     */
    public $nyuushukkobi;

    /**
     *
     * @var string
     */
    public $nyuushukkoym;

    /**
     *
     * @var string
     */
    public $denpyou_mr_cd;

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
    public $meisai_id;

    /**
     *
     * @var integer
     */
    public $meisai_cd;

    /**
     *
     * @var string
     */
    public $utiwake_kbn_cd;

    /**
     *
     * @var string
     */
    public $torihikisaki_cd;

    /**
     *
     * @var string
     */
    public $bikou;

    /**
     *
     * @var string
     */
    public $zaiko_ryou1s;

    /**
     *
     * @var string
     */
    public $zaiko_ryou2s;

    /**
     *
     * @var string
     */
    public $tanka_tanni_mr_cd;

    /**
     *
     * @var string
     */
    public $shiirebi_tankas;

    /**
     *
     * @var integer
     */
    public $shiire_gakus;

    /**
     *
     * @var string
     */
    public $shiire_ryou1s;

    /**
     *
     * @var string
     */
    public $shiire_ryou2s;

    /**
     *
     * @var string
     */
    public $hokanyuuko_ryou1s;

    /**
     *
     * @var string
     */
    public $hokanyuuko_ryou2s;

    /**
     *
     * @var string
     */
    public $uriage_ryou1s;

    /**
     *
     * @var string
     */
    public $uriage_ryou2s;

    /**
     *
     * @var string
     */
    public $hokashukko_ryou1s;

    /**
     *
     * @var string
     */
    public $hokashukko_ryou2s;

    /**
     *
     * @var string
     */
    public $shiiresaki_mr_cd;

    /**
     *
     * @var string
     */
    public $tokuisaki_mr_cd;

    /**
     *
     * @var string
     */
    public $nounyuu_kijitu;

    /**
     *
     * @var string
     */
    public $nouki;

    /**
     *
     * @var integer
     */
    public $hacchuu_dt_id;

    /**
     *
     * @var integer
     */
    public $juchuu_dt_id;

    /**
     *
     * @var string
     */
    public $hacchuuzan_ryou1;

    /**
     *
     * @var string
     */
    public $hacchuuzan_ryou2;

    /**
     *
     * @var string
     */
    public $juchuuzan_ryou1;

    /**
     *
     * @var string
     */
    public $juchuuzan_ryou2;

    /**
     *
     * @var string
     */
    public $azukari_zan1s;

    /**
     *
     * @var string
     */
    public $azukari_zan2s;

    /**
     *
     * @var string
     */
    public $azukari_tasi1s;

    /**
     *
     * @var string
     */
    public $azukari_tasi2s;

    /**
     *
     * @var string
     */
    public $azukari_hiki1s;

    /**
     *
     * @var string
     */
    public $azukari_hiki2s;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("smm");
        $this->setSource("test_zaiko_shime");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'test_zaiko_shime';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TestZaikoShime[]|TestZaikoShime|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TestZaikoShime|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

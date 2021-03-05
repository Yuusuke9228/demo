<?php

class ReportAzukariVws extends \Phalcon\Mvc\Model
{

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
    public $tanni_mr2_cd;

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
    public $zaiko_ryou2s;

    /**
     *
     * @var string
     */
    public $nyuuko_ryou2s;

    /**
     *
     * @var string
     */
    public $shukko_ryou2s;

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
    public $oya_id;

    /**
     *
     * @var integer
     */
    public $oya_cd;

    /**
     *
     * @var integer
     */
    public $gyou_cd;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('tanni_mr2_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMr2s'));
        $this->belongsTo('shouhin_mr_cd', 'ShouhinMrs', 'cd', array('alias' => 'ShouhinMrs'));
        $this->belongsTo('utiwake_kbn_cd', 'UtiwakeKbns', 'cd', array('alias' => 'UtiwakeKbns'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        $this->belongsTo('denpyou_mr_cd', 'DenpyouMrs', 'cd', array('alias' => 'DenpyouMrs'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'report_azukari_vws';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ReportAzukariVws[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ReportAzukariVws
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

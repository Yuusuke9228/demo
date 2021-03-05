<?php

class HKishuMrs extends \Phalcon\Mvc\Model
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
    public $h_kouteimei_mr_cd;

    /**
     *
     * @var integer
     */
    public $daisuu;

    /**
     *
     * @var integer
     */
    public $sou_suisuu;

    /**
     *
     * @var integer
     */
    public $kaitensuu;

    /**
     *
     * @var string
     */
    public $kadouritu;

    /**
     *
     * @var integer
     */
    public $kadouhun_aday;

    /**
     *
     * @var string
     */
    public $seisansei;

    /**
     *
     * @var string
     */
    public $max_haba;

    /**
     *
     * @var string
     */
    public $max_kei;

    /**
     *
     * @var string
     */
    public $max_makiryou;

    /**
     *
     * @var integer
     */
    public $max_yorisuu;

    /**
     *
     * @var string
     */
    public $ryakushou;

    /**
     *
     * @var string
     */
    public $bikou;

    /**
     *
     * @var string
     */
    public $h_calendar_patan_dt_cd;

    /**
     *
     * @var string
     */
    public $irowake;

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
        $this->setSource("h_kishu_mrs");
        $this->belongsTo('h_kouteimei_mr_cd', 'HKouteimeiMrs', 'cd', array('alias' => 'HKouteimeiMrs'));
        $this->hasMany('cd', 'GyoumuDts', 'h_kishu_mr_cd', array('alias' => 'GyoumuDts'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'h_kishu_mrs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HKishuMrs[]|HKishuMrs|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HKishuMrs|\Phalcon\Mvc\Model\ResultInterface
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
        $bak = new BakHKishuMrs(); // 書き換え忘れ注意！！
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

}

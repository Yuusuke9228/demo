<?php

class HJoukenMidasiMrs extends \Phalcon\Mvc\Model
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
    public $h_kouteimei_mr_cd;

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
    public $tanni_mr_cd;

    /**
     *
     * @var integer
     */
    public $retu;

    /**
     *
     * @var integer
     */
    public $gyou;

    /**
     *
     * @var integer
     */
    public $val_type;

    /**
     *
     * @var integer
     */
    public $seisuuketa;

    /**
     *
     * @var integer
     */
    public $shousuuketa;

    /**
     *
     * @var string
     */
    public $h_jouken_kouho_mr_cd;

    /**
     *
     * @var string
     */
    public $yuuikey;

    /**
     *
     * @var string
     */
    public $jikan_keisan;

    /**
     *
     * @var integer
     */
    public $jikan_keisan_jun;

    /**
     *
     * @var string
     */
    public $sagyou_keisan;

    /**
     *
     * @var integer
     */
    public $sagyou_keisan_jun;

    /**
     *
     * @var string
     */
    public $koutin_keisan;

    /**
     *
     * @var integer
     */
    public $koutin_keisan_jun;

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
        $this->setSource("h_jouken_midasi_mrs");
        $this->hasMany('h_jouken_kouho_mr_cd', 'HJoukenKouhoMrs', 'cd', array('alias' => 'HJoukenKouhoMrs', 'params'=>['order'=>'jouken']));

    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HJoukenMidasiMrs[]|HJoukenMidasiMrs|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HJoukenMidasiMrs|\Phalcon\Mvc\Model\ResultInterface
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
        return 'h_jouken_midasi_mrs';
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
        $bak = new BakHJoukenMidasiMrs(); // 書き換え忘れ注意！！
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
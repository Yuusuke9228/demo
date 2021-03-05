<?php

class HCalendarDts extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $h_calender_patan_dt_cd;

    /**
     *
     * @var integer
     */
    public $kadou_kbn;

    /**
     *
     * @var string
     */
    public $jukoku1;

    /**
     *
     * @var string
     */
    public $jikan1;

    /**
     *
     * @var string
     */
    public $jikoku2;

    /**
     *
     * @var string
     */
    public $jikan2;

    /**
     *
     * @var string
     */
    public $jikoku3;

    /**
     *
     * @var string
     */
    public $jikan3;

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
    public $hiduke;

    /**
     *
     * @var integer
     */
    public $kadou_flg;

    /**
     *
     * @var string
     */
    public $bikou;

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
        $this->setSource("h_calendar_dts");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HCalendarDts[]|HCalendarDts|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HCalendarDts|\Phalcon\Mvc\Model\ResultInterface
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
        $bak = new BakHCalendarDts(); // 書き換え忘れ注意！！
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
        return 'h_calendar_dts';
    }

}

<?php

class BakHCalendarDts extends \Phalcon\Mvc\Model
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
    public $h_calender_patan_dt_cd;

    /**
     *
     * @var string
     */
    public $hiduke;

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
        $this->setSource("bak_h_calendar_dts");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHCalendarDts[]|BakHCalendarDts|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHCalendarDts|\Phalcon\Mvc\Model\ResultInterface
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
        return 'bak_h_calendar_dts';
    }

}

<?php

class KakouJoukenMeisai extends \Phalcon\Mvc\Model
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
    public $shouhin_mr_cd;

    /**
     *
     * @var integer
     */
    public $kakou_jouken_midashi_cd;

    /**
     *
     * @var string
     */
    public $kakou_jouken_kbn_cd;

    /**
     *
     * @var string
     */
    public $naiyou;

    /**
     *
     * @var integer
     */
    public $version;

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
        //$this->setSchema("erphalcon");
        $this->setSource("kakou_jouken_meisai");
        $this->belongsTo('kakou_jouken_kbn_cd', 'KakouJoukenKbnsMrs', 'cd', array('alias' => 'KakouJoukenKbnsMrs', 'params' => ['order' => 'cd']));
        $this->belongsTo('kakou_jouken_midashi_cd', 'KakouJoukenMidashiMrs', 'cd', array('alias' => 'KakouJoukenMidashiMrs', 'params' => ['order' => 'cd']));
        $this->belongsTo('shouhin_mr_cd', 'ShouhinMrs', 'cd', array('alias' => 'ShouhinMrs'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'kakou_jouken_meisai';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return KakouJoukenMeisai[]|KakouJoukenMeisai|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return KakouJoukenMeisai|\Phalcon\Mvc\Model\ResultInterface
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


}

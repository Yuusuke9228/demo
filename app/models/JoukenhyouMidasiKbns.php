<?php

class JoukenhyouMidasiKbns extends \Phalcon\Mvc\Model
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
    public $name;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui1_kbn_cd;

    /**
     *
     * @var string
     */
    public $type_kbn_cd;

    /**
     *
     * @var integer
     */
    public $ketasuu;

    /**
     *
     * @var integer
     */
    public $gyousuu;

    /**
     *
     * @var integer
     */
    public $shousuu;

    /**
     *
     * @var integer
     */
    public $tuika_max;

    /**
     *
     * @var string
     */
    public $memo;

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
        $this->belongsTo('shouhin_bunrui1_kbn_cd', 'ShouhinBunrui1Kbns', 'cd', array('alias' => 'ShouhinBunrui1Kbns'));
	}

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'joukenhyou_midasi_kbns';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return JoukenhyouMidasiKbns[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return JoukenhyouMidasiKbns
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

<?php

class JoukenUriageBunsekis extends \Phalcon\Mvc\Model
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
    public $junjo_kbn_cd;

    /**
     *
     * @var string
     */
    public $hanni_from;

    /**
     *
     * @var string
     */
    public $hanni_to;

    /**
     *
     * @var string
     */
    public $junjo2_kbn_cd;

    /**
     *
     * @var string
     */
    public $hanni2_from;

    /**
     *
     * @var string
     */
    public $hanni2_to;

    /**
     *
     * @var integer
     */
    public $koujun_flg;

    /**
     *
     * @var integer
     */
    public $meisaigyou_flg;

    /**
     *
     * @var integer
     */
    public $goukeigyou_flg;

    /**
     *
     * @var integer
     */
    public $torihikiari_flg;

    /**
     *
     * @var integer
     */
    public $torihikinashi_flg;

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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'jouken_uriage_bunsekis';
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('junjo_kbn_cd', 'JunjoKbns', 'cd', array('alias' => 'JunjoKbns'));
        $this->belongsTo('junjo2_kbn_cd', 'JunjoKbns', 'cd', array('alias' => 'Junjo2Kbns'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return JoukenUriageBunsekis[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return JoukenUriageBunsekis
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

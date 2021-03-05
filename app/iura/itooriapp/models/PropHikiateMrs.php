<?php

class PropHikiateMrs extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $指図番号;

    /**
     *
     * @var integer
     */
    public $指図枝番;

    /**
     *
     * @var string
     */
    public $加工№;

    /**
     *
     * @var integer
     */
    public $加工NO;

    /**
     *
     * @var string
     */
    public $単価;

    /**
     *
     * @var string
     */
    public $単価単位;

    /**
     *
     * @var string
     */
    public $糸名;

    /**
     *
     * @var string
     */
    public $糸名２;

    /**
     *
     * @var string
     */
    public $ロット;

    /**
     *
     * @var string
     */
    public $備考;

    /**
     *
     * @var string
     */
    public $出荷先;

    /**
     *
     * @var string
     */
    public $住所;

    /**
     *
     * @var string
     */
    public $電話;

    /**
     *
     * @var integer
     */
    public $ラベル形式;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'prop_hikiate_mrs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PropHikiateMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PropHikiateMrs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

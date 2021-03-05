<?php

class ShiiresakiTankaDts extends \Phalcon\Mvc\Model
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
    public $shiiresaki_mr_cd;

    /**
     *
     * @var string
     */
    public $shouhin_mr_cd;

    /**
     *
     * @var string
     */
    public $tanka;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var integer
     */
    public $sakusei_user_id;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     *
     * @var integer
     */
    public $kousin_user_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("smm");
        $this->setSource("shiiresaki_tanka_dts");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'shiiresaki_tanka_dts';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShiiresakiTankaDts[]|ShiiresakiTankaDts|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShiiresakiTankaDts|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function beforeCreate()
    {
        $this->created_at = date("Y-m-d H:i:s");
        $this->sakusei_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $this->updated_at = date("Y-m-d H:i:s");
        $this->kousin_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
    }

    public function beforeUpdate()
    {
        $this->updated_at = date("Y-m-d H:i:s");
        $this->kousin_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
    }
}
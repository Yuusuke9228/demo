<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class ReadonlyFieldKbns extends \Phalcon\Mvc\Model
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
    public $controller_cd;

    /**
     *
     * @var string
     */
    public $gamen_cd;

    /**
     *
     * @var string
     */
    public $riyou_user_id;

    /**
     *
     * @var string
     */
    public $field_cd;

    /**
     *
     * @var integer
     */
    public $readonly_flg;

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
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ReadonlyFieldKbns[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ReadonlyFieldKbns
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
        return 'readonly_field_kbns';
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

    /**
     * @param $controller_cd
     * @param $gamen_cd
     * @param null $riyou_user_id
     * @return array
     */
    public function getForm($controller_cd, $gamen_cd, $riyou_user_id=null)
    {
        if (!$riyou_user_id) {
            $riyou_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        }
        $readonly_field_kbns = parent::find([
            "conditions"=>"controller_cd = ?1 AND gamen_cd = ?2 AND riyou_user_id = ?3",
            "bind"=>[1=>$controller_cd, 2=>$gamen_cd, 3=>$riyou_user_id]
        ]);
        $readonlys=[];
        foreach ($readonly_field_kbns as $readonly_field_kbn) {
            $readonlys[$readonly_field_kbn->field_cd]=$readonly_field_kbn->readonly_flg?'readonly':null;
        }
        return $readonlys;
    }
}

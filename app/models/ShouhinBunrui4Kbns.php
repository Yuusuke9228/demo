<?php

class ShouhinBunrui4Kbns extends \Phalcon\Mvc\Model
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
        $this->hasMany('cd', 'ShouhinMrs', 'shouhin_bunrui4_kbn_cd', array('alias' => 'ShouhinMrs'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShouhinBunrui4Kbns[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShouhinBunrui4Kbns
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


/*    public function validation()
    {

        $validator = new Validation();
        $validator->add(
            'cd',
            new UniquenessValidator([
                'model' => $this,
                'message' => 'コードが既に登録されています。',
            ])
        );

        return $this->validate($validator);
    }
*/

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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'shouhin_bunrui4_kbns';
    }

}

<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class LoadKoumokuMrs extends \Phalcon\Mvc\Model
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
    public $load_mr_cd;

    /**
     *
     * @var integer
     */
    public $jun;

    /**
     *
     * @var string
     */
    public $koumoku_mr_cd;

    /**
     *
     * @var integer
     */
    public $keys;

    /**
     *
     * @var integer
     */
    public $fusiyou_kbn;

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
        $this->belongsTo('load_mr_cd', 'LoadMrs', 'cd', array('alias' => 'LoadMrs'));
        $this->belongsTo(array('load_mr_cd','koumoku_mr_cd'), 'KoumokuMrs', array('table_mr_cd','cd'), array('alias' => 'KoumokuMrs')); //‚Qs‚É‘‚­‚Æ AND ‚É‚È‚é‚ñ‚¾‚ÆI
        $this->hasMany(array('cd','load_mr_cd'), 'LoadHenkanMrs', array('load_koumoku_mr_cd','load_mr_cd'), array('alias' => 'LoadHenkanMrs'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return LoadKoumokuMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return LoadKoumokuMrs
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

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'load_koumoku_mrs';
    }

}

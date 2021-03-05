<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class ShouhinMrs extends \Phalcon\Mvc\Model
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
    public $kana;

    /**
     *
     * @var string
     */
    public $tanni_mr_cd;

    /**
     *
     * @var integer
     */
    public $irisuu;

    /**
     *
     * @var string
     */
    public $kikaku;

    /**
     *
     * @var string
     */
    public $iro;

    /**
     *
     * @var string
     */
    public $size;

    /**
     *
     * @var integer
     */
    public $suu_shousuu;

    /**
     *
     * @var integer
     */
    public $tanka_shousuu;

    /**
     *
     * @var integer
     */
    public $kazei_kbn_cd;

    /**
     *
     * @var integer
     */
    public $zaikokanri;

    /**
     *
     * @var string
     */
    public $hacchuu_lot;

    /**
     *
     * @var integer
     */
    public $lead_time;

    /**
     *
     * @var string
     */
    public $zaiko_tekisei;

    /**
     *
     * @var string
     */
    public $zaiko_hyouka_kbn_cd;

    /**
     *
     * @var string
     */
    public $shu_shiiresaki_mr_cd;

    /**
     *
     * @var string
     */
    public $shu_souko_mr_cd;

    /**
     *
     * @var integer
     */
    public $hacchuu_rendou;

    /**
     *
     * @var string
     */
    public $gen_zaiko;

    /**
     *
     * @var string
     */
    public $last_shukko_date;

    /**
     *
     * @var string
     */
    public $last_nyuuko_date;

    /**
     *
     * @var string
     */
    public $joudai;

    /**
     *
     * @var string
     */
    public $uri_tanka1;

    /**
     *
     * @var string
     */
    public $uri_tanka2;

    /**
     *
     * @var string
     */
    public $uri_tanka3;

    /**
     *
     * @var string
     */
    public $uri_tanka4;

    /**
     *
     * @var string
     */
    public $uri_genka;

    /**
     *
     * @var string
     */
    public $shiire_tanka;

    /**
     *
     * @var string
     */
    public $hyoujunn_genka;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui1_kbn_cd;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui2_kbn_cd;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui3_kbn_cd;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui4_kbn_cd;

    /**
     *
     * @var string
     */
    public $shouhin_bunrui5_kbn_cd;

    /**
     *
     * @var integer
     */
    public $sanshou_hyouji;

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
        $this->belongsTo('tanni_mr_cd', 'TanniMrs', 'cd', array('alias' => 'TanniMrs'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShouhinMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShouhinMrs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    public function validation()
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
        return 'shouhin_mrs';
    }

}

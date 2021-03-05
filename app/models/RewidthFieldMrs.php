<?php

class RewidthFieldMrs extends \Phalcon\Mvc\Model
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
     * @var integer
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
    public $haba;

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
        return 'rewidth_field_mrs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RewidthFieldMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RewidthFieldMrs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * 画面に項目幅をセットする
     */
    public function getForm($controller_cd, $gamen_cd, $riyou_user_id=null) // 利用ユーザID=nullなら呼ぶ前にクラスをnewせよ！
    {
        if (!$riyou_user_id) {
            $riyou_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        }
        $rewidth_field_mrs = parent::find([
            "conditions"=>"controller_cd = ?1 AND gamen_cd = ?2 AND riyou_user_id = ?3",
            "bind"=>[1=>$controller_cd, 2=>$gamen_cd, 3=>$riyou_user_id]
        ]);
        $rewidths=[];
        foreach ($rewidth_field_mrs as $rewidth_field_mr) {
            $rewidths[$rewidth_field_mr->field_cd]=$rewidth_field_mr->haba;
        }
        return $rewidths;
    }
}

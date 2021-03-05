<?php

use Phalcon\Mvc\Model\Relation;

class HSioriMrs extends \Phalcon\Mvc\Model
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
    public $moku;

    /**
     *
     * @var string
     */
    public $symd;

    /**
     *
     * @var string
     */
    public $kymd;

    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var string
     */
    public $irai;

    /**
     *
     * @var string
     */
    public $etnt;

    /**
     *
     * @var string
     */
    public $ktnt;

    /**
     *
     * @var string
     */
    public $kibo;

    /**
     *
     * @var string
     */
    public $inou;

    /**
     *
     * @var string
     */
    public $snou;

    /**
     *
     * @var string
     */
    public $tnou;

    /**
     *
     * @var string
     */
    public $ynou;

    /**
     *
     * @var string
     */
    public $anou;

    /**
     *
     * @var integer
     */
    public $tken;

    /**
     *
     * @var integer
     */
    public $yken;

    /**
     *
     * @var string
     */
    public $socd;

    /**
     *
     * @var integer
     */
    public $soth;

    /**
     *
     * @var integer
     */
    public $soyh;

    /**
     *
     * @var integer
     */
    public $htkb;

    /**
     *
     * @var integer
     */
    public $htho;

    /**
     *
     * @var integer
     */
    public $htsi;

    /**
     *
     * @var integer
     */
    public $hykb;

    /**
     *
     * @var integer
     */
    public $hyho;

    /**
     *
     * @var integer
     */
    public $ayma;

    /**
     *
     * @var string
     */
    public $aycd;

    /**
     *
     * @var integer
     */
    public $ayho;

    /**
     *
     * @var integer
     */
    public $ayme;

    /**
     *
     * @var string
     */
    public $shab;

    /**
     *
     * @var string
     */
    public $snag;

    /**
     *
     * @var string
     */
    public $osa;

    /**
     *
     * @var string
     */
    public $uti;

    /**
     *
     * @var integer
     */
    public $miha;

    /**
     *
     * @var integer
     */
    public $mihk;

    /**
     *
     * @var integer
     */
    public $miho;

    /**
     *
     * @var integer
     */
    public $jiha;

    /**
     *
     * @var integer
     */
    public $jihk;

    /**
     *
     * @var integer
     */
    public $dohk;

    /**
     *
     * @var integer
     */
    public $jiho;

    /**
     *
     * @var string
     */
    public $khab;

    /**
     *
     * @var string
     */
    public $knag;

    /**
     *
     * @var string
     */
    public $tiji;

    /**
     *
     * @var string
     */
    public $ahab;

    /**
     *
     * @var string
     */
    public $anag;

    /**
     *
     * @var string
     */
    public $auti;

    /**
     *
     * @var integer
     */
    public $jury;

    /**
     *
     * @var string
     */
    public $kkoh;

    /**
     *
     * @var string
     */
    public $nkoh;

    /**
     *
     * @var integer
     */
    public $tkoh;

    /**
     *
     * @var integer
     */
    public $ykoh;

    /**
     *
     * @var integer
     */
    public $dkoh;

    /**
     *
     * @var integer
     */
    public $skoh;

    /**
     *
     * @var string
     */
    public $nnfk;

    /**
     *
     * @var string
     */
    public $gjur;

    /**
     *
     * @var integer
     */
    public $ecod1;

    /**
     *
     * @var integer
     */
    public $ecod2;

    /**
     *
     * @var integer
     */
    public $ecod3;

    /**
     *
     * @var integer
     */
    public $ecod4;

    /**
     *
     * @var integer
     */
    public $ecod5;

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
        $this->hasMany('cd', 'HSisosikiMrs', 'h_siori_mr_cd', array('alias' => 'HSisosikiMrs', 'params'=>['order'=>'cd']));
        $this->hasMany('cd', 'HSinenMrs', 'h_siori_mr_cd', array('alias' => 'HSinenMrs', 'params'=>['order'=>'cd'], 'foreignKey' => ['action' => Relation::ACTION_CASCADE,]));
        $this->hasMany('cd', 'HSioriKonrituMrs', 'h_siori_mr_cd', array('alias' => 'HSioriKonrituMrs', 'params'=>['order'=>'cd'], 'foreignKey' => ['action' => Relation::ACTION_CASCADE]));
        $this->hasMany('cd', 'HSioriKakouMrs', 'h_siori_mr_cd', array('alias' => 'HSioriKakouMrs', 'params'=>['order'=>'cd'], 'foreignKey' => ['action' => Relation::ACTION_CASCADE,]));
        $this->hasMany('cd', 'HSioriJihonMrs', 'h_siori_mr_cd', array('alias' => 'HSioriJihonMrs', 'params'=>['order'=>'cd'], 'foreignKey' => ['action' => Relation::ACTION_CASCADE,]));
        $this->hasMany('cd', 'HSiitoMrs', 'h_siori_mr_cd', array('alias' => 'HSiitoMrs', 'params'=>['order'=>'cd'], 'foreignKey' => ['action' => Relation::ACTION_CASCADE,]));
        $this->hasMany('cd', 'HSihaireMrs', 'h_siori_mr_cd', array('alias' => 'HSihaireMrs', 'params'=>['order'=>'cd'], 'foreignKey' => ['action' => Relation::ACTION_CASCADE,]));
        $this->hasMany('cd', 'HSigenMrs', 'h_siori_mr_cd', array('alias' => 'HSigenMrs', 'params'=>['order'=>'cd'], 'foreignKey' => ['action' => Relation::ACTION_CASCADE,]));
        $this->hasMany('cd', 'HSichuiMrs', 'h_siori_mr_cd', array('alias' => 'HSichuiMrs', 'params'=>['order'=>'cd'], 'foreignKey' => ['action' => Relation::ACTION_CASCADE,]));
        $this->hasMany('cd', 'HSiayaMrs', 'h_siori_mr_cd', array('alias' => 'HSiayaMrs', 'params'=>['order'=>'cd'], 'foreignKey' => ['action' => Relation::ACTION_CASCADE,]));
        $this->belongsTo('etan', 'TantouMrs', 'cd', array('alias' => 'TantouMr'));
        $this->belongsTo('socd', 'HSioriMrs', 'cd', array('alias' => 'HSosikiMr'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'h_siori_mrs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HSioriMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HSioriMrs
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

    public function backOut($dlt_flg = 0)
    {
        $bak = new BakHSioriMrs(); // ‘‚«Š·‚¦–Y‚ê’ˆÓII
        foreach ($this as $fld=>$val) {
            if (substr($fld,0,1) != '_') {
               $bak->$fld = $this->$fld;
            }
        }
        $bak->id = NULL;
        $bak->id_moto = $this->id;
        $bak->hikae_dltflg = $dlt_flg;
        $bak->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak->hikae_nichiji = date("Y-m-d H:i:s");
        return $bak->save();
    }

}

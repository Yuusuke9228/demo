<?php

class BakHSioriMrs extends \Phalcon\Mvc\Model
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'bak_h_siori_mrs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHSioriMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakHSioriMrs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}

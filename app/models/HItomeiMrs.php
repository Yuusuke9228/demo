<?php

class HItomeiMrs extends \Phalcon\Mvc\Model
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
    public $eda;

    /**
     *
     * @var integer
     */
    public $ishu;

    /**
     *
     * @var integer
     */
    public $gumu;

    /**
     *
     * @var string
     */
    public $itme;

    /**
     *
     * @var string
     */
    public $ktak;

    /**
     *
     * @var string
     */
    public $kden;

    /**
     *
     * @var string
     */
    public $kfil;

    /**
     *
     * @var string
     */
    public $biko;

    /**
     *
     * @var string
     */
    public $itm2;

    /**
     *
     * @var string
     */
    public $meik;

    /**
     *
     * @var integer
     */
    public $dtex;

    /**
     *
     * @var string
     */
    public $rykg;

    /**
     *
     * @var string
     */
    public $shin;

    /**
     *
     * @var string
     */
    public $hana;

    /**
     *
     * @var string
     */
    public $turi;

    /**
     *
     * @var string
     */
    public $gaic;

    /**
     *
     * @var string
     */
    public $hnyk;

    /**
     *
     * @var string
     */
    public $bnam;

    /**
     *
     * @var string
     */
    public $symd;

    /**
     *
     * @var string
     */
    public $stnk;

    /**
     *
     * @var string
     */
    public $tate;

    /**
     *
     * @var integer
     */
    public $tank;

    /**
     *
     * @var integer
     */
    public $kohi;

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
     * @return HItomeiMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HItomeiMrs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


	public static function Itozs04($ik = null)
	{
		$data = "";
		if (!$ik) {return $data;}
		if ($ik->ishu == 1 || $ik->ishu == 2) {
			if ($ik->meik) {$data .= $ik->meik.' ';}
			$data .= $ik->itme;
			if ($ik->itm2) {$data .= ' '.$ik->itm2;}
			if ($ik->dtex) {$data .= '<'.$ik->dtex.'>';}
			if ($ik->ktak) {$data .= ' '.$ik->ktak;}
			if ($ik->kden) {$data .= ' '.$ik->kden;}
			$data .= '/';
			if ($ik->kfil) {$data .= ' '.$ik->kfil;}
			if ($ik->biko) {$data .= ' '.$ik->biko;}
		} else if ($ik->ishu == 3) {
			$data .= $ik->shin;
			if ($ik->hana) {$data .= ':'.$ik->hana;}
			if ($ik->turi) {$data .= ':'.$ik->turi;}
			if ($ik->gaik) {$data .= ':'.$ik->gaik;}
			if ($ik->hnyk) {$data .= ' '.$ik->hnyk;}
		}
		return $data;
	}

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'h_itomei_mrs';
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

}

<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Controller;

class NavigatorsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        //クッキーが以前にセットされているかどうかチェック
        if ($this->cookies->has('')) {
            //クッキーの取得
            $erphNavis = $this->cookies->get('erph_navis');
            //クッキーの値を取得
            $erph_navis = $erphNavis->getValue();
        } else {
            $erph_navis="dounyuu";
        }
        $this->dispatcher->forward(array(
            'controller' => "navigators",
            'action' => $erph_navis
        ));
    }

    /**
     * 導入
     */
    public function dounyuuAction()
    {
        $this->cookies->set('erph_navis', 'dounyuu', time() + 15 * 86400);
    }

    /**
     * 売上
     */
    public function uriageAction()
    {
        $this->cookies->set('erph_navis', 'uriage', time() + 15 * 86400);
    }

    /**
     * 売上レポート
     */
    public function uriagerepoAction()
    {
        $this->cookies->set('erph_navis', 'uriagerepo', time() + 15 * 86400);
    }

    /**
     * 仕入
     */
    public function shiireAction()
    {
        $this->cookies->set('erph_navis', 'shiire', time() + 15 * 86400);
    }

    /**
     * 在庫
     */
    public function zaikoAction()
    {
        $this->cookies->set('erph_navis', 'zaiko', time() + 15 * 86400);
    }

    /**
     * 仕入在庫レポート
     */
    public function shiirezaikorepoAction()
    {
        $this->cookies->set('erph_navis', 'shiirezaikorepo', time() + 15 * 86400);
    }

    /**
     * 事業所データ
     */
    public function jigyoushoAction()
    {
        $this->cookies->set('erph_navis', 'jigyousho', time() + 15 * 86400);
    }


}

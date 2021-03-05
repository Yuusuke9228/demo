<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class NounyuusakiMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
		ControllerBase::indexCd("NounyuusakiMrs", "納入先台帳");
    }

    /**
     * モーダル
     */
    public function modalAction()
    {
		ControllerBase::indexCd("NounyuusakiMrs", "納入先台帳");
    }

    /**
     * Searches for nounyuusaki_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
		ControllerBase::nextCd($id, "nounyuusaki_mrs", "NounyuusakiMrs", "納入先台帳");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id = 0)
    {
		ControllerBase::prevCd($id, "nounyuusaki_mrs", "NounyuusakiMrs", "納入先台帳");
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="Nounyuusaki")
    {

        if ($id) {
        	$nameMrs = $dataname."Mrs";
            $nounyuusaki_mr = $nameMrs::findFirstByid($id);
            if (!$nounyuusaki_mr) {
                $this->flash->error($dataname."台帳が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "nounyuusaki_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($nounyuusaki_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", "?".$nounyuusaki_mr->cd);
            $this->tag->setDefault("sakusei_user_id", null);
            $this->tag->setDefault("created", null);
            $this->tag->setDefault("kousin_user_id", null);
            $this->tag->setDefault("updated", null);
        }
	}

    /**
     * Edits a nounyuusaki_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $nounyuusaki_mr = NounyuusakiMrs::findFirstByid($id);
            if (!$nounyuusaki_mr) {
                $this->flash->error("納入先マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "nounyuusaki_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $nounyuusaki_mr->id;

            $this->_setDefault($nounyuusaki_mr, "edit");
        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($nounyuusaki_mr, $action="edit", $meisai="Nounyuusaki")
    {
		$setdts = [
            "id",
            "cd",
            "name",
            "kana",
            "ryakushou",
            "yuubin_bangou",
            "juusho1",
            "juusho2",
            "bushomei",
            "yakushoku",
            "gotantousha",
            "keishou",
            "tel",
            "fax",
            "tokuisaki_mr_cd",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated"
		];
		foreach ($setdts as $setdt) {
			if (property_exists($nounyuusaki_mr, $setdt)) {
				$this->tag->setDefault($setdt, $nounyuusaki_mr->$setdt);
			}
		}
	}

    /**
     * Creates a new nounyuusaki_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nounyuusaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        $nounyuusaki_mr = new NounyuusakiMrs();
        $post_flds = [
        	"cd",
        	"name",
        	"kana",
        	"ryakushou",
        	"yuubin_bangou",
        	"juusho1",
        	"juusho2",
        	"bushomei",
        	"yakushoku",
        	"gotantousha",
        	"keishou",
        	"tel",
        	"fax",
        	"tokuisaki_mr_cd",
        	"updated",
        ];
        foreach ($post_flds as $post_fld) {
            $nounyuusaki_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$nounyuusaki_mr->save()) {
            foreach ($nounyuusaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nounyuusaki_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("納入先マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nounyuusaki_mrs",
            'action' => 'edit',
            'params' => array($nounyuusaki_mr->id)
        ));
    }

    /**
     * Saves a nounyuusaki_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "nounyuusaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $nounyuusaki_mr = NounyuusakiMrs::findFirstByid($id);

        if (!$nounyuusaki_mr) {
            $this->flash->error("納入先マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "nounyuusaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = [
        	"cd",
        	"name",
        	"kana",
        	"ryakushou",
        	"yuubin_bangou",
        	"juusho1",
        	"juusho2",
        	"bushomei",
        	"yakushoku",
        	"gotantousha",
        	"keishou",
        	"tel",
        	"fax",
        	"tokuisaki_mr_cd",
        	"updated",
        ];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($nounyuusaki_mr->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "nounyuusaki_mrs",
                "action" => "edit",
                "params" => array($nounyuusaki_mr->id)
            ));

            return;
        }

        $this->_bakOut($nounyuusaki_mr);

        foreach ($post_flds as $post_fld) {
            $nounyuusaki_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$nounyuusaki_mr->save()) {

            foreach ($nounyuusaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nounyuusaki_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("納入先マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "nounyuusaki_mrs",
            'action' => 'edit',
            'params' => array($nounyuusaki_mr->id)
        ));
    }

    /**
     * Deletes a nounyuusaki_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $nounyuusaki_mr = NounyuusakiMrs::findFirstByid($id);
        if (!$nounyuusaki_mr) {
            $this->flash->error("納入先マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "nounyuusaki_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$nounyuusaki_mr->delete()) {

            foreach ($nounyuusaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "nounyuusaki_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($nounyuusaki_mr, 1);

        $this->flash->success("納入先マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "nounyuusaki_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a nounyuusaki_mr
     *
     * @param string $nounyuusaki_mr, $dlt_flg
     */
    public function _bakOut($nounyuusaki_mr, $dlt_flg = 0)
    {

        $bak_nounyuusaki_mr = new BakNounyuusakiMrs();
        foreach ($nounyuusaki_mr as $fld => $value) {
            $bak_nounyuusaki_mr->$fld = $nounyuusaki_mr->$fld;
        }
        $bak_nounyuusaki_mr->id = NULL;
        $bak_nounyuusaki_mr->id_moto = $nounyuusaki_mr->id;
        $bak_nounyuusaki_mr->hikae_dltflg = $dlt_flg;
        $bak_nounyuusaki_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_nounyuusaki_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_nounyuusaki_mr->save()) {
            foreach ($bak_nounyuusaki_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /*
     * カナを取得 Add By Nishiyama 2019-10-23
     */
    public function ajaxGetHuriganaAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) echo "Request is not Ajax!";
        if (!$this->request->isPost()) echo "Request is not Post!";
        $mecab = \Phalcon\DI::getDefault()->get('mecab');
        $input_data = $this->request->getPost('input');
        $res = $mecab->mecab_parse($input_data);
        $yomi = $mecab->return_kana($res);
        $res_data = ['kana' => $yomi];
        $response->setContent(json_encode($res_data));
        return $response;
    }

	public function ajaxGetAction()
	{
	    $this->view->disable();

	    //Create a response instance
	    $response = new \Phalcon\Http\Response();

        if (!$this->request->isAjax()) {
            echo "is not Ajax ! ";
        //    return;
        }
        if (!$this->request->isPost()) {
            echo "is not Post ! ";
        //    return;
        }

	    $nounyuusaki_mrs = NounyuusakiMrs::find(array(
//	        'columns' => array('cd, name'), 全項目とする
	        'order' => 'cd',
	        'conditions' => ' cd LIKE ?1 ',
	        'bind' => array(1 => $this->request->getPost('cd').'%')
	    ));
        $res_flds = ["id","cd","name","ryakushou","bushomei","yakushoku","gotantousha","keishou",];
	    $resData = array();
	    foreach ($nounyuusaki_mrs as $nounyuusaki_mr) {
	        $resAdata = array();
	        foreach ($res_flds as $res_fld) {
	            $resAdata[$res_fld] = $nounyuusaki_mr->$res_fld;
	        }
	        //$resAdata['seikyuusaki_name'] = $nounyuusaki_mr->SeikyuusakiMrs->name;
            $resAdata['seikyuusaki_name'] = $nounyuusaki_mr->name;
	        $resData[] = $resAdata;//array('cd' => $nounyuusaki_mr->cd, 'name' => $nounyuusaki_mr->name);
	    }

	    //Set the content of the response
	    $response->setContent(json_encode($resData));

	    //Return the response
	    return $response;
	}

}

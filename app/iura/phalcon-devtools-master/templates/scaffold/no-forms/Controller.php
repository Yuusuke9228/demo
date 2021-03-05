<?php
$namespace$
$useFullyQualifiedModelName$

class $className$Controller extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
		ControllerBase::indexCd("$className$", "$nsingular$"); //簡易検索付き一覧表示
    }

    /**
     * Searches for $plural$
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="$className$")
    {
        $this->view->imax = 0;

        if ($id) {
        	$nameDts = $dataname;
            $singularVar$ = $nameDts::findFirstByid($id);
            if (!$singularVar$) {
                $this->flash->error("$nsingular$が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "$plural$",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($singularVar$, "new", $dataname);
            $this->tag->setDefault("$pk$", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
		ControllerBase::nextCd($id, "$plural$", "$className$", "$nsingular$");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
		ControllerBase::prevCd($id, "$plural$", "$className$", "$nsingular$");
    }

    /**
     * Edits a $singular$
     *
     * @param string $pkVar$
     */
    public function editAction($pkVar$)
    {
//        if (!$this->request->isPost()) {

            $singularVar$ = $className$::findFirstBy$pk$($pkVar$);
            if (!$singularVar$) {
                $this->flash->error("$nsingular$が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "$plural$",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->$pk$ = $singularVar$->$pk$;

            $this->_setDefault($singularVar$, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($singularVar$, $action="edit", $meisai="$className$")
    {
		$assignTagDefaults$
		foreach ($setdts as $setdt) {
			if (property_exists($singularVar$, $setdt)) {
				$this->tag->setDefault($setdt, $singularVar$->$setdt);
			}
		}
	}

    /**
     * Creates a new $singular$
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "$plural$",
                'action' => 'index'
            ));

            return;
        }

        $singularVar$ = new $className$();

        $post_flds = [];
        $assignInputFromRequestCreate$

        $thisPost=[];
        foreach ($post_flds as $post_fld) {
            $singularVar$->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$singularVar$->save()) {
            foreach ($singularVar$->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "$plural$",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("$nsingular$の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "$plural$",
            'action' => 'edit',
            'params' => array($singularVar$->$pk$)
        ));
    }

    /**
     * Saves a $singular$ edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "$plural$",
                'action' => 'index'
            ));

            return;
        }

        $pkVar$ = $this->request->getPost("$pk$");
        $singularVar$ = $className$::findFirstBy$pk$($pkVar$);

        if (!$singularVar$) {
            $this->flash->error("$nsingular$が見つからなくなりました。" . $pkVar$);

            $this->dispatcher->forward(array(
                'controller' => "$plural$",
                'action' => 'index'
            ));

            return;
        }

        if ($singularVar$->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから$nsingular$が変更されたため更新を中止しました。"
                . $pkVar$ . ",uid=" . $singularVar$->kousin_user_id . " tb=" . $singularVar$->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "$plural$",
                'action' => 'edit',
                'params' => array($pkVar$)
            ));

            return;
        }

        $post_flds = [];
        $assignInputFromRequestUpdate$

        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $singularVar$->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $pkVar$);

            $this->dispatcher->forward(array(
                "controller" => "$plural$",
                "action" => "edit",
                "params" => array($singularVar$->$pk$)
            ));

            return;
        }

        $this->_bakOut($singularVar$, 0, $chg_flgs);

        $thisPost=[];
        foreach ($post_flds as $post_fld) {
            $singularVar$->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$singularVar$->save()) {

            foreach ($singularVar$->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "$plural$",
                'action' => 'edit',
                'params' => array($pkVar$)
            ));

            return;
        }

        $this->flash->success("$nsingular$の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "$plural$",
            'action' => 'edit',
            'params' => array($singularVar$->$pk$)
        ));
    }

    /**
     * Deletes a $singular$
     *
     * @param string $pkVar$
     */
    public function deleteAction($pkVar$)
    {
        $singularVar$ = $className$::findFirstBy$pk$($pkVar$);
        if (!$singularVar$) {
            $this->flash->error("$nsingular$が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "$plural$",
                'action' => 'index'
            ));

            return;
        }

        if (!$singularVar$->delete()) {

            foreach ($singularVar$->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "$plural$",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($singularVar$, 1);

        $this->flash->success("$nsingular$の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "$plural$",
            'action' => "index"
        ));
    }

    /**
     * Back Out a $singular$
     *
     * @param string $singularVar$, $dlt_flg
     */
    public function _bakOut($singularVar$, $dlt_flg = 0)
    {

        $bak_$singular$ = new Bak$className$();
        foreach ($singularVar$ as $fld => $value) {
            $bak_$singular$->$fld = $singularVar$->$fld;
        }
        $bak_$singular$->$pk$ = NULL;
        $bak_$singular$->$pk$_moto = $singularVar$->$pk$;
        $bak_$singular$->hikae_dltflg = $dlt_flg;
        $bak_$singular$->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_$singular$->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_$singular$->save()) {
            foreach ($bak_$singular$->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}

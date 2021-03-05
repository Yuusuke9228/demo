<?php
 


class JoukenhyouMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("JoukenhyouMrs", "条件台帳"); //簡易検索付き一覧表示
    }

    /**
     * Searches for joukenhyou_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="JoukenhyouMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $joukenhyou_mr = $nameDts::findFirstByid($id);
            if (!$joukenhyou_mr) {
                $this->flash->error("条件台帳が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "joukenhyou_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($joukenhyou_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "joukenhyou_mrs", "JoukenhyouMrs", "条件台帳");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "joukenhyou_mrs", "JoukenhyouMrs", "条件台帳");
    }

    /**
     * Edits a joukenhyou_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $joukenhyou_mr = JoukenhyouMrs::findFirstByid($id);
            if (!$joukenhyou_mr) {
                $this->flash->error("条件台帳が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "joukenhyou_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $joukenhyou_mr->id;

            $this->_setDefault($joukenhyou_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($joukenhyou_mr, $action="edit", $meisai="JoukenhyouMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "suuti",
            "shouhin_mr_cd",
            "midasi_cd",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
            ];
            
        foreach ($setdts as $setdt) {
            if (property_exists($joukenhyou_mr, $setdt)) {
                $this->tag->setDefault($setdt, $joukenhyou_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new joukenhyou_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $joukenhyou_mr = new JoukenhyouMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "suuti",
            "shouhin_mr_cd",
            "midasi_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $joukenhyou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$joukenhyou_mr->save()) {
            foreach ($joukenhyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("条件台帳の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "joukenhyou_mrs",
            'action' => 'edit',
            'params' => array($joukenhyou_mr->id)
        ));
    }

    /**
     * Saves a joukenhyou_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $joukenhyou_mr = JoukenhyouMrs::findFirstByid($id);

        if (!$joukenhyou_mr) {
            $this->flash->error("条件台帳が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($joukenhyou_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから条件台帳が変更されたため更新を中止しました。"
                . $id . ",uid=" . $joukenhyou_mr->kousin_user_id . " tb=" . $joukenhyou_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "suuti",
            "shouhin_mr_cd",
            "midasi_cd",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $joukenhyou_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "joukenhyou_mrs",
                "action" => "edit",
                "params" => array($joukenhyou_mr->id)
            ));

            return;
        }

        $this->_bakOut($joukenhyou_mr);

        foreach ($post_flds as $post_fld) {
            $joukenhyou_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$joukenhyou_mr->save()) {

            foreach ($joukenhyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("条件台帳の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "joukenhyou_mrs",
            'action' => 'edit',
            'params' => array($joukenhyou_mr->id)
        ));
    }

    /**
     * Deletes a joukenhyou_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $joukenhyou_mr = JoukenhyouMrs::findFirstByid($id);
        if (!$joukenhyou_mr) {
            $this->flash->error("条件台帳が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($joukenhyou_mr, 1);

        if (!$joukenhyou_mr->delete()) {

            foreach ($joukenhyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("条件台帳の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "joukenhyou_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a joukenhyou_mr
     *
     * @param string $joukenhyou_mr, $dlt_flg
     */
    public function _bakOut($joukenhyou_mr, $dlt_flg = 0)
    {

        $bak_joukenhyou_mr = new BakJoukenhyouMrs();
        foreach ($joukenhyou_mr as $fld => $value) {
            $bak_joukenhyou_mr->$fld = $joukenhyou_mr->$fld;
        }
        $bak_joukenhyou_mr->id = NULL;
        $bak_joukenhyou_mr->id_moto = $joukenhyou_mr->id;
        $bak_joukenhyou_mr->hikae_dltflg = $dlt_flg;
        $bak_joukenhyou_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_joukenhyou_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_joukenhyou_mr->save()) {
            foreach ($bak_joukenhyou_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * 条件台帳を表示・変更・作成<!-- まだ、数値フィールドはつかえないし、追加行もつかえない。 -->
     *
     * @param string $id ＝商品マスターのID
     */
    public function editgAction($id,$new,$newid)
    {
//        if (!$this->request->isPost()) {

            if (!$id) {
            	return;
            }
            $shouhin_mr = ShouhinMrs::findFirstByid($id);
            if (!$shouhin_mr) {
                $this->flash->error("商品台帳が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "shouhin_mrs",
                    'action' => 'index'
                ));

                return;
            }
			if ($new=="new") {
				if ($newid) {
					$new_shouhin_mr = ShouhinMrs::findFirstByid($newid);
					if (!$new_shouhin_mr) {
						$this->flash->error("複写先商品台帳が見つかりません。");
						$this->dispatcher->forward(array(
							'controller' => "joukenhyou_mrs",
							'action' => 'editg',
							'params' => array($shouhin_mr->id,'new')
						));
						return;
					} else {
						$this->view->id = $newid;
						$this->tag->setDefault("id", $newid);
						$this->tag->setDefault("shouhin_mr_cd", $new_shouhin_mr->cd);
						$this->tag->setDefault("shouhin_mr_name", $new_shouhin_mr->name);
					}
				} else {
					$this->view->id = "";
					$this->tag->setDefault("id", "");
					$this->tag->setDefault("shouhin_mr_cd", "-".$shouhin_mr->cd);
					$this->tag->setDefault("shouhin_mr_name", "");
				}
			} else {
				$this->view->id = $id;
				$this->tag->setDefault("id", $id);
				$this->tag->setDefault("shouhin_mr_cd", $shouhin_mr->cd);
				$this->tag->setDefault("shouhin_mr_name", $shouhin_mr->name);
			}


			$midasis=[];
			foreach ($shouhin_mr->ShouhinBunrui1Kbns->JoukenhyouMidasiKbns as $midasi) {
				$m=$midasi->cd;
				$midasis[$m]=[];
				$midasis[$m]["name"]=$midasi->name;
				$midasis[$m]["ketasuu"]=$midasi->ketasuu;
				$midasis[$m]["gyousuu"]=$midasi->gyousuu;
				$midasis[$m]["type_kbn_cd"]=$midasi->type_kbn_cd;
				$midasis[$m]["tuika_max"]=$midasi->tuika_max;
			}//最後の$mは最大値
            $this->view->midasis = $midasis;
			$i=1;//行番
			$j=1;//見出しキー
			$midasi_cds=[];
			foreach ($shouhin_mr->JoukenhyouMrs as $naiyou) {
				for (; $j < $naiyou->midasi_cd; $j++) {
					if ($j != $midasi_cds[$i - 1]) {
						$this->tag->setDefault("data[meisais][".$i."][name]", "");
						$midasi_cds[$i++] = $j;
					}
				}
				if ($j == $naiyou->midasi_cd) {
					$midasi_cds[$i]=$j;
					$this->tag->setDefault("data[meisais][".$i."][id]", $new=="new"?"":$naiyou->id);
					$this->tag->setDefault("data[meisais][".$i."][name]", $naiyou->name);
					$this->tag->setDefault("data[meisais][".$i."][midasi_cd]", $naiyou->midasi_cd);
					$this->tag->setDefault("data[meisais][".$i."][updated]", $naiyou->updated);
					$i++;
				}
			}
			if ($j == $midasi_cds[$i - 1]) {$j++;}
			for (; $j <= $m; $j++) {
				$midasi_cds[$i] = $j;
				$this->tag->setDefault("data[meisais][".$i++."][name]", "");
			}
            $this->view->midasi_cds = $midasi_cds;
			
//        }
    }

    /**
     * 条件台帳容を　変更・作成　で　更新・追加・削除<!-- まだ、数値フィールドはつかえないし、追加行もつかえない。 -->
     *
     */
    public function savegAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        if (!$id) {
            $this->flash->error("商品を指定してください。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "joukenhyou_mrs",
                'action' => 'editg'
            ));

            return;
        }
        $shouhin_mr = ShouhinMrs::findFirstByid($id);

        if (!$shouhin_mr) {
            $this->flash->error("商品台帳が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'index'
            ));

            return;
        }
		$meisai = $this->request->getPost("data");
			//echo "<pre>";print_r($meisai);echo "</pre>";
		$id_keys=[];
		$i = 1;
		$all_space = 1;
		foreach ($meisai["meisais"] as $meisai1) {
			if ($meisai1["id"]) {
				$id_keys[$meisai1["id"]]=$i++;
			}
			if ($meisai1["name"]!="") {
				$all_space = 0;
			}
		}
			//echo "id_keys<pre>";print_r($id_keys);echo "</pre>";
		if ($all_space == 1) { // 全空白にしたら…
			if (count($shouhin_mr->JoukenhyouMrs) == 0) {
				$this->flash->error("入力がありません。" . $id);
			} else { // 全削除
				foreach ($shouhin_mr->JoukenhyouMrs as $joukenhyou_mr) {
				//	$joukenhyou_mr = JoukenhyouMrs::findFirstByid($joukenhyou_mr->id);
					$this->_bakOut($joukenhyou_mr, 1);
					if (!$joukenhyou_mr->delete()) {
						foreach ($joukenhyou_mr->getMessages() as $message) {
							$this->flash->error($message);
						}
					}
				}
				$this->flash->success("条件台帳の情報を削除しました。");
			}
			$this->dispatcher->forward(array(
				"controller" => "joukenhyou_mrs",
				"action" => "editg",
				"params" => array($id)
			));
			return; // ここで戻る。
		}
					// echo "<br>".$i." : ".count($shouhin_mr->JoukenhyouMrs);return;
		$chg_flg = 0;
		if ($i - 1 != count($shouhin_mr->JoukenhyouMrs)) {$chg_flg = 1;}
		if ($all_space == 0 && count($shouhin_mr->JoukenhyouMrs) == 0) {$chg_flg = 1;}
		if ($chg_flg == 0) {
			foreach ($shouhin_mr->JoukenhyouMrs as $joukenhyou_mr) {
				if (array_key_exists($joukenhyou_mr->id, $id_keys)) {
					if ($joukenhyou_mr->name !== $meisai["meisais"][$id_keys[$joukenhyou_mr->id]]["name"]) {
						$chg_flg = 1;
						if ($joukenhyou_mr->updated !== $meisai["meisais"][$id_keys[$joukenhyou_mr->id]]["updated"]) {
							$this->flash->error("他のプロセスから条件台帳が変更されたため更新を中止しました。". $id
							 . ",uid=" . $joukenhyou_mr->kousin_user_id . " tb=" . $joukenhyou_mr->updated ." pt=" . $this->request->getPost("updated"));
							$this->dispatcher->forward(array(
								'controller' => "joukenhyou_mrs",
								'action' => 'editg',
								'params' => array($id)
							));
							return;
						}
					}
				} else {
					$chg_flg = 1;
				}
			}
		}
        if ($chg_flg == 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "joukenhyou_mrs",
                "action" => "editg",
                "params" => array($shouhin_mr->id)
            ));
            return;
        }

		foreach ($shouhin_mr->JoukenhyouMrs as $joukenhyou_mr) {
			if (array_key_exists($joukenhyou_mr->id, $id_keys)) { // 更新分
				if ($joukenhyou_mr->name !== $meisai["meisais"][$id_keys[$joukenhyou_mr->id]]["name"]) {
				//	$joukenhyou_mr = JoukenhyouMrs::findFirstByid($shouhin_jouken_dt->id);
					$this->_bakOut($joukenhyou_mr);
					$joukenhyou_mr->name = $meisai["meisais"][$id_keys[$joukenhyou_mr->id]]["name"];
					if (!$joukenhyou_mr->save()) {
						foreach ($joukenhyou_mr->getMessages() as $message) {
							$this->flash->error($message);
						}
					}
				}
			} else { // 削除分、通常ありえない、見出しを削除したときのみ。
				$this->_bakOut($joukenhyou_mr, 1);
				if (!$joukenhyou_mr->delete()) {
					foreach ($joukenhyou_mr->getMessages() as $message) {
						$this->flash->error($message);
					}
				}
			}
		}
		// ここから、新規追加分
				//echo "<pre>";print_r($meisai);echo "</pre>";return;
		foreach ($meisai["meisais"] as $meisai1) {
			if (!$meisai1["id"]) {
				$joukenhyou_mr = new JoukenhyouMrs();
				$joukenhyou_mr->name = $meisai1["name"];
				$joukenhyou_mr->cd = $i++;
				$joukenhyou_mr->shouhin_mr_cd = $shouhin_mr->cd;
				$joukenhyou_mr->midasi_cd = $meisai1["midasi_cd"];
				if (!$joukenhyou_mr->save()) {
					foreach ($joukenhyou_mr->getMessages() as $message) {
						$this->flash->error($message);
					}
				}
			}
		}


        $this->flash->success("条件台帳の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "joukenhyou_mrs",
            'action' => 'editg',
            'params' => array($shouhin_mr->id)
        ));
    }
    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。共通部分
     */
    public function  nextgAction($id, $table_id="shouhin_mrs", $TableId="ShouhinMrs", $table_name="商品台帳", $key = 'cd') // 例：ControllerBase::nextCd($id, "uriage_dts", "UriageDts", "売上伝票")
    {
        if (!$this->request->isPost()) {
            $tblrow = $TableId::findFirstByid($id);
            if (!$tblrow) {
                $this->flash->error($table_name."が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => $table_id,
                    'action' => 'index'
                ));

                return;
            }
            $tblrow = $TableId::findFirst([$key." > :cd:", "bind"=>["cd"=>$tblrow->$key], "order"=>$key]);
            if (!$tblrow) {
                $this->flash->warning($table_name."の最後です。");

                $this->dispatcher->forward(array(
                    'controller' => 'joukenhyou_mrs',
                    'action' => 'editg',
                    'params' => array($id)
                ));

                return;
            }
            $this->response->redirect("joukenhyou_mrs/editg/".$tblrow->id);
/*            $this->dispatcher->forward(array( // redirectの方が良いかも
                'controller' => 'joukenhyou_mrs',
                'action' => 'editg',
                'params' => array($tblrow->id)
            ));
*/
        }
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。共通部分
     */
    public function  prevgAction($id, $table_id="shouhin_mrs", $TableId="ShouhinMrs", $table_name="商品台帳", $key = 'cd') // 例：ControllerBase::prevCd($id, "uriage_dts", "UriageDts", "売上伝票")
    {
        if (!$this->request->isPost()) {
            $tblrow = $TableId::findFirstByid($id);
            if (!$tblrow) {
                $this->flash->error($table_name."が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => $table_id,
                    'action' => 'index'
                ));

                return;
            }
            $tblrow = $TableId::findFirst([$key." < :cd:", "bind"=>["cd"=>$tblrow->$key], "order"=>$key." DESC"]);
            if (!$tblrow) {
                $this->flash->warning($table_name."の最初です。");

                $this->dispatcher->forward(array(
                    'controller' => 'joukenhyou_mrs',
                    'action' => 'editg',
                    'params' => array($id)
                ));

                return;
            }
            $this->response->redirect("joukenhyou_mrs/editg/".$tblrow->id);
/*            $this->dispatcher->forward(array( // redirectの方が良いかも
                'controller' => 'joukenhyou_mrs',
                'action' => 'editg',
                'params' => array($tblrow->id)
            ));
*/
        }
    }

    /**
     * 条件台帳容を　変更・作成　で　更新・追加・削除<!-- まだ、数値フィールドはつかえないし、追加行もつかえない。 -->
     *
     */
    public function deletegAction($id)
    {
        $shouhin_mr = ShouhinMrs::findFirstByid($id);

        if (!$shouhin_mr) {
            $this->flash->error("商品台帳が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "shouhin_mrs",
                'action' => 'index'
            ));

            return;
        }
		foreach ($shouhin_mr->JoukenhyouMrs as $joukenhyou_mr) {
			$this->_bakOut($joukenhyou_mr, 1);
			if (!$joukenhyou_mr->delete()) {
				foreach ($joukenhyou_mr->getMessages() as $message) {
					$this->flash->error($message);
				}
			}
		}
		$this->flash->success("条件台帳の情報を削除しました。");
		$this->dispatcher->forward(array(
			'controller' => 'joukenhyou_mrs',
			'action' => 'editg',
			'params' => array($shouhin_mr->id)
		));
    }

}

<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class LoadMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'LoadMrs', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "cd";

        $load_mrs = LoadMrs::find($parameters);
        if (count($load_mrs) == 0) {
            $this->flash->notice("検索の結果、ロードマスタは０件でした。");
        }

        $paginator = new Paginator(array(
            'data' => $load_mrs,
            'limit'=> 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for load_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a load_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $load_mr = LoadMrs::findFirstByid($id);
            if (!$load_mr) {
                $this->flash->error("ロードマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "load_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $load_mr->id;

            $this->tag->setDefault("id", $load_mr->id);
            $this->tag->setDefault("cd", $load_mr->cd);
            $this->tag->setDefault("name", $load_mr->name);
            $this->tag->setDefault("table_mr_cd", $load_mr->table_mr_cd);
            $this->tag->setDefault("file_name", $load_mr->file_name);
            $this->tag->setDefault("skip", $load_mr->skip);
            $this->tag->setDefault("uwagaki", $load_mr->uwagaki);
            $this->tag->setDefault("id_moto", $load_mr->id_moto);
            $this->tag->setDefault("hikae_dltflg", $load_mr->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $load_mr->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $load_mr->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $load_mr->sakusei_user_id);
            $this->tag->setDefault("created", $load_mr->created);
            $this->tag->setDefault("kousin_user_id", $load_mr->kousin_user_id);
            $this->tag->setDefault("updated", $load_mr->updated);
            
            $this->view->load_koumoku_mrs = $load_mr->LoadKoumokuMrs;
//        }
    }

    /**
     * Creates a new load_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }

        $load_mr = new LoadMrs();
        $post_flds = ["cd","name","table_mr_cd","file_name","skip","uwagaki","updated",];
        foreach ($post_flds as $post_fld) {
            $load_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$load_mr->save()) {
            foreach ($load_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("ロードマスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_mrs",
            'action' => 'edit',
            'params' => array($load_mr->id)
        ));
    }

    /**
     * Saves a load_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $load_mr = LoadMrs::findFirstByid($id);

        if (!$load_mr) {
            $this->flash->error("ロードマスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }

        $post_flds = ["cd","name","table_mr_cd","file_name","skip","uwagaki","updated",];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($load_mr->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "load_mrs",
                "action" => "edit",
                "params" => array($load_mr->id)
            ));

            return;
        }

        $this->_bakOut($load_mr);

        foreach ($post_flds as $post_fld) {
            $load_mr->$post_fld = $this->request->getPost($post_fld);
        }
        

        if (!$load_mr->save()) {

            foreach ($load_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'edit',
                'params' => array($load_mr->id)
            ));

            return;
        }

        $this->flash->success("ロードマスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_mrs",
            'action' => 'edit',
            'params' => array($id)
        ));
    }

    /**
     * Deletes a load_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $load_mr = LoadMrs::findFirstByid($id);
        if (!$load_mr) {
            $this->flash->error("ロードマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$load_mr->delete()) {

            foreach ($load_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($load_mr, 1);

        $this->flash->success("ロードマスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a load_mr
     *
     * @param string $load_mr, $dlt_flg
     */
    public function _bakOut($load_mr, $dlt_flg = 0)
    {

        $bak_load_mr = new BakLoadMrs();
        foreach ($load_mr as $fld => $value) {
            $bak_load_mr->$fld = $load_mr->$fld;
        }
        $bak_load_mr->id = NULL;
        $bak_load_mr->id_moto = $load_mr->id;
        $bak_load_mr->hikae_dltflg = $dlt_flg;
        $bak_load_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_load_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_load_mr->save()) {
            foreach ($bak_load_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * Autogens a load_mr
     *
     */
    public function autogenAction()
    {
        $table_mrs = TableMrs::find();
        foreach ($table_mrs as $table_mr) {
            $load_mr = LoadMrs::findfirst(array("cd = '".$table_mr->cd."'",));
            if (!$load_mr) {
                $load_mr = new LoadMrs();
                $load_mr->cd = $table_mr->cd;
            }
            $load_mr->name = $table_mr->name;
            $load_mr->table_mr_cd = $table_mr->cd;
            $load_mr->file_name = $table_mr->name.".csv";
            if (!$load_mr->save()) {
                foreach ($load_mr->getMessages() as $message) {
                    $this->flash->error($message);
                }
            }
        }
        
        $this->flash->success("ロード項目マスタの自動登録を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "load_mrs",
            'action' => "index"
        ));
    }

    /**
     * Upload any table
     *
     */
    public function uploadAction($id)
    {
		if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
			if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "files/" . mb_convert_encoding( $_FILES["upfile"]["name"], "sjis", "utf-8" ))) {
				//  chmod("files/" . $_FILES["upfile"]["name"], 0644); //Windowsでは不要
				$this->flash->success($_FILES["upfile"]["name"] . "をアップロードしました。");
			} else {
				$this->flash->error("ファイルをアップロードできません。");
				$this->dispatcher->forward(array(
					'controller' => "load_mrs",
					'action' => 'edit',
					'params' => array($id)
				));

                return;
			}
		} else {
			$this->flash->error("ファイルが選択されていません。");
			$this->dispatcher->forward(array(
			    'controller' => "load_mrs",
			    'action' => 'edit',
				'params' => array($id)
			));

			return;
		}

        $load_mr = LoadMrs::findFirstByid($id);

        if (!$load_mr) {
            $this->flash->error("テーブルマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }

        $load_mr->file_name = $_FILES["upfile"]["name"];//mb_convert_encoding( $_FILES["upfile"]["name"], "SJIS-win", "utf-8" );

        if (!$load_mr->save()) {

            foreach ($load_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'edit',
                'params' => array($load_mr->id)
            ));

            return;
        }
        $this->dispatcher->forward(array(
            'controller' => "load_mrs",
            'action' => 'edit',
            'params' => array($load_mr->id)
        ));

    }

    /**
     * 調整：設定入力 any table
     *
     */
    public function chouseiAction($id)
    {
        $load_mr = LoadMrs::findFirstByid($id);

        if (!$load_mr) {
            $this->flash->error("テーブルマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->tag->setDefault("id", $load_mr->id);
        $this->tag->setDefault("skip", $load_mr->skip);
        $this->tag->setDefault("uwagaki", $load_mr->uwagaki);

		// ファイル取得

		$filepath = "files/" . mb_convert_encoding( $load_mr->file_name, "SJIS-win", "utf-8" );
		$file = new SplFileObject($filepath); 
		$file->setFlags(SplFileObject::READ_CSV);
		 
		// ファイル内のデータループ
		foreach ($file as $key => $line) {

		    foreach( $line as $str ){

		        $records[ $key ][] = mb_convert_encoding($str, "utf-8", "SJIS-win" ) ;
		    }

		}

//        if (!$this->request->isPost()) {

        $load_mr = LoadMrs::findFirstByid($id);
        if (!$load_mr) {
            $this->flash->error("テーブルマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->tag->setDefault("id", $load_mr->id);
        $this->view->load_mr = $load_mr;
		$this->view->records = $records;

/*		echo "<pre>";
		print_r( $records );
		echo "</pre>";
*/
    }

    /**
     * 設定更新 any table
     *
     */
    public function setteiAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $load_mr = LoadMrs::findFirstByid($id);

        if (!$load_mr) {
            $this->flash->error("ロードマスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }
        
        $load_mr->skip = $this->request->getPost("skip");
        $load_mr->uwagaki = $this->request->getPost("uwagaki");

        $cols = $this->request->getPost("cols");
        $qkeys = $this->request->getPost("qkeys");
        $sels = $this->request->getPost("sels");

/*
$data = $this->request->getPost();
 echo "<br><br><br><pre>";
 var_dump($data);
 echo "</pre>";
// return;

 foreach ($cols as $col => $name) {
  echo $name.":". $col."<br>\n";
 }
 return;
*/
        $LoadKoumokuMrs = array();
        foreach ($load_mr->LoadKoumokuMrs as $load_koumoku_mr) {
            $load_koumoku_mr->fusiyou_kbn = 1; //一旦不使用とする
            foreach ($cols as $col => $name) {
                if ($name == $load_koumoku_mr->koumoku_mr_cd) {
                    $load_koumoku_mr->jun = $col;
                    $load_koumoku_mr->fusiyou_kbn = (array_key_exists($col, $sels) && $sels[$col]=="on")?2:0;
                    $load_koumoku_mr->keys = (array_key_exists($col, $qkeys) && $qkeys[$col]=="on")?1:0;
                    break;
                }
            }
            $LoadKoumokuMrs[] = $load_koumoku_mr;
        }
        $load_mr->LoadKoumokuMrs = array();
        $load_mr->LoadKoumokuMrs = $LoadKoumokuMrs;

        if (!$load_mr->save()) {

            foreach ($load_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'edit',
                'params' => array($load_mr->id)
            ));

            return;
        }

        $this->flash->success("ロードマスタの情報を更新しました。");

/*
 echo "<pre>";
 var_dump($sels);
 echo "</pre>";
 return;
*/
		// ファイル取得

		$filepath = "files/" . mb_convert_encoding( $load_mr->file_name, "SJIS-win", "utf-8" );
		$file = new SplFileObject($filepath); 
		$file->setFlags(SplFileObject::READ_CSV);
		 
		// ファイル内のデータループ
		foreach ($file as $key => $line) {
		    foreach( $line as $str ){
		        $records[ $key ][] = mb_convert_encoding($str, "utf-8", "SJIS-win" ) ;
		    }
		}
		$list = array(array());
		$cnt = array();
		$n = 0;
		foreach ($records as $record) {
			$i = 0;
			if ($n >= $load_mr->skip) {
				foreach ($record as $coldata) {
					if ($sels != null && array_key_exists($i, $sels) && $sels[$i] == "on" && $cols[$i] != "[UNUSE]") {
						for ($j = 0; array_key_exists($i, $cnt) && $j < $cnt[$i] && array_key_exists($i, $list) && $list[$i][$j] != $coldata; $j++) {}
						if (!array_key_exists($i, $cnt) || $j >= $cnt[$i]) {
							$cnt[$i] = $j + 1;
							$list[$i][$j] = $coldata;
						}
					}
					$i++;
				}
			}
			$n++;
		}
/*
 echo "<pre>";
 var_dump($list);
 echo "</pre>";
 return;
*/

        foreach ($list as $i => $lists) {
			for ($j = 0; $j < count($lists); $j++) {
				$load_henkan_mr = LoadHenkanMrs::findfirst("load_mr_cd = '".$load_mr->cd."' AND load_koumoku_mr_cd = '".$cols[$i]."' AND name = '".$lists[$j]."'");
				if (!$load_henkan_mr) {
//echo "load_mr_cd = '".$load_mr->cd."' AND load_koumoku_mr_cd = '".$cols[$i]."' AND name = '".$lists[$j]."'"."<br />";
					$load_henkan_mr = new LoadHenkanMrs();
					$load_henkan_mr->load_mr_cd = $load_mr->cd;
					$load_henkan_mr->load_koumoku_mr_cd = $cols[$i];
					$load_henkan_mr->name = $lists[$j];
					if (!$load_henkan_mr->save()) {
						foreach ($load_mr->getMessages() as $message) {
							$this->flash->error($message);
						}
						$this->dispatcher->forward(array(
							'controller' => "load_mrs",
							'action' => 'edit',
							'params' => array($load_mr->id)
						));
						return;
					}
				}
			}
		}

        $this->dispatcher->forward(array(
            'controller' => "load_mrs",
            'action' => 'index'
        ));
    }

    /**
     * インポート any table
     *
     */
    public function importAction($id)
    {
        $load_mr = LoadMrs::findFirstByid($id);

        if (!$load_mr) {
            $this->flash->error("テーブルマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "load_mrs",
                'action' => 'index'
            ));

            return;
        }

		// 上書きキー項目印
		$keys = [];
		foreach ($load_mr->LoadKoumokuMrs as $load_koumoku_mr) {
			if ($load_koumoku_mr->keys != null && $load_koumoku_mr->keys == 1) {
				$keys[$load_koumoku_mr->jun] = $load_koumoku_mr->koumoku_mr_cd;
			}
		}

		// 変換配列作成
		$henkan = [];
		foreach ($load_mr->LoadHenkanMrs as $load_henkan_mr) {
//echo "<br>\n".$load_henkan_mr->name;
			$henkan[$load_henkan_mr->LoadKoumokuMrs->koumoku_mr_cd][$load_henkan_mr->name] = $load_henkan_mr->cd;
		}
//return;
		// ファイル取得

		$filepath = "files/" . mb_convert_encoding( $load_mr->file_name, "SJIS-win", "utf-8" );
		$file = new SplFileObject($filepath); 
		$file->setFlags(SplFileObject::READ_CSV);
		 
		// ファイル内のデータループ
		foreach ($file as $key => $line) {
		    foreach( $line as $str ){
		        $records[ $key ][] = mb_convert_encoding($str, "utf-8", "SJIS-win" ) ;
		    }
		}

		$classname = str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($load_mr->table_mr_cd))));
		$i = 0;
		foreach ($records as $record) {
			if ($i >= $load_mr->skip) {
				$requi = "";
				$where = "";
				foreach ($keys as $jun => $koumoku_cd) {
					if ($where != "") {$where .= " AND ";}
					$where .= $koumoku_cd." = '". current(array_slice($record, $jun, 1))."'";
					$requi .= current(array_slice($record, $jun, 1));
				}
				if ($requi == '') {continue;}
				$target_row = $classname::findfirst($where);
				if (!$target_row) {
					$target_row = new $classname();
					foreach ($keys as $jun => $koumoku_cd) {
						$target_row->$koumoku_cd = current(array_slice($record, $jun, 1));
					}
				} else if ($load_mr->uwagaki != 1) {
					continue;
				}
				foreach ($load_mr->LoadKoumokuMrs as $load_koumoku_mr) {
					if ($load_koumoku_mr->keys != 1 && $load_koumoku_mr->fusiyou_kbn != 1) {
						$koumoku_cd = $load_koumoku_mr->koumoku_mr_cd;
						$koumoku_data = current(array_slice($record, $load_koumoku_mr->jun, 1));
						if ($load_koumoku_mr->fusiyou_kbn == 2 && array_key_exists($koumoku_cd, $henkan) && $koumoku_data != "") {
//echo "<br>\n".$koumoku_cd."=".$koumoku_data;
							$koumoku_data = $henkan[$koumoku_cd][$koumoku_data];
						} else if (strpos($load_koumoku_mr->KoumokuMrs->data_kata, "int(") !== false
								|| $load_koumoku_mr->KoumokuMrs->data_kata == "double") {
								$koumoku_data = trim(str_replace(',', '', $koumoku_data));
						}
						$target_row->$koumoku_cd = $koumoku_data;
					}
				}
/* if($i == 2){
 echo "<pre>";
 var_dump($target_row);
 echo "</pre>";
 return;
} */
				if (!$target_row->save()) {
					foreach ($target_row->getMessages() as $message) {
						$this->flash->error($message);
					}
					$this->dispatcher->forward(array(
						'controller' => "load_mrs",
						'action' => 'edit',
						'params' => array($load_mr->id)
					));
					return;
				}
			}
			$i++;
		}
		$this->dispatcher->forward(array(
			'controller' => $load_mr->table_mr_cd,
			'action' => 'index'
		));
    }

}

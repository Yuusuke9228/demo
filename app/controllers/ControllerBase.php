<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->tag->prependTitle('ERP | ');
        $this->view->setTemplateAfter('main');
        $log = new CtrlLogs();
        $log->cd = "_".$this->getDI()->getSession()->get('auth')['id']."_";
        $log->name = $_SERVER["REQUEST_URI"];
//        $log->actn = $_SERVER["QUERY_STRING"];
//        $log->save();
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0],
    			'action' => $uriParts[1],
                'params' => $params
    		)
    	);
    }
    /**
     * 簡易検索付き一覧表。共通部分
     */
    protected function indexCd($TableId, $table_name, $orgkey="cd") // 例：ControllerBase::indexCd("UriageDts", "売上伝票", $query) 標準キーがcdで無いとき指定できる
    {
        $numberPage = 1;
        $sort = $orgkey;
        $order = "ASC";
        $wherecd = "";
        $addlimit = ""; // postからの場合TableSortの機能ではlimitを付加してくれないため、自前で付加する。→view\common\indexsort.phtml
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, $TableId, $_POST);

            $this->persistent->parameters = $query->getParams();

            $parameters = $this->persistent->parameters;

            if ($this->request->getPost("cd")) { // コードは先頭文字から検索したいので修正2019/4/4井浦
                $parameters['bind']['cd'] = $this->request->getPost('cd').'%';
                $this->persistent->parameters = $parameters;
            }

            $pagelimit = $this->request->getPost("pagelimit");
            if ($pagelimit !== 10) {$addlimit = "&limit=".$pagelimit;}
        } else {
            $sort = $this->request->getQuery("sort") ?? $sort;
            $sort .= ' ' . $this->request->getQuery("order") ?? $order;
            $numberPage = $this->request->getQuery("page", "int");
            $wherecd = $this->request->getQuery($orgkey);
            $pagelimit = $this->request->getQuery("limit", "int");
            if (count($this->request->getQuery()) > 2) {
            	$parameters = $this->persistent->parameters; // ここへ移動2019/3/29井浦
            } else {
		        if ($wherecd) { /* 現在のコードのページを開く */
		            $parameters1 = [];
		            $parameters1["conditions"] = "cd < '". $wherecd ."'";
		            $numberPage = $TableId::count($parameters1) / 20 + 1;
		        }
            }
        }

        //Add By Nishiyama 2019/2/6
        //現場要望により表示行数20行に変更
        if (!$pagelimit) {$pagelimit = 20;}

//        $parameters = $this->persistent->parameters;
        //parametersが空だとundefinedになる為、条件追加() Nishiyama
        if (isset($parameters) && !is_array($parameters)) {
            $parameters = array();
            $this->persistent->parameters = $parameters;
        }

        $parameters["order"] = $sort;


/* * デバッグ 
  if($this->getDI()->getSession()->get('auth')['id']==1){
   echo $this->persistent->parameters['bind']['cd'];
   echo "<pre>";
   var_dump($parameters);
   echo "</pre>";
  // return;
}
 */
        $tblrows = $TableId::find($parameters);
        if (count($tblrows) == 0) {
            $this->flash->notice("検索の結果、".$table_name."は０件でした。");
        }

        $this->view->parasort = $this->request->getQuery("sort") ?'&sort='.$this->request->getQuery("sort"): '';
        $this->view->parasort .= $this->request->getQuery("order") ?'&order='.$this->request->getQuery("order"): '';
        $this->view->parasort .= $pagelimit !== 10 ?'&limit='.$pagelimit: '';
        $this->view->addlimit = $addlimit;

        $paginator = new Paginator(array(
            'data' => $tblrows,
            'limit'=> $pagelimit,
            'page' => $numberPage
        ));
        $this->view->page = $paginator->getPaginate();
        $this->tag->setDefault("pagelimit", $pagelimit);
    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。共通部分
     */
    protected function nextCd($id, $table_id, $TableId, $table_name, $key = 'cd') // 例：ControllerBase::nextCd($id, "uriage_dts", "UriageDts", "売上伝票")
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
                    'controller' => $table_id,
                    'action' => 'edit',
                    'params' => array($id)
                ));

                return;
            }
            $this->response->redirect($table_id.'/edit/'.$tblrow->id);
        }
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。共通部分
     */
    protected function prevCd($id = 0, $table_id, $TableId, $table_name, $key = 'cd') // 例：ControllerBase::prevCd($id, "uriage_dts", "UriageDts", "売上伝票")
    {
        if (!$this->request->isPost()) {
            if ($id > 0) {
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
            } else {
                $tblrow = $TableId::findFirst(["order"=>"id DESC"]);
            }
            if (!$tblrow) {
                $this->flash->warning($table_name."の最初です。");

                $this->dispatcher->forward(array(
                    'controller' => $table_id,
                    'action' => 'edit',
                    'params' => array($id)
                ));

                return;
            }
            $this->response->redirect($table_id.'/edit/'.$tblrow->id);
        }
    }

}

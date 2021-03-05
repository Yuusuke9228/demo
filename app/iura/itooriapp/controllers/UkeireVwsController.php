<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UkeireVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for ukeire_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'UkeireVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "itomei";

        $ukeire_vws = UkeireVws::find($parameters);
        if (count($ukeire_vws) == 0) {
            $this->flash->notice("The search did not find any ukeire_vws");

            $this->dispatcher->forward([
                "controller" => "ukeire_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $ukeire_vws,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a ukeire_vw
     *
     * @param string $itomei
     */
    public function editAction($itomei)
    {
        if (!$this->request->isPost()) {

            $ukeire_vw = UkeireVws::findFirstByitomei($itomei);
            if (!$ukeire_vw) {
                $this->flash->error("ukeire_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "ukeire_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->itomei = $ukeire_vw->itomei;

            $this->tag->setDefault("itomei", $ukeire_vw->itomei);
            $this->tag->setDefault("hinmei", $ukeire_vw->hinmei);
            $this->tag->setDefault("niukebi", $ukeire_vw->niukebi);
            $this->tag->setDefault("shukka_moto", $ukeire_vw->shukka_moto);
            $this->tag->setDefault("suuryou", $ukeire_vw->suuryou);
            $this->tag->setDefault("honsuu", $ukeire_vw->honsuu);
            $this->tag->setDefault("hakosuu", $ukeire_vw->hakosuu);
            $this->tag->setDefault("lot", $ukeire_vw->lot);
            $this->tag->setDefault("kakou_no", $ukeire_vw->kakou_no);
            $this->tag->setDefault("sasizu_no", $ukeire_vw->sasizu_no);
            $this->tag->setDefault("bikou", $ukeire_vw->bikou);
            $this->tag->setDefault("kishu", $ukeire_vw->kishu);
            $this->tag->setDefault("seihin_code", $ukeire_vw->seihin_code);
            $this->tag->setDefault("genryou_code", $ukeire_vw->genryou_code);
            $this->tag->setDefault("henkyaku", $ukeire_vw->henkyaku);
            
        }
    }

    /**
     * Creates a new ukeire_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "ukeire_vws",
                'action' => 'index'
            ]);

            return;
        }

        $ukeire_vw = new UkeireVws();
        $ukeire_vw->Itomei = $this->request->getPost("itomei");
        $ukeire_vw->Hinmei = $this->request->getPost("hinmei");
        $ukeire_vw->Niukebi = $this->request->getPost("niukebi");
        $ukeire_vw->Shukka_moto = $this->request->getPost("shukka_moto");
        $ukeire_vw->Suuryou = $this->request->getPost("suuryou");
        $ukeire_vw->Honsuu = $this->request->getPost("honsuu");
        $ukeire_vw->Hakosuu = $this->request->getPost("hakosuu");
        $ukeire_vw->Lot = $this->request->getPost("lot");
        $ukeire_vw->Kakou_no = $this->request->getPost("kakou_no");
        $ukeire_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $ukeire_vw->Bikou = $this->request->getPost("bikou");
        $ukeire_vw->Kishu = $this->request->getPost("kishu");
        $ukeire_vw->Seihin_code = $this->request->getPost("seihin_code");
        $ukeire_vw->Genryou_code = $this->request->getPost("genryou_code");
        $ukeire_vw->Henkyaku = $this->request->getPost("henkyaku");
        

        if (!$ukeire_vw->save()) {
            foreach ($ukeire_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "ukeire_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("ukeire_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "ukeire_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a ukeire_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "ukeire_vws",
                'action' => 'index'
            ]);

            return;
        }

        $itomei = $this->request->getPost("itomei");
        $ukeire_vw = UkeireVws::findFirstByitomei($itomei);

        if (!$ukeire_vw) {
            $this->flash->error("ukeire_vw does not exist " . $itomei);

            $this->dispatcher->forward([
                'controller' => "ukeire_vws",
                'action' => 'index'
            ]);

            return;
        }

        $ukeire_vw->Itomei = $this->request->getPost("itomei");
        $ukeire_vw->Hinmei = $this->request->getPost("hinmei");
        $ukeire_vw->Niukebi = $this->request->getPost("niukebi");
        $ukeire_vw->Shukka_moto = $this->request->getPost("shukka_moto");
        $ukeire_vw->Suuryou = $this->request->getPost("suuryou");
        $ukeire_vw->Honsuu = $this->request->getPost("honsuu");
        $ukeire_vw->Hakosuu = $this->request->getPost("hakosuu");
        $ukeire_vw->Lot = $this->request->getPost("lot");
        $ukeire_vw->Kakou_no = $this->request->getPost("kakou_no");
        $ukeire_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $ukeire_vw->Bikou = $this->request->getPost("bikou");
        $ukeire_vw->Kishu = $this->request->getPost("kishu");
        $ukeire_vw->Seihin_code = $this->request->getPost("seihin_code");
        $ukeire_vw->Genryou_code = $this->request->getPost("genryou_code");
        $ukeire_vw->Henkyaku = $this->request->getPost("henkyaku");
        

        if (!$ukeire_vw->save()) {

            foreach ($ukeire_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "ukeire_vws",
                'action' => 'edit',
                'params' => [$ukeire_vw->itomei]
            ]);

            return;
        }

        $this->flash->success("ukeire_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "ukeire_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a ukeire_vw
     *
     * @param string $itomei
     */
    public function deleteAction($itomei)
    {
        $ukeire_vw = UkeireVws::findFirstByitomei($itomei);
        if (!$ukeire_vw) {
            $this->flash->error("ukeire_vw was not found");

            $this->dispatcher->forward([
                'controller' => "ukeire_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$ukeire_vw->delete()) {

            foreach ($ukeire_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "ukeire_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("ukeire_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "ukeire_vws",
            'action' => "index"
        ]);
    }

	public function copyfromAction()
	{
		if ($this->db->execute('TRUNCATE TABLE sfn.shiire_dts')) { // 全削除
			$this->flash->success("shiire_dt was deleted successfully");
		} else {
			$this->flash->error("shiire_dt was not deleted ERROR!!");
		}
		$sql='SET @rownum=0;
			INSERT INTO sfn.shiire_dts (
				cd,
				nendo,
				tekiyou,
				shiirebi,
				juchuu_dt_cd,
				shiiresaki_mr_cd,
				torihiki_kbn_cd,
				zei_tenka_kbn_cd,
				tantou_mr_cd,
				shimekiri_flg,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				@rownum:=@rownum+1 as cd,
				year(date_add(niukebi, interval "61" DAY))-1 as nendo,
				a.shukka_moto as tekiyou,
				a.niukebi as shiirebi,
				substring(a.kakou_no,5,4) as juchuu_dt_cd,
				"SMM" as shiiresaki_mr_cd,
				1 as torihiki_kbn_cd,
				10 as zei_tenka_kbn_cd,
				82 as tantou_mr_cd,
				0 as shimekiri_flg,
				63 as sakusei_user_id,
				a.niukebi as created,
				63 as kousin_user_id,
				a.niukebi as updated
			FROM ukeire_vws a
			ORDER BY a.niukebi,a.genryou_code,a.lot,a.suuryou,a.bikou';
		if ($this->db->execute($sql)) {
			$this->flash->success("shiire_dt was created successfully");
		} else {
			$this->flash->error("shiire_dt was not created ERROR!!");
		}
/** デバッグ
 echo "<pre>";
 var_dump($rows);
 echo "</pre>";
 return;
*/
        $this->dispatcher->forward([
            'controller' => "ukeire_vws",
            'action' => "search"
        ]);
	}

	public function copymeisaiAction()
	{
		if ($this->db->execute('TRUNCATE TABLE sfn.shiire_meisai_dts')) { // 全削除
			$this->flash->success("shiire_meisai_dt was deleted successfully");
		} else {
			$this->flash->error("shiire_meisai_dt was not deleted ERROR!!");
		}
//		22支給受入 1/原糸
		$sql="SET @rownum=0;
			INSERT INTO sfn.shiire_meisai_dts (
				cd,
				utiwake_kbn_cd,
				shiire_dt_id,
				shouhin_mr_cd,
				tekiyou,
				lot,
				hinsitu_kbn_cd,
				souko_mr_cd,
				tanni_mr1_cd,
				tanni_mr2_cd,
				suuryou1,
				suuryou2,
				tanka_kbn,
				gentanka,
				tanka,
				kingaku,
				genkagaku,
				zeiritu_mr_cd,
				bikou,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				1 AS cd,
				22 as utiwake_kbn_cd,
				@rownum:=@rownum+1 as shiire_dt_id,
				g.cd as shouhin_mr_cd,
				a.hinmei as tekiyou,
				a.lot as lot,
				11 as hinsitu_kbn_cd,
				'HARA' as souko_mr_cd,
				11 as tanni_mr1_cd,
				5 as tanni_mr2_cd,
				a.honsuu as suuryou1,
				a.suuryou as suuryou2,
				2 as tanka_kbn,
				0 as gentanka,
				0 as tanka,
				0 as kingaku,
				0 as genkagaku,
				90 as zeiritu_mr_cd,
				a.bikou as bikou,
				63 as sakusei_user_id,
				a.niukebi as created,
				63 as kousin_user_id,
				a.niukebi as updated
			FROM ukeire_vws as a
			LEFT JOIN sfn.shouhin_mrs as g ON g.cd LIKE concat('%',a.genryou_code) AND g.zaikokanri = 1
			ORDER BY a.niukebi,a.genryou_code,a.lot,a.suuryou,a.bikou";
		if ($this->db->execute($sql)) {
			$this->flash->success("shiire_meisai_dt was created successfully");
		} else {
			$this->flash->error("shiire_meisai_dt was not created ERROR!!");
		}
        $this->dispatcher->forward([
            'controller' => "ukeire_vws",
            'action' => "search"
        ]);
	}

}

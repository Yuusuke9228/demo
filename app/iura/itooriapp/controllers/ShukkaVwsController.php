<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ShukkaVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for shukka_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'ShukkaVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "ito_code";

        $shukka_vws = ShukkaVws::find($parameters);
        if (count($shukka_vws) == 0) {
            $this->flash->notice("The search did not find any shukka_vws");

            $this->dispatcher->forward([
                "controller" => "shukka_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $shukka_vws,
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
     * Edits a shukka_vw
     *
     * @param string $ito_code
     */
    public function editAction($ito_code)
    {
        if (!$this->request->isPost()) {

            $shukka_vw = ShukkaVws::findFirstByito_code($ito_code);
            if (!$shukka_vw) {
                $this->flash->error("shukka_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "shukka_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->ito_code = $shukka_vw->ito_code;

            $this->tag->setDefault("ito_code", $shukka_vw->ito_code);
            $this->tag->setDefault("hiduke", $shukka_vw->hiduke);
            $this->tag->setDefault("denpyou_no", $shukka_vw->denpyou_no);
            $this->tag->setDefault("kakou_no", $shukka_vw->kakou_no);
            $this->tag->setDefault("lot", $shukka_vw->lot);
            $this->tag->setDefault("suuryou", $shukka_vw->suuryou);
            $this->tag->setDefault("honsuu", $shukka_vw->honsuu);
            $this->tag->setDefault("hinsitu", $shukka_vw->hinsitu);
            $this->tag->setDefault("bikou1", $shukka_vw->bikou1);
            $this->tag->setDefault("bikou2", $shukka_vw->bikou2);
            $this->tag->setDefault("shukkasaki", $shukka_vw->shukkasaki);
            
        }
    }

    /**
     * Creates a new shukka_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "shukka_vws",
                'action' => 'index'
            ]);

            return;
        }

        $shukka_vw = new ShukkaVws();
        $shukka_vw->Ito_code = $this->request->getPost("ito_code");
        $shukka_vw->Hiduke = $this->request->getPost("hiduke");
        $shukka_vw->Denpyou_no = $this->request->getPost("denpyou_no");
        $shukka_vw->Kakou_no = $this->request->getPost("kakou_no");
        $shukka_vw->Lot = $this->request->getPost("lot");
        $shukka_vw->Suuryou = $this->request->getPost("suuryou");
        $shukka_vw->Honsuu = $this->request->getPost("honsuu");
        $shukka_vw->Hinsitu = $this->request->getPost("hinsitu");
        $shukka_vw->Bikou1 = $this->request->getPost("bikou1");
        $shukka_vw->Bikou2 = $this->request->getPost("bikou2");
        $shukka_vw->Shukkasaki = $this->request->getPost("shukkasaki");
        

        if (!$shukka_vw->save()) {
            foreach ($shukka_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "shukka_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("shukka_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "shukka_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a shukka_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "shukka_vws",
                'action' => 'index'
            ]);

            return;
        }

        $ito_code = $this->request->getPost("ito_code");
        $shukka_vw = ShukkaVws::findFirstByito_code($ito_code);

        if (!$shukka_vw) {
            $this->flash->error("shukka_vw does not exist " . $ito_code);

            $this->dispatcher->forward([
                'controller' => "shukka_vws",
                'action' => 'index'
            ]);

            return;
        }

        $shukka_vw->Ito_code = $this->request->getPost("ito_code");
        $shukka_vw->Hiduke = $this->request->getPost("hiduke");
        $shukka_vw->Denpyou_no = $this->request->getPost("denpyou_no");
        $shukka_vw->Kakou_no = $this->request->getPost("kakou_no");
        $shukka_vw->Lot = $this->request->getPost("lot");
        $shukka_vw->Suuryou = $this->request->getPost("suuryou");
        $shukka_vw->Honsuu = $this->request->getPost("honsuu");
        $shukka_vw->Hinsitu = $this->request->getPost("hinsitu");
        $shukka_vw->Bikou1 = $this->request->getPost("bikou1");
        $shukka_vw->Bikou2 = $this->request->getPost("bikou2");
        $shukka_vw->Shukkasaki = $this->request->getPost("shukkasaki");
        

        if (!$shukka_vw->save()) {

            foreach ($shukka_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "shukka_vws",
                'action' => 'edit',
                'params' => [$shukka_vw->ito_code]
            ]);

            return;
        }

        $this->flash->success("shukka_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "shukka_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a shukka_vw
     *
     * @param string $ito_code
     */
    public function deleteAction($ito_code)
    {
        $shukka_vw = ShukkaVws::findFirstByito_code($ito_code);
        if (!$shukka_vw) {
            $this->flash->error("shukka_vw was not found");

            $this->dispatcher->forward([
                'controller' => "shukka_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$shukka_vw->delete()) {

            foreach ($shukka_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "shukka_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("shukka_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "shukka_vws",
            'action' => "index"
        ]);
    }
	public function copyoyaAction()
	{
		$sql="DELETE a FROM sfn.uriage_dts a
			WHERE a.tekiyou like '出荷%'"; // 23=出荷
		if ($this->db->execute($sql)) {
			$this->flash->success("uriage_dt was deleted successfully");
		} else {
			$this->flash->error("uriage_dt was not deleted ERROR!!");
		}
		$sql="SET @rownum=(select max(cd) from sfn.uriage_dts)+1;
			INSERT INTO sfn.uriage_dts (
				cd,
				nendo,
				tekiyou,
				uriagebi,
				juchuu_dt_id,
				saki_hacchuu_cd,
				tokuisaki_mr_cd,
				torihiki_kbn_cd,
				zei_tenka_kbn_cd,
				shukkabi,
				nounyuusaki_mr_cd,
				nounyuusaki,
				tantou_mr_cd,
				shimekiri_flg,
				tanka_shurui_kbn_cd,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				(select count(*) from 
					(select a2.hiduke,a2.denpyou_no from shukka_vws a2
						WHERE a2.kakou_no is not null
						group BY a2.hiduke,a2.denpyou_no
						ORDER BY a2.hiduke,a2.denpyou_no
					) a1
					where a1.hiduke<a.hiduke or a1.hiduke=a.hiduke and a1.denpyou_no<a.denpyou_no
				) + @rownum as cd,
				year(date_add(a.hiduke, interval '61' DAY))-1 as nendo,
				concat('出荷',a.denpyou_no) as tekiyou,
				a.hiduke as uriagebi,
				b.id as juchuu_dt_id,
				a.kakou_no as saki_hacchuu_cd,
				'SMM' as tokuisaki_mr_cd,
				1 as torihiki_kbn_cd,
				10 as zei_tenka_kbn_cd,
				a.hiduke,
				'' as nounyuusaki_mr_cd,
				a.shukkasaki as nounyuusaki,
				82 as tantou_mr_cd,
				0 as shimekiri_flg,
				2 as tanka_shurui_kbn_cd,
				3 as sakusei_user_id,
				a.hiduke as created,
				3 as kousin_user_id,
				a.hiduke as updated
			FROM shukka_vws a
			LEFT JOIN sfn.juchuu_dts b on b.cd = substring(a.kakou_no,1,4)
			WHERE a.kakou_no is not null
			group BY a.hiduke,a.denpyou_no
			ORDER BY a.hiduke,a.denpyou_no";
		if ($this->db->execute($sql)) {
			$this->flash->success("uriage_dt was created successfully");
		} else {
			$this->flash->error("uriage_dt was not created ERROR!!");
		}
/** デバッグ
 echo "<pre>";
 var_dump($rows);
 echo "</pre>";
 return;
*/
        $this->dispatcher->forward([
            'controller' => "shukka_vws",
            'action' => "search"
        ]);
	}

	public function copykoAction()
	{
		$sql="DELETE a FROM sfn.uriage_meisai_dts a
			WHERE a.utiwake_kbn_cd=23"; // 23=出荷
		if ($this->db->execute($sql)) {
			$this->flash->success("uriage_meisai_dt was deleted successfully");
		} else {
			$this->flash->error("uriage_meisai_dt was not deleted ERROR!!");
		}
		// 23預り出荷
		$sql="INSERT INTO sfn.uriage_meisai_dts (
				cd,
				utiwake_kbn_cd,
				uriage_dt_id,
				shouhin_mr_cd,
				kousei,
				tekiyou,
				lot,
				hinsitu_kbn_cd,
				souko_mr_cd,
				iro,
				suuryou1,
				tanni_mr1_cd,
				suuryou2,
				tanni_mr2_cd,
				tanka_kbn,
				gentanka,
				tanka,
				kingaku,
				genkagaku,
				zeinukigaku,
				zeigaku,
				zeiritu_mr_cd,
				bikou,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				1 as cd,
				23 as utiwake_kbn_cd,
				b.id as uriage_dt_id,
				IFNULL(d.shouhin_mr_cd,g.cd) as shouhin_mr_cd,
				'' as kousei,
				IFNULL(d.tekiyou,g.name) as tekiyou,
				a.lot as lot,
				11 as hinsitu_kbn_cd,
				'HARA' as souko_mr_cd,
				'' as iro,
				if(d.tanni_mr1_cd=4,1,a.honsuu) as suuryou1,
				d.tanni_mr1_cd as tanni_mr1_cd,
				round(a.suuryou,2) as suuryou2,
				5 as tanni_mr2_cd,
				d.tanka_kbn as tanka_kbn,
				0 as gentanka,
				0 as tanka,
				0 as kingaku,
				0 as genkagaku,
				0 as zeinukigaku,
				0 as zeigaku,
				90 as zeiritu_mr_cd,
				concat(IFNULL(a.hinsitu,''),' ',IFNULL(a.bikou1,''),' ',IFNULL(a.bikou2,'')) as bikou,
				3 as sakusei_user_id,
				a.hiduke as created,
				3 as kousin_user_id,
				a.hiduke as updated
			FROM shukka_vws a
			LEFT JOIN sfn.uriage_dts b on b.uriagebi=a.hiduke AND b.tekiyou = concat('出荷',a.denpyou_no)
			LEFT JOIN sfn.juchuu_dts c on c.cd = substring(a.kakou_no,1,4)
			LEFT JOIN (
				select * from sfn.juchuu_meisai_dts where utiwake_kbn_cd=20 group by juchuu_dt_id,shouhin_mr_cd
				) d on d.juchuu_dt_id = c.id AND d.shouhin_mr_cd LIKE concat('%',a.ito_code)
			LEFT JOIN sfn.shouhin_mrs as g ON g.cd LIKE concat('%',a.ito_code) AND g.zaikokanri = 1
			WHERE a.kakou_no is not null
			ORDER BY a.hiduke,a.denpyou_no";
		if ($this->db->execute($sql)) {
			$this->flash->success("uriage_meisai_dt was created successfully");
		} else {
			$this->flash->error("uriage_meisai_dt was not created ERROR!!");
		}
        $this->dispatcher->forward([
            'controller' => "shukka_vws",
            'action' => "search"
        ]);
	}
}

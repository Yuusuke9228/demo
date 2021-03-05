<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UriVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for uri_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'UriVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "hiduke";

        $uri_vws = UriVws::find($parameters);
        if (count($uri_vws) == 0) {
            $this->flash->notice("The search did not find any uri_vws");

            $this->dispatcher->forward([
                "controller" => "uri_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $uri_vws,
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
     * Edits a uri_vw
     *
     * @param string $hiduke
     */
    public function editAction($hiduke)
    {
        if (!$this->request->isPost()) {

            $uri_vw = UriVws::findFirstByhiduke($hiduke);
            if (!$uri_vw) {
                $this->flash->error("uri_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "uri_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->hiduke = $uri_vw->hiduke;

            $this->tag->setDefault("hiduke", $uri_vw->hiduke);
            $this->tag->setDefault("uriagesaki", $uri_vw->uriagesaki);
            $this->tag->setDefault("uriage_no", $uri_vw->uriage_no);
            $this->tag->setDefault("gyou", $uri_vw->gyou);
            $this->tag->setDefault("hinban", $uri_vw->hinban);
            $this->tag->setDefault("tantou", $uri_vw->tantou);
            $this->tag->setDefault("kibata_no", $uri_vw->kibata_no);
            $this->tag->setDefault("ito_code", $uri_vw->ito_code);
            $this->tag->setDefault("irai_no", $uri_vw->irai_no);
            $this->tag->setDefault("sasizu_no", $uri_vw->sasizu_no);
            $this->tag->setDefault("suuryou_meisai", $uri_vw->suuryou_meisai);
            $this->tag->setDefault("suuryou_goukei", $uri_vw->suuryou_goukei);
            $this->tag->setDefault("tanka", $uri_vw->tanka);
            $this->tag->setDefault("tanni", $uri_vw->tanni);
            $this->tag->setDefault("itomei", $uri_vw->itomei);
            $this->tag->setDefault("lot", $uri_vw->lot);
            $this->tag->setDefault("kishu", $uri_vw->kishu);
            
        }
    }

    /**
     * Creates a new uri_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "uri_vws",
                'action' => 'index'
            ]);

            return;
        }

        $uri_vw = new UriVws();
        $uri_vw->Hiduke = $this->request->getPost("hiduke");
        $uri_vw->Uriagesaki = $this->request->getPost("uriagesaki");
        $uri_vw->Uriage_no = $this->request->getPost("uriage_no");
        $uri_vw->Gyou = $this->request->getPost("gyou");
        $uri_vw->Hinban = $this->request->getPost("hinban");
        $uri_vw->Tantou = $this->request->getPost("tantou");
        $uri_vw->Kibata_no = $this->request->getPost("kibata_no");
        $uri_vw->Ito_code = $this->request->getPost("ito_code");
        $uri_vw->Irai_no = $this->request->getPost("irai_no");
        $uri_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $uri_vw->Suuryou_meisai = $this->request->getPost("suuryou_meisai");
        $uri_vw->Suuryou_goukei = $this->request->getPost("suuryou_goukei");
        $uri_vw->Tanka = $this->request->getPost("tanka");
        $uri_vw->Tanni = $this->request->getPost("tanni");
        $uri_vw->Itomei = $this->request->getPost("itomei");
        $uri_vw->Lot = $this->request->getPost("lot");
        $uri_vw->Kishu = $this->request->getPost("kishu");
        

        if (!$uri_vw->save()) {
            foreach ($uri_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "uri_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("uri_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "uri_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a uri_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "uri_vws",
                'action' => 'index'
            ]);

            return;
        }

        $hiduke = $this->request->getPost("hiduke");
        $uri_vw = UriVws::findFirstByhiduke($hiduke);

        if (!$uri_vw) {
            $this->flash->error("uri_vw does not exist " . $hiduke);

            $this->dispatcher->forward([
                'controller' => "uri_vws",
                'action' => 'index'
            ]);

            return;
        }

        $uri_vw->Hiduke = $this->request->getPost("hiduke");
        $uri_vw->Uriagesaki = $this->request->getPost("uriagesaki");
        $uri_vw->Uriage_no = $this->request->getPost("uriage_no");
        $uri_vw->Gyou = $this->request->getPost("gyou");
        $uri_vw->Hinban = $this->request->getPost("hinban");
        $uri_vw->Tantou = $this->request->getPost("tantou");
        $uri_vw->Kibata_no = $this->request->getPost("kibata_no");
        $uri_vw->Ito_code = $this->request->getPost("ito_code");
        $uri_vw->Irai_no = $this->request->getPost("irai_no");
        $uri_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $uri_vw->Suuryou_meisai = $this->request->getPost("suuryou_meisai");
        $uri_vw->Suuryou_goukei = $this->request->getPost("suuryou_goukei");
        $uri_vw->Tanka = $this->request->getPost("tanka");
        $uri_vw->Tanni = $this->request->getPost("tanni");
        $uri_vw->Itomei = $this->request->getPost("itomei");
        $uri_vw->Lot = $this->request->getPost("lot");
        $uri_vw->Kishu = $this->request->getPost("kishu");
        

        if (!$uri_vw->save()) {

            foreach ($uri_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "uri_vws",
                'action' => 'edit',
                'params' => [$uri_vw->hiduke]
            ]);

            return;
        }

        $this->flash->success("uri_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "uri_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a uri_vw
     *
     * @param string $hiduke
     */
    public function deleteAction($hiduke)
    {
        $uri_vw = UriVws::findFirstByhiduke($hiduke);
        if (!$uri_vw) {
            $this->flash->error("uri_vw was not found");

            $this->dispatcher->forward([
                'controller' => "uri_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$uri_vw->delete()) {

            foreach ($uri_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "uri_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("uri_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "uri_vws",
            'action' => "index"
        ]);
    }

	public function copyurioyaAction()
	{
		$sql="TRUNCATE TABLE sfn.uriage_dts"; // 全削除
		if ($this->db->execute($sql)) {
			$this->flash->success("uriage_dt was deleted successfully");
		} else {
			$this->flash->error("uriage_dt was not deleted ERROR!!");
		}
		$sql="SET @rownum=0;
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
				@rownum:=@rownum+1 as cd,
				year(date_add(a.hiduke, interval '61' DAY))-1 as nendo,
				concat('弥生',lpad(a.uriage_no,5,'0'),'.',IFNULL(a.gyou,0),'.',j.ji_sasizu_no) as tekiyou,
				a.hiduke as uriagebi,
				b.id as juchuu_dt_id,
				c.kakou_no1 as saki_hacchuu_cd,
				a.uriagesaki as tokuisaki_mr_cd,
				1 as torihiki_kbn_cd,
				10 as zei_tenka_kbn_cd,
				'SFN' as nounyuusaki_mr_cd,
				'原工場' as nounyuusaki,
				82 as tantou_mr_cd,
				0 as shimekiri_flg,
				2 as tanka_shurui_kbn_cd,
				3 as sakusei_user_id,
				a.hiduke as created,
				3 as kousin_user_id,
				a.hiduke as updated
			FROM uri_vws a
			JOIN jiyori_tenkai j on j.ue_sasizu_no=left(a.sasizu_no,5)
			LEFT JOIN prop_hikiate_vws c on c.sasizu_no=j.ji_sasizu_no
			LEFT JOIN sfn.juchuu_dts b on b.cd = c.kakou_no1
			WHERE suuryou_goukei<>0
			ORDER BY a.hiduke,a.uriage_no,a.gyou";
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
            'controller' => "uri_vws",
            'action' => "search"
        ]);
	}

	public function copyurikoAction()
	{
		$sql="TRUNCATE TABLE sfn.uriage_meisai_dts"; // 全削除
		if ($this->db->execute($sql)) {
			$this->flash->success("uriage_meisai_dt was deleted successfully");
		} else {
			$this->flash->error("uriage_meisai_dt was not deleted ERROR!!");
		}
		// 24加工生産仕切
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
				24 as utiwake_kbn_cd,
				b.id as uriage_dt_id,
				c.shouhin_mr_cd as shouhin_mr_cd,
				'-' as kousei,
				c.tekiyou as tekiyou,
				a.lot as lot,
				11 as hinsitu_kbn_cd,
				'HARA' as souko_mr_cd,
				j.ji_sasizu_no as iro,
				if(c.tanni_mr1_cd=4,1,d.honsuu) as suuryou1,
				c.tanni_mr1_cd as tanni_mr1_cd,
				round(suuryou_goukei,2) as suuryou2,
				5 as tanni_mr2_cd,
				c.tanka_kbn as tanka_kbn,
				c.gentanka as gentanka,
				0 as tanka,
				0 as kingaku,
				c.gentanka * j.tanka_flg*if(c.tanka_kbn=1,if(c.tanni_mr1_cd=4,1,d.honsuu),round(a.suuryou_goukei,2)) as genkagaku,
				0 as zeinukigaku,
				0 as zeigaku,
				90 as zeiritu_mr_cd,
				'' as bikou,
				3 as sakusei_user_id,
				a.hiduke as created,
				3 as kousin_user_id,
				a.hiduke as updated
			FROM uri_vws a
			JOIN jiyori_tenkai j on j.ue_sasizu_no=left(a.sasizu_no,5)
			LEFT JOIN sfn.uriage_dts b on b.uriagebi=a.hiduke AND b.tekiyou = concat('弥生',lpad(a.uriage_no,5,'0'),'.',IFNULL(a.gyou,0),'.',j.ji_sasizu_no)
			LEFT JOIN (
                select * from sfn.juchuu_meisai_dts where utiwake_kbn_cd = 20 group by iro
                ) c on c.iro = j.ji_sasizu_no
			LEFT JOIN (
				select hiduke, sasizu_no, sum(honsuu) as honsuu 
				from kensa_sum_vws
				group by hiduke,sasizu_no
				) d on d.hiduke=a.hiduke AND d.sasizu_no = left(a.sasizu_no,5)
			WHERE suuryou_goukei<>0
			ORDER BY a.hiduke,a.uriage_no,a.gyou";
		if ($this->db->execute($sql)) {
			$this->flash->success("uriage_meisai_dt was created successfully");
		} else {
			$this->flash->error("uriage_meisai_dt was not created ERROR!!");
		}
		//10工賃
		$sql="INSERT INTO sfn.uriage_meisai_dts (
				cd,
				utiwake_kbn_cd,
				uriage_dt_id,
				shouhin_mr_cd,
				kousei,
				keisu,
				tekiyou,
				lot,
				hinsitu_kbn_cd,
				souko_mr_cd,
				iro,
				suuryou,
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
				2 as cd,
				10 as utiwake_kbn_cd,
				b.id as uriage_dt_id,
				c.shouhin_mr_cd as shouhin_mr_cd,
				'├' as kousei,
				1 as keisu,
				c.tekiyou as tekiyou,
				a.lot as lot,
				11 as hinsitu_kbn_cd,
				'HARA' as souko_mr_cd,
				j.ji_sasizu_no as iro,
				round(a.suuryou_goukei,2) as suuryou,
				if(c.tanni_mr1_cd=4,1,d.honsuu) as suuryou1,
				c.tanni_mr1_cd as tanni_mr1_cd,
				round(a.suuryou_goukei,2) as suuryou2,
				5 as tanni_mr2_cd,
				c.tanka_kbn as tanka_kbn,
				c.gentanka * j.tanka_flg as gentanka,
				a.tanka * j.tanka_flg as tanka,
				a.tanka * j.tanka_flg*if(c.tanka_kbn=1,if(c.tanni_mr1_cd=4,1,d.honsuu),round(a.suuryou_goukei,2)) as kingaku,
				c.gentanka * j.tanka_flg*if(c.tanka_kbn=1,if(c.tanni_mr1_cd=4,1,d.honsuu),round(a.suuryou_goukei,2)) as genkagaku,
				a.tanka * j.tanka_flg*if(c.tanka_kbn=1,if(c.tanni_mr1_cd=4,1,d.honsuu),round(a.suuryou_goukei,2)) as zeinukigaku,
				a.tanka * j.tanka_flg*if(c.tanka_kbn=1,if(c.tanni_mr1_cd=4,1,d.honsuu),round(a.suuryou_goukei,2))*0.08 as zeigaku,
				12 as zeiritu_mr_cd,
				a.kishu as bikou,
				3 as sakusei_user_id,
				a.hiduke as created,
				3 as kousin_user_id,
				a.hiduke as updated
			FROM uri_vws a
			JOIN jiyori_tenkai j on j.ue_sasizu_no=left(a.sasizu_no,5)
			LEFT JOIN sfn.uriage_dts b on b.uriagebi=a.hiduke AND b.tekiyou = concat('弥生',lpad(a.uriage_no,5,'0'),'.',IFNULL(a.gyou,0),'.',j.ji_sasizu_no)
			LEFT JOIN (
                select * from sfn.juchuu_meisai_dts where utiwake_kbn_cd = 10 group by iro
                ) c on c.iro = j.ji_sasizu_no
			LEFT JOIN (
				select hiduke, sasizu_no, sum(honsuu) as honsuu 
				from kensa_sum_vws
				group by hiduke,sasizu_no
				) d on d.hiduke=a.hiduke AND d.sasizu_no = left(a.sasizu_no,5)
			WHERE suuryou_goukei<>0
			ORDER BY a.hiduke,a.uriage_no,a.gyou";
		if ($this->db->execute($sql)) {
			$this->flash->success("uriage_meisai_dt was created successfully");
		} else {
			$this->flash->error("uriage_meisai_dt was not created ERROR!!");
		}
		//21支給消費
		$sql="INSERT INTO sfn.uriage_meisai_dts (
				cd,
				utiwake_kbn_cd,
				uriage_dt_id,
				shouhin_mr_cd,
				kousei,
				keisu,
				tekiyou,
				lot,
				hinsitu_kbn_cd,
				souko_mr_cd,
				iro,
				suuryou,
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
				c.cd as cd,
				21 as utiwake_kbn_cd,
				b.id as uriage_dt_id,
				c.shouhin_mr_cd as shouhin_mr_cd,
				c.kousei as kousei,
				c.keisu as keisu,
				c.tekiyou as tekiyou,
				c.lot as lot,
				11 as hinsitu_kbn_cd,
				'HARA' as souko_mr_cd,
				j.ji_sasizu_no as iro,
				round(a.suuryou_goukei,2) as suuryou,
				0 as suuryou1,
				c.tanni_mr1_cd as tanni_mr1_cd,
				round(c.keisu*a.suuryou_goukei,2) as suuryou2,
				5 as tanni_mr2_cd,
				c.tanka_kbn as tanka_kbn,
				c.gentanka as gentanka,
				0 as tanka,
				0 as kingaku,
				truncate(c.gentanka * round(c.keisu*a.suuryou_goukei,2),0) as genkagaku,
				0 as zeinukigaku,
				0 as zeigaku,
				90 as zeiritu_mr_cd,
				'' as bikou,
				3 as sakusei_user_id,
				a.hiduke as created,
				3 as kousin_user_id,
				a.hiduke as updated
			FROM uri_vws a
			JOIN jiyori_tenkai j on j.ue_sasizu_no=left(a.sasizu_no,5)
			LEFT JOIN sfn.uriage_dts b on b.uriagebi=a.hiduke AND b.tekiyou = concat('弥生',lpad(a.uriage_no,5,'0'),'.',IFNULL(a.gyou,0),'.',j.ji_sasizu_no)
			LEFT JOIN (
                select * from sfn.juchuu_meisai_dts where utiwake_kbn_cd = 21 group by iro,shouhin_mr_cd
                ) c on c.iro = j.ji_sasizu_no
			WHERE suuryou_goukei<>0
			ORDER BY a.hiduke,a.uriage_no,a.gyou";
		if ($this->db->execute($sql)) {
			$this->flash->success("uriage_meisai_dt was created successfully");
		} else {
			$this->flash->error("uriage_meisai_dt was not created ERROR!!");
		}
        $this->dispatcher->forward([
            'controller' => "ukeire_vws",
            'action' => "search"
        ]);
	}

}

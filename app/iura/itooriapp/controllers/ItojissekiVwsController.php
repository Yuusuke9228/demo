<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ItojissekiVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for itojisseki_vws
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'ItojissekiVws', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "nichiji";

        $itojisseki_vws = ItojissekiVws::find($parameters);
        if (count($itojisseki_vws) == 0) {
            $this->flash->notice("The search did not find any itojisseki_vws");

            $this->dispatcher->forward([
                "controller" => "itojisseki_vws",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $itojisseki_vws,
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
     * Edits a itojisseki_vw
     *
     * @param string $nichiji
     */
    public function editAction($nichiji)
    {
        if (!$this->request->isPost()) {

            $itojisseki_vw = ItojissekiVws::findFirstBynichiji($nichiji);
            if (!$itojisseki_vw) {
                $this->flash->error("itojisseki_vw was not found");

                $this->dispatcher->forward([
                    'controller' => "itojisseki_vws",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->nichiji = $itojisseki_vw->nichiji;

            $this->tag->setDefault("nichiji", $itojisseki_vw->nichiji);
            $this->tag->setDefault("rec_kbn", $itojisseki_vw->rec_kbn);
            $this->tag->setDefault("seikei_no", $itojisseki_vw->seikei_no);
            $this->tag->setDefault("genryou_jun", $itojisseki_vw->genryou_jun);
            $this->tag->setDefault("sasizu_no", $itojisseki_vw->sasizu_no);
            $this->tag->setDefault("itoshu", $itojisseki_vw->itoshu);
            $this->tag->setDefault("ito_code", $itojisseki_vw->ito_code);
            $this->tag->setDefault("itoryou", $itojisseki_vw->itoryou);
            $this->tag->setDefault("honsuu", $itojisseki_vw->honsuu);
            $this->tag->setDefault("kishu", $itojisseki_vw->kishu);
            $this->tag->setDefault("floor", $itojisseki_vw->floor);
            $this->tag->setDefault("gouki", $itojisseki_vw->gouki);
            $this->tag->setDefault("moto_kishu", $itojisseki_vw->moto_kishu);
            $this->tag->setDefault("moto_floor", $itojisseki_vw->moto_floor);
            $this->tag->setDefault("denpyou_no", $itojisseki_vw->denpyou_no);
            $this->tag->setDefault("denpyou_eda", $itojisseki_vw->denpyou_eda);
            $this->tag->setDefault("sagyousha_code", $itojisseki_vw->sagyousha_code);
            $this->tag->setDefault("nouhinn_kbn", $itojisseki_vw->nouhinn_kbn);
            $this->tag->setDefault("oodama", $itojisseki_vw->oodama);
            
        }
    }

    /**
     * Creates a new itojisseki_vw
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "itojisseki_vws",
                'action' => 'index'
            ]);

            return;
        }

        $itojisseki_vw = new ItojissekiVws();
        $itojisseki_vw->Nichiji = $this->request->getPost("nichiji");
        $itojisseki_vw->Rec_kbn = $this->request->getPost("rec_kbn");
        $itojisseki_vw->Seikei_no = $this->request->getPost("seikei_no");
        $itojisseki_vw->Genryou_jun = $this->request->getPost("genryou_jun");
        $itojisseki_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $itojisseki_vw->Itoshu = $this->request->getPost("itoshu");
        $itojisseki_vw->Ito_code = $this->request->getPost("ito_code");
        $itojisseki_vw->Itoryou = $this->request->getPost("itoryou");
        $itojisseki_vw->Honsuu = $this->request->getPost("honsuu");
        $itojisseki_vw->Kishu = $this->request->getPost("kishu");
        $itojisseki_vw->Floor = $this->request->getPost("floor");
        $itojisseki_vw->Gouki = $this->request->getPost("gouki");
        $itojisseki_vw->Moto_kishu = $this->request->getPost("moto_kishu");
        $itojisseki_vw->Moto_floor = $this->request->getPost("moto_floor");
        $itojisseki_vw->Denpyou_no = $this->request->getPost("denpyou_no");
        $itojisseki_vw->Denpyou_eda = $this->request->getPost("denpyou_eda");
        $itojisseki_vw->Sagyousha_code = $this->request->getPost("sagyousha_code");
        $itojisseki_vw->Nouhinn_kbn = $this->request->getPost("nouhinn_kbn");
        $itojisseki_vw->Oodama = $this->request->getPost("oodama");
        

        if (!$itojisseki_vw->save()) {
            foreach ($itojisseki_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "itojisseki_vws",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("itojisseki_vw was created successfully");

        $this->dispatcher->forward([
            'controller' => "itojisseki_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a itojisseki_vw edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "itojisseki_vws",
                'action' => 'index'
            ]);

            return;
        }

        $nichiji = $this->request->getPost("nichiji");
        $itojisseki_vw = ItojissekiVws::findFirstBynichiji($nichiji);

        if (!$itojisseki_vw) {
            $this->flash->error("itojisseki_vw does not exist " . $nichiji);

            $this->dispatcher->forward([
                'controller' => "itojisseki_vws",
                'action' => 'index'
            ]);

            return;
        }

        $itojisseki_vw->Nichiji = $this->request->getPost("nichiji");
        $itojisseki_vw->Rec_kbn = $this->request->getPost("rec_kbn");
        $itojisseki_vw->Seikei_no = $this->request->getPost("seikei_no");
        $itojisseki_vw->Genryou_jun = $this->request->getPost("genryou_jun");
        $itojisseki_vw->Sasizu_no = $this->request->getPost("sasizu_no");
        $itojisseki_vw->Itoshu = $this->request->getPost("itoshu");
        $itojisseki_vw->Ito_code = $this->request->getPost("ito_code");
        $itojisseki_vw->Itoryou = $this->request->getPost("itoryou");
        $itojisseki_vw->Honsuu = $this->request->getPost("honsuu");
        $itojisseki_vw->Kishu = $this->request->getPost("kishu");
        $itojisseki_vw->Floor = $this->request->getPost("floor");
        $itojisseki_vw->Gouki = $this->request->getPost("gouki");
        $itojisseki_vw->Moto_kishu = $this->request->getPost("moto_kishu");
        $itojisseki_vw->Moto_floor = $this->request->getPost("moto_floor");
        $itojisseki_vw->Denpyou_no = $this->request->getPost("denpyou_no");
        $itojisseki_vw->Denpyou_eda = $this->request->getPost("denpyou_eda");
        $itojisseki_vw->Sagyousha_code = $this->request->getPost("sagyousha_code");
        $itojisseki_vw->Nouhinn_kbn = $this->request->getPost("nouhinn_kbn");
        $itojisseki_vw->Oodama = $this->request->getPost("oodama");
        

        if (!$itojisseki_vw->save()) {

            foreach ($itojisseki_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "itojisseki_vws",
                'action' => 'edit',
                'params' => [$itojisseki_vw->nichiji]
            ]);

            return;
        }

        $this->flash->success("itojisseki_vw was updated successfully");

        $this->dispatcher->forward([
            'controller' => "itojisseki_vws",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a itojisseki_vw
     *
     * @param string $nichiji
     */
    public function deleteAction($nichiji)
    {
        $itojisseki_vw = ItojissekiVws::findFirstBynichiji($nichiji);
        if (!$itojisseki_vw) {
            $this->flash->error("itojisseki_vw was not found");

            $this->dispatcher->forward([
                'controller' => "itojisseki_vws",
                'action' => 'index'
            ]);

            return;
        }

        if (!$itojisseki_vw->delete()) {

            foreach ($itojisseki_vw->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "itojisseki_vws",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("itojisseki_vw was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "itojisseki_vws",
            'action' => "index"
        ]);
    }

	public function copyseisanoyaAction()
	{
		$sql="DELETE FROM sfn.zaiko_henkan_dts WHERE zaiko_henkan_kbn_cd=1"; // 1=生産
		if ($this->db->execute($sql)) {
			$this->flash->success("zaiko_henkan_dt was deleted successfully");
		} else {
			$this->flash->error("zaiko_henkan_dt was not deleted ERROR!!");
		}
		$sql="SET @rownum=0;
			INSERT INTO sfn.zaiko_henkan_dts (
				cd,
				nendo,
				name,
				henkanbi,
				tantou_mr_cd,
				zaiko_henkan_kbn_cd,
				sasizu_dt_cd,
				souko_mr_cd,
				moto_souko_mr_cd,
				moto_tantou_mr_cd,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				@rownum:=@rownum+1 as cd,
				year(date_add(a.nichiji, interval '61' DAY))-1 as nendo,
				concat(a.kishu,'-',a.floor,'-',a.gouki,'-',a.seikei_no) as name,
				a.nichiji as henkanbi,
				82 as tantou_mr_cd,
				1 as zaiko_henkan_kbn_cd,
				a.sasizu_no as sasizu_dt_cd,
				'HARA' as souko_mr_cd,
				'HARA' as moto_souko_mr_cd,
				82 as moto_tantou_mr_cd,
				b.user_id as sakusei_user_id,
				a.nichiji as created,
				b.user_id as kousin_user_id,
				a.nichiji as updated
			FROM itojisseki_vws a
			LEFT JOIN seisan_tantou_vws b on b.bangou = a.sagyousha_code
			JOIN (select sasizu_no from prop_hikiate_vws group by sasizu_no) f on f.sasizu_no=a.sasizu_no
			WHERE a.rec_kbn>=3 AND a.rec_kbn<4
			ORDER BY a.nichiji,a.sasizu_no,a.rec_kbn";
		if ($this->db->execute($sql)) {
			$this->flash->success("zaiko_henkan_dt was created successfully");
		} else {
			$this->flash->error("zaiko_henkan_dt was not created ERROR!!");
		}
/** デバッグ
 echo "<pre>";
 var_dump($rows);
 echo "</pre>";
 return;
*/
        $this->dispatcher->forward([
            'controller' => "itojisseki_vws",
            'action' => "search"
        ]);
	}

	public function copyseisankoAction()
	{
		$sql="DELETE a FROM sfn.zaiko_henkan_meisai_dts a
			left join sfn.zaiko_henkan_dts b on b.id=a.zaiko_henkan_dt_id
			WHERE b.id is null"; // 1=生産
		if ($this->db->execute($sql)) {
			$this->flash->success("zaiko_henkan_meisai_dt was deleted successfully");
		} else {
			$this->flash->error("zaiko_henkan_meisai_dt was not deleted ERROR!!");
		}
//		[0=>"もと",1=>"先",2=>"共通"]
		$sql="INSERT INTO sfn.zaiko_henkan_meisai_dts (
				cd,
				bikou,
				zaiko_henkan_dt_id,
				henkansaki_flg,
				shouhin_mr_cd,
				kousei,
				tekiyou,
				hinsitu_kbn_cd,
				kousei_suuryou,
				iro,
				suuryou1,
				tanni_mr1_cd,
				suuryou2,
				tanni_mr2_cd,
				tanka_kbn,
				tanka,
				kingaku,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				1 as cd,
				(CASE a.oodama WHEN '1' THEN '大玉' ELSE '' END) as bikou,
				c.id as zaiko_henkan_dt_id,
				1 as henkansaki_flg,
				g.cd as shouhin_mr_cd,
				'-' as kousei,
				g.name as tekiyou,
				(CASE a.rec_kbn WHEN 3.1 THEN 21 ELSE 11 END) as hinsitu_kbn_cd,
				1 as kousei_suuryou,
				a.sasizu_no as iro,
				if(d.tanni_mr1_cd=4,1,a.honsuu) as suuryou1,
				d.tanni_mr1_cd as tanni_mr1_cd,
				a.itoryou as suuryou2,
				5 as tanni_mr2_cd,
				d.tanka_kbn as tanka_kbn,
				d.gentanka as tanka,
				if(d.tanka_kbn=2,a.itoryou,if(d.tanni_mr1_cd=4,1,a.honsuu))*d.gentanka as kingaku,
				b.user_id as sakusei_user_id,
				a.nichiji as created,
				b.user_id as kousin_user_id,
				a.nichiji as updated
			FROM itojisseki_vws as a
			LEFT JOIN sfn.shouhin_mrs as g ON g.cd LIKE concat('%',a.ito_code) AND g.zaikokanri = 1
			LEFT JOIN seisan_tantou_vws b on b.bangou = a.sagyousha_code
			LEFT JOIN sfn.zaiko_henkan_dts c on c.zaiko_henkan_kbn_cd=1 AND c.created = a.nichiji AND c.sasizu_dt_cd=a.sasizu_no AND c.sakusei_user_id = b.user_id
			LEFT JOIN sfn.juchuu_meisai_dts d on d.iro = a.sasizu_no AND d.shouhin_mr_cd = g.cd
			JOIN (select sasizu_no from prop_hikiate_vws group by sasizu_no) f on f.sasizu_no=a.sasizu_no
			WHERE a.rec_kbn>=3 AND a.rec_kbn<4
			ORDER BY a.nichiji,a.sasizu_no,a.rec_kbn";
		if ($this->db->execute($sql)) {
			$this->flash->success("zaiko_henkan_meisai_dt was created successfully");
		} else {
			$this->flash->error("zaiko_henkan_meisai_dt was not created ERROR!!");
		}
		$sql="INSERT INTO sfn.zaiko_henkan_meisai_dts (
				cd,
				bikou,
				zaiko_henkan_dt_id,
				henkansaki_flg,
				shouhin_mr_cd,
				kousei,
				tekiyou,
				hinsitu_kbn_cd,
				kousei_suuryou,
				iro,
				suuryou1,
				tanni_mr1_cd,
				suuryou2,
				tanni_mr2_cd,
				tanka_kbn,
				tanka,
				kingaku,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				2 as cd,
				(CASE a.oodama WHEN '1' THEN '大玉' ELSE '' END) as bikou,
				c.id as zaiko_henkan_dt_id,
				0 as henkansaki_flg,
				g.cd as shouhin_mr_cd,
				'├' as kousei,
				g.name as tekiyou,
				(CASE a.rec_kbn WHEN 3.1 THEN 21 ELSE 11 END) as hinsitu_kbn_cd,
				1 as kousei_suuryou,
				a.sasizu_no as iro,
				if(d.tanni_mr1_cd=4,1,a.honsuu) as suuryou1,
				d.tanni_mr1_cd as tanni_mr1_cd,
				a.itoryou as suuryou2,
				5 as tanni_mr2_cd,
				d.tanka_kbn as tanka_kbn,
				d.gentanka as tanka,
				if(d.tanka_kbn=2,a.itoryou,if(d.tanni_mr1_cd=4,1,a.honsuu))*d.gentanka as kingaku,
				b.user_id as sakusei_user_id,
				a.nichiji as created,
				b.user_id as kousin_user_id,
				a.nichiji as updated
			FROM itojisseki_vws as a
			LEFT JOIN sfn.shouhin_mrs as g ON g.cd LIKE concat('%',a.ito_code) AND g.zaikokanri = 0
			LEFT JOIN seisan_tantou_vws b on b.bangou = a.sagyousha_code
			LEFT JOIN sfn.zaiko_henkan_dts c on c.zaiko_henkan_kbn_cd=1 AND c.created = a.nichiji AND c.sasizu_dt_cd=a.sasizu_no AND c.sakusei_user_id = b.user_id
			LEFT JOIN sfn.juchuu_meisai_dts d on d.iro = a.sasizu_no AND d.shouhin_mr_cd = g.cd
			JOIN (select sasizu_no from prop_hikiate_vws group by sasizu_no) f on f.sasizu_no=a.sasizu_no
			WHERE a.rec_kbn>=3 AND a.rec_kbn<4
			ORDER BY a.nichiji,a.sasizu_no,a.rec_kbn";
		if ($this->db->execute($sql)) {
			$this->flash->success("zaiko_henkan_meisai_dt was created successfully");
		} else {
			$this->flash->error("zaiko_henkan_meisai_dt was not created ERROR!!");
		}
		$sql="INSERT INTO sfn.zaiko_henkan_meisai_dts (
				cd,
				bikou,
				zaiko_henkan_dt_id,
				henkansaki_flg,
				shouhin_mr_cd,
				kousei,
				tekiyou,
				hinsitu_kbn_cd,
				kousei_suuryou,
				iro,
				suuryou1,
				tanni_mr1_cd,
				suuryou2,
				tanni_mr2_cd,
				tanka_kbn,
				tanka,
				kingaku,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				2 + a.genryou_jun as cd,
				'' as bikou,
				c.id as zaiko_henkan_dt_id,
				0 as henkansaki_flg,
				g.cd as shouhin_mr_cd,
				'└' as kousei,
				g.name as tekiyou,
				11 as hinsitu_kbn_cd,
				d.gentanni as kousei_suuryou,
				a.sasizu_no as iro,
				a.honsuu as suuryou1,
				11 as tanni_mr1_cd,
				a.itoryou as suuryou2,
				5 as tanni_mr2_cd,
				2 as tanka_kbn,
				g.hyoujun_genka as tanka,
				g.hyoujun_genka * a.itoryou as kingaku,
				b.user_id as sakusei_user_id,
				a.nichiji as created,
				b.user_id as kousin_user_id,
				a.nichiji as updated
			FROM itojisseki_vws as a
			LEFT JOIN sfn.shouhin_mrs as g ON g.cd LIKE concat('%',a.ito_code) AND g.zaikokanri = 1
			LEFT JOIN seisan_tantou_vws b on b.bangou = a.sagyousha_code
			LEFT JOIN sfn.zaiko_henkan_dts c on c.zaiko_henkan_kbn_cd=1 AND c.created = a.nichiji AND c.sasizu_dt_cd=a.sasizu_no AND c.sakusei_user_id = b.user_id
			LEFT JOIN higenr_vws d on d.sasizu_no=a.sasizu_no AND d.genryou_jun=a.genryou_jun
			JOIN (select sasizu_no from prop_hikiate_vws group by sasizu_no) f on f.sasizu_no=a.sasizu_no
			WHERE a.rec_kbn=2
			ORDER BY a.nichiji,a.sasizu_no,a.rec_kbn";
		if ($this->db->execute($sql)) {
			$this->flash->success("zaiko_henkan_meisai_dt was created successfully");
		} else {
			$this->flash->error("zaiko_henkan_meisai_dt was not created ERROR!!");
		}
        $this->dispatcher->forward([
            'controller' => "itojisseki_vws",
            'action' => "search"
        ]);
	}

}

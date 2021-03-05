<?php

class ChartsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
    }

    /**
     * 導入
     */
    public function dounyuuAction()
    {
    }

    /**
     * 売上
     */
    public function uriageAction()
    {
    }

    /**
     * 売上レポート
     */
    public function uriagerepoAction()
    {
    }

    /**
     * 仕入
     */
    public function shiireAction()
    {
    }

    /**
     * 在庫
     */
    public function zaikoAction()
    {
    }

    /**
     * 仕入在庫レポート
     */
    public function shiirezaikorepoAction()
    {
    }

    /**
     * 事業所データ
     */
    public function jigyoushoAction()
    {
    }

    /**
     * 売上レポートajax
     */
	public function uriage1_ajaxGetAction()
	{
		$todate = $this->request->getPost('date')??date('Y-m-d');
//		$todate = '2018-04-12';//$this->request->getPost('date')??date('Y-m-d');
		$date01 = date('Y-m-01',strtotime($todate));
		$fromdate = date('Y-m-01',strtotime($date01.' -1 month'));
		$phql = "
			SELECT SUM(um.zeinukigaku) as um_kingaku, SUM(um.zeinukigaku - um.genkagaku) as arari, u.uriagebi as u_uriagebi, um.utiwake_kbn_cd as um_utiwake_kbn_cd
			FROM UriageMeisaiDts AS um
			LEFT JOIN UriageDts AS u ON um.uriage_dt_id = u.id
			WHERE u.uriagebi >= ?0 AND u.uriagebi <= ?1 AND um.utiwake_kbn_cd = '10'
			GROUP BY u.uriagebi
			ORDER BY u.uriagebi
		";
		$di   = \Phalcon\DI::getDefault();
		$mgr  = $di->get('modelsManager');
		$rows = $mgr->executeQuery($phql, [0 => $fromdate, 1 => $todate]);

		$returnData = array(
			'type' => 'line',
			'title' => '売上月計',
//			'data' => array(
				'labels' => [],
				'datasets' => array(
					array(
						'data' => [],
						'borderColor' => "#f7464a",
						'backgroundColor' => "rgba(153,255,51,0.4)",
						'label' => '当月粗利高',
						'fill' => true,
						'lineTension' => 0,
					),
					array(
						'data' => [],
						'borderColor' => "#5ea28e",
						'backgroundColor' => "rgba(153,255,51,0.4)",
						'label' => '当月売上高',
						'fill' => true,
						'lineTension' => 0,
					),
					array(
						'data' => [],
						'borderColor' => "#464af7",
						'backgroundColor' => "rgba(255,153,0,0.4)",
						'label' => '前月粗利高',
						'fill' => true,
						'lineTension' => 0,
					),
					array(
						'data' => [],
						'borderColor' => "#8e5ea2",
						'backgroundColor' => "rgba(255,153,0,0.4)",
						'label' => '前月売上高',
						'fill' => true,
						'lineTension' => 0,
					),
				),
//			),
			'options' => array(
				'scales' => array(
					'yAxes' => array(
						array(
							'label' => '金額(百万円)',
							'ticks' => array(
								'beginAtZero' => 'true',
							),
						),
					),
				),
			),
		);

		for ($i = 0; $i < 31; $i++) {
			$returnData['labels'][$i] = strval($i + 1).'日';
			for ($j = 0; $j < 4; $j++) {
				$returnData['datasets'][$j]['data'][$i] = null;
			}
		}
		for ($j = 0; $j < 4; $j++) {
			$ruikei[$j] = 0;
		}
		$i0 = 0;
		$i2 = 0;
		foreach ($rows as $row) {
			$i = intval(substr($row->u_uriagebi,-2)) - 1;
			if ($row->u_uriagebi < $date01) {
				for ( ; $i0 < $i - 1; $i0++) {
					$returnData['datasets'][3]['data'][$i0] = $ruikei[0];
					$returnData['datasets'][2]['data'][$i0] = $ruikei[1];
				}
				$ruikei[0] += $row->um_kingaku;
				$ruikei[1] += $row->arari;
				$returnData['datasets'][3]['data'][$i] = $ruikei[0];
				$returnData['datasets'][2]['data'][$i] = $ruikei[1];
			} else {
				for ( ; $i2 < $i; $i2++) {
					$returnData['datasets'][1]['data'][$i2] = $ruikei[2];
					$returnData['datasets'][0]['data'][$i2] = $ruikei[3];
				}
				$ruikei[2] += $row->um_kingaku;
				$ruikei[3] += $row->arari;
				$returnData['datasets'][1]['data'][$i] = $ruikei[2];
				$returnData['datasets'][0]['data'][$i] = $ruikei[3];
			}
		}


		return json_encode($returnData);
	}

}

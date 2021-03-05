<?php
 


class SensyokuIraisController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        if ($this->request->isPost()) {
            $startDate = $this->request->getPost('start_date');
            $endDate = $this->request->getPost('end_date');
        } else {
            $startDate = date("Y-m-01", strtotime("-3 month")); // 取り敢えずデフォルトで3ヶ月表示
            $endDate = date("Y-m-t");
        }

        $db = \Phalcon\DI::getDefault()->get('db');
        $phql = "
            select
                a.id as h_id,
                a.cd as h_cd,
                a.hacchuubi as hacchuubi,
                a.nounyuu_kijitu as nounyuu_kijitu,
                k.nouki_hensin as nouki_hensin,
                if(k.bika=1, 'ビーカー', '') as bika,
                k.bika_henji as bika_henji,
                b.id as h_meisai_id,
                b.cd as row,
                a.shiiresaki_mr_cd as shiiresaki_mr_cd,
                g.name as shiiresaki_name,
                case when c.nyuuka_kbn_max = '5' then '完' when c.nyuuka_kbn_max = '8' then 'ｷｬﾝｾﾙ' else '' end as nyuuka_kbn,
                b.utiwake_kbn_cd as utiwake_kbn_cd,
                b.shouhin_mr_cd as shouhin_mr_cd,
                b.tekiyou as tekiyou,
                b.iro as iro,
                b.lot as lot,
                b.iromei as iromei,
                b.suuryou1 as suuryou1,
                e.name as tanni1,
                b.suuryou2 as suuryou2,
                f.name as tanni2,
                b.tanka as tanka,
                if(h.tanka_kbn=2, f.name, e.name) as tanka_tani,
                j.tokuisaki_mr_cd as tokuisaki_mr_cd,
                sei.name as tokuisaki_name,
                bun.name as shouhin_bunrui3_kbn_cd,
                j.saki_hacchuu_cd as saki_hacchuu_cd,
                k.sensyokubi as sensyokubi,
                case when a.hassousaki_kbn_cd = 2 then t.name when a.hassousaki_kbn_cd = 3 then n.name when a.hassousaki_kbn_cd = 4 then s.name else '' end as syukkasaki_name,
                case when a.hassousaki_kbn_cd = 2 then t.juusho1 when a.hassousaki_kbn_cd = 3 then n.juusho1 when a.hassousaki_kbn_cd = 4 then s.juusho1 else '' end as syukkasaki_juusho1,
                case when a.hassousaki_kbn_cd = 2 then t.name when a.hassousaki_kbn_cd = 3 then n.juusho2 when a.hassousaki_kbn_cd = 4 then s.juusho2 else '' end as syukkasaki_juusho2,
                case when a.hassousaki_kbn_cd = 2 then t.name when a.hassousaki_kbn_cd = 3 then n.tel when a.hassousaki_kbn_cd = 4 then s.tel else '' end as syukkasaki_tel
            from hacchuu_dts as a
            left join hacchuu_meisai_dts as b on b.hacchuu_dt_id = a.id
            left join sensyoku_irais as k on k.h_meisai_id = b.id
            left join shiire_nyuuka_max_vws as c on c.hacchuu_dt_id = a.id and c.cd = b.shouhin_mr_cd and c.irocd = b.iro
            left join tanni_mrs as e on e.cd = b.tanni_mr1_cd
            left join tanni_mrs as f on f.cd = b.tanni_mr2_cd
            left join shiiresaki_mrs as g on g.cd = a.shiiresaki_mr_cd
            left join shouhin_mrs as h on h.cd = b.shouhin_mr_cd
            left join juchuu_dts as j on j.cd = a.juchuu_dt_cd
            left join tokuisaki_mrs as sei on sei.cd = j.tokuisaki_mr_cd
            left join souko_mrs as s on s.cd = a.hassousaki_mr_cd
            left join nounyuusaki_mrs as n on n.cd = a.hassousaki_mr_cd
            left join tokuisaki_mrs as t on t.cd = a.hassousaki_mr_cd
            left join shouhin_bunrui3_kbns as bun on bun.cd = h.shouhin_bunrui3_kbn_cd
            where ( a.hacchuubi between '{$startDate}' and '{$endDate}' )
            and a.shiiresaki_mr_cd in (
                select cd as cd from shiiresaki_mrs where shiiresaki_bunrui5_kbn_cd = 'S'
            )
            and (b.bikou not like '%調整%' )
            order by a.id DESC, b.cd
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // 発注データを染色依頼で使用できる形に編集
        $data = [];
        $i = 0;
        $tempSuuryou = 0;
        $tempId = '';
        foreach ($rows as $row) {
            $tempId = $data[$i]['h_id'];
            if ($row['utiwake_kbn_cd'] === '20') {
                if ((float)$row['suuryou1'] < 0) {
                    continue;
                } else if ((float)$row['suuryou2'] < 0) {
                    continue;
                }
                $data[$i]['h_id'] = $row['h_id'];
                $data[$i]['h_cd'] = $row['h_cd'];
                $data[$i]['h_meisai_id'] = $row['h_meisai_id'];
                $data[$i]['row'] = $row['row'];
                $data[$i]['shiiresaki_mr_cd'] = $row['shiiresaki_mr_cd'];
                $data[$i]['shiiresaki_name'] = $row['shiiresaki_name'];
                $data[$i]['nyuuka_kbn'] = $row['nyuuka_kbn'];
                $data[$i]['shouhin_mr_cd'] = $row['shouhin_mr_cd'];
                $data[$i]['tekiyou'] = $row['tekiyou'];
                $data[$i]['iro'] = $row['iro'];
                $data[$i]['iromei'] = $row['iromei'];
                $data[$i]['lot'] = $row['lot'];
                $data[$i]['suuryou1'] = $row['suuryou1'];
                $data[$i]['tanni1'] = $row['tanni1'];
                $data[$i]['nouki'] = $row['nouki'];
                $data[$i]['suuryou2'] = $row['suuryou2'];
                $tempSuuryou = (float)$row['suuryou2'];
                $data[$i]['tanni2'] = $row['tanni2'];
                $data[$i]['lot'] = $row['lot'];
                $data[$i]['hacchuubi'] = $row['hacchuubi'];
                $data[$i]['nounyuu_kijitu'] = $row['nounyuu_kijitu'];
                $data[$i]['nouki_hensin'] = $row['nouki_hensin'];
                $data[$i]['tokuisaki_mr_cd'] = $row['tokuisaki_mr_cd'];
                $data[$i]['tokuisaki_name'] = $row['tokuisaki_name'];
                $data[$i]['shouhin_bunrui3_kbn_cd'] = $row['shouhin_bunrui3_kbn_cd'];
                $data[$i]['syukkasaki_name'] = $row['syukkasaki_name'];
                $data[$i]['syukkasaki_juusho'] = $row['syukkasaki_juusho1'] . ' ' . $row['syukkasaki_juusho2'];
                $data[$i]['syukkasaki_tel'] = $row['syukkasaki_tel'];
                $data[$i]['saki_hacchuu_cd'] = $row['saki_hacchuu_cd'];
                $data[$i]['sensyokubi'] = $row['sensyokubi'];
            } else if ($row['utiwake_kbn_cd'] === '21') { // 原料
                if ($tempId === $row['h_id']) {
                    $data[$i]['genryou_cd'] .= $row['shouhin_mr_cd'] . ',';
                    $data[$i]['genryou_name'] .= $row['tekiyou'] . ',';
                    try {
                        $data[$i]['konritsu'] .= round(((float)$row['suuryou2'] / $tempSuuryou) * 100) . '%,';
                    } catch (Exception $e) {
                        $data[$i]['konritsu'] .= '0%,';
                    }
                }
            } else if ($row['utiwake_kbn_cd'] === '10') { // 工賃か試作
                if ($row['shouhin_mr_cd'] == '988') { // 試作
                    continue; // 内訳１０は試作でも表示しない
                } else { // 工賃
                    if ($data[$i]['shouhin_mr_cd']) {
                        if ($tempId === $data[$i]['h_id']) {
                            $data[$i]['kouchin'] = $row['tanka'];
                            $data[$i]['tanka_tani'] = $row['tanka_tani'];
                            $tempSuuryou = 0;
                            $i++;
                        }
                    }
                }
            } else {
                continue;
            }
        }

        $this->tag->setDefault("start_date", $startDate);
        $this->tag->setDefault("end_date", $endDate);
        $this->view->data = $data;
    }

    /**
     * Edits a sensyoku_irai
     *
     * @return void
     */
    public function editAction()
    {
        $h_id = $this->request->getQuery('h_id');
        $h_meisai_id = $this->request->getQuery('h_meisai_id');
        $h_cd = $this->request->getQuery('h_cd');
        $meisaiRow = $this->request->getQuery('meisai_row');
        $genryouCds = $this->request->getQuery('genryou_cd');
        $genryouNames = $this->request->getQuery('genryou_name');
        $konritsu = $this->request->getQuery('konritsu');
        $koutin = $this->request->getQuery('koutin');
        $tanka_tani = $this->request->getQuery('tanka_tani');
        if ($this->request->getQuery('message')) {
            $message = $this->request->getQuery('message');
        } else {
            $message = '';
        }

        $db = \Phalcon\DI::getDefault()->get('db');
        // 発注データ
        $phql = "
            select
                a.id as h_id,
                a.cd as h_cd,
                a.nounyuu_kijitu as nounyuu_kijitu,
                b.id as h_meisai_id,
                a.hacchuubi as hacchuubi,
                c.name as shiiresaki_name,
                a.juchuu_dt_cd as juchuu_no,
                d.name as tantou_name,
                b.shouhin_mr_cd as shouhin_mr_cd,
                b.tekiyou as tekiyou,
                b.lot as lot,
                b.iro as iroban,
                b.iromei as iromei,
                b.suuryou1 as suuryou1,
                e.name as tanni1,
                b.suuryou2 as suuryou2,
                f.name as tanni2,
                b.utiwake_kbn_cd as utiwake,
                j.saki_hacchuu_cd as saki_hacchuu_cd,
                case when a.hassousaki_kbn_cd = 2 then t.name when a.hassousaki_kbn_cd = 3 then n.name when a.hassousaki_kbn_cd = 4 then s.name else '' end as syukkasaki_name,
                case when a.hassousaki_kbn_cd = 2 then t.juusho1 when a.hassousaki_kbn_cd = 3 then n.juusho1 when a.hassousaki_kbn_cd = 4 then s.juusho1 else '' end as syukkasaki_juusho1,
                case when a.hassousaki_kbn_cd = 2 then t.juusho2 when a.hassousaki_kbn_cd = 3 then n.juusho2 when a.hassousaki_kbn_cd = 4 then s.juusho2 else '' end as syukkasaki_juusho2,
                case when a.hassousaki_kbn_cd = 2 then t.tel when a.hassousaki_kbn_cd = 3 then n.tel when a.hassousaki_kbn_cd = 4 then s.tel else '' end as syukkasaki_tel
            from hacchuu_dts as a 
            left join hacchuu_meisai_dts as b on b.hacchuu_dt_id = a.id
            left join shiiresaki_mrs as c on c.cd = a.shiiresaki_mr_cd
            left join tantou_mrs as d on d.cd = a.tantou_mr_cd
            left join tanni_mrs as e on e.cd = b.tanni_mr1_cd
            left join tanni_mrs as f on f.cd = b.tanni_mr2_cd
            left join juchuu_dts as j on j.cd = a.juchuu_dt_cd
            left join tokuisaki_mrs as sei on sei.cd = j.tokuisaki_mr_cd
            left join souko_mrs as s on s.cd = a.hassousaki_mr_cd
            left join nounyuusaki_mrs as n on n.cd = a.hassousaki_mr_cd
            left join tokuisaki_mrs as t on t.cd = a.hassousaki_mr_cd
            where a.id = {$h_id} and b.id = {$h_meisai_id}
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($data[0]['juchuu_no'] > 0) {
            $query = $this->modelsManager->createQuery("select id from JuchuuDts where cd = {$data[0]['juchuu_no']}");
            $juchuuModel = $query->execute();
        } else {
            $juchuuModel = '';
        }

        $this->tag->setDefault('h_id', $h_id);
        $this->tag->setDefault('h_meisai_id', $h_meisai_id);
        $this->tag->setDefault('h_cd', $h_cd);
        $this->tag->setDefault('meisai_row', $meisaiRow);
        $this->tag->setDefault('nouki_memo', $data[0]['nounyuu_kijitu']);
        if ($juchuuModel !== '') {
            $this->tag->setDefault('juchuu_id', $juchuuModel[0]['id']);
            $this->tag->setDefault('juchuu_no', $data[0]['juchuu_no']);
        }
        $this->tag->setDefault('koutin', $koutin);
        $this->tag->setDefault('tanka_tani', $tanka_tani);
        $this->tag->setDefault('shiiresaki_name', $data[0]['shiiresaki_name']);
        $this->tag->setDefault('hacchuubi', $data[0]['hacchuubi']);
        $this->tag->setDefault('tantou_name', $data[0]['tantou_name']);
        $this->tag->setDefault('shouhin_mr_cd', $data[0]['shouhin_mr_cd']);
        $this->tag->setDefault('tekiyou', $data[0]['tekiyou']);
        $this->tag->setDefault('lot', $data[0]['lot']);
        $this->tag->setDefault('iroban', $data[0]['iroban']);
        $this->tag->setDefault('iromei', $data[0]['iromei']);
        $this->tag->setDefault('suuryou1', number_format($data[0]['suuryou1']). ' ' . $data[0]['tanni1']);
        $this->tag->setDefault('suuryou2', number_format($data[0]['suuryou2'], 2) . ' ' . $data[0]['tanni2']);
        $this->tag->setDefault('syukkasaki_juusho', $data[0]['syukkasaki_juusho1'] . $data[0]['syukkasaki_juusho2']);
        $this->tag->setDefault('syukkasaki_name', $data[0]['syukkasaki_name']);
        $this->tag->setDefault('tel', $data[0]['syukkasaki_tel']);
        $this->tag->setDefault('saki_hacchuu_cd', $data[0]['saki_hacchuu_cd']);

        // 染色依頼内容取得
        $phql = "
            select * from sensyoku_irais where h_id = {$h_id} and h_meisai_id = {$h_meisai_id}
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $iraiData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->tag->setDefault('id', $iraiData[0]['id']);
        $this->tag->setDefault('bunkatsu', $iraiData[0]['bunkatsu']);
        $this->tag->setDefault('nouki_hensin', $iraiData[0]['nouki_hensin']);
        $this->tag->setDefault('bika', $iraiData[0]['bika']);
        $this->tag->setDefault('bika_henji', $iraiData[0]['bika_henji']);
        $this->tag->setDefault('atomaki_oiru', $iraiData[0]['atomaki_oiru']);
        $this->tag->setDefault('kakou_shurui', $iraiData[0]['kakou_shurui']);
        $this->tag->setDefault('memo', $iraiData[0]['memo']);
        $this->tag->setDefault('seikyuusaki', $iraiData[0]['seikyuusaki']);
        $this->tag->setDefault('koujou_hensin', $iraiData[0]['koujou_hensin']);
        $this->tag->setDefault('sensyokubi', $iraiData[0]['sensyokubi']);
        $this->tag->setDefault('shukkabi', $iraiData[0]['shukkabi']);
        $this->tag->setDefault('shanai_bikou', $iraiData[0]['shanai_bikou']);
        $this->tag->setDefault('sai_fax_memo', $iraiData[0]['sai_fax_bikou']);
        $this->tag->setDefault('asistant', $iraiData[0]['asistant']);
        $this->tag->setDefault('gotantousha', $iraiData[0]['gotantousha']);
        $this->tag->setDefault('genryou_bikou', $iraiData[0]['genryou_bikou']);
        $this->tag->setDefault('genryou_cds', $genryouCds);
        $this->tag->setDefault('genryou_names', $genryouNames);
        $this->tag->setDefault('konritsu', $konritsu);
        $this->tag->setDefault('updated', $iraiData[0]['updated']);
        if ($iraiData[0]['kousin_user_id']) {
            $users = Users::find('id = ' . $iraiData[0]['kousin_user_id']);
            foreach ($users as $user) {
                $this->tag->setDefault('kousin_user_id', $user->name);
            }
        }

        if ($message !== '') {
            $this->view->message = $message;
        }
        $this->view->genryou_cds = explode(',', $genryouCds);
        $this->view->genryou_names = explode(',', $genryouNames);
        $this->view->konritsus = explode(',', $konritsu);
    }

    /**
     * Saves a sensyoku_irai edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->flash->error('保存はポストアクセスのみ可能です。');
            $this->dispatcher->forward([
                'controller' => "sensyoku_irais",
                'action' => 'index'
            ]);
            return;
        }

        $id = $this->request->getPost("id");
        $h_id = $this->request->getPost('h_id');
        $h_meisai_id = $this->request->getPost('h_meisai_id');
        // リダイレクト時に必要
        $h_cd = $this->request->getPost('h_cd');
        $meisaiRow = $this->request->getPost('meisai_row');
        $genryouCds = $this->request->getPost('genryou_cds');
        $genryouNames = $this->request->getPost('genryou_names');
        $konritsu = $this->request->getPost('konritsu');
        $koutin = $this->request->getPost('koutin');
        $tankaTanni = $this->request->getPost('tanka_tani');

        $id = $this->request->getPost("id");
        $sensyoku_irai = SensyokuIrais::findFirstByid($id);
        if (!$sensyoku_irai) {
            // idで見つからない場合、新規登録
            $sensyoku_irai = new SensyokuIrais();
        }
        $sensyoku_irai->h_id = $this->request->getPost("h_id");
        $sensyoku_irai->h_meisai_id = $this->request->getPost("h_meisai_id");
        $sensyoku_irai->row = $this->request->getPost("meisai_row");
        $sensyoku_irai->bunkatsu = $this->request->getPost("bunkatsu");
        $sensyoku_irai->bika = $this->request->getPost("bika");
        $sensyoku_irai->bika_henji = $this->request->getPost("bika_henji");
        $sensyoku_irai->nouki_hensin = $this->request->getPost("nouki_hensin");
        $sensyoku_irai->genryou_bikou = $this->request->getPost("genryou_bikou");
        $sensyoku_irai->kakou_shurui = $this->request->getPost("kakou_shurui");
        $sensyoku_irai->atomaki_oiru = $this->request->getPost("atomaki_oiru");
        $sensyoku_irai->memo = $this->request->getPost("memo");
        $sensyoku_irai->seikyuusaki = $this->request->getPost("seikyuusaki");
        $sensyoku_irai->koujou_hensin = $this->request->getPost("koujou_hensin");
        $sensyoku_irai->sensyokubi = $this->request->getPost("sensyokubi");
        $sensyoku_irai->shukkabi = $this->request->getPost("shukkabi1") === '' ? '0000-00-00' : $this->request->getPost("shukkabi1");
        $sensyoku_irai->shanai_bikou = $this->request->getPost("shanai_bikou");
        $sensyoku_irai->sai_fax_bikou = $this->request->getPost("sai_fax_memo");
        $sensyoku_irai->asistant = $this->request->getPost("asistant");
        $sensyoku_irai->gotantousha = $this->request->getPost("gotantousha");
        $sensyoku_irai->koutin = $koutin;
        $sensyoku_irai->genryou = $genryouNames;
        if (!$sensyoku_irai->save()) {
            foreach ($sensyoku_irai->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                'controller' => "sensyoku_irais",
                'action' => 'edit',
                'params' => [$id]
            ]);
            return;
        }
        $message = "染色依頼データを更新しました。";
        $this->tag->setDefault('id', $sensyoku_irai->id);
        $params = [];
        $params['h_id'] = $h_id;
        $params['h_cd'] = $h_cd;
        $params['h_meisai_id'] = $h_meisai_id;
        $params['meisai_row'] = $meisaiRow;
        $params['genryou_cd'] = $genryouCds;
        $params['genryou_name'] = $genryouNames;
        $params['konritsu'] = $konritsu;
        $params['koutin'] = $koutin;
        $params['tanka_tani'] = $tankaTanni;
        $params['message'] = $message;
        $getParams = http_build_query($params);
        header(
            "Location: http://192.168.11.199/demo/sensyoku_irais/edit?{$getParams}"
        );
    }

    /**
     * 染色依頼エクセル印刷（Excelテンプレートへデータを出力する）
     *
     * @return \Phalcon\Http\Response
     */
    public function excelPrintAction(): \Phalcon\Http\Response
    {
        $post = $this->request->getPost();
        if (!$this->request->isPost()) {
            $this->flash->error('保存はポストアクセスのみ可能です。');
            $this->dispatcher->forward([
                'controller' => "sensyoku_irais",
                'action' => 'index'
            ]);
        }

        $id = $this->request->getPost("id");
        $h_id = $this->request->getPost('h_id');
        $h_meisai_id = $this->request->getPost('h_meisai_id');
        // リダイレクト時に必要
        $h_cd = $this->request->getPost('h_cd');
        $meisaiRow = $this->request->getPost('meisai_row');
        $genryouCds = $this->request->getPost('genryou_cds');
        $genryouNames = $this->request->getPost('genryou_names');
        $konritsu = $this->request->getPost('konritsu');
        $koutin = $this->request->getPost('koutin');
        $tankaTanni = $this->request->getPost('tanka_tani');

        $id = $this->request->getPost("id");
        $sensyoku_irai = SensyokuIrais::findFirstByid($id);
        if (!$sensyoku_irai) {
            // idで見つからない場合、新規登録
            $sensyoku_irai = new SensyokuIrais();
        }
        $sensyoku_irai->h_id = $this->request->getPost("h_id");
        $sensyoku_irai->h_meisai_id = $this->request->getPost("h_meisai_id");
        $sensyoku_irai->row = $this->request->getPost("meisai_row");
        $sensyoku_irai->bunkatsu = $this->request->getPost("bunkatsu");
        $sensyoku_irai->bika = $this->request->getPost("bika");
        $sensyoku_irai->bika_henji = $this->request->getPost("bika_henji");
        $sensyoku_irai->nouki_hensin = $this->request->getPost("nouki_hensin");
        $sensyoku_irai->genryou_bikou = $this->request->getPost("genryou_bikou");
        $sensyoku_irai->kakou_shurui = $this->request->getPost("kakou_shurui");
        $sensyoku_irai->atomaki_oiru = $this->request->getPost("atomaki_oiru");
        $sensyoku_irai->memo = $this->request->getPost("memo");
        $sensyoku_irai->seikyuusaki = $this->request->getPost("seikyuusaki");
        $sensyoku_irai->koujou_hensin = $this->request->getPost("koujou_hensin");
        $sensyoku_irai->sensyokubi = $this->request->getPost("sensyokubi");
        $sensyoku_irai->shukkabi = $this->request->getPost("shukkabi1") === '' ? '0000-00-00' : $this->request->getPost("shukkabi1");
        $sensyoku_irai->shanai_bikou = $this->request->getPost("shanai_bikou");
        $sensyoku_irai->sai_fax_bikou = $this->request->getPost("sai_fax_memo");
        $sensyoku_irai->asistant = $this->request->getPost("asistant");
        $sensyoku_irai->gotantousha = $this->request->getPost("gotantousha");
        $sensyoku_irai->koutin = $koutin;
        $sensyoku_irai->genryou = $genryouNames;
        if (!$sensyoku_irai->save()) {
            foreach ($sensyoku_irai->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                'controller' => "sensyoku_irais",
                'action' => 'edit',
                'params' => [$id]
            ]);
        }
//        $this->tag->setDefault('id', $sensyoku_irai->id);
        $this->view->irai_id = $sensyoku_irai->id;

        $db = \Phalcon\DI::getDefault()->get('db');
        $phql = "
            select
                a.cd as cd,
                a.hacchuubi as hacchuubi,
                tan.name as tantou,
                a.hassousaki_mr_name as hassousaki_mr_name,
                a.hacchuubi as hacchuubi,
                a.shiiresaki_mr_cd as shiiresaki_mr_cd,
                d.name as shiiresaki_name,
                b.id as h_meisai_id,
                b.shouhin_mr_cd as shouhin_mr_cd,
                b.tekiyou as tekiyou,
                b.lot as lot,
                b.iro as iro,
                b.iromei as iromei,
                b.suuryou1 as suuryou1,
                e.name as tanni1,
                b.suuryou2 as suuryou2,
                f.name as tanni2,
                c.bunkatsu as bunkatsu,
                c.kakou_shurui as kakou_shurui,
                c.atomaki_oiru as atomaki_oiru,
                c.bika_henji as bika_henji,
                c.memo as memo,
                c.koutin as koutin,
                c.genryou_bikou as genryou_bikou,
                c.sai_fax_bikou as sai_fax_bikou,
                u.name as asistant,
                c.gotantousha as gotantousha,
                a.nounyuu_kijitu as nounyuu_kijitu,
                j.saki_hacchuu_cd as saki_hacchuu_cd,
                case when a.hassousaki_kbn_cd = 2 then t.name when a.hassousaki_kbn_cd = 3 then n.name when a.hassousaki_kbn_cd = 4 then s.name else '' end as syukkasaki_name,
                case when a.hassousaki_kbn_cd = 2 then t.juusho1 when a.hassousaki_kbn_cd = 3 then n.juusho1 when a.hassousaki_kbn_cd = 4 then s.juusho1 else '' end as syukkasaki_juusho1,
                case when a.hassousaki_kbn_cd = 2 then t.juusho2 when a.hassousaki_kbn_cd = 3 then n.juusho2 when a.hassousaki_kbn_cd = 4 then s.juusho2 else '' end as syukkasaki_juusho2,
                case when a.hassousaki_kbn_cd = 2 then t.tel when a.hassousaki_kbn_cd = 3 then n.tel when a.hassousaki_kbn_cd = 4 then s.tel else '' end as syukkasaki_tel
            from hacchuu_dts as a
            left join hacchuu_meisai_dts as b on b.hacchuu_dt_id = a.id
            left join sensyoku_irais as c on c.h_meisai_id = b.id
            left join tantou_mrs as tan on tan.cd = a.tantou_mr_cd
            left join users as u on u.id = c.asistant
            left join juchuu_dts as j on j.cd = a.juchuu_dt_cd
            left join shiiresaki_mrs as d on d.cd = a.shiiresaki_mr_cd
            left join tanni_mrs as e on e.cd = b.tanni_mr1_cd
            left join tanni_mrs as f on f.cd = b.tanni_mr2_cd
            left join souko_mrs as s on s.cd = a.hassousaki_mr_cd
            left join nounyuusaki_mrs as n on n.cd = a.hassousaki_mr_cd
            left join tokuisaki_mrs as t on t.cd = a.hassousaki_mr_cd
            where a.id = {$h_id} and b.utiwake_kbn_cd = 20
            and (b.bikou not like '%調整%' )
            order by a.cd, b.cd
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php'; //Include PHPExcel_IOFactory
        $objReader = PHPExcel_IOFactory::createReader("Excel2007");
        //テンプレートファイルパス
        $temp_dir = __DIR__ . '/temp/';
        $temp_path = $temp_dir . 'sensyoku_irais.xlsx';
        $PHPExcel = $objReader->load($temp_path);
        if ((int)$post['bika'] === 1) {
            $sheet = $PHPExcel->getSheetByName('VIEW_BIKA');
        } else {
            $sheet = $PHPExcel->getSheetByName('VIEW');
        }
        $count = count($data);
        foreach ($data as $item) {
            $sheet->setCellValue('AZ1', $item['cd']);
            $sheet->setCellValue('AZ2', $item['saki_hacchuu_cd']);
            $sheet->setCellValue('Y9', $item['hacchuubi']);
            $sheet->setCellValue('C5', $item['shiiresaki_name']);
            $sheet->setCellValue('C1', $item['sai_fax_bikou']);
            $sheet->setCellValue('C8', $item['gotantousha']);
            $sheet->setCellValue('AQ11', $item['tantou']);
            $sheet->setCellValue('BC11', $item['asistant']);
            $sheet->setCellValue('AZ2', $item['saki_hacchuu_cd']);
            $sheet->setCellValue('C45', $item['syukkasaki_name']);
            $sheet->setCellValue('C48', $item['syukkasaki_juusho1'] . ' ' . $item['syukkasaki_juusho2']);

            $keys = array_keys($post);
            $genryouName = '';
            foreach ($keys as $key) {
                if (preg_match('/genryou_name_/', $key)) {
                    $genryouName .= $post[$key] . ',' . PHP_EOL;
                }
            }
            $sheet->setCellValue('AN43', $genryouName . ' ' . $item['genryou_bikou']);
        }
        $interval = 4;
        $j = 15;
        for ($i = 0; $i < $count; $i++) {
            $sheet->setCellValue('C' . $j, $data[$i]['tekiyou']);
            $sheet->setCellValue('L' . $j, $data[$i]['iro']);
            $sheet->setCellValue('R' . $j, $data[$i]['iromei']);
            $sheet->setCellValue('X' . $j, $data[$i]['suuryou2']);
            $sheet->setCellValue('AB' . $j, $data[$i]['suuryou1']);
            $sheet->setCellValue('AF' . $j, $data[$i]['bunkatsu']);
            $sheet->setCellValue('AH' . $j, $data[$i]['bika_henji']);
            $sheet->setCellValue('AT' . $j, $data[$i]['koutin']);
            if ($data[$i]['nounyuu_kijitu'] !== '0000-00-00') {
                $sheet->setCellValue('AX' . $j, substr($data[$i]['nounyuu_kijitu'], 5, 5));
            }
            $sheet->setCellValue('BD' . $j, $data[$i]['h_meisai_id']);
            $j += 4;
            if ($i === 0) {
                $sheet->setCellValue('C53', $item['syukkasaki_tel']);
                $sheet->setCellValue('S45', $item['memo']);
                $sheet->setCellValue('AN47', $item['kakou_shurui']);
                $sheet->setCellValue('AN51', $item['atomaki_oiru']);
            }
        }

        if ((int)$post['bika'] === 1) {
            $PHPExcel->setActiveSheetIndex(1);
        } else {
            $PHPExcel->setActiveSheetIndex(0);
        }
        $filename = uniqid("sensyoku_irais_" . $post['hacchuubi'] . '_' . $post['shiiresaki_name'] . '_', true) . '.xlsx';
        $upload = __DIR__ . '/temp/';
        $path = $upload . $filename;
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save($path);

        $response = new \Phalcon\Http\Response();
        $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->setHeader('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setHeader('Cache-Control', 'max-age=1');
        $response->setContent(file_get_contents($path));
        unlink($path);

        return $response;
    }

    public function exportHoukokuAction (): \Phalcon\Http\Response
    {
        $post = $this->request->getPost();
        $response = new Phalcon\Http\Response();
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php'; //Include PHPExcel_IOFactory
        $objReader = PHPExcel_IOFactory::createReader("Excel2007");
        //テンプレートファイルパス
        $temp_dir = __DIR__ . '/temp/';
        $temp_path = $temp_dir . 'nouki_houkoku.xlsx';
        $PHPExcel = $objReader->load($temp_path);
        $sheet = $PHPExcel->getSheetByName('DATA');
        foreach ($post as $item) {
            for ($j = 0; $j < count($post); $j++) {
                $sheet->fromArray($item, null, 'A' . ($j + 1) );
            }
        }
        $PHPExcel->setActiveSheetIndex(1);
        $filename = uniqid("nouki_houkoku_", true) . '.xlsx';
        $upload = __DIR__ . '/../../public/temp/';
        $path = $upload . $filename;
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save($path);

        return $response->setContent(json_encode($path));
    }

    public function delExcelAction()
    {
        $response = new Phalcon\Http\Response();
        $path = $this->request->getPost('path');
        unlink(__DIR__ . '/../../public' . $path);
        return $response->setContent(json_encode(['ok:' => 'unlink→' . $path]));
    }

}

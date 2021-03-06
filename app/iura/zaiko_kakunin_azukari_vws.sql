drop VIEW `zaiko_kakunin_azukari_vws`;
CREATE VIEW `zaiko_kakunin_azukari_vws` AS select 

`a`.`shouhin_mr_cd`,
`a`.`tantou_mr_cd`,
`a`.`tanni_mr1_cd`,
`a`.`tanni_mr2_cd`,
`a`.`iro`,
`a`.`iromei`,
`a`.`lot`,
`a`.`kobetucd`,
`a`.`hinsitu_kbn_cd`,
`a`.`hinsitu_hyouka_kbn_cd`,
`a`.`souko_mr_cd`,
`a`.`nyuukobis`,
`a`.`shukkobis`,
`a`.`nyuushukkobi`,
`a`.`nyuushukkoym`,
'shiire' AS `denpyou_mr_cd`,
`a`.`id`,
`a`.`cd`,
`a`.`meisai_id`,
`a`.`meisai_cd`,
`a`.`utiwake_kbn_cd`,
`a`.`torihikisaki_cd`,
`a`.`bikou`,
`a`.`zaiko_ryou1s`,
`a`.`zaiko_ryou2s`,
`a`.`tanka_tanni_mr_cd`,
`a`.`shiirebi_tankas`,
`a`.`shiire_gakus`,
`a`.`shiire_ryou1s`,
`a`.`shiire_ryou2s`,
0 AS `hokanyuuko_ryou1s`,
0 AS `hokanyuuko_ryou2s`,
0 AS `uriage_ryou1s`,
0 AS `uriage_ryou2s`,
`a`.`hokashukko_ryou1s`,
`a`.`hokashukko_ryou2s`,
`a`.`shiiresaki_mr_cd`,
NULL AS `tokuisaki_mr_cd`,
NULL AS `nounyuu_kijitu`,
NULL AS `nouki`,
`a`.`hacchuu_dt_id`,
0 AS `juchuu_dt_id`,
`a`.`hacchuuzan_ryou1`,
`a`.`hacchuuzan_ryou2`,
0 AS `juchuuzan_ryou1`,
0 AS `juchuuzan_ryou2`,
`a`.`azukari_zan1s`,
`a`.`azukari_zan2s`,
`a`.`azukari_tasi1s`,
`a`.`azukari_tasi2s`,
`a`.`azukari_hiki1s`,
`a`.`azukari_hiki2s` 

from `work_shiire_vws` `a`
union all select

`b`.`shouhin_mr_cd`,
`b`.`tantou_mr_cd`,
`b`.`tanni_mr1_cd`,
`b`.`tanni_mr2_cd`,
`b`.`iro`,
`b`.`iromei`,
`b`.`lot`,
`b`.`kobetucd`,
`b`.`hinsitu_kbn_cd`,
`b`.`hinsitu_hyouka_kbn_cd`,
`b`.`souko_mr_cd`,
NULL AS `nyuukobis`,
`b`.`shukkobis`,
`b`.`nyuushukkobi`,
`b`.`nyuushukkoym`,
'uriage' AS `denpyou_mr_cd`,
`b`.`id`,
`b`.`cd`,
`b`.`meisai_id`,
`b`.`meisai_cd`,
`b`.`utiwake_kbn_cd`,
`b`.`torihikisaki_cd`,
`b`.`bikou`,
`b`.`zaiko_ryou1s`,
`b`.`zaiko_ryou2s`,
`b`.`tanka_tanni_mr_cd`,
'0000-00-000' AS `shiirebi_tankas`,
0 AS `shiire_gakus`,
0 AS `shiire_ryou1s`,
0 AS `shiire_ryou2s`,
0 AS `hokanyuuko_ryou1s`,
0 AS `hokanyuuko_ryou2s`,
`b`.`uriage_ryou1s`,
`b`.`uriage_ryou2s`,
0 AS `hokashukko_ryou1s`,
0 AS `hokashukko_ryou2s`,
NULL AS `shiiresaki_mr_cd`,
`b`.`tokuisaki_mr_cd`,
NULL AS `nounyuu_kijitu`,
NULL AS `nouki`,
0 AS `hacchuu_dt_id`,
`b`.`juchuu_dt_id`,
0 AS `hacchuuzan_ryou1`,
0 AS `hacchuuzan_ryou2`,
`b`.`juchuuzan_ryou1`,
`b`.`juchuuzan_ryou2`,
`b`.`azukari_zan1s`,
`b`.`azukari_zan2s`,
`b`.`azukari_tasi1s`,
`b`.`azukari_tasi2s`,
`b`.`azukari_hiki1s`,
`b`.`azukari_hiki2s`

from `work_uriage_vws` `b` 
union all select

`c`.`shouhin_mr_cd`,
`c`.`tantou_mr_cd`,
`c`.`tanni_mr1_cd`,
`c`.`tanni_mr2_cd`,
`c`.`iro`,
`c`.`iromei`,
`c`.`lot`,
`c`.`kobetucd`,
`c`.`hinsitu_kbn_cd`,
`c`.`hinsitu_hyouka_kbn_cd`,
'' AS `souko_mr_cd`,
NULL AS `nyuukobis`,
NULL AS `shukkobis`,
NULL AS `nyuushukkobi`,
'' AS `nyuushukkoym`,
'hacchuu' AS `denpyou_mr_cd`,
`c`.`id`,
`c`.`cd`,
`c`.`meisai_id`,
`c`.`meisai_cd`,
`c`.`utiwake_kbn_cd`,
`c`.`torihikisaki_cd`,
`c`.`bikou`,
0 AS `zaiko_ryou1s`,
0 AS `zaiko_ryou2s`,
`c`.`tanka_tanni_mr_cd`,
'0000-00-000' AS `shiirebi_tankas`,
0 AS `shiire_gakus`,
0 AS `shiire_ryou1s`,
0 AS `shiire_ryou2s`,
0 AS `hokanyuuko_ryou1s`,
0 AS `hokanyuuko_ryou2s`,
0 AS `uriage_ryou1s`,
0 AS `uriage_ryou2s`,
0 AS `hokashukko_ryou1s`,
0 AS `hokashukko_ryou2s`,
`c`.`shiiresaki_mr_cd`,
NULL AS `tokuisaki_mr_cd`,
`c`.`nounyuu_kijitu`,
`c`.`nouki`,
`c`.`hacchuu_dt_id`,
0 AS `juchuu_dt_id`,
`c`.`hacchuuzan_ryou1`,
`c`.`hacchuuzan_ryou2`,
0 AS `juchuuzan_ryou1`,
0 AS `juchuuzan_ryou2`,
0 AS `azukari_zan1s`,
0 AS `azukari_zan2s`,
0 AS `azukari_tasi1s`,
0 AS `azukari_tasi2s`,
0 AS `azukari_hiki1s`,
0 AS `azukari_hiki2s`

from `work_hacchuu_vws` `c`
union all select

`d`.`shouhin_mr_cd`,
`d`.`tantou_mr_cd`,
`d`.`tanni_mr1_cd`,
`d`.`tanni_mr2_cd`,
`d`.`iro`,
`d`.`iromei`,
`d`.`lot`,
`d`.`kobetucd`,
`d`.`hinsitu_kbn_cd`,
`d`.`hinsitu_hyouka_kbn_cd`,
'' AS `souko_mr_cd`,
NULL AS `nyuukobis`,
NULL AS `shukkobis`,
NULL AS `nyuushukkobi`,
'' AS `nyuushukkoym`,
'juchuu' AS `denpyou_mr_cd`,
`d`.`id`,
`d`.`cd`,
`d`.`meisai_id`,
`d`.`meisai_cd`,
`d`.`utiwake_kbn_cd`,
`d`.`torihikisaki_cd`,
`d`.`bikou`,
0 AS `zaiko_ryou1`,
0 AS `zaiko_ryou2`,
`d`.`tanka_tanni_mr_cd`,
'0000-00-000' AS `shiirebi_tankas`,
0 AS `shiire_gakus`,
0 AS `shiire_ryou1s`,
0 AS `shiire_ryou2s`,
0 AS `hokanyuuko_ryou1s`,
0 AS `hokanyuuko_ryou2s`,
0 AS `uriage_ryou1s`,
0 AS `uriage_ryou2s`,
0 AS `hokashukko_ryou1s`,
0 AS `hokashukko_ryou2s`,
NULL AS `shiiresaki_mr_cd`,
`d`.`tokuisaki_mr_cd`,
`d`.`nounyuu_kijitu`,
`d`.`nouki`,
0 AS `hacchuu_dt_id`,
`d`.`juchuu_dt_id`,
0 AS `hacchuuzan_ryou1`,
0 AS `hacchuuzan_ryou2`,
`d`.`juchuuzan_ryou1`,
`d`.`juchuuzan_ryou2`,
0 AS `azukari_zan1s`,
0 AS `azukari_zan2s`,
0 AS `azukari_tasi1s`,
0 AS `azukari_tasi2s`,
0 AS `azukari_hiki1s`,
0 AS `azukari_hiki2s`

from `work_juchuu_vws` `d`
union all select

`e`.`shouhin_mr_cd`,
`e`.`tantou_mr_cd`,
`e`.`tanni_mr1_cd`,
`e`.`tanni_mr2_cd`,
`e`.`iro`,
`e`.`iromei`,
`e`.`lot`,
`e`.`kobetucd`,
`e`.`hinsitu_kbn_cd`,
`e`.`hinsitu_hyouka_kbn_cd`,
`e`.`souko_mr_cd`,
`e`.`nyuukobis`,
NULL AS `shukkobis`,
`e`.`nyuushukkobi`,
`e`.`nyuushukkoym`,
`e`.`denpyou_mr_cd`,
`e`.`id`,
`e`.`cd`,
`e`.`meisai_id`,
`e`.`meisai_cd`,
'1' AS `utiwake_kbn_cd`,
`e`.`torihikisaki_cd`,
`e`.`bikou`,
`e`.`zaiko_ryou1s`,
`e`.`zaiko_ryou2s`,
`e`.`tanka_tanni_mr_cd`,
`e`.`shiirebi_tankas`,
`e`.`shiire_gakus`,
`e`.`shiire_ryou1s`,
`e`.`shiire_ryou2s`,
`e`.`hokanyuuko_ryou1s`,
`e`.`hokanyuuko_ryou2s`,
0 AS `uriage_ryou1s`,
0 AS `uriage_ryou2s`,
0 AS `hokashukko_ryou1s`,
0 AS `hokashukko_ryou2s`,
NULL AS `shiiresaki_mr_cd`,
`e`.`tokuisaki_mr_cd`,
NULL AS `nounyuu_kijitu`,
NULL AS `nouki`,
0 AS `hacchuu_dt_id`,
0 AS `juchuu_dt_id`,
0 AS `hacchuuzan_ryou1`,
0 AS `hacchuuzan_ryou2`,
0 AS `juchuuzan_ryou1`,
0 AS `juchuuzan_ryou2`,
0 AS `azukari_zan1s`,
0 AS `azukari_zan2s`,
0 AS `azukari_tasi1s`,
0 AS `azukari_tasi2s`,
0 AS `azukari_hiki1s`,
0 AS `azukari_hiki2s`

from `work_nyuuko_vws` `e`
union all select

`f`.`shouhin_mr_cd`,
`f`.`tantou_mr_cd`,
`f`.`tanni_mr1_cd`,
`f`.`tanni_mr2_cd`,
`f`.`iro`,
`f`.`iromei`,
`f`.`lot`,
`f`.`kobetucd`,
`f`.`hinsitu_kbn_cd`,
`f`.`hinsitu_hyouka_kbn_cd`,
`f`.`souko_mr_cd`,
NULL AS `nyuukobis`,
`f`.`shukkobis`,
`f`.`nyuushukkobi`,
`f`.`nyuushukkoym`,
`f`.`denpyou_mr_cd`,
`f`.`id`,
`f`.`cd`,
`f`.`meisai_id`,
`f`.`meisai_cd`,
'0' AS `utiwake_kbn_cd`,
`f`.`torihikisaki_cd`,
`f`.`bikou`,
`f`.`zaiko_ryou1s`,
`f`.`zaiko_ryou2s`,
`f`.`tanka_tanni_mr_cd`,
'0000-00-000' AS `shiirebi_tankas`,
0 AS `shiire_gakus`,
0 AS `shiire_ryou1s`,
0 AS `shiire_ryou2s`,
0 AS `hokanyuuko_ryou1s`,
0 AS `hokanyuuko_ryou2s`,
`f`.`uriage_ryou1s`,
`f`.`uriage_ryou2s`,
`f`.`hokashukko_ryou1s`,
`f`.`hokashikko_ryou2s`,
NULL AS `shiiresaki_mr_cd`,
`f`.`tokuisaki_mr_cd`,
NULL AS `nounyuu_kijitu`,
NULL AS `nouki`,
0 AS `hacchuu_dt_id`,
0 AS `juchuu_dt_id`,
0 AS `hacchuuzan_ryou1`,
0 AS `hacchuuzan_ryou2`,
0 AS `juchuuzan_ryou1`,
0 AS `juchuuzan_ryou2`,
0 AS `azukari_zan1s`,
0 AS `azukari_zan2s`,
0 AS `azukari_tasi1s`,
0 AS `azukari_tasi2s`,
0 AS `azukari_hiki1s`,
0 AS `azukari_hiki2s`

from `work_shukko_vws` `f`
union all select

`g`.`shouhin_mr_cd`,
`g`.`tantou_mr_cd`,
`g`.`tanni_mr1_cd`,
`g`.`tanni_mr2_cd`,
`g`.`iro`,
`g`.`iromei`,
`g`.`lot`,
`g`.`kobetucd`,
`g`.`hinsitu_kbn_cd`,
`g`.`hinsitu_hyouka_kbn_cd`,
`g`.`souko_mr_cd`,
NULL AS `nyuukobis`,
`g`.`shukkobis`,
`g`.`nyuushukkobi`,
`g`.`nyuushukkoym`,
`g`.`denpyou_mr_cd`,
`g`.`id`,
`g`.`cd`,
`g`.`meisai_id`,
`g`.`meisai_cd`,
'0' AS `utiwake_kbn_cd`,
`g`.`torihikisaki_cd`,
`g`.`bikou`,
0 AS `zaiko_ryou1s`,
0 AS `zaiko_ryou2s`,
`g`.`tanka_tanni_mr_cd`,
'0000-00-000' AS `shiirebi_tankas`,
0 AS `shiire_gakus`,
0 AS `shiire_ryou1s`,
0 AS `shiire_ryou2s`,
0 AS `hokanyuuko_ryou1s`,
0 AS `hokanyuuko_ryou2s`,
0 AS `uriage_ryou1s`,
0 AS `uriage_ryou2s`,
0 AS `hokashukko_ryou1s`,
0 AS `hokashukko_ryou2s`,
NULL AS `shiiresaki_mr_cd`,
`g`.`tokuisaki_mr_cd`,
NULL AS `nounyuu_kijitu`,
NULL AS `nouki`,
0 AS `hacchuu_dt_id`,
0 AS `juchuu_dt_id`,
0 AS `hacchuuzan_ryou1`,
0 AS `hacchuuzan_ryou2`,
0 AS `juchuuzan_ryou1`,
0 AS `juchuuzan_ryou2`,
`g`.`azukari_zan1s`,
`g`.`azukari_zan2s`,
0 AS `azukari_tasi1s`,
0 AS `azukari_tasi2s`,
`g`.`azukari_hiki1s`,
`g`.`azukari_hiki2s`

from `work_azuchou_vws` `g`

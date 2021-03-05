drop VIEW `work_azuchou_vws`;
CREATE VIEW `work_azuchou_vws` AS select 
`a`.`shouhin_mr_cd` AS `shouhin_mr_cd`,
`b`.`tantou_mr_cd` AS `tantou_mr_cd`,
`a`.`tanni_mr1_cd` AS `tanni_mr1_cd`,
`a`.`tanni_mr2_cd` AS `tanni_mr2_cd`,
`a`.`iro` AS `iro`,
`a`.`iromei` AS `iromei`,
`a`.`lot` AS `lot`,
`a`.`kobetucd` AS `kobetucd`,
`a`.`hinsitu_kbn_cd` AS `hinsitu_kbn_cd`,
`d`.`hinsitu_hyouka_kbn_cd` AS `hinsitu_hyouka_kbn_cd`,
`b`.`souko_mr_cd` AS `souko_mr_cd`,
NULL AS `nyuukobis`,
`b`.`henkanbi` AS `shukkobis`,
`b`.`henkanbi` AS `nyuushukkobi`,
date_format(`b`.`henkanbi`,'%Y%m') AS `nyuushukkoym`,
`c`.`denpyou_mr_cd` AS `denpyou_mr_cd`,
`b`.`id` AS `id`,
`b`.`cd` AS `cd`,
`a`.`id` AS `meisai_id`,
`a`.`cd` AS `meisai_cd`,
'0' AS `utiwake_kbn_cd`,
`b`.`tokuisaki_mr_cd` AS `torihikisaki_cd`,
`a`.`bikou` AS `bikou`,
0 AS `zaiko_ryou1s`,
0 AS `zaiko_ryou2s`,
if(`a`.`tanka_kbn`=1,`a`.`tanni_mr1_cd`,`a`.`tanni_mr2_cd`) AS tanka_tanni_mr_cd,
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
`b`.`tokuisaki_mr_cd` AS `tokuisaki_mr_cd`,
NULL AS `nounyuu_kijitu`,
NULL AS `nouki`,
0 AS `hacchuu_dt_id`,
0 AS `juchuu_dt_id`,
0 AS `hacchuuzan_ryou1`,
0 AS `hacchuuzan_ryou2`,
0 AS `juchuuzan_ryou1`,
0 AS `juchuuzan_ryou2`,
(0 - `a`.`suuryou1`) AS `azukari_zan1s`,
(0 - `a`.`suuryou2`) AS `azukari_zan2s`,
0 AS `azukari_tasi1s`,
0 AS `azukari_tasi2s`,
`a`.`suuryou1` AS `azukari_hiki1s`,
`a`.`suuryou2` AS `azukari_hiki2s`
from (((`zaiko_henkan_meisai_dts` `a` 
join `zaiko_henkan_dts` `b` on((`b`.`id` = `a`.`zaiko_henkan_dt_id`))) 
join `zaiko_henkan_kbns` `c` on((`c`.`cd` = `b`.`zaiko_henkan_kbn_cd`))) 
join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) 
where ((`a`.`henkansaki_flg` <> 1) and (`c`.`azuchou_flg` <> 0))
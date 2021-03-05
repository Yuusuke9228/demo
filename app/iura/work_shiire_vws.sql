drop VIEW `work_shiire_vws`;
CREATE VIEW `work_shiire_vws` AS select 
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
`a`.`souko_mr_cd` AS `souko_mr_cd`,
(case `c`.`shiire_zaiko_flg` when 1 then `b`.`shiirebi` else NULL end) AS `nyuukobis`,
(case `c`.`shiire_zaiko_flg` when -(1) then `b`.`shiirebi` else NULL end) AS `shukkobis`,
`b`.`shiirebi` AS `nyuushukkobi`,
date_format(`b`.`shiirebi`,'%Y%m') AS `nyuushukkoym`,
'shiire' AS `denpyou_mr_cd`,
`b`.`id` AS `id`,
`b`.`cd` AS `cd`,
`a`.`id` AS `meisai_id`,
`a`.`cd` AS `meisai_cd`,
`a`.`utiwake_kbn_cd` AS `utiwake_kbn_cd`,
`b`.`shiiresaki_mr_cd` AS `torihikisaki_cd`,
`a`.`bikou` AS `bikou`,
(`a`.`suuryou1` * `c`.`shiire_zaiko_flg`) AS `zaiko_ryou1s`,
(`a`.`suuryou2` * `c`.`shiire_zaiko_flg`) AS `zaiko_ryou2s`,
if(`a`.`tanka_kbn`=1,`a`.`tanni_mr1_cd`,`a`.`tanni_mr2_cd`) AS tanka_tanni_mr_cd,
(case 
when (`a`.`utiwake_kbn_cd` < 20) then convert(concat(`b`.`shiirebi`,`a`.`tanka`) using utf8mb4) 
when (`a`.`utiwake_kbn_cd` = 20) then convert(concat(`b`.`shiirebi`,`a`.`gentanka`) using utf8mb4) 
else '0000-00-000' end) AS `shiirebi_tankas`,
(case 
when (`a`.`utiwake_kbn_cd` < 20) then `a`.`zeinukigaku` 
when (`a`.`utiwake_kbn_cd` = 20) then `a`.`genkagaku` 
else 0 end) AS `shiire_gakus`,
(case `c`.`shiire_zaiko_flg` when 1 then `a`.`suuryou1` else 0 end) AS `shiire_ryou1s`,
(case `c`.`shiire_zaiko_flg` when 1 then `a`.`suuryou2` else 0 end) AS `shiire_ryou2s`,
0 AS `hokanyuuko_ryou1s`,
0 AS `hokanyuuko_ryou2s`,
0 AS `uriage_ryou1s`,
0 AS `uriage_ryou2s`,
(case `c`.`shiire_zaiko_flg` when -(1) then `a`.`suuryou1` else 0 end) AS `hokashukko_ryou1s`,
(case `c`.`shiire_zaiko_flg` when -(1) then `a`.`suuryou2` else 0 end) AS `hokashukko_ryou2s`,
`b`.`shiiresaki_mr_cd` AS `shiiresaki_mr_cd`,
NULL AS `tokuisaki_mr_cd`,
NULL AS `nounyuu_kijitu`,
NULL AS `nouki`,
`b`.`hacchuu_dt_id` AS `hacchuu_dt_id`,
0 AS `juchuu_dt_id`,
(case 
when (`b`.`hacchuu_dt_id` > 0) then (0 - (`a`.`suuryou` * `c`.`hacchuu_zan_flg`)) 
else 0 end) AS `hacchuuzan_ryou1`,
(case 
when (`b`.`hacchuu_dt_id` > 0) then (0 - (`a`.`suuryou2` * `c`.`hacchuu_zan_flg`)) 
else 0 end) AS `hacchuuzan_ryou2`,
0 AS `juchuuzan_ryou1`,
0 AS `juchuuzan_ryou2`,
(`a`.`suuryou1` * `c`.`shiire_azukari_flg`) AS `azukari_zan1s`,
(`a`.`suuryou2` * `c`.`shiire_azukari_flg`) AS `azukari_zan2s`,
(case `c`.`shiire_azukari_flg` when 1 then `a`.`suuryou1` else 0 end) AS `azukari_tasi1s`,
(case `c`.`shiire_azukari_flg` when 1 then `a`.`suuryou2` else 0 end) AS `azukari_tasi2s`,
(case `c`.`shiire_azukari_flg` when -(1) then `a`.`suuryou1` else 0 end) AS `azukari_hiki1s`,
(case `c`.`shiire_azukari_flg` when -(1) then `a`.`suuryou2` else 0 end) AS `azukari_hiki2s` 
from (((`shiire_meisai_dts` `a` 
join `shiire_dts` `b` on((`b`.`id` = `a`.`shiire_dt_id`))) 
join `utiwake_kbns` `c` on((`c`.`cd` = `a`.`utiwake_kbn_cd`))) 
join `hinsitu_kbns` `d` on((`d`.`cd` = `a`.`hinsitu_kbn_cd`))) 
where ((`c`.`shiire_zaiko_flg` <> 0) or (`c`.`hacchuu_zan_flg` <> 0) or (`c`.`shiire_azukari_flg` <> 0))

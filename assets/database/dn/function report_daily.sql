DROP FUNCTION IF EXISTS `report_daily`;
CREATE FUNCTION `report_daily`(`v_date` date,`v_id_downtime` int,`v_shift` int,`v_machine` int) RETURNS int(11)
BEGIN
	#Routine body goes here...
	DECLARE jml INT;
	SELECT count(*) INTO jml FROM log_book a
	LEFT JOIN log_book_det_time b on a.id = b.id_log_book
	WHERE a.date = v_date and b.CODE = v_id_downtime and a.shift = v_shift and a.machine = v_machine;

	RETURN jml;
END
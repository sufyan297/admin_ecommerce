BEGIN
	IF NOT EXISTS( SELECT NULL
	            FROM INFORMATION_SCHEMA.COLUMNS
	           WHERE table_name = TABLE_NAME
	         AND table_schema = DB_NAME
	             AND column_name = COL_NAME)  THEN
	
	  SET @ddl = CONCAT ('alter table ', TABLE_NAME,' add column (', COL_NAME,' VARCHAR(50))');
	  PREPARE STMT FROM @ddl;
	  EXECUTE STMT;
	END IF;
END

/* Create Code */

/*

	CREATE DEFINER=`krerum_main`@`localhost` PROCEDURE `add_column_all_items`(IN `COL_NAME` VARCHAR(50), IN `DB_NAME` VARCHAR(50), IN `TABLE_NAME` VARCHAR(50))
	LANGUAGE SQL
	NOT DETERMINISTIC
	CONTAINS SQL
	SQL SECURITY DEFINER
	COMMENT ''
BEGIN
	IF NOT EXISTS( SELECT NULL
	            FROM INFORMATION_SCHEMA.COLUMNS
	           WHERE table_name = TABLE_NAME
	         AND table_schema = DB_NAME
	             AND column_name = COL_NAME)  THEN
	
	  SET @ddl = CONCAT ('alter table ', TABLE_NAME,' add column (', COL_NAME,' VARCHAR(50))');
	  PREPARE STMT FROM @ddl;
	  EXECUTE STMT;
	END IF;
END



*/
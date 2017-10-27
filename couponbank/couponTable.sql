/*
1. Coupon code
2. Coupon serial number
3. Coupon value
4. Coupon Expiry Date
*/
CREATE TABLE `earlyfoo_efood`.`coupon_bank` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `serial_number` INT(24) NOT NULL , `coupon_code` INT(24) NOT NULL , `coupon_value` FLOAT NOT NULL , `expiry_date` TIMESTAMP NOT NULL , `coupon_status` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

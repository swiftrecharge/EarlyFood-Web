CREATE TABLE coupon_codes(
	id int(11) NOT NULL AUTO_INCREMENT,
	user_id int(11) foreign key NOT NULL,
	code VARCHAR(255) NOT NULL,
	value FLOAT NOT NULL,
	date_time TIMESTAMP NOT NULL,
	PRIMARY KEY(id)
)
CREATE TABLE couponBank(
	id int NOT NULL AUTO_INCCREMENT,
	coupon_code VARCHAR(255) NOT NULL,
	code_value int(11) NOT NULL,
	expiry_date TIMESTAMP NOT NULL,
	status  boolean NOT NILL,
	PRIMARY KEY (coupon_code)
)
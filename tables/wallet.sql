CREATE TABLE user_wallet(
	id int(11) NOT NULL AUTO_INCREMENT,
	user_id int(11) foreign key NOT NULL,
	balance int(11) NOT NULL,
	date_time TIMESTAMP NOT NULL,
	transaction_details text NOT NULL,
	transaction_charges FLOAT NOT NULL,
	PRIMARY KEY(id)  
)
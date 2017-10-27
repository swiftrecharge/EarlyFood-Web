CREATE TABLE restaurant_openTime (
	id INT(11) NOT NULL AUTO_INCREMENT,
	restaurant_id INT(11) NOT NULL,
	monday TEXT NOT NULL,
	tuesday TEXT NOT NULL,
	wednesday TEXT NOT NULL,
	thursday TEXT NOT NULL,
	friday TEXT NOT NULL,
	saturday TEXT NOT NULL,
	sunday TEXT NOT NULL,
	PRIMARY KEY (id)
);
CREATE TABLE restaurant_closeTime (
	id INT(11) NOT NULL AUTO_INCREMENT,
	restaurant_id INT(11) NOT NULL,
	monday TEXT NOT NULL,
	tuesday TEXT NOT NULL,
	wednesday TEXT NOT NULL,
	thursday TEXT NOT NULL,
	friday TEXT NOT NULL,
	saturday TEXT NOT NULL,
	sunday TEXT NOT NULL,
	PRIMARY KEY (id)
);
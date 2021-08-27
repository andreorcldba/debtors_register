## Execute aplication in Apache server (https://httpd.apache.org/docs/) PHP 7.3

# Run compose (https://getcomposer.org/doc/)
composer install
# debtors_register
 debt registration software

# DATABASE (MySQL)

CREATE TABLE users (
  id bigint NOT NULL AUTO_INCREMENT,
  email varchar(255) NOT NULL,
  pass varchar(255) NOT NULL,
  active boolean NOT NULL DEFAULT true,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (email)
);

CREATE TABLE company (
  id bigint NOT NULL AUTO_INCREMENT,
  email varchar(255) NOT NULL,
  address varchar(100) DEFAULT NULL,
  telephone varchar(14) DEFAULT NULL,
  cnpj varchar(18) NOT NULL,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (cnpj)
);

CREATE TABLE debtor (
  id bigint NOT NULL AUTO_INCREMENT,
  company_id bigint NOT NULL,
  type_cod char(6) NOT NULL,
  cod varchar(18) NOT NULL,
  date_of_birth date DEFAULT NULL,
  email varchar(255) NOT NULL,
  address varchar(100) DEFAULT NULL,
  description varchar(200) NOT NULL,
  value float(10,2) NOT NULL,
  expiration date not null,
  created_at timestamp NOT NULL,
  updated_at timestamp NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (company_id,cod,type_cod),
  FOREIGN KEY (company_id) REFERENCES company (id)
);


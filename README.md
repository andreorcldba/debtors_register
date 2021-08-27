# debtors_register
 debt registration software


# DATABASE

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
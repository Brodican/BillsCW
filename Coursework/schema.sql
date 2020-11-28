 
drop table users;
CREATE TABLE users (ID Integer PRIMARY KEY, username varchar(16), email text, salt varchar(16), encrypted_pass varchar(16), household text, housepass_salt varchar(16), enc_housepass varchar(16));  
drop table bills;
CREATE TABLE bills (ID Integer PRIMARY KEY, user_ID Integer, link_ID Integer, bill text, price Integer, category varchar(10), household text, created date, complete Boolean);
drop table links;
CREATE TABLE links (bill_ID Integer, user_ID Integer, checkoff Boolean, count Integer);
drop table mainbills;
CREATE TABLE mainbills (ID Integer PRIMARY KEY, issuer_ID Integer, issuer_name varchar(16), bill text, price Integer, category varchar(10), household text, created date, confirmed text);

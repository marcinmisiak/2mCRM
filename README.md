2mCMR it's crm for call centers

It's made in Yii

dodanie uzytwkonika administratora

-- update users set password= SHA2('admin', 256) where username='admin';
insert into users (email, username,password,roles) 
values ('marcin1@wseip.edu.pl', 'admin1', SHA2('admin1', 256), 'administrator');

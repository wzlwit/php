create database BBshop;

use  BBshop;


create table if not exists tblUser 
(
  UserID int not null auto_increment,
  FirstName varchar(20) not null,
  LastName varchar(20) not null,
  email varchar(20) not null,
  Password varchar(20) not null  ,
  Address varchar(40) not null,
  City varchar(20) not null,
  State char(2) not null,
  Zip char(10) not null,
  Phone varchar(15) not null,
  constraint pk_tblUser primary key clustered (UserID asc)
  )
;

/* show columns from tblUser */
show columns from tblUser
;


create table if not exists tblProduct 
(
  ProID int not null auto_increment,
  ProName varchar(30) not null,
  ProDesc varchar(2000) not null,
  ProImg varchar(100) not null,
  ProPrice varchar(20) not null,
  InvQty varchar(20) not null  ,
  Active tinyint(1) not null,
  constraint pk_tblProduct primary key clustered (ProID asc)
  )
;

/* show columns from tblProduct */
show columns from tblProduct
;


create table if not exists tblItem 
(
  ItemID int not null auto_increment,
  UserID int not null,
  TotalQty int not null default 0,
  TotalPrice DECIMAL(10, 2) not null default 0,
  PaymentMethod varchar(20) not null,
  IsPayed tinyint(1) not null default 0 ,
  constraint pk_tblItem primary key clustered (ItemID asc)
  )
;

/* show columns from tblItem */
show columns from tblItem
;


create table if not exists tblOrder 
(
  OrderID int not null auto_increment,
  ItemID int not null,
  ProID int not null,
  UnitPrice DECIMAL(10, 2) not null,
  Qty int not null,
  constraint pk_tblOrder primary key clustered (OrderID asc)
  )
;

/* show columns from tblItem */
show columns from tblOrder
;

/* Data intigrity   */
alter table tblItem
	add constraint fk_tblItem_tblUser foreign key (UserID)
		references tblUser (UserID)
;

alter table tblOrder
	add constraint fk_tblOrder_tblItem foreign key (ItemID)
		references tblItem (ItemID)
;

alter table tblOrder
	add constraint fk_tblOrder_tblProduct foreign key (ProID)
		references tblProduct (ProID)
;
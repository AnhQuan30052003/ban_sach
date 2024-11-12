-- In SQL Server --

create database quanlybansach
use quanlybansach

create table loai_sach (
	maLS varchar(4) primary key,
	tenLS nvarchar(100)
)

create table sach (
	maSach varchar(4) primary key,
	tenSach nvarchar(100),
	maLS varchar(4) foreign key references loai_sach(maLS),
	moTa nvarchar(256),
	giaTien int,
	soLuong int,
	tacGia nvarchar(256),
	hinhAnh nvarchar(256)
)

create table khach_hang (
	ma varchar(4) primary key,
	ten nvarchar(100),
	email varchar(100),
	sdt varchar(10),
	matKhau varchar(50),
	diaChi nvarchar(200)
)

create table admin (
	ma varchar(4) primary key,
	ten nvarchar(100),
	email varchar(100),
	sdt varchar(10),
	matKhau varchar(50)
)

create table sach_yeu_thich (
	ma varchar(4) foreign key references khach_hang(ma),
	maSach varchar(4) foreign key references sach(maSach),
)
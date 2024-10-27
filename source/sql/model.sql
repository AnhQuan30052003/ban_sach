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
	maKH varchar(4) primary key,
	tenKH nvarchar(100),
	email varchar(100),
	matKhau varchar(50),
)

create table sach_yeu_thich (
	maSYT varchar(4) primary key,
	maKH varchar(4) foreign key references khach_hang(maKH),
	maSach varchar(4) foreign key references sach(maSach),
)
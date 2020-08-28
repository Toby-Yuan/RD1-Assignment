CREATE database rd1 DEFAULT character set utf8;

USE rd1;

-- 抓取一般天氣預報-36hr
CREATE TABLE city36hr(
    id int not null auto_increment primary key,
    locationName varchar(10) not null,
    wxName varchar(20) not null,
    wxValue int not null,
    popValue int not null
);

-- 抓取氣象站現在天氣
CREATE TABLE town(
    id int not null auto_increment primary key,
    cityName varchar(10) not null,
    townName varchar(10) not null,
    townNum int not null,
    temp int not null,
    D_tx int not null,
    D_tn int not null
);

-- 抓取雨量站累積雨量
CREATE TABLE rain(
    id int not null auto_increment primary key,
    townNum int not null,
    rain int not null,
    hour24 int not null,
    dayRain int not null
);
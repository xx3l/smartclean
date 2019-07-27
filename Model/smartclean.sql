create table map
(
   map_id               int not null auto_increment,
   map_name             varchar(100) not null,
   primary key (map_id)
);

alter table map comment 'Карта';

create table point
(
   point_id             int not null auto_increment,
   map_id               int not null,
   lat                  double not null,
   lon                  double not null,
   height               double,
   primary key (point_id)
);

alter table point comment 'Точка на карте';

create table ref_transport
(
   ref_transport_id     int not null auto_increment,
   transport_name       varchar(100) not null,
   width                float default 2,
   speed                float default 10,
   max_loading          float,
   active               int4 not null default 1,
   primary key (ref_transport_id)
);

alter table ref_transport comment 'Справочник: Снегоуборочная техника';

create table route_point
(
   route_point_id       int not null auto_increment,
   transport_id         int not null,
   lat                  double not null,
   lon                  double not null,
   num                  int not null,
   planned_time         timestamp,
   primary key (route_point_id)
);

alter table route_point comment 'Таблица маршрута движения для каждого транспорта (данные мен';

create index Index_route_num on route_point
(
   num
);

create table snow_dump
(
   snow_dump_id         int not null auto_increment,
   snow_dump_name       varchar(100),
   snow_dump_lat        double,
   snow_dump_lon        double,
   primary key (snow_dump_id)
);

alter table snow_dump comment 'Пункт сброса снега (заполняется оператором)';

create table street
(
   street_id            int not null auto_increment,
   p1                   int not null,
   p2                   int not null,
   width                float not null,
   len                  float not null,
   active               int not null default 1,
   primary key (street_id)
);

alter table street comment 'Улица';

create table transport
(
   transport_id         int not null auto_increment,
   ref_transport_id     int not null,
   gibdd_number         varchar(30) not null,
   active               int4 not null default 1,
   current_lat          double,
   current_lon          double,
   primary key (transport_id)
);

alter table transport comment 'Снегоуборочная техника (одна единица)';

alter table point add constraint FK_POINT_REFERENCE_MAP foreign key (map_id)
      references map (map_id) on delete restrict on update restrict;

alter table route_point add constraint FK_ROUTE_PO_REFERENCE_TRANSPOR foreign key (transport_id)
      references transport (transport_id) on delete restrict on update restrict;

alter table street add constraint FK_STREET_REF1_POINT foreign key (p1)
      references point (point_id) on delete restrict on update restrict;

alter table street add constraint FK_STREET_REF2_POINT foreign key (p2)
      references point (point_id) on delete restrict on update restrict;

alter table transport add constraint FK_TRANSPOR_REFERENCE_REF_TRAN foreign key (ref_transport_id)
      references ref_transport (ref_transport_id) on delete restrict on update restrict;


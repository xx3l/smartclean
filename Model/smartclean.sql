create table map
(
   map_id               int not null auto_increment  comment '',
   map_name             varchar(100) not null  comment 'Наименование карты'
);

alter table map comment 'Карта';

INSERT INTO `map`(`map_name`) VALUES ('Тестовая модель');

create table point
(
   point_id             bigint not null  comment '',
   map_id               int not null  comment '',
   lat                  double not null  comment 'ширина',
   lon                  double not null  comment 'долгота',
   height               double  comment 'высота над уровнем моря'
);

alter table point comment 'Точка на карте';

create index Index_point_lat on point
(
   lat
);

create index Index_point_lon on point
(
   lon
);

create table ref_transport
(
   ref_transport_id     int not null auto_increment  comment '',
   transport_name       varchar(100) not null  comment '',
   width                float default 2  comment 'ширина уборки в метрах',
   speed                float default 10  comment 'скорость км/ч',
   max_loading          float  comment 'максимальная нагрузка в тоннах',
   active               int4 not null default 1  comment ''
);

alter table ref_transport comment 'Справочник: Снегоуборочная техника';

INSERT INTO `ref_transport`(`transport_name`) VALUES ('Снегоуборочная машина');

create table route_point
(
   route_point_id       int not null auto_increment  comment '',
   transport_id         int not null  comment '',
   lat                  double not null  comment 'ширина',
   lon                  double not null  comment 'долгота',
   num                  int not null  comment 'порядковый номер (для сортировки)',
   planned_time         timestamp  comment 'планируемое время посещения точки машиной'
);

alter table route_point comment 'Таблица маршрута движения для каждого транспорта (данные мен';

create index Index_route_num on route_point
(
   num
);

create table snow_dump
(
   snow_dump_id         int not null auto_increment  comment '',
   snow_dump_name       varchar(100)  comment 'Название пункта',
   snow_dump_lat        double  comment 'Координата пункта сброса снега (широта)',
   snow_dump_lon        double  comment 'Координата пункта сброса снега долгота)'
);

alter table snow_dump comment 'Пункт сброса снега (заполняется оператором)';

create table street
(
   street_id            bigint not null auto_increment  comment '',
   p1                   bigint not null  comment 'Начальная точка',
   p2                   bigint not null  comment 'Конечная точка',
   path_id              bigint  comment 'Open street map PATH_ID',
   one_way              int not null default 1  comment '',
   width                float not null default 3.5  comment 'Ширина улицы в метрах',
   len                  float not null  comment 'Длина улицы в метрах',
   priority             int not null default 1  comment 'Приоритетная улица (выставляется оператором)',
   active               int not null default 1  comment '1 - можно ездить, 0 - нельзя ездить, ремонт'
);

alter table street comment 'Улица';

create table transport
(
   transport_id         int not null auto_increment  comment '',
   ref_transport_id     int not null  comment '',
   gibdd_number         varchar(30) not null  comment 'Номер машины',
   active               int4 not null default 1  comment '',
   current_lat          double  comment 'Текущее местоположение машины (широта).',
   current_lon          double  comment 'Текущее местоположение машины (долгота)'
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

